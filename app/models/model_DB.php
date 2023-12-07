<?php

use \RedBeanPHP\R as R;					

class Model_DB extends Model
{
	
	//метод получает из таблицы uservk запись о пользователе и возвращает в виде массива
	public function get_userArray ($findUserName)	{	// 
		
		$user = R::findOne('uservk', 'LOGIN = ?', [$findUserName]);

		if (is_null ($user)) return false;
		else {
		$userarray ['login'] = $user->login;
		$userarray ['password'] = $user->password;
		$userarray ['sault'] = $user->sault;
		$userarray ['role'] = $user->role;
	
		return $userarray;
	}
}	
	// метод вставляет в БД строку с логином, паролью, солью и ролью
	public function insert_data( $login, $password, $sault, $role)	{	

			$create = R::dispense('uservk');          // создание таблицы 
			$create->login = $login;
			$create->password = $password;
			$create->sault= $sault;
			$create->role = $role;

			//Записываем объект в БД
			R::store($create);

	}

}