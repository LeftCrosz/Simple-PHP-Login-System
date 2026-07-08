<?php
session_start();

$errors = [
    "login"=> $_SESSION['login_error'] ?? '',
    "register"=> $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['activeForm'] ?? 'login';

session_unset();
function displayError(string $formerror) {
    if (!empty($formerror)) {
        return !empty($formerror) ? "<p class='p-2 bg-red-600 text-white'>$formerror</p>" :"";
    }
}

function isActiveForm(string $formName, string $activeForm) {
    return $formName === $activeForm ? '' : 'hidden';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <section id="login-section" class="loginform <?= isActiveForm('login', $activeForm); ?>">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="flex flex-col justify-center items-center bg-yellow-100/10 p-10 rounded-2xl shadow-lg gap-5">
            <h1 class="text-4xl uppercase font-bold select-none">Login</h1>
            <form action="login_register.php" method="post" class="flex flex-col p-10 gap-2">
                <?= displayError($errors['login']) ?>
                <input type="email" name="email" placeholder="Email" required class="border rounded p-0.5">
                <input type="password" name="password" placeholder="Password" required class="border rounded p-0.5">
                <button type="submit" name="login" class="border border-black rounded bg-cyan-400 text-white p-1.5 font-semibold hover:scale-105">Login</button>
            </form>
            <p class="select-none">Don't have an account? <a onclick="hideForm('login-section')" class="text-cyan-500 hover:underline cursor-pointer">Register here</a></p>
            </div>
        </div>
    </section>


    <section id="register-section" class="loginform <?= isActiveForm('register', $activeForm); ?>">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="flex flex-col justify-center items-center bg-yellow-100/10 p-10 rounded-2xl shadow-lg gap-5">
                <h1 class="text-4xl uppercase font-bold select-none">Register</h1>
                <?= displayError($errors['register']) ?>
                <form action="login_register.php" method="post" class="flex flex-col p-10 gap-2">
                    <input type="text" name="username" placeholder="Username" required class="border rounded p-0.5">
                    <input type="email" name="email" placeholder="Email" required class="border rounded p-0.5">
                    <input type="password" name="password" placeholder="Password" required class="border rounded p-0.5">
                    <button type="submit" name="register" class="border border-black rounded bg-cyan-400 text-white p-1.5 font-semibold hover:scale-105">Register</button>
                </form>
                <p class="select-none">Have an account? <a onclick="hideForm('register-section')" class="text-cyan-500 hover:underline cursor-pointer">Login here</a></p>
            </div>
        </div>
    </section>


    <script>
        function hideForm(sectionId) {
            document.querySelectorAll('.loginform').forEach(section => section.classList.remove('hidden'));
            document.getElementById(sectionId).classList.add('hidden');
        }

    </script>
</body>
</html>