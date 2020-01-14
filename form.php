<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh;">
        <form method="POST">
                <div class="form-group">
                    <label for="id-field">ID</label>
                    <input name="id" type="number" class="form-control" id="id-field" required>
                </div>
                <div class="form-group">
                    <label for="keyword-field">Ключевое слово</label>
                    <input name="keyword" type="text" class="form-control" id="keyword-field" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Отправить">
        </form>
        <div class="d-flex justify-content-center mt-5">
            <h4 class="mr-3">Page: <?= $res['page'] ?></h4>
            <h4 class="ml-3">Position: <?= $res['position'] ?></h4>
        </div>
    </div>
</body>
</html>