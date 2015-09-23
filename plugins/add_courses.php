<?php

$this->access('Secrétaire');
if(isset($_POST['submit']))
{
	$student = intval($_POST['student']);
	$monitor = intval($_POST['monitor']);
	$date = explode('/', $_POST['date']);
	$date = strtotime($date[2] . $date[1] . $date[0] . $_POST['time']);
	$duration = intval($_POST['duration']);
	$type = mysqli_real_escape_string($this->_sql, $_POST['type']);
	mysqli_query($this->_sql, "INSERT INTO courses (id, student, monitor, date, duration, type) VALUES ('', $student, $monitor, $date, $duration, '$type')");
	$_SESSION['POPUP'] = 'Cours créé avec succès !';
	$this->redirect('secretariat#tabs-2');
}
else
{
	$result = mysqli_query($this->_sql, 'SELECT * FROM users ORDER by lastname ASC');
	while($row = mysqli_fetch_array($result))
	{
		switch($row['access'])
		{
			case 'Élève':
				@$students .= '<option value="'. $row['id'] .'">'. $row['lastname'] .' '. $row['firstname'] .'</option>';
				break;
			case 'Moniteur':
				@$monitors .= '<option value="'. $row['id'] .'">'. $row['lastname'] .' '. $row['firstname'] .'</option>';
				break;
		}
	}
}

?>
<h2>Espace secrétariat de <?php echo $this->_currentUser; ?></h2>
<h3>Créer un cours</h3>
<form name="add" method="post">
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
		<input type="text" name="date" value="<?php echo date('d/m/Y', time()); ?>" class="datepicker" readonly required>
	</p>
	<p>
		<label>Heure</label>
		<select name="time" required>
			<option value="09:00">09:00</option>
			<option value="10:00">10:00</option>
			<option value="11:00">11:00</option>
			<option value="14:00">14:00</option>
			<option value="15:00">15:00</option>
			<option value="16:00">16:00</option>
		</select>
	</p>
	<p>
		<label>Durée (en heure)</label>
		<select name="duration" required>
			<option value="1">1</option>
			<option value="2">2</option>
		</select>
	</p>
	<p>
		<label>Type de cours</label>
		<select name="type" required>
			<option value="Code">Code</option>
			<option value="Auto">Auto</option>
			<option value="Moto">Moto</option>
		</select>
	</p>
	<p>
		<input type="submit" name="submit" value="Enregistrer">
		<a href="?secretariat#tabs-2" class="button">Retour</a>
	</p>
</form>