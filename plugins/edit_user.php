<?php

$this->access('Secrétaire');
$id = intval($this->_url[1]);
$result = mysqli_query($this->_sql, "SELECT * FROM users WHERE id=$id");
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	if(isset($_POST['submit']))
	{
		$password = empty($_POST['password']) ? $row['password'] : md5($_POST['password']);
		$lastname = mysqli_real_escape_string($this->_sql, strtoupper($_POST['lastname']));
		$firstname = mysqli_real_escape_string($this->_sql, $_POST['firstname']);
		$birthday = strtotime($_POST['birthday']);
		$mail = mysqli_real_escape_string($this->_sql, $_POST['mail']);
		$address = mysqli_real_escape_string($this->_sql, $_POST['address']);
		$postal = intval($_POST['postal']);
		$city = mysqli_real_escape_string($this->_sql, $_POST['city']);
		mysqli_query($this->_sql, "UPDATE users SET password='$password', lastname='$lastname', firstname='$firstname', birthday=$birthday, mail='$mail', address='$address', postal=$postal, city='$city' WHERE id=$id");
		$_SESSION['POPUP'] = 'Élève modifié avec succès !';
		$this->redirect('secretariat');
	}
}
else
{
	$this->redirect('404');
}

?>
<h2>Espace secrétariat de <?php echo $this->_currentUser; ?></h2>
<h3>Modifier l'utilisateur <?php echo $row['lastname'] .' '. $row['firstname']; ?></h3>
<form name="edit" method="post">
	<p>
		<label>Nom</label>
		<input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" required>
	</p>
	<p>
		<label>Prénom</label>
		<input type="text" name="firstname" value="<?php echo $row['firstname']; ?>" required>
	</p>
	<p>
		<label>Date de naissance</label>
		<input type="text" name="birthday" value="<?php echo date('m/d/Y', $row['birthday']); ?>" class="datepicker" readonly required>
	</p>
	<p>
		<label>Adresse mail</label>
		<input type="text" name="mail" value="<?php echo $row['mail']; ?>" required>
	</p>
	<p>
		<label>Adresse</label>
		<input type="text" name="address" value="<?php echo $row['address']; ?>" required>
	</p>
	<p>
		<label>Code postal</label>
		<input type="text" name="postal" value="<?php echo $row['postal']; ?>" required>
	</p>
	<p>
		<label>Ville</label>
		<input type="text" name="city" value="<?php echo $row['city']; ?>" required>
	</p>
	<p>
		<label>Type d'utilisateurs</label>
		<select name="access" required>
			<option value="Élève" <?php echo ($row['access'] == 'Élève') ? 'selected' : false; ?>>Élève</option>
			<option value="Moniteur" <?php echo ($row['access'] == 'Moniteur') ? 'selected' : false; ?>>Moniteur</option>
			<option value="Secrétaire" <?php echo ($row['access'] == 'Secrétaire') ? 'selected' : false; ?>>Secrétaire</option>
		</select>
	</p>
	<p>
		<label>Nouveau mot de passe</label>
		<input type="password" name="password">
	</p>
	<p>
		<input type="submit" name="submit" value="Enregistrer">
		<a href="?secretariat" class="button">Retour</a>
	</p>
</form>