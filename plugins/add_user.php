<?php

$this->access('Secrétaire');
if(isset($_POST['submit']))
{
	$password = md5($_POST['password']);
	$access = intval($_POST['access']);
	$lastname = mysqli_real_escape_string($this->_sql, strtoupper($_POST['lastname']));
	$firstname = mysqli_real_escape_string($this->_sql, $_POST['firstname']);
	$birthday = strtotime($_POST['birthday']);
	$mail = mysqli_real_escape_string($this->_sql, $_POST['mail']);
	$address = mysqli_real_escape_string($this->_sql, $_POST['address']);
	$postal = intval($_POST['postal']);
	$city = mysqli_real_escape_string($this->_sql, $_POST['city']);
	$registration = time();
	mysqli_query($this->_sql, "INSERT INTO users (id, password, access, lastname, firstname, birthday, mail, address, postal, city, registration) VALUES ('', '$password', $access, '$lastname', '$firstname', $birthday, '$mail', '$address', $postal, '$city', $registration)");
	$_SESSION['POPUP'] = 'Élève créé avec succès !';
	$this->redirect('secretariat');
}

?>
<h2>Espace secrétariat de <?php echo $this->_currentUser; ?></h2>
<h3>Créer un utilisateur</h3>
<form name="add" method="post">
	<p>
		<label>Nom</label>
		<input type="text" name="lastname" required>
	</p>
	<p>
		<label>Prénom</label>
		<input type="text" name="firstname" required>
	</p>
	<p>
		<label>Date de naissance</label>
		<input type="text" name="birthday" class="datepicker" readonly required>
	</p>
	<p>
		<label>Adresse mail</label>
		<input type="text" name="mail" required>
	</p>
	<p>
		<label>Adresse</label>
		<input type="text" name="address" required>
	</p>
	<p>
		<label>Code postal</label>
		<input type="text" name="postal" required>
	</p>
	<p>
		<label>Ville</label>
		<input type="text" name="city" required>
	</p>
	<p>
		<label>Type d'utilisateurs</label>
		<select name="access" required>
			<option value="Élève">Élève</option>
			<option value="Moniteur">Moniteur</option>
			<option value="Secrétaire">Secrétaire</option>
		</select>
	</p>
	<p>
		<label>Mot de passe</label>
		<input type="password" name="password" required>
	</p>
	<p>
		<input type="submit" name="submit" value="Enregistrer">
		<a href="?secretariat" class="button">Retour</a>
	</p>
</form>