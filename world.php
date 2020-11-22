<?php

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['country']) and !preg_match("/[^( ,\.\-\(\)\w)]/", $_GET['country'])){
      $country=$_GET['country'];
      $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
      echo "Invalid query string";
      die();
    }
  }
}catch(Exception $e){
  die($e->getMessages());
}
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
