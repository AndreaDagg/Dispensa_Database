<?

if (isset($_GET['BARCODE'])) {

    //echo "http://databasedispensa.altervista.org/getFromAndroid.php?BRAND=pasta&TYPE=zucchero&BARCODE=8022647300109&CATEGORY=ALI&IMAGE= <br/><br/> LOG: " . htmlspecialchars($_GET["BRAND"]) . " " . htmlspecialchars($_GET["TYPE"]) . " " . htmlspecialchars($_GET["CATEGORY"]) . " " . htmlspecialchars($_GET["BARCODE"]) . "<br/>";

    $Databse = "my_databasedispensa";
    $Host = "localhost";
    $Username = "";
    $Password = "";

    // Create connection
    $connection = mysqli_connect($Host, $Username, $Password, $Databse);
    // Check connection
    if (!$connection) {
        die("LOG: Connection failed: " . mysqli_connect_error());
    }
    //echo "LOG: Connected successfully " . "<br/>";

    $barcode = $_GET["BARCODE"];
    $querySelect = "SELECT * FROM prodotti WHERE idbarcode='$barcode'";
    $resultQuery = $connection->query($querySelect);

    //Check if barcode exist
    if ($resultQuery->num_rows > 0) {

       // echo "LOG: true <br/>";

        //TODO:delete echo
        while ($data = mysqli_fetch_array($resultQuery)) {
           /* echo "id: " . $data['id'] . " - ";
            echo "Marca: " . $data['brand'] . " - ";
            echo "Tipo: " . $data['producttype'] . " - ";
            echo "Categoria: " . $data['category'] . "<br/><br/>";*/

            $Product = array('DB_brand' => $data['brand'], 'DB_type' => $data['producttype'], 'DB_barcode' => $data['idbarcode'], 'DB_category' => $data['category'], 'DB_image' => $data['image'], 'DB_islist' => $data['islist'], 'DB_newbuy' => $data['newbuy'], 'DB_note' => $data['note']);
            echo json_encode($Product);
            return json_encode($Product);
        }
    } else if (isset($_GET['BRAND']) && isset($_GET['TYPE']) && isset($_GET['BARCODE']) && isset($_GET['CATEGORY'])) {

        $brand = $_GET["BRAND"];
        $type = $_GET["TYPE"];
        $category = $_GET["CATEGORY"];
        $image = $_GET['IMAGE'];

        $queryInsert = "INSERT INTO prodotti(id,idbarcode,category,brand,producttype,image,islist,newbuy,note) 
                    VALUES (null, '$barcode','$category', '$brand', '$type','$image',null ,null ,null )";

        if ($connection->query($queryInsert)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $queryInsert . "<br>" . $connection->error;
        }
    } else {
        echo "LOG: false";
    }
}
?>
