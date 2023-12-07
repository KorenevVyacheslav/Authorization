<?php

use Monolog\Level;									// подключаем класс для создания лога
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Controller_Author extends Controller
{
	
	public function __construct()	{
		$this->model = new Model_DB();				// инициализация объекта модели БД
		$this->view = new View();					// инициализация объекта представления
	}

	public function action_index()	{
				
		$data = [								
			'errors' => [],							// массив ошибок
			'messages'=>[],							// массив сообщений
			'auth' => false,						// авторизация
			'token' => true,						// проверка токена CSRF
		];

		// обработка кнопки "Авторизация"
		if (isset($_POST['submit']) && isset ($_POST['login']) && isset ($_POST['password']))	{

			if (! CSRF::validate($_POST['token1']))	{						// проверка токена CSRF в форме авторизации
				$data ['errors'] [] ="Ошибка проверки токена!";
				$data['token'] = false;
			} else {

				$userarray=$this->model->get_userArray ($_POST['login']);	// токен проверен, извлекаем пользователя из БД
			
				if ($userarray) {

					if ($userarray['password'] == md5(md5(trim($_POST['password']), $userarray['sault'])))	{	// проверяем пароль пользователя

						setcookie("login", $userarray['login'], time()+60*60*24*7, "/");							// куки семь дней	
						$_SESSION['vk'] = false;																	// не будет права просмотра картинки		
						$data['messages'] [] = "Вы успешно авторизовались в системе и через несколько секунд 
						будете перенаправлены на страницу c фото";	
						$data['auth']=true;																			// авторизация
					} else {

			 			$data ['errors'] [] ="Вы ввели неправильный пароль";
				 		$log = new Logger('authlogger1');															// пишем лог
				 		$log->pushHandler(new StreamHandler('mylog1.log', Level::Info));
				 		$now=new Datetime();
				 		$log->info('неправильный пароль введен в ' . $now->format('c'));
					}
				} else {
					$data ['errors'] [] ="Такой пользователь не зарегистрирован";
					$log = new Logger('authlogger2');																// пишем лог
					$log->pushHandler(new StreamHandler('mylog1.log', Level::Info));
					$now=new Datetime();
		    		$log->info('неправильный логин введен в ' . $now->format('c'));
				}
			}
		}	
		$this->view->generate('author_view.php','template_view.php', $data);								// генерация изображения
	}
}

