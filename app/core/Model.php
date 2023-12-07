<?php

use \RedBeanPHP\R as R;				// используем эту ORM 

class Model							
{

	public function __construct () {
		
		R::setup( 'mysql:host='. HOST.';dbname='.DB_NAME, USER, PASSWORD );
		//R::setup( 'mysql:host=localhost;dbname=test', 'root', '' );
	}

}