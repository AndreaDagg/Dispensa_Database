<?php

$Databse = "my_databasedispensa";
$Host = "localhost";
$Username = "";
$Password = "";

// Create connection
$connection = mysqli_connect($Host, $Username, $Password, $Databse);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully " . "<br/>";

$query = "SELECT * FROM prodotti";

//Do query
$risultato = $connection->query($query);

while ($dati = mysqli_fetch_array($risultato)) {
    echo "id: " . $dati['id'] . " - ";
    echo "Marca: " . $dati['brand'] . " - ";
    echo "Tipo: " . $dati['producttype'] . " - ";
    echo "Categoria: " . $dati['category'] . "<br/>";
}

if (isset($_POST['submitButton'])) {
    echo $_POST['insertBrand'] . " - ";
    echo $_POST['insertType'] . " - ";
    echo $_POST['insertCategory'] . " - ";
    echo $_POST['insertBarcode'] . "<br/>";
    $barcode = $_POST['insertBarcode'];
    $brand = $_POST['insertBrand'];
    $type = $_POST['insertType'];
    $category = $_POST['insertCategory'];

    $queryInsert = "INSERT INTO prodotti(id,idbarcode,category,brand,producttype,image,islist,newbuy,note) 
                    VALUES (null, '$barcode','$category', '$brand', '$type',' ',null ,null ,null )";

    if ($connection->query($queryInsert)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $queryInsert . "<br>" . $connection->error;
    }
}

CloseCon($connection);

/*Close the DB connection*/
function CloseCon($conn) {
    $conn->close();
}

?>
