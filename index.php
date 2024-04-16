<?php
session_start();
//var_dump($_SESSION);
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<h1 class= "m-4">Benvenuto, <?php echo ucfirst(strtolower($_SESSION['username'])); ?>!</h1>
    <a class="p-2 m-4 bg-primary text-white link-offset-2 link-underline link-underline-opacity-0 rounded"
    href="logout.php" class="ms-5">
        <strong>Logout</strong>
    </a>
    <?php
    if (strtolower($_SESSION['username']) === 'admin'){
        echo '<a class="p-2 m-4 bg-primary text-white link-offset-2 link-underline link-underline-opacity-0 rounded"
    href="#" class="ms-5">'.
       '<strong>Gestione utenti</strong>'.
    '</a>';
}
    ?>
</body>
</html>

