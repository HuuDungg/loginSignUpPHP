<?php
$id= $_GET['id'];
echo "the first id" .$id;
require "connectDB.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password == $confirmPassword){
        try{
            $id = $_POST['id'];
            echo "this is id $id";
            $stmt = $conn->prepare("UPDATE account SET password = ? where id = ?");
            $stmt->bind_param("si", $password, $id);
            echo "this is password changed $password and $id successfully";
            $stmt->execute();
            header("Location: login.php");
        }
        catch(Exception $e){
            echo "Error: " . $e->getMessage();
            header("Location: updateForm.php?id=".$_POST['id']);
        }

        
    }else{
        header("Location: updateForm.php?id=".$_POST['id']);
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="/traincookie/css/updateFormCss.css">
</head>
<body>
    <form action="updateForm.php" method="post" class="update-form">
        <input style="color: rgba(0, 0, 0, 0);" type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>" class="hidden-input">
        
        <div class="form-group">
            <div>
                <label for="password" class="form-label">Password</label>
            </div>
            <div>
                <input placeholder="enter your password" type="password" name="password" id="password" class="form-input" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="confirmPassword" class="form-label">Confirm Password</label>
            </div>
            <div>
                <input placeholder="enter your password confirm" type="password" name="confirmPassword" id="confirmPassword" class="form-input" required>
            </div>
        </div>

        <button type="submit" class="submit-button">SUBMIT</button>
    </form>
</body>
</html>
