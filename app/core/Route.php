<?php


class Route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		 if ( !empty($routes[1]) )	 {	
		 	$controller_name = $routes[1];
		 }
		
		 //получаем имя экшена
		 if ( !empty($routes[2]) )	 {
		 	$action_name = $routes[2];
		 }

		$controller_name = 'Controller_'.ucfirst (strtolower($controller_name));  		//Controller_Main 

		$action_name = 'action_'.$action_name;						//action_index

		// подключаем файл с классом контроллера
		$controller_file = $controller_name.'.php';					//Controller_Main.php
		$controller_path = CONTROLLERS.$controller_file;

		if (file_exists($controller_path))	{
			include CONTROLLERS.$controller_file;					//   подключаем файл контроллера
		}
		else   {	
			Route::ErrorPage();			
			return;
		}
		
		// создаем контроллер
		$controller = new $controller_name;													
		$action = $action_name;										
		
		if (method_exists($controller, $action))	{
					$controller->$action(); 						// вызываем действие контроллера
		}				
		else   {
			Route::ErrorPage();						
			return;		
		}
	}

	public static function ErrorPage()
	{
		require_once CONTROLLERS.'Controller_404.php';												
		$controller = new Controller_404; 
		$controller->action_index();

         $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
         header('HTTP/1.1 404 Not Found');
		 header("Status: 404 Not Found");
		 header('Location:'.$host.'404');
    }
}