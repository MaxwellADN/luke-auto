<?php

$this->access('Moniteur');
$id = intval($this->_url[1]);
$result = mysqli_query($this->_sql, "SELECT * FROM courses WHERE id=$id");
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	if(isset($_POST['submit']))
	{
		$appreciation = mysqli_real_escape_string($this->_sql, $_POST['appreciation']);
		mysqli_query($this->_sql, "UPDATE courses SET appreciation='$appreciation' WHERE id=$id");
		$_SESSION['POPUP'] = 'Appréciation modifiée avec succès !';
		$this->redirect('monitor#tabs-2');
	}
}
else
{
	$this->redirect('404');
}

?>
<h2>Espace moniteur de <?php echo $this->_currentUser; ?></h2>
<h3>Appréciation du <?php echo date('d/m/Y à H:i', $row['date']); ?></h3>
<form name="edit" method="post">
	<p>
		<textarea name="appreciation"><?php echo $row['appreciation']; ?></textarea>
	</p>
	<p>
		<input type="submit" name="submit" value="Enregistrer">
		<a href="?monitor#tabs-2" class="button">Retour</a>
	</p>
</form>