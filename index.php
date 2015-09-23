<?php

session_start();
class core
{
	private $_url;
	private $_popup;
	private $_sql;
	private $_resultUser;
	private $_numUser;
	private $_rowUser;
	private $_currentUser;
	public function __construct()
	{
		$this->_url = empty($_SERVER['QUERY_STRING']) ? 'index' : $_SERVER['QUERY_STRING'];
		$this->_url = explode('/', $this->_url);
		$this->_popup = empty($_SESSION['POPUP']) ? false : $_SESSION['POPUP'];
		$this->_sql = mysqli_connect('localhost', 'root', '', 'ppe');
		//$this->_sql = mysqli_connect('mysql51-111.perso', 'ctrlaltszmysql', 'AAqM2YRj5yhy', 'ctrlaltszmysql');
		mysqli_set_charset($this->_sql, 'utf8');
		if(!empty($_COOKIE['SESSION']))
		{
			$session = mysqli_real_escape_string($this->_sql, $_COOKIE['SESSION']);
			$this->_resultUser = mysqli_query($this->_sql, "SELECT * FROM users WHERE session='$session'");
			$this->_rowUser = mysqli_fetch_array($this->_resultUser);
			$this->_currentUser = $this->_rowUser['lastname'] .' '. $this->_rowUser['firstname'];
		}
	}
	public function getRowUser($value)
	{
		return isset($this->_rowUser[$value]) ? $this->_rowUser[$value] : false;
	}
	public function template()
	{
		ob_start();
		require 'template/index.html';
		return ob_get_clean();
	}
	public function popup()
	{
		if($this->_popup)
		{
			unset($_SESSION['POPUP']);
			return '<div id="popup">' . $this->_popup . '</div>';
		}
	}
	public function logout()
	{
		return ($this->getRowUser('id') == false) ? false : '<li><a href="?logout" onclick="return confirm(\'Confirmer la déconnexion\')">Déconnexion</a></li>';
	}
	public function builder()
	{
		if(file_exists('plugins/'. $this->_url[0] .'.php'))
		{
			require 'plugins/'. $this->_url[0] .'.php';
		}
		else
		{
			$this->redirect('404');
		}
	}
	public function access($value)
	{
		if($this->getRowUser('id') == false)
		{
			$this->redirect('login');
		}
		elseif($this->getRowUser('access') !== $value)
		{
			$this->redirect('403');
		}
	}
	public function redirect($url)
	{
		header('location:?'. $url);
		exit;
	}
}

$core = new core;
echo $core->template();

?>