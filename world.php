<?php

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['country']) and !preg_match("/[^( ,\.\-\(\)\w)]/", $_GET['country'])){
      $query=$_GET['country'];
      $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$query%'");
      $contries = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

<table>
  <caption>List of Contries</caption>
  <thead>
      <tr>
          <th>Name</th>
          <th>Continent</th>
          <th>Independence Year</th>
          <th>Head of State</th>
      </tr>
  </thead>
  <tbody>
      <?php foreach ($contries as $country): ?>
      <tr>
          <td><?= $country['name']; ?></td>
          <td><?= $country['continent']; ?></td>
          <td><?= $country['independence_year']; ?></td>
          <td><?= $country['head_of_state']; ?></td>
      </tr>
      <?php endforeach; ?>
  </tbody>
</table>
      