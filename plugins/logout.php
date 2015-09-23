<?php

setcookie('SESSION');
session_destroy();
$this->redirect('index');

?>