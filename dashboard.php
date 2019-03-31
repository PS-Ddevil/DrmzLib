<html>
<head>
    <title>SinhaLib| Beyond the World of Letters</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script> 
    
    <!-- Style Sheets -->
    <link href="css/style-dash.css" type="text/css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Gochi+Hand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet"> 
    
</head>
<body style="background-image:url(img/pexels-photo-747964.jpeg); background-position: center; background-attachment: fixed;background-repeat: no-repeat;background-size: cover">
    <?php 
        if(isset($_GET["bookid"])){
            $id = $_GET["bookid"];
//            echo $id;
        }else{
            $id = "000";
            header('Location: index.php');
//            echo $id;
        }
    ?>
    <?php include 'connect.php' ?>
    
    <?php
        $sql = "SELECT * FROM ".$datatable." WHERE book_id = '".$id."';";
//        echo $sql;
        $re_result = $conn->query($sql);
        if($row = $re_result->fetch_assoc()){
            $name = $row["book_name"];
            $sql2 = "SELECT * FROM author WHERE author_id = ".$row["author_id"].";";
            $result_2 = $conn->query($sql2);
            while($row2 = $result_2->fetch_assoc()){
                $author = $row2["name"];
                $author_pic = $row2["pic"];
            }
            $genre = $row["genre"];
            $lang = $row["language"];
            $image = $row["image"];
            $des = $row["description"];
        }
        if($name == NULL){
            header('Location: index.php'); 
        }
    ?>
    
    <div class="container" style="background-color: rgba(255,255,255,0.9); margin-top: 100px; margin-bottom: 100px;">
        <h2 id="book_name"><?php echo $name ?> | (<?php echo $id ?>)</h2>
        <center><img src= '<?php echo $image ?>' width="25%"></center>
        <br>
        <hr>
        <h4 id="heads">Author:</h4>
        <h5 id="subheads"><?php echo $author ?></h5>
        <img src= '<?php echo $author_pic ?>' width="20%">
        <?php echo "<a href='author_display.php?page=1&author=".$row["author_id"]."'>View All Books</a>" ?>
        <hr>
        <h4 id="heads">Genre:</h4>
        <h5 id="subheads"><?php echo $genre ?></h5>
        <hr>
        <h4 id="heads">Language:</h4>
        <h5 id="subheads"><?php echo $lang ?></h5>
        <hr>
        <h4 id="heads">Description:</h4>
        <h5 id="subheads"><?php echo $des ?></h5>
        <hr>
        <a href="index.php" style="text-align: right">Back to Home</a>
    </div>
    
</body>
</html>