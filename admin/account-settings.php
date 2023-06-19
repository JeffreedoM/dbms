<?php
include 'includes/session.inc.php';
include 'includes/functions.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $current_username = $_POST['current_username'];
    $current_password = $_POST['current_password'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Check if current username and password match
    $stmt = $pdo->prepare('SELECT username, password FROM tbl_accounts WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    // if ($user && $user['username'] == $current_username && $current_password == $user['password']) {
    if ($user && $user['username'] == $current_username && password_verify($current_password, $user['password'])) {
        // Encrypt the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update username and password
        $stmt = $pdo->prepare('UPDATE tbl_accounts SET username = ?, password = ? WHERE user_id = ?');
        if ($stmt->execute([$new_username, $hashed_password, $user_id])) {
            $_SESSION['username'] = $new_username;
            $success = 'Username and password updated successfully.';
            header('Location: account-settings.php?message=' . $success);
        } else {
            $error = 'An error occurred while updating the username and password.';

            header('Location: account-settings.php?error=' . $error);
        }
    } else {
        $error = 'Invalid username or password. Please try again!';
        header('Location: account-settings.php?error=' . $error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="assets/css/main.css">
    <?php
    include 'partials/title.php';
    ?>

    <style>
        /* show password */
        #password-container {
            position: relative;
        }

        #password-container span {
            position: absolute;
            right: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        input {
            width: 100%;
            border-radius: 5px !important;
        }

        form div {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <?php
    include 'partials/nav_sidebar.php';
    ?>

    <main class="main-content">
        <?php
        include 'partials/nav_header.php';
        ?>

        <div class="wrapper">
            <?php
            include 'includes/query-results.inc.php';
            ?>

            <!-- Page header -->
            <!-- This is where the title of the page is shown -->
            <div class="page-header">
                <h3 class="page-title">Account Settings</h3>
            </div>

            <!-- Page body -->
            <div class="page-body">

                <!-- HTML code for change username and password form -->
                <form method="post" class="">
                    <div>
                        <label for="current_username">Current Username:</label>
                        <input type="text" id="current_username" name="current_username" placeholder="Enter current username" required>
                    </div>
                    <div>
                        <label for="current_password">Current Password:</label>
                        <div id="password-container">
                            <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
                            <span id="show-pass"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>
                    <div>
                        <label for="new_username">New Username:</label>
                        <input type="text" id="new_username" name="new_username" placeholder="Enter new username" required>
                    </div>
                    <div>
                        <label for="new_password">New Password:</label>
                        <div id="password-container">
                            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
                            <span id="show-pass2"><i class="fa-solid fa-eye"></i></span>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['error'])) { ?>
                        <div style="color: red;"><?php echo $_GET['error'] ?></div>
                    <?php } ?>
                    <button type="submit" class="w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Update</button>
                </form>

            </div>


    </main>

    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/header.js"></script>
    <script src="assets/js/query-results.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    <script>
        /* show / hide password ============================================= */
        function togglePasswordVisibility(passwordField, showPassButton) {
            showPassButton.addEventListener('click', () => {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    showPassButton.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
                } else {
                    passwordField.type = 'password';
                    showPassButton.innerHTML = `<i class="fa-solid fa-eye"></i>`;
                }
            })
        }

        // Example usage:
        const currentPass = document.getElementById('current_password');
        const showCurrentPass = document.getElementById('show-pass');
        togglePasswordVisibility(currentPass, showCurrentPass);

        const newPass = document.getElementById('new_password');
        const showNewPass = document.getElementById('show-pass2');
        togglePasswordVisibility(newPass, showNewPass);
    </script>
</body>

</html>