<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
 <?php include ('modules/navbar.php')?>

    <form id="form-register">
        <input type="text" name="nickname" id="nickname" placeholder="nickname" required>
        <input type="email" name="email" id="email" placeholder="email" required>
        <input type="password" name="password" id="password" placeholder="password" required>
        <button type="submit">Submit</button>
    </form>

    <!-- Libraries -->
    <script src="js/jquery-3.6.3.js"></script>
    <script src="ajax/form-register.js"></script>
</body>

</html>