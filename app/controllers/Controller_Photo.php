<?php


class Controller_Photo extends Controller
{

	public function __construct()	 {	

	  	$this->view = new View();	
	}

	function action_index()	{	

		$data = [
            'permissions' => [],                      // разрешения для ролей
            'imageFileName' => 'Desert.jpg'           // картинка
		];

      if (isset ($_SESSION['vk']) && $_SESSION['vk'] == false) {           // роль - не пользователь VK
               $role = 'notvk';
         } elseif (isset ($_SESSION['vk']) && $_SESSION['vk'] == true) {
               $role = 'vk';                                               // роль - пользователь VK
      }; 

      if ($role =='vk')  {                                                 //  распределяем разрешения в зависимости от роли
         $data ['permissions'] [] = 'Veiwtext';                         
         $data ['permissions'][] = 'Veiwpicture'; 
      } else {
         $data ['permissions'][] = 'Veiwtext';
      }
      
		$this->view->generate('photo_view.php', 'template_view.php', $data);	
	}

}