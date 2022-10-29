<?php

if (empty($_POST['username'])) {
    header('Location: register_form.php');
    exit();
    //echo "Username not passed";
}
if (empty($_POST['password'])) {
    header('Location: register_form.php');
    exit();
    //echo "password not passed";
}

if ($_POST['password'] != $_POST['passwordRepeat']) {
    header('Location: register_form.php');
    exit();
} else if (isset($_POST["reg_submit"])) {

    $entered_username = $_POST['username'];
    $entered_pwd = $_POST['password'];
    $hashed_pwd = password_hash($entered_pwd, PASSWORD_DEFAULT);

    $register = 0;
    //read users.txt line by line
    foreach (file('database/users.txt') as $line) {
        //split each line as two parts
        list($username, $password) = explode(",", $line);
        //verify if an exist user with the same username
        if ($username == $entered_username) {
            $register = 1;
            break;
        }
    }

    if ($register == 1) {
        echo "That username is already taken<br />";
        echo '<a href="register_form.php">Go back</a>';
    } else {
        //open a file named "text.txt"
        $file = fopen("database/users.txt", "a");
        //insert this user into the users.txt file
        fwrite($file, $entered_username . "," . $hashed_pwd . "\n");
        //close the "$file"
        fclose($file);
        echo 'Congratulations, you can now <a href="login_form.php">Log In</a> here';
    }
} else {
    header("location: register_form.php");
}
