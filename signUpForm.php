<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Form</title>
    <link rel="stylesheet" href="/traincookie/css/signUpCss.css">
</head>
<body>
    <form action="verification.php" method="post" class="verification-form">
        <div class="form-group">
            <div>
                <label for="username" class="form-label">Username</label>
            </div>
            <div>
                <input placeholder="enter your username" name="username" type="text" id="username" class="form-input" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="email" class="form-label">Email</label>
            </div>
            <div>
                <input placeholder="enter your email" name="email" type="text" id="email" class="form-input" required>
            </div>
        </div>
        <br>
                <span style="color: red;"><?php echo $_GET["notice"] ?></span>

        <button type="submit" class="submit-button">Send</button>
    </form>
</body>
</html>
