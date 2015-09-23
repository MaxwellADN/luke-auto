<?php

$this->access('Secrétaire');
$result = mysqli_query($this->_sql, 'SELECT c.*, s.firstname AS sfirstname, s.lastname AS slastname, m.firstname AS mfirstname, m.lastname AS mlastname FROM courses c JOIN users s ON c.student = s.id JOIN users m ON c.monitor = m.id ORDER by date DESC');
while($row = mysqli_fetch_array($result))
{
	@$courses .= '<tr>'.
				'<td>'. date('d/m/Y à H:i', $row['date']) .'</td>'.
				'<td>'. $row['duration'] .'</td>'.
				'<td>'. $row['type'] .'</td>'.
				'<td>'. $row['mlastname'] .' '. $row['mfirstname'] .'</td>'.
				'<td>'. $row['slastname'] .' '. $row['sfirstname'] .'</td>'.
				'<td><a href="?edit_courses/'. $row['id'] .'"><img src="template/css/images/pencil.png" title="Modifier" alt="Modifier"></a> <a href="?delete_courses/'. $row['id'] .'" onclick="return confirm(\'Confirmer la suppression.\')"><img src="template/css/images/delete.png" title="Supprimer" alt="Supprimer"></a></td>'.
				'</tr>';
}
$result = mysqli_query($this->_sql, 'SELECT * FROM users ORDER by lastname ASC');
while($row = mysqli_fetch_array($result))
{
	@$users .= '<tr>'.
				'<td>'. $row['lastname'] .' '.  $row['firstname'] .'</td>'.
				'<td>'. $row['mail'] .'</td>'.
				'<td>'. $row['access'] .'</td>'.
				'<td><a href="?edit_user/'. $row['id'] .'"><img src="template/css/images/pencil.png" title="Modifier" alt="Modifier"></a> <a href="?delete_user/'. $row['id'] .'" onclick="return confirm(\'Confirmer la suppression.\')"><img src="template/css/images/delete.png" title="Supprimer" alt="Supprimer"></a></td>'.
				'</tr>';
}

?>
<h2>Espace secrétariat de <?php echo $this->_currentUser; ?></h2>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Utilisateurs</a></li>
		<li><a href="#tabs-2">Cours</a></li>
	</ul>
	<div id="tabs-1">
		<table>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Adresse mail</th>
					<th>Type de compte</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php echo @$users; ?>
			</tbody>
		</table>
		<p>
			<a href="?add_user" class="button">Créer un utilisateur</a>
		</p>
	</div>
	<div id="tabs-2">
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Durée (en heure)</th>
					<th>Type de cours</th>
					<th>Moniteur</th>
					<th>Élève</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php echo @$courses; ?>
			</tbody>
		</table>
		<p>
			<a href="?add_courses" class="button">Créer un cours</a>
		</p>
	</div>
</div>