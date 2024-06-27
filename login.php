<?php

require "connectDB.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    function authenticate($username, $password) {
        global $conn;
        try {
            $stmt = $conn->prepare("SELECT * FROM account WHERE username =? AND password =?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    if (authenticate($username, $password)) {
        header("Location: welcome.php");
        exit();
    } else {
        echo "Wrong username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/traincookie/css/loginCss.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST">
            <div>
                <div>
                    <label for="username">Username</label>
                </div>
                <div>
                    <input class="textInput" placeholder="enter your username"  type="text" name="username" id="username" required>
                </div>
            </div>
            <div>
                <div>
                    <label for="password">Password</label>
                </div>
                <div>
                    <input placeholder="enter your password" class="textInput" type="password" name="password" id="password" required>
                </div>
            </div>

            <div>
                Remember login <input type="checkbox">
            </div>
            <button class="btn" type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
