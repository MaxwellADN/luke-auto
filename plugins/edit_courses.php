<?php

$this->access('Secrétaire');
$id = intval($this->_url[1]);
$result = mysqli_query($this->_sql, "SELECT * FROM courses WHERE id=$id");
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	if(isset($_POST['submit']))
	{
		$student = intval($_POST['student']);
		$monitor = intval($_POST['monitor']);
		$date = explode('/', $_POST['date']);
		$date = strtotime($date[2] . $date[1] . $date[0] . $_POST['time']);
		$duration = intval($_POST['duration']);
		$type = mysqli_real_escape_string($this->_sql, $_POST['type']);
		mysqli_query($this->_sql, "UPDATE courses SET student=$student, monitor=$monitor, date=$date, duration=$duration, type='$type' WHERE id=$id");
		$_SESSION['POPUP'] = 'Cours modifié avec succès !';
		$this->redirect('secretariat#tabs-2');
	}
	else
	{
		$time = date('H:i', $row['date']);
		$resultUsers = mysqli_query($this->_sql, 'SELECT * FROM users ORDER by lastname ASC');
		while($rowUsers = mysqli_fetch_array($resultUsers))
		{
			switch($rowUsers['access'])
			{
				case 'Élève':
					$selected = ($rowUsers['id'] == $row['student']) ? ' selected' : false;
					@$students .= '<option value="'. $rowUsers['id'] .'"'. $selected .'>'. $rowUsers['lastname'] .' '. $rowUsers['firstname'] .'</option>';
					break;
				case 'Moniteur':
					$selected = ($rowUsers['id'] == $row['monitor']) ? ' selected' : false;
					@$monitors .= '<option value="'. $rowUsers['id'] .'"'. $selected .'>'. $rowUsers['lastname'] .' '. $rowUsers['firstname'] .'</option>';
					break;
			}
		}
	}
}
else
{
	$this->redirect('404');
}

?>
<h2>Espace secrétariat de <?php echo $this->_currentUser; ?></h2>
<h3>Modifier le cours du <?php echo date('d/m/Y à H:i', $row['date']); ?></h3>
<form name="edit" method="post">
	<p>
		<label>Élève</label>
		<select name="student" required>
			<?php echo $students; ?>
		</select>
	</p>
	<p>
		<label>Moniteur</label>
		<select name="monitor" required>
			<?php echo $monitors; ?>
		</select>
	</p>
	<p>
		<label>Date</label>
		<input type="text" name="date" value="<?php echo date('d/m/Y', $row['date']); ?>" class="datepicker" readonly required>
	</p>
	<p>
		<label>Heure</label>
		<select name="time" required>
			<option value="09:00" <?php echo ($time == '09:00') ? 'selected' : false; ?>>09:00</option>
			<option value="10:00" <?php echo ($time == '10:00') ? 'selected' : false; ?>>10:00</option>
			<option value="11:00" <?php echo ($time == '11:00') ? 'selected' : false; ?>>11:00</option>
			<option value="14:00" <?php echo ($time == '14:00') ? 'selected' : false; ?>>14:00</option>
			<option value="15:00" <?php echo ($time == '15:00') ? 'selected' : false; ?>>15:00</option>
			<option value="16:00" <?php echo ($time == '16:00') ? 'selected' : false; ?>>16:00</option>
		</select>
	</p>
	<p>
		<label>Durée (en heure)</label>
		<select name="duration" required>
			<option value="1" <?php echo ($row['duration'] == 1) ? 'selected' : false; ?>>1</option>
			<option value="2" <?php echo ($row['duration'] == 2) ? 'selected' : false; ?>>2</option>
		</select>
	</p>
	<p>
		<label>Type de cours</label>
		<select name="type" required>
			<option value="Code" <?php echo ($row['type'] == 'Code') ? 'selected' : false; ?>>Code</option>
			<option value="Auto" <?php echo ($row['type'] == 'Auto') ? 'selected' : false; ?>>Auto</option>
			<option value="Moto" <?php echo ($row['type'] == 'Moto') ? 'selected' : false; ?>>Moto</option>
		</select>
	</p>
	<p>
		<input type="submit" name="submit" value="Enregistrer">
		<a href="?secretariat#tabs-2" class="button">Retour</a>
	</p>
</form>