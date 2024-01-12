<?php
$host = "localhost";
$dbname = "sneakersclub";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $passwordAttempt = isset($_POST['password']) ? $_POST['password'] : "";

        if ($email === 'admin@example.com') {
            header("Location: dashboard.php");
            exit();
        }

        $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        $user = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwordAttempt, $user['password'])) {
            // Set user information in the session
            $_SESSION['user'] = $user;
            $_SESSION['username'] = isset($user['username']) ? $user['username'] : 'default_username';

            if ($user['email'] === 'admin@example.com') {
                header("Location: dashboard.php");
                exit();
            } else {
                // Redirect user after login
                echo '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Welcome Back</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 0;
                                    padding: 0;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 100vh;
                                    background-color: #f4f4f4;
                                }
                                .modal {
                                    display: none;
                                    background-color: #fff;
                                    border: 1px solid #dcdcdc;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                    max-width: 400px;
                                    width: 100%;
                                    padding: 20px;
                                    text-align: center;
                                }
                                .modal p {
                                    margin-bottom: 20px;
                                }
                                .modal small {
                                    color: #888;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="modal">
                                <p>Welcome back, ' . htmlspecialchars($user['firstname']) . '!</p>
                                <small>Redirecting to the homepage...</small>
                            </div>
                            <script>
                                // Show the modal
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.querySelector(".modal").style.display = "block";
                                    // Redirect after 2 seconds
                                    setTimeout(function() {
                                        window.location.href = "index.php";
                                    }, 2000);
                                });
                            </script>
                        </body>
                        </html>';
                exit();
            }
        } else {
            // Redirect to login page with an error message
            echo '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <title>Invalid Login</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 0;
                                    padding: 0;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 100vh;
                                    background-color: #f4f4f4;
                                }
                                .modal {
                                    display: none;
                                    background-color: #fff;
                                    border: 1px solid #dcdcdc;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                    max-width: 400px;
                                    width: 100%;
                                    padding: 20px;
                                    text-align: center;
                                }
                                .modal p {
                                    margin-bottom: 20px;
                                }
                                .modal small {
                                    color: #888;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="modal">
                                <p>Invalid email or password. Please try again.</p>
                                <small>Redirecting to login page...</small>
                            </div>
                            <script>
                                // Show the modal
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.querySelector(".modal").style.display = "block";
                                    // Redirect after 2 seconds
                                    setTimeout(function() {
                                        window.location.href = "loginpage.php";
                                    }, 2000);
                                });
                            </script>
                        </body>
                        </html>';
                        exit();

            }
        }
    }
 catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
