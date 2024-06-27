<?php
session_start(); // Bắt đầu phiên

require "send.php";
require "connectDB.php";

function checkEmailExits($email){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM account WHERE email =?");
        $stmt->bind_param("s", $email);
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

function checkUserExits($username){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM account WHERE username =?");
        $stmt->bind_param("s", $username);
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

function generateRandomNumber() {
    $number = rand(0, 9999);
    return str_pad($number, 4, '0', STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
    if(checkEmailExits($email) == true){
        echo "Email exits";
        header("Location: signUpForm.php?notice= email is already in use");
    }else if(checkUserExits($username) == true){
        header("Location: signUpForm.php?notice= username is already in use");
    }
    else{
        
        
        $code = generateRandomNumber();
        $_SESSION['verification_code'] = $code; // Lưu giá trị $code vào phiên
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        
        senMailNha($email, "please click this link to verification:  <a href='http://localhost/traincookie/verification.php?code=$code'>click me</a>");
       
    }


}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $inputCode = $_GET['code'];
    $code = isset($_SESSION['verification_code']) ? $_SESSION['verification_code'] : '';
    
    if ($inputCode == $code) {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
        $password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
        $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
        $firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
        $lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';

        try {
            $stmt = $conn->prepare("INSERT INTO account (username, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $password, $email, $firstname, $lastname);
            $stmt->execute();
            $stmt->close();
            echo "Sign up successfully!";
            header("Location: updateForm.php?id=$conn->insert_id");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        session_unset();
        session_destroy();
        
    } else {
        echo "Fail verification. Please try again.";
    }
}
?>


<form action="verification.php" method="get">
<h1 style="
    max-width: fit-content;
    margin-left: auto;
    margin-right: auto;"
    >We will send you an email. Please click on the link to activate your account</h1> 
</form>
