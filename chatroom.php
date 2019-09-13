<?php
    $dbhandle = new PDO("sqlite:scrabble.sqlite") or die("Failed to open DB");
    if (!$dbhandle) die ($error);
 
     
      $verb = $_SERVER["REQUEST_METHOD"];
      
      if ($verb == "GET"){
          
          $query = "SELECT * from Chat";
          $statement = $dbhandle->prepare($query);
          $statement->execute();
          $results = $statement->fetchAll(PDO::FETCH_ASSOC);
          
      } else if ($verb == "POST"){
          $author = "anonymous";
          $content = "secret message";
          if (isset($_POST["author"])){
              $author = $_POST["author"];
          }
          if (isset($_POST["content"])){
              $content = $_POST["content"];
          }
          $query =  "INSERT INTO Chat VALUES(".$author.",".$content.")";
          $statement = $dbhandle->prepare($query);
          $statement->execute();

      } else {
          echo "USAGE GET or POST";
      }

     
 
    header('HTTP/1.1 200 OK');
    header('Content-Type: application/json');
    echo json_encode($results);
?>