<?php
	session_start();

	if (isset($_GET["logout"]))
		unset($_SESSION["name"]);

	if (!isset($_SESSION["name"])) {
		header("Location: /login.php");
		die();
	} else {
		if ($_SESSION["name"] == "") {
			header("Location: /?logout");
			die();
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>JQuery Memory Game</title>
		<script src="js/script.js"></script>
		<script src="js/leaderboard.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript">
			name = "<?php echo $_SESSION["name"]; ?>";
		</script>
		<link rel="stylesheet" href="style.css">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<!-- <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/minty/bootstrap.min.css" rel="stylesheet" integrity="sha384-4eGtnTOp6je5m6l1Zcp2WUGR9Y7kJZuAiD3Pk2GAW3uNRgHQSIqcrcAxBipzlbWP" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="https://bootswatch.com/4/minty/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> -->

	</head>
	<body onload="initialize()">
		<div class="container">
			<h1>JQuery Memory Game</h1>
			<div class="container" width="200px">
				<br>Welcome <?php echo $_SESSION["name"]; ?>, select the level:
				<div class="btn-group" role="group">
				  <button type="button" class="btn btn-primary" data-level="1">Easy</button>
				  <button type="button" class="btn btn-primary active" data-level="2">Medium</button>
				  <button type="button" class="btn btn-primary" data-level="3">Hard</button>
				</div>
				<button type="button" onclick="location.href='/?logout';" class="btn btn-outline-primary float-right">Logout</button>
			</div>
			<hr>
			<div class="alert alert-dismissible alert-success" style="display: none;">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4 class="alert-heading">Way to go!</h4>
				<p class="mb-0">Well done, you've just beaten your record.</p>
			</div>
			<div class="alert alert-dismissible alert-warning" style="display: none;">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <h4 class="alert-heading">Better luck next time!</h4>
			  <p class="mb-0">You didn't beat your record, try again.</p>
			</div>
			<div id="memTab"></div>
			<p id="moves">Moves: 0</p>
			<hr>
			<p>Leaderboard for the current difficulty</p>
			<table id="leaderboard" class="table table-striped">
			<thead>
				<tr class="table-success">
				 <th>Rank</th>
				 <th>Names</th>
				 <th>Moves</th>
				 <th>Timestamp</th>
				</tr>
			</thead>
		 	</table>
			<hr>
			<?php include("inc/footer.php"); ?>
		</div>
	</body>
</html>
