<?php
$username = isset($_POST["username"]) ? $_POST["username"] :""; 
$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] :"";
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] :""; 
$password = isset($_POST["password"]) ? $_POST["password"] :"";
$passwordVerify = isset($_POST["passwordVerify"]) ? $_POST["passwordVerify"] :"";

$errors = [];

if($username == ""){
    $errors[] = "Username is required";
}
if($firstname == ""){
    $errors[] = "First name is required";
} 
if($lastname == ""){  
    $errors[] = "Last name is required";
}
if($password == ""){
    $errors[] = "Password is required";
}
if($passwordVerify == ""){
    $errors[] = "Password verification is required";
}


if($password != "&&$passwordVerify" && $password != $passwordVerify) {
    $errors[] = "Passwords do not match";
}


if(!empty($errors)){
    $errorString = implode(",", $errors);
    header("Location: index.php?errors=" .urlencode($errorString));
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body>
    <h2>Submitted Successfully!</h2>
    <p><strong>Username:</strong><?php echo $username; ?></p>
    <p><strong>First Name:</strong><?php echo $firstname; ?></p>
    <p><strong>Last Name:</strong><?php echo $lastname; ?></p>
</body>
</html>

