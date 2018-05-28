<?php

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "memory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: application/json');

if ($_GET["q"] == "getLeaderboard") {
  $level = $_GET["level"];
  $level = mysqli_real_escape_string($conn, $level);
  $sql = "SELECT * FROM `leaderboard` WHERE `level` = $level";
  $result = $conn->query($sql);
  $json = [];
  $i = 0;
  if ($result->num_rows > 0) //output data of each row
    while ($row = $result->fetch_assoc())
      array_push($json, array(
        'rank' => ++$i,
        'name' => $row["name"],
        'level' => $row["level"],
        'moves' => $row["moves"],
        'timestamp' => $row["timestamp"]
      ));
  $json = json_encode($json);
} else if ($_GET["q"] == "postRecord") {
  echo "POST RECORD";
  $name = $_GET["name"];
  $level = $_GET["level"];
  $moves = $_GET["moves"];
  echo $name;
  echo $level;
  echo $moves;
}

$conn->close();
echo $json;

?>
