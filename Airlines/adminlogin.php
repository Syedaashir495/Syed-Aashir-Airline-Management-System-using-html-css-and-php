<?php
    $error = "";
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username == "comsats") {
            if ($password == "comsats") {
                echo "<script>window.location='adminchoice.html'</script>";
            } else {
                echo "<script>alert('Invalid Password')</script>";
                echo "<script>window.location='adminlogin.php'</script>";
            }
        } else {
            echo "<script>alert('Invalid Username')</script>";
            echo "<script>window.location='adminlogin.php'</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Century Gothic, sans-serif;
        }
        body {
            background-color: black;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .main {
            position: fixed;
            top: 0;
            background-color: black;
            z-index: 1000;
            width: 100%;
            padding: 10px 0;
        }
        .main ul {
            list-style-type: none;
            text-align: right;
            margin-right: 20px;
        }
        .main ul li {
            display: inline-block;
        }
        .main ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border: 1px solid #fff;
            transition: 0.6s ease;
        }
        .main ul li a:hover {
            background-color: #fff;
            color: #000;
        }
        .main ul li.active a {
            background-color: #fff;
            color: #000;
        }
        .container {
            background-color: rgb(255, 255, 255);
            padding: 20px;
            width: 80%;
            max-width: 400px;
            border-radius: 10px;
            text-align: center;
            margin-top: 100px; /* Adjusted to avoid overlap with fixed navbar */
        }
        .container h1 {
            color: #000;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container input[type=text], .container input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .container input[type=submit] {
            border: 1px solid #000;
            padding: 10px 30px;
            text-decoration: none;
            transition: 0.6s ease;
            cursor: pointer;
            background-color: #fff;
            color: #000;
        }
        .container input[type=submit]:hover {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="main">
        <ul>
            <li class="active"><a href="#">Admin Login</a></li>
            <li><a href="homepage.html">Home</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>Admin Login</h1>
        <form method="post">
            <label for="username">User Name:</label>
            <input type="text" placeholder="User Name" name="username" required>
            <label for="password">Password:</label>
            <input type="password" placeholder="Password" name="password" required>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>
