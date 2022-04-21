<?php
	session_start();
	require "functions.php";
?>

<?php include "/Applications/MAMP/htdocs/PA/stylesheet/template/header.php";?>


<head>
    <meta charset="utf-8">
	<meta name="Description" content="::" lang="FR">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet/css/style.css">
    <title></title>
</head>
<body id="registerBody">
	<div class="container">
		<div class="row mt-4">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<?php
					if(!empty($_SESSION['errors'])){
						print_r( $_SESSION['errors'] );
						unset($_SESSION['errors']);
						//session_destroy();
					}
				?>

				<form method="POST" action="addUser.php">

					<input type="email" class="form-control" name="email" placeholder="Votre email" required="required"><br>

					<input type="text" class="form-control" name="firstname" placeholder="Votre prénom"><br>
					<input type="text" class="form-control" name="lastname" placeholder="Votre nom"><br>
					<input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo"  required="required"><br>

					<input type="date" class="form-control" name="birthday" placeholder="Votre date de naissance"><br>

					<input type="password" class="form-control" name="password" placeholder="Votre mot de passe"  required="required"><br>
					<input type="password" class="form-control" name="passwordConfirm" placeholder="confirmation" required="required"><br>

					<select name="country" class="form-control">
						<option value="fr">France</option>
						<option value="pl">Pologne</option>
						<option value="ml">Mali</option>
					</select>

					<input type="checkbox" name="cgu"  required="required"> CGU <br>

					<input type="submit" class="btn btn-primary" value="S'inscrire">

				</form>
			</div>
		</div>
	</div>
</body>
<?php include "/Applications/MAMP/htdocs/PA/stylesheet/template/footer.php";?>