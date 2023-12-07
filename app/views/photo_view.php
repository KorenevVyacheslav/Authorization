<html>
    <head>
        <title>Фотокарточка</title>
    </head>
    <body>
        <div class="container pt-4">
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h2>Добро пожаловать!</h2>
                </div>
            </div>      
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h3>Вы вошли как <?php echo $_COOKIE['login']?>
                        <?php if($_SESSION['vk'] == false): ?>
                                   , у вас нет прав на просмотр картинки </h3>
                        <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2">
                    <!-- Перебор разрешений-->
                    <?php foreach ($data['permissions'] as $permission): ?>
                        <?php if ($permission=='Veiwpicture'): ?>
                            <img src="<?php echo 'images'. DIRECTORY_SEPARATOR . $data['imageFileName'] ?>" class="img-thumbnail mb-4"
                            alt="<?php echo $data['imageFileName'] ?>">
                        <?php endif; ?>
                        <?php if ($permission=='Veiwtext'): ?>
                                <h6> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</h6>
                        <?php endif; ?>
                    <?php endforeach; ?>
                 </div>
            </div>
            <div class="row">
                <div class="col-auto mx-auto">
                    <h2><a href="/">Вернуться на главную страницу</a></h2>
                </div>
            </div> 
        </div> <!--/.container -->
    </body>
</html>