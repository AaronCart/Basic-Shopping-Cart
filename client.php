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

    <title>Session Key</title>
    </head>
<body>
    <?php
    require_once('includes/header.php');
    include('des.php');
    session_start();
    ?>

    <div class="container mt-3">
        <?php
        if (isset($_SESSION['username'])) {
            $key = "abcdefgh";
            $message = "This_is_our_session_key";
            $seshKey = php_des_encryption($key, $message);

            if (isset($_POST['response'])) {
                $ciphertext = $_POST['response'];
                echo ("<p>Encrypted text: " . $ciphertext . "</p>");
                $decrypt = php_des_decryption($seshKey, $ciphertext);
                echo ("<p>Session Key is: " . $seshKey . "</p>");
                echo ("<p>Decrypted text: " . $decrypt . "</p>");
            }
        } else {
            echo ("<p>Please Login in order to generate a session key</p>");
            header('Location: login_form.php');
            exit();
        }
        ?>
    </div>

    <section class="Form mb-5">
        <div class="container">
            <div class="row justify-content-center g-0">
                <div class="col-lg-7 mt-4">
                    <h3>Establish Secure Connection</h3>
                    <form action="server.php" method="post">
                        <input type="hidden" name="seshKey" id="seshKey" value="<?php echo $seshKey; ?>">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <button class="mybtn mt-3 mb-4" type="submit" onclick="RSA_encryption()" name="msg_submit">Exchange Session Key</button>
                            </div>
                        </div>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>

    </section>
    <?php
    require_once('includes/footer.php');
    ?>

    <script src="rsa.js"></script>
    <script type="text/javascript">
        function RSA_encryption() {
            var plaintext = document.getElementById("seshKey").value;
            var public_key = "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzdxaei6bt/xIAhYsdFdW62CGTpRX+GXoZkzqvbf5oOxw4wKENjFX7LsqZXxdFfoRxEwH90zZHLHgsNFzXe3JqiRabIDcNZmKS2F0A7+Mwrx6K2fZ5b7E2fSLFbC7FsvL22mN0KNAp35tdADpl4lKqNFuF7NT22ZBp/X3ncod8cDvMb9tl0hiQ1hJv0H8My/31w+F+Cdat/9Ja5d1ztOOYIx1mZ2FD2m2M33/BgGY/BusUKqSk9W91Eh99+tHS5oTvE8CI8g7pvhQteqmVgBbJOa73eQhZfOQJ0aWQ5m2i0NUPcmwvGDzURXTKW+72UKDz671bE7YAch2H+U7UQeawwIDAQAB-----END PUBLIC KEY-----";
            // Encrypt with the public key...
            var encrypt = new JSEncrypt();
            encrypt.setPublicKey(public_key);
            var encrypted = encrypt.encrypt(plaintext);
            document.getElementById("seshKey").value = encrypted;
        }
    </script>

</body>

</html>
