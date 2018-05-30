<?php

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "memory";


$conn = new mysqli($servername, $username, $password, $dbname); // Create connection

if ($conn->connect_error)
  die("Connection failed: " . $conn->connect_error);

header('Content-Type: application/json');
$level = mysqli_real_escape_string($conn, htmlspecialchars($_GET["level"]));

if ($_GET["q"] == "getLeaderboard") {
  $sql = "SELECT * FROM `leaderboard` WHERE `level` = $level ORDER BY `moves` ASC";
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
} else if ($_GET["q"] == "postResult") {
  $name = mysqli_real_escape_string($conn, htmlspecialchars($_GET["name"]));
  $moves = mysqli_real_escape_string($conn, htmlspecialchars($_GET["moves"]));

  $sql = "SELECT * FROM `leaderboard` WHERE `level` = $level AND `name` = '$name' AND `moves` <= $moves";
  $result = $conn->query($sql);

  if ($result->num_rows == 0) {
    $sql = "INSERT INTO `leaderboard` (`name`, `level`, `moves`) VALUES ('$name', '$level', '$moves') ON DUPLICATE KEY UPDATE moves='$moves', timestamp=CURRENT_TIMESTAMP";

    if ($conn->query($sql) === TRUE)
      $json = json_encode(array('status' => true, 'msg' => 'New personal record'));
    else
      $json = json_encode(array('status' => false, 'msg' => 'SQL Error:' . $sql . " - " . $conn->error));
  } else {
    $json = json_encode(array('status' => false, 'msg' => 'Personal record not beaten.'));
  }
}

$conn->close();
echo $json;

?>
