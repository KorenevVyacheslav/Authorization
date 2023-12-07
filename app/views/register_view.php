<html>
    <head>
        <title>Регистрация</title>       
    </head>
    <body>
        <div class="container pt-4">
            <div class="row">
                <div class="col-auto mx-auto">
                    <h2 class="mb-4"><a href="<?php echo 'http:\\' ?>">Вернуться на главную страницу</a></h2>
                </div>
            </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Логин</label>
                            <input type="text" class="form-control" name="login" placeholder="Логин" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" placeholder="Пароль" required>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
        <?php foreach ($data['errors'] as $error): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <?php foreach ($data['messages'] as $message): ?>
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
        <?php endforeach; ?>

        <div>
            <small class="form-text text-muted">
                Логин может состоять только из букв английского/русского алфавита, цифр и символа "_". Максимум 15 символов. 
            </small>
        </div>

        <?php if($data['auth'] == true):
            header("Refresh: 3; URL=http:\\photo");
        endif; ?>  
    </body>
</html>




