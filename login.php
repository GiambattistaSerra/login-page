<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

function validateCredentials(string $username, string $password): ?bool
{
    $filePath = 'data.txt';
    $fp = fopen($filePath, "r");

    while (($row = fgets($fp)) !== false) {
        $user = str_getcsv($row);
        if (strtolower($user[0]) === strtolower($username)) {
            if ($user[1] === md5($password)) {
                fclose($fp);
                return true;
            }
            else {
                return false;
            }
        }
    }
    fclose($fp);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (validateCredentials($username, $password) === true) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } elseif (validateCredentials($username, $password) === false) {
        $errorMessage = "Password errata. Riprova.";
    } else {
        $errorMessage = "Utente non trovato";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Login</h2>
                <?php
                    if (isset($errorMessage)) {
                        echo "<p class='text-danger'>$errorMessage</p>";
                    }
                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome utente:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


