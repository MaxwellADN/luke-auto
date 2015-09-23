<?php

if(isset($_POST['submit']))
{
	$mail = mysqli_real_escape_string($this->_sql, $_POST['mail']);
	$password = md5($_POST['password']);
	$result = mysqli_query($this->_sql, "SELECT * FROM users WHERE mail='$mail' AND password='$password'");
	if(mysqli_num_rows($result) > 0)
	{
		for($i = 0; $i < 100; $i++)
		{
			@$session .= rand('0', '9');
		}
		$session = md5($session);
		setcookie('SESSION', $session, time() + 1800); 
		mysqli_query($this->_sql, "UPDATE users SET session='$session' WHERE mail='$mail'");
		$this->redirect('login');
	}
	else
	{
		$_SESSION['POPUP'] = 'Identifiants incorrects !';
		$this->redirect('login');
	}
}
if($this->getRowUser('id') !== false)
{
	switch($this->getRowUser('access'))
	{
		case 'Moniteur':
			$this->redirect('monitor');
			break;
		case 'Secrétaire':
			$this->redirect('secretariat');
			break;
		default:
			$this->redirect('student');
	}
}

?>
<h2>Espace personnel</h2>
<form name="login" method="post">
	<p>
		<label>Adresse mail</label>
		<input type="text" name="mail" class="small">
	</p>
	<p>
		<label>Mot de passe</label>
		<input type="password" name="password" class="small">
	</p>
	<p>
		<input type="submit" name="submit" value="Connexion">
	</p>
</form>