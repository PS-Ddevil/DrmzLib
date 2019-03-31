<!DOCTYPE html>
<html>
<head>
    <title>SinhaLib| Beyond the World of Letters</title>
    <link rel="icon" href="/img/Itzikgur-My-Seven-Books-2.ico" type="tmage/x-icon">
    
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
    <link href="css/style.css" type="text/css" rel="stylesheet">
    
    <!-- Font Stylesheet -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet"> 
</head>
<body style="background-image: url(img/BestBooks2016.jpg); background-attachment: fixed">
  <!-- Load an icon library to show a hamburger menu (bars) on small screens -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <div class="topnav" id="myTopnav">
    <a href="index.php"><img src="img/Itzikgur-My-Seven-Books-2.ico" width="50px"><img></a>
    <a class="nav-link" href="insert.html">Insert</a>
    <a class="nav-link" href="https://www.facebook.com/purushottam.sinha.31">Connect Fb</a>
    <a class="nav-link" href="add_author.html">Add Author</a>
    <a class="nav-link" href="authors.html">Authors</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div> 
    <div class="container" id="main-body">
        <img src="img/Itzikgur-My-Seven-Books-2.ico" style="width: 70px;">
        <span id="title">SinhaLib</span>
        <span id="subtitle">Beyond the World of Letters</span>
        <hr><hr>
    </div>
    <div class="container" id="second-body">
        <?php
            include 'connect.php';
        ?>
        <?php
//            echo $username;
            if(isset($_GET["page"])){$page = $_GET["page"];} else {$page=1;};
            $start_from = $start_var*results_per_page;
            $sql = "SELECT * FROM ".$datatable." LIMIT ".($page - 1)*$results_per_page.", ".$results_per_page.";";
          //  echo $sql;
//            echo $_GET["page"];
            $re_result = $conn->query($sql);
        ?>
        <table border="1" style="width:100%;" cellpadding="4">
        <?php 
            while($row = $re_result->fetch_assoc()){
        ?>
            <tr>
                <td id="image"><?php echo "<center><img src='".$row["image"]."' style='width:100px;'><center>" ?></td>
                <td id="book_name"><?php echo $row["book_name"] ?></td>
                <td id="Author">
                <?php 
                  $sql2 = "SELECT name FROM author WHERE author_id = ".$row["author_id"].";";
                  $result_2 = $conn->query($sql2);
                  while($row2 = $result_2->fetch_assoc())echo $row2["name"];
                ?></td>
                <td id="genre"><?php echo "<a href='dashboard.php?bookid=".$row["book_id"]."'>Open Dashboard</a>" ?></td>
            </tr>
        <?php
            };
        ?>
        </table>
        
        <?php 
        $sql = "SELECT COUNT(book_name) AS total FROM ".$datatable;
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

        for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                    echo "<a href='index.php?page=".$i."'";
                    if ($i==$page)  echo " class='curPage'";
                    echo ">".$i."</a> "; 
        }; 
        ?>
    </div>
    <script src="js/action.js"></script>
</body>
</html>