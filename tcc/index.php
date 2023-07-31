<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/estilo-log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="projeto de login inicial de um site">
    <meta name="keywords" content="user, senha and log">
    <meta name="author" content="Felipe S. silva">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="Login"> 
        <form method="post">
            <h2>login</h2>
            <div class="mb-3" id="login-form">
                <label for="formGroupExampleInput" class="form-label">Usuário</label>
                <input class="form-control" name="x" type="text" placeholder="Nome de usuário"  aria-label="default input example">
            </div>

            <div class="mb-3" id="login-form">
                <label for="formGroupExampleInput" class="form-label">Email</label>
                <input class="form-control" name="t" type="text" placeholder="Email"  aria-label="default input example">
            </div>
   
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Senha</label>
                <input class="form-control" name="w"  type="password" placeholder="Senha"  aria-label="default input example">
            </div>

            <br>
            <button type="submit">Logar</button>
            <a href="creat.php">Criar conta</a>
        </form>

        <?php
            include 'conecxao.php';

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario = $_POST["x"];
                $senha = $_POST["w"];
                $email = $_POST["t"];

                // Usar declarações preparadas para evitar ataques de injeção SQL
                $stmt = $conn->prepare("SELECT * FROM logi WHERE usuario = ? OR email = ? AND senha = ?");
                $stmt->bind_param("sss", $usuario, $email, $senha);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    echo '<script>window.location.replace("creat.php");</script>';
                } else {
                    echo "Erro: Usuário, email ou senha incorretos.";
                }

                $stmt->close();
                $conn->close();
            }
        ?>
    </div>
</body>
</html>