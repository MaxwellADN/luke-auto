<?php

$this->access('Secrétaire');
$id = intval($this->_url[1]);
$result = mysqli_query($this->_sql, "SELECT * FROM users WHERE id=$id");
if(mysqli_num_rows($result) > 0)
{
	if($id == $this->_rowUser['id'])
	{
		$_SESSION['POPUP'] = 'Impossible de supprimer son propre compte !';
	}
	else
	{
		mysqli_query($this->_sql, "DELETE FROM users WHERE id=$id");
		$_SESSION['POPUP'] = 'Élève supprimé avec succès !';
	}
	$this->redirect('secretariat');
}
else
{
	$this->redirect('404');
}

?>