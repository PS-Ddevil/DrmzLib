<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_data";
$_book_name = $_POST["book"];
$_author = $_POST["author"];
$_genre = $_POST["genre"];
$_lang = $_POST["lang"];
$_datatable = "book_details";
$_description = $_POST["sum"];
$_book_id = $_POST["book_id"];
$conn = mysqli_connect($servername, $username, $password, $dbname) or die($link);
// $book_name =  mysql_real_escape_string($link, $_POST["book"]);
// $author =  mysql_real_escape_string($link, $_POST["author"]);
// $genre =  mysql_real_escape_string($link, $_POST["genre"]);
// $lang =  mysql_real_escape_string($link, $_POST["lang"]);
// $description =  mysql_real_escape_string($link, $_POST["sum"]);
// $book_id =  mysql_real_escape_string($link, $_POST["book_id"]);
$book_name =  addslashes($_POST["book"]);
$author =  addslashes($_POST["author"]);
$genre =  addslashes($_POST["genre"]);
$lang =  addslashes($_POST["lang"]);
$description =  addslashes($_POST["sum"]);
$book_id =  addslashes($_POST["book_id"]);
// $upload_dir = "img/cover/";
// $upload_file = $upload_dir.basename($_FILES['image']['name']);
echo "<p>";

$ext = end(explode('.', $_FILES["image"]["name"]));
$name = $_POST["book_id"].'.'.$ext;
$upload_dir = "img/cover/".$name;
if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir)) {
//  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

$sql = "INSERT INTO book_details(book_id, book_name, author_id, genre, language, image, description) VALUES('".$book_id."','".$book_name."','".$author."','".$genre."','".$lang."','".$upload_dir."','".$description."')";
$sql2 = "INSERT INTO author_list(author_id, book_id) VALUES('".$author."','".$book_id."')";
if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
    header("Location: index.php");
}else{
    echo "Error: ".$sql."<br>".mysqli_error($conn);
}

// echo readfile("submitted.html");
mysqli_close($conn);
?>