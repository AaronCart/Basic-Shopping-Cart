<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="styling/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Server Response</title>
</head>

<body>

    <?php
    include('rsa.php');
    include('des.php');
    require_once('includes/header.php');
    ?>

    <div class="container mt-3">
        <h1>RSA exchange</h1>
        <?php

        $ciphertext = $_POST["seshKey"];
        echo ("<p>Encrypted Session Key: " . $ciphertext . "</p>");

        // Get the private Key
        $privateKey = get_rsa_privatekey('private.key');

        // compute the decrypted value, this is our session key
        $seshKey = rsa_decryption($ciphertext, $privateKey);

        echo ("<p>Key with RSA encryption removed: " . $seshKey . "</p>");

        $message = "Session key received";
        $encrypted = php_des_encryption($seshKey, $message);

        ?>
    </div>

    <section class="Form mb-5">
        <div class="container-fluid">
            <div class="row justify-content-center g-0">
                <div class="col-lg-7 mt-4">
                    <form action="client.php" method="post">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button class="mybtn mt-3 mb-4" type="submit" name="response" value="<?php echo $encrypted ?>">Reply</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once('includes/footer.php');
    ?>

</body>

</html>