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

    <title>Register Form</title>

    <!-- Simple form validation for password -->
    <script>
        function validateForm() {
            let x = document.forms["regi"]["password"].value;
            let y = document.forms["regi"]["passwordRepeat"].value;
            if (x != y) {
                alert("Your Password does not match!");
                return false;
            }
        }
    </script>

</head>

<body>

    <?php
    require_once("includes/header2.php");
    session_start();
    if (isset($_SESSION['username'])) {
        header('Location: home.php');
        exit();
    }
    ?>

    <section class="Form mb-5">
        <div class="container-fluid">
            <div class="row justify-content-center g-0">
                <div class="col-lg-7 mt-4">
                    <h1>SEC Register Form</h1><br>
                    <h3>Please Register down below</h3>
                    <form name="regi" action="register_action.php" onsubmit="return validateForm()" method="post">
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="text" placeholder="Enter Username" name="username" class="form-control my-3 p-4" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" placeholder="Enter Password" name="password" class="form-control my-3 p-4" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                                <input type="password" placeholder="Repeat Password" name="passwordRepeat" class="form-control my-3 p-4" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-lg-7">
                                <button class="mybtn mt-3 mb-4" type="submit" name="reg_submit">Register</button>
                            </div>
                        </div>
                        <p>Already have an account?<a href="login_form.php"> Login Here!</a></p>
                </div>
            </div>
            </form>
        </div>
        </div>
        </div>

    </section>
    <?php require_once("includes/footer.php"); ?>
</body>

</html>