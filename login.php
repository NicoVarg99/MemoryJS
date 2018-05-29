<?php
  session_start();

  if (isset($_GET["name"])) {
    $_SESSION["name"] = $_GET["name"];
    header("Location: /");
  }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>JQuery Memory Game</title>
		<link rel="stylesheet" href="style.css">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
		<!-- <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> -->
	</head>
	<body>
		<div class="container">
			<h1>JQuery Memory Game</h1>
			<hr>
  		<div class="container center_div">
  			<form>
  			    <label>Your name</label>
  			    <label class="sr-only">Name</label>
  			    <input type="name" class="form-control" name="name" required>
            <br>
  			    <button type="submit" class="btn btn-primary">Play</button>
  			</form>
  		</div>
			<hr>
			<div class="footer">
  			<p>Nicola Salsotto</p>
			</div>
		</div>
	</body>
</html>
