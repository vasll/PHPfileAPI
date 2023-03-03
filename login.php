<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <?php include ('modules/navbar.php')?>

    <form action="api/auth/login.php" method="post">
        <input type="text" name="nickname" id="nickname" placeholder="nickname" required>
        <input type="password" name="password" id="password" placeholder="password" required>
        <button type="submit">Submit</button>
    </form>
</body>

</html>