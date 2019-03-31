<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_data";
$_author = $_POST["author"];
$conn = mysqli_connect($servername, $username, $password, $dbname) or die($link);
$author =  addslashes($_POST["author"]);
echo "<p>";
$author_id = rand(10000000, 999999999);
$ext = end(explode('.', $_FILES["image"]["name"]));
$name = $author_id.'.'.$ext;
$upload_dir = "img/author/".$name;
if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir)) {
//  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

$sql = "INSERT INTO author(author_id, name, pic) VALUES('".$author_id."','".$author."','".$upload_dir."')";

if(mysqli_query($conn, $sql)){
    header("Location: index.php");
}else{
    echo "Error: ".$sql."<br>".mysqli_error($conn);
}

// echo readfile("submitted.html");
mysqli_close($conn);
?>