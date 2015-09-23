<?php

$this->access('Moniteur');
$id = intval($this->_rowUser['id']);
$result = mysqli_query($this->_sql, "SELECT c.*, u.firstname, u.lastname FROM courses c INNER JOIN users u ON c.student = u.id WHERE c.monitor=$id ORDER by date DESC");
$num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result))
{
	$date = date('d/m/Y à H:i', $row['date']);
	if(time() > $row['date'])
	{
		$edit = empty($row['appreciation']) ? 'Ajouter' : 'Modifier';
		@$history .= '<tr>'.
					'<td>'. $date .'</td>'.
					'<td>'. $row['duration'] .'</td>'.
					'<td>'. $row['type'] .'</td>'.
					'<td>'. $row['lastname'] .' '. $row['firstname'] .'</td>'.
					'<td>'. $row['appreciation'] .'</td>'.
					'<td><a href="?edit_appreciation/'. $row['id'] .'"><img src="template/css/images/pencil.png" title="'. $edit .' appréciation" alt="'. $edit .' appréciation"></a></td>'.
					'</tr>';
	}
	else
	{
		@$upcoming .= '<tr>'.
					'<td>'. $date .'</td>'.
					'<td>'. $row['duration'] .'</td>'.
					'<td>'. $row['type'] .'</td>'.
					'<td>'. $row['lastname'] .' '. $row['firstname'] .'</td>'.
					'</tr>';
	}
}

?>
<h2>Espace moniteur de <?php echo $this->_currentUser; ?></h2>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Cours à venir</a></li>
		<li><a href="#tabs-2">Historique des cours</a></li>
	</ul>
	<div id="tabs-1">
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Durée (en heure)</th>
					<th>Type de cours</th>
					<th>Élève</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php echo @$upcoming; ?>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="tabs-2">
		<form name="monitor" method="post">
			<table>
				<thead>
					<tr>
						<th>Date</th>
						<th>Durée (en heure)</th>
						<th>Type de cours</th>
						<th>Élève</th>
						<th>Appréciations</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php echo @$history; ?>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>