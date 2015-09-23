<?php

$this->access('Secrétaire');
$id = intval($this->_url[1]);
$result = mysqli_query($this->_sql, "SELECT * FROM courses WHERE id=$id");
if(mysqli_num_rows($result) > 0)
{
	mysqli_query($this->_sql, "DELETE FROM courses WHERE id=$id");
	$_SESSION['POPUP'] = 'Cours supprimé avec succès !';
	$this->redirect('secretariat#tabs-2');
}
else
{
	$this->redirect('404');
}

?>