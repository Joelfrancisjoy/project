<?php
// Start the session to manage user login
session_start();

// Dummy credentials for login (username = 'user' and password = 'password')
$valid_username = 'user';
$valid_password = 'password';

// Check if the form was submitted for login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        header("Location: #quote"); // Redirect to quote page
        exit();
    } else {
        $login_error = "Invalid username or password.";
    }
}

// Check if the user is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Array of quotes
    $quotes = [
        "The only way to do great work is to love what you do. – Steve Jobs",
        "Success is not final, failure is not fatal: It is the courage to continue that counts. – Winston Churchill",
        "It does not matter how slowly you go as long as you do not stop. – Confucius",
        "The best time to plant a tree was 20 years ago. The second best time is now. – Chinese Proverb",
        "In the end, we will remember not the words of our enemies, but the silence of our friends. – Martin Luther King Jr.",
        "You miss 100% of the shots you don’t take. – Wayne Gretzky",
        "Life is 10% what happens to us and 90% how we react to it. – Charles R. Swindoll",
        "The purpose of life is not to be happy. It is to be useful, to be honorable, to be compassionate, to have it make some difference that you have lived and lived well. – Ralph Waldo Emerson",
        "It always seems impossible until it’s done. – Nelson Mandela",
        "Don’t watch the clock; do what it does. Keep going. – Sam Levenson"
    ];

    // Get a random quote
    $randomQuote = $quotes[array_rand($quotes)];
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: #login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Quote Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            padding: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        .quote {
            font-size: 1.2em;
            font-style: italic;
            margin: 20px 0;
            color: #555;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-form input {
            padding: 10px;
            font-size: 1em;
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .login-form button {
            margin-top: 20px;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>

    <!-- Login Form -->
    <div class="container">
        <h1>Login to Access Quote Generator</h1>
        <?php if (isset($login_error)): ?>
            <p class="error"><?= $login_error; ?></p>
        <?php endif; ?>
        <form class="login-form" method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

<?php else: ?>

    <!-- Quote Generator -->
    <div class="container">
        <h1>Welcome to the Random Quote Generator!</h1>
        <p class="quote"><?= $randomQuote; ?></p>
        <button onclick="window.location.reload();">Get Another Quote</button>
        <br>
        <a href="?logout=true">Logout</a>
    </div>

<?php endif; ?>

</body>
</html>

