<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


try{
  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['country'], $_GET['context']) and !preg_match("/[^( ,\.\-\(\)\w)]/", $_GET['country'])){
      $country=$_GET['country'];
      $context=$_GET['context'];

      if($context==="cities"){
        $stmt=$conn->query("SELECT c.name, c.district, c.population 
         FROM cities c JOIN countries cs ON c.country_code = cs.code 
         WHERE cs.name = '$country'");
      }

      if ($context==="countries") {
        $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");       
      }
      
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
//var_dump($results);
?>

<table >
  <?php echo "<caption>List of $context</caption>";?>
  <thead>
    <tr>
    <?php 
      if($context==='countries'){
        echo "<th>Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
      }
      if ($context==='cities') {
        echo "<th>Name</th>";
        echo "<th>District</th>";
        echo "<th>Population</th>";
      }
    ?>
    </tr>
  </thead>
  <tbody>
      <?php 
        if ($context==="countries") {
          foreach ($results as $result):
            echo "<tr>";
            echo "<td>".$result['name']."</td>";
            echo "<td>".$result['continent']."</td>";
            echo "<td>".$result['independence_year']."</td>";
            echo "<td>".$result['head_of_state']."</td>";
            echo "</tr>";
          endforeach;
        }

        if ($context==="cities"){
          foreach ($results as $result):
            echo "<tr>";
            echo "<td>".$result['name']."</td>";
            echo "<td>".$result['district']."</td>";
            echo "<td>".$result['population']."</td>";
            echo "</tr>";
          endforeach;
        }
      ?>
  </tbody>
</table>
      