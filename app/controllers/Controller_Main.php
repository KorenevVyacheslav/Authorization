<?php

class Controller_Main extends Controller
{

	public function __construct()	{				
	 	$this->view = new View();						// инициализация объекта представления
	}

	function action_index()	{	

		// подготовка первого запроса для получения токена
		$clientId     = '1111111'; 						// ID приложения
		$redirectUri  = 'https://localhost.ru/vk'; 		// Адрес, на который будет переадресован пользователь после прохождения авторизации
		$clientSecret = parent::generateCode(10); 		// Защищённый ключ

   		// Формируем ссылку для авторизации
   		$params = array (
	    	'client_id'     => $clientId,
	    	'redirect_uri'  => $redirectUri,
	    	'response_type' => 'code',
	    	'v'             => '5.199', 					// (обязательный параметр) версии API https://vk.com/dev/versions
	   		// Права доступа приложения https://vk.com/dev/permissions
	    	// Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
	    	'scope'         => 'photos,offline'
   		);

   		// Обработка кнопки "Авторизация через VK". Отправлен запрос GET, получен ответ
   		// формируем запрос на получение токена
   		if (isset($_GET['code']))		{	

			$redirectUri  = 'https://localhost.ru/vk';		// Адрес, на который будет переадресован пользователь после получения токена  
														
			$params = array (
	   			'client_id'     => $clientId,
	   			'client_secret' => $clientSecret,
	   			'code'          => $_GET['code'],
	   			'redirect_uri'  => $redirectUri
			);
 
			// отправляем запрос
	   		if (!$content = @file_get_contents('https://oauth.vk.com/access_token?'. http_build_query($params))) {
			 	$error = error_get_last();
			 	throw new Exception('HTTP request failed. Error: ' . $error['message']);
			} 
			
			$response = json_decode($content);				// ответ получен
			
			// Если при получении токена произошла ошибка
	   		if (isset($response->error)) {
		  		throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
	   		} else {
  			//выполняем код, если все прошло хорошо
	   		$token = $response->access_token;   		// Токен
			$userId = $response->user_id;				// ID авторизовавшегося пользователя
			$_SESSION['token'] = $token;
			$_SESSION['user_id'] = $userId;
			}
		}

		// токен получен, извлекаем информацию о пользователе
		if (isset($_SESSION['token']))		{ 

			$params = array(
				'user_ids'     => $_SESSION['user_id'],
				'v' 		   => '5.199',
				'access_token' => $_SESSION['token'], 
				'fields' 	   => 'first_name,last_name'
		 	);

			// отправляем запрос
		 	if (!$content = @file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params))) {
				$error = error_get_last();
				throw new Exception('HTTP request failed. Error: ' . $error['message']);
			}

			$response = json_decode($content);

			if (isset($response->error)) {
				throw new Exception('При получении данных о пользователе произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
			} else {

				$response = $response->response;
				$firstName = $response->first_name;				// извлекаем имя
			 	$lastName = $response->last_name;				// извлекаем фамилию

			 	$_SESSION['vk'] = true;							// есть право просматривать фото

			 	setcookie("login", $firstName ." ". $lastName  , time()+60*60*24*7, "/");				// куки семь дней 
			 	unset ($_GET['code']); unset ($_SESSION['token']);										// чтобы запрос не сработал второй раз 		 																
			 	header("Location: http:\\photo");														// переход на главную страницу
			}
		}

   		$data = [								
			'auth' => false,									// авторизация
			'params' => http_build_query( $params ),			// запрос при нажатии кнопки
		];
   

	   	if (isset($_COOKIE['login'])) { 						// проверяем куки
			$data['auth'] = true;
		};	

		$this->view->generate('main_view.php', 'template_view.php', $data);		// генерация изображения
	}
}


