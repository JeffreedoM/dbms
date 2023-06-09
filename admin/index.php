<?php
session_start();
include 'includes/dbh.inc.php';
include 'includes/login-system.inc.php';

//Login
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password) && !is_numeric($username)) {
        //read from database
        $result = $pdo->prepare("SELECT * FROM tbl_accounts WHERE username = '$username'");
        $result->execute();
        $numRows = $result->rowCount();
        if ($result && $numRows > 0) {
            $user_data = $result->fetch();

            // password_verify($password, $user_data['password'])
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['user_id'] = $user_data['user_id'];
                header('Location: add-brgy.php');
                die;
            } else {
                header('Location: ?error=Wrong password.');
            }
        } else {
            header('Location: ?error=Username does not exists.');
        }
    } else {
        header('Location: ?error=Username does not exists.');
    }
}

if (isset($_SESSION['user_id'])) {
    header('Location: add-brgy.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/main.css" />
    <title>Login</title>

    <style>
        /* show password */
        #password-container {
            position: relative;
        }

        #show-pass {
            position: absolute;
            right: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>

<body class="login-body">

    <div class="login">

        <div class="login__desc">
            <!-- <p class="login__p1">Sign in to continue.</p> -->
            <p class="login__p2">Sign in to continue.</p>
        </div>

        <!-- login -->
        <form action="" method="POST" class="login__form">
            <div>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            <div>
                <div id="password-container">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <span id="show-pass"><i class="fa-solid fa-eye"></i></span>
                </div>
                <!-- <input type="password" name="password" id="password" placeholder="Password" required> -->
            </div>
            <?php
            if (isset($_GET['error'])) { ?>
                <div style="color: red; font-size: 14px;"><?php echo $_GET['error'] ?></div>
            <?php } ?>
            <button type="submit" name="submit">SIGN IN</button>
        </form>


    </div>

    <script>
        /* show / hide password ============================================= */
        pass = document.getElementById('password')
        showPass = document.getElementById('show-pass')
        showPass.addEventListener('click', () => {
            // console.log('clicked')
            // console.log(pass.type)
            if (pass.type === 'password') {
                // console.log('passowrd')
                pass.type = 'text';
                showPass.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
            } else {
                pass.type = 'password';
                showPass.innerHTML = `<i class="fa-solid fa-eye"></i>`;
            }
        })
    </script>

</body>

</html>