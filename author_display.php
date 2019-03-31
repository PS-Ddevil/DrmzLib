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
<body style="background-image: url(img/5c9cd3569ad30.png); background-attachment: fixed">
    <div class="container" style="z-index=3;background-color: rgba(255,255,255,0.9); margin-top: 100px; margin-bottom: 100px;">
    <?php
        include 'connect.php';
    ?>
    <?php
        if(isset($_GET["page"])){$page = $_GET["page"];} else {$page=1;};
        if(isset($_GET["author"])){$select_auth = $_GET["author"];} else {header('Location: index.php');};
        $start_from = $start_var*results_per_page;
        $sql = "SELECT * FROM book_details"." WHERE author_id = ".$select_auth." LIMIT ".($page - 1)*$results_per_page2.", ".$results_per_page.";";
        $sql2 = "SELECT * FROM author"." WHERE author_id = ".$select_auth.";";
        $re_result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        while($row2 = $result2->fetch_assoc()){$name_of_auth = $row2["name"]; $pic = $row2["pic"];};
        // echo $sql;
    ?>
    <center>
        <br>
        <img src= '<?php echo $pic ?>' width="25%">
        <br>
        <h2>Books by <?php echo $name_of_auth ?></h2>
    </center>
    <table border="1" style="width:100%;" cellpadding="4">
    <?php 
        while($row = $re_result->fetch_assoc()){
    ?>
        <tr>
            <td id="image"><?php echo "<center><img src='".$row["image"]."' style='width:100px;'><center>" ?></td>
            <td id="book_name"><?php echo $row["book_name"] ?></td>
            <td id="dash"><?php echo "<a href='dashboard.php?bookid=".$row["book_id"]."'>Open Dashboard</a>" ?></td>
        </tr>
    <?php
        };
    ?>
    </table>
    
    <?php 
    $sql = "SELECT COUNT(book_name) AS total FROM ".$datatable." WHERE author_id = ".$select_auth.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

    for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                echo "<a href='author_diaplay.php?page=".$i."&author=".$select_auth."'";
                if ($i==$page)  echo " class='curPage'";
                echo ">".$i."</a> "; 
    }; 
    ?>
    </div>
</body>
</html>