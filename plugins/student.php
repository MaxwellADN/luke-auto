<?php

$this->access('Élève');
$id = intval($this->_rowUser['id']);
$result = mysqli_query($this->_sql, "SELECT c.*, u.firstname, u.lastname FROM courses c INNER JOIN users u ON c.monitor = u.id WHERE c.student=$id ORDER by date DESC");
$num = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result))
{
	$date = date('d/m/Y à H:i', $row['date']);
	if(time() > $row['date'])
	{
		@$history .= '<tr>'.
					'<td>'. $date .'</td>'.
					'<td>'. $row['duration'] .'</td>'.
					'<td>'. $row['type'] .'</td>'.
					'<td>'. $row['lastname'] .' '. $row['firstname'] .'</td>'.
					'<td>'. $row['appreciation'] .'</td>'.
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
<h2>Espace élève de <?php echo $this->_currentUser; ?></h2>
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
					<th>Moniteur</th>
				</tr>
			</thead>
			<tbody>
				<?php echo @$upcoming; ?>
			</tbody>
		</table>
	</div>
	<div id="tabs-2">
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Durée (en heure)</th>
					<th>Type de cours</th>
					<th>Moniteur</th>
					<th>Appréciations</th>
				</tr>
			</thead>
			<tbody>
				<?php echo @$history; ?>
			</tbody>
		</table>
	</div>
</div>