<?php

class Controller_Logout extends Controller
{
	function action_index()	{	

		setcookie("login", "", time() - 3600*24*30*12, "/");	// уничтожаем куки
		session_destroy();
		header("Location: http:\\");
	}
}