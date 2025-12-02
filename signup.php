<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCheck - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4e73df',
                        secondary: '#1cc88a',
                        light: '#f8f9fc',
                        dark: '#5a5c69',
                    }
                }
            }
        }
    </script>
    <style>
        .auth-bg {
            background: linear-gradient(rgba(78, 115, 223, 0.8), rgba(78, 115, 223, 0.8)), url('assest\\bg1.png');
            background-size: cover;
            background-position: center;
        }

        .password-strength {
            height: 5px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-6xl w-full flex shadow-2xl rounded-xl overflow-hidden">

        <!-- Left side - Branding and Info -->
        <div class="auth-bg hidden md:flex md:w-1/2 text-white p-12 flex-col justify-between">
            <div>
                <div class="flex items-center mb-8">
                    <i class="fas fa-heartbeat text-3xl mr-3"></i>
                    <span class="text-2xl font-bold">FitCheck</span>
                </div>
                <h1 class="text-4xl font-bold mb-6">Join FitCheck Today</h1>
                <p class="text-xl mb-6">Start your journey to better health</p>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Track your health progress</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Set personalized goals</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Get insights and recommendations</span>
                    </li>
                </ul>
            </div>
            <div class="flex space-x-4">
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200">
                    <i class="fab fa-linkedin-in text-lg"></i>
                </a>
            </div>
        </div>

        <!-- Right side - Sign Up Form -->
        <div class="w-full md:w-1/2 bg-white p-8 md:p-12 flex flex-col justify-center relative">
            <!-- Back Button (Top Right) -->
            <div class="absolute top-4 right-4">
                <a href="index.php"
                    class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            </div>

            <div class="text-center mb-8 md:hidden">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-heartbeat text-3xl text-primary mr-3"></i>
                    <span class="text-2xl font-bold text-primary">FitCheck</span>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Create your account</h2>
            </div>

            <div class="mb-6 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign Up</h2>
                <p class="text-gray-600">Create your account to get started</p>
            </div>

            <form class="space-y-2" method="POST" action="">
                <div>
                    <label for="uname" class="block text-sm font-medium text-gray-700 mb-1">User Name</label>
                    <input id="uname" name="uname" type="text" autocomplete="given-name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Username">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Enter your email">
                </div>
                <div>
                    <label for="number" class="block text-sm font-medium text-gray-700 mb-1"> Phone number</label>
                    <input id="number" name="number" type="number"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Enter your Phone number">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Create a password">


                </div>

                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Confirm your password">
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the <a href="#" class="text-primary hover:underline">Terms and Conditions</a>
                    </label>
                </div>

                <div>
                    <button type="submit" name="btnsubmit"
                        class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        Create Account
                    </button>
                </div>
            </form>



            <div class="mt-5 text-center">
                <p class="text-gray-600">
                    Already have an account?
                    <a href="signin.php" class="font-medium text-primary hover:underline">Sign in</a>
                </p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
if (isset($_POST['btnsubmit'])) {
    $uname = trim($_POST['uname']);
    $number = trim($_POST['number']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $error = "";

    // Validation
    if (empty($uname))
        $error .= "User name is required.<br>";
    if (empty($number))
        $error .= "phone number is required.<br>";
    if (empty($email))
        $error .= "Email is required.<br>";
    if (empty($password))
        $error .= "Password is required.<br>";
    if (empty($confirm_password))
        $error .= "Confirm Password is required.<br>";
    if ($password !== $confirm_password)
        $error .= "Passwords do not match.<br>";
    if (strlen($password) < 6)
        $error .= "Password must be at least 6 characters.<br>";

    if (empty($error)) {
        $con = mysqli_connect("localhost", "root", "", "fitcheck");

        if (!$con) {
            echo "<script>
        Swal.fire({
          title: 'Database Error!',
          text: 'Could not connect to the database.',
          icon: 'error'
        });
      </script>";
            exit;
        }

        // Check if email already exists
        $checkEmail = mysqli_query($con, "SELECT * FROM tbl_user WHERE email='$email'");
        if (mysqli_num_rows($checkEmail) > 0) {
            echo "<script>
        Swal.fire({
          title: 'Oops!',
          html: 'This email is already registered.<br>Please use a different one.',
          icon: 'warning'
        });
      </script>";
        } else {
            $query = $query = "INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `email`, `mobileno`) 
                        VALUES (NULL, '$uname', '$password', '$email', '$number');";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<script>
          Swal.fire({
            title: '🎉 Account Created!',
            text: 'Welcome to FitCheck, $uname!',
            icon: 'success',
            confirmButtonText: 'Go to Sign In'
          }).then(() => {
            window.location.href = 'signin.php';
          });
        </script>";
            } else {
                echo "<script>
          Swal.fire({
            title: 'Error!',
            text: 'Something went wrong. Please try again.',
            icon: 'error'
          });
        </script>";
            }
        }

        mysqli_close($con);
    } else {
        echo "<script>
      Swal.fire({
        title: 'Validation Error',
        html: '$error',
        icon: 'error'
      });
    </script>";
    }
}

?>