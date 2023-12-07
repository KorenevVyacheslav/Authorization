<html>
    <head>
        <title>Галлерея</title>
    </head>
    <body>
        <div class="row">
            <div class="col-auto mx-auto"> 
                <h2>Добро пожаловать!</h2>
            </div>
        </div>
        <!-- Страница для неавторизованного пользователя  -->
        <?php if($data['auth'] == false): ?>
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h4> Авторизуйтесь или зарегистрируйтесь </h4>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-auto">
                        <div class="p-3 bg-light border"> 
                            <a href="/author">Авторизация</a> 
                        </div> 
                    </div>
                    <div class="col-md-auto">
                        <div class="p-3 bg-light border"> 
                            <a href="/register">Регистрация</a>  
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="p-3 bg-light border"> 
                            <a href="http://oauth.vk.com/authorize?<?php echo $data['params']?>">Авторизация через ВКонтакте</a>
                        </div> 
                    </div>
                </div>
            </div>
        <!-- Страница для авторизованного пользователя  -->
        <?php else: ?>
            <div class="row">
                <div class="col-auto mx-auto"> 
                    <h2>Вы вошли как <?php echo $_COOKIE['login']?> </h2>
                </div>
            </div>
            <div class="container pt-4">
                <div class="row">
                    <div class="col-auto mx-auto">
                        <h2 class="mb-4"><a href="/photo">Страница картинки</a></h2>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-auto mx-auto">    
                <div class="p-3 bg-light border"> 
                    <a href="/logout">Выход</a>  
                </div>
            </div>
        </div>
    </body>
</html>