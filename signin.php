<!DOCTYPE html>
<html lang="en">

<?php
session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCheck - Sign In</title>
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
            background: linear-gradient(rgba(78, 115, 223, 0.8), rgba(78, 115, 223, 0.8)), url('assest/bg2.png');
            background-size: cover;
            background-position: center;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 90%;
            max-width: 450px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        /* OTP Input Styles */
        .otp-container {
            display: flex;
            justify-content: space-between;
            margin: 1.5rem 0;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            border: 2px solid #d1d5db;
            border-radius: 0.5rem;
            margin: 0 5px;
            transition: all 0.2s;
        }

        .otp-input:focus {
            border-color: #4e73df;
            outline: none;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }

        .otp-input.filled {
            border-color: #1cc88a;
        }

        /* Step Indicator */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
            font-weight: bold;
            color: #6b7280;
        }

        .step.active {
            background-color: #4e73df;
            color: white;
        }

        .step.completed {
            background-color: #1cc88a;
            color: white;
        }

        .step-line {
            flex-grow: 1;
            height: 2px;
            background-color: #e5e7eb;
            margin: auto 0;
            max-width: 40px;
        }

        .step-line.completed {
            background-color: #1cc88a;
        }

        /* Countdown Timer */
        .countdown {
            text-align: center;
            margin: 1rem 0;
            font-weight: bold;
            color: #4e73df;
        }

        /* Hidden Form Steps */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        /* Password Strength Indicator */
        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 5px;
            transition: all 0.3s;
        }

        .strength-weak {
            width: 25%;
            background-color: #ef4444;
        }

        .strength-medium {
            width: 50%;
            background-color: #f59e0b;
        }

        .strength-strong {
            width: 75%;
            background-color: #10b981;
        }

        .strength-very-strong {
            width: 100%;
            background-color: #1cc88a;
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
                <h1 class="text-4xl font-bold mb-6">Welcome to FitCheck</h1>
                <p class="text-xl mb-6">Your personal health and wellness companion</p>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Track your health metrics</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Set and achieve fitness goals</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-secondary"></i>
                        <span>Monitor your progress over time</span>
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

        <!-- Right side - Sign In Form -->
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
                <h2 class="text-2xl font-bold text-gray-800">Sign in to your account</h2>
            </div>

            <div class="mb-6 text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h2>
                <p class="text-gray-600">Welcome back! Please enter your details</p>
            </div>

            <form class="space-y-6" method="POST" action="">
                <div>
                    <label for="uname" class="block text-sm font-medium text-gray-700 mb-1">User Name</label>
                    <input id="uname" name="uname" type="text" autocomplete="given-name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Username">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="#" id="forgot-password-link" class="text-sm text-primary hover:underline">Forgot
                            password?</a>
                    </div>
                    <input id="password" name="password" type="password" autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                        placeholder="Enter your password">
                </div>

                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <div>
                    <button type="submit" name="btnsignin"
                        class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="signup.php" class="font-medium text-primary hover:underline">Sign up now</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-password-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-lg font-semibold text-gray-800">Reset Your Password</h3>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step completed" id="step-1">1</div>
                    <div class="step-line completed"></div>
                    <div class="step active" id="step-2">2</div>
                    <div class="step-line"></div>
                    <div class="step" id="step-3">3</div>
                </div>

                <!-- Step 1: Email Verification -->
                <div id="step-1-form" class="form-step active">
                    <p class="text-gray-600 mb-4">Enter your email address to receive a verification code.</p>
                    <form id="email-verification-form">
                        <div class="mb-4">
                            <label for="reset-email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                Address</label>
                            <input id="reset-email" name="reset-email" type="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Enter your email">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                                Send Verification Code
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 2: OTP Verification -->
                <div id="step-2-form" class="form-step">
                    <p class="text-gray-600 mb-4">Enter the 6-digit verification code sent to your email.</p>
                    <div class="otp-container">
                        <input type="text" class="otp-input" maxlength="1" data-index="1">
                        <input type="text" class="otp-input" maxlength="1" data-index="2">
                        <input type="text" class="otp-input" maxlength="1" data-index="3">
                        <input type="text" class="otp-input" maxlength="1" data-index="4">
                        <input type="text" class="otp-input" maxlength="1" data-index="5">
                        <input type="text" class="otp-input" maxlength="1" data-index="6">
                    </div>
                    <div class="countdown" id="countdown">02:00</div>
                    <div class="text-center mb-4">
                        <a href="#" id="resend-otp" class="text-sm text-primary hover:underline hidden">Resend Code</a>
                    </div>
                    <div class="flex justify-between">
                        <button id="back-to-email" type="button"
                            class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                            Back
                        </button>
                        <button id="verify-otp" type="button"
                            class="bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                            Verify Code
                        </button>
                    </div>
                </div>

                <!-- Step 3: New Password -->
                <div id="step-3-form" class="form-step">
                    <p class="text-gray-600 mb-4">Create your new password.</p>
                    <form id="new-password-form">
                        <div class="mb-4">
                            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New
                                Password</label>
                            <input id="new-password" name="new-password" type="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Enter new password">
                            <div id="password-strength" class="password-strength"></div>
                            <p id="password-strength-text" class="text-xs mt-1"></p>
                        </div>
                        <div class="mb-4">
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                Password</label>
                            <input id="confirm-password" name="confirm-password" type="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition"
                                placeholder="Confirm new password">
                            <p id="password-match" class="text-xs mt-1 hidden text-red-500">Passwords do not match</p>
                        </div>
                        <div class="flex justify-between">
                            <button id="back-to-otp" type="button"
                                class="bg-gray-200 text-gray-800 py-2 px-4 rounded-lg font-medium hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition">
                                Back
                            </button>
                            <button type="submit"
                                class="bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Forgot Password Modal Functionality
        document.addEventListener('DOMContentLoaded', function () {
            // DOM Elements
            const forgotPasswordLink = document.getElementById('forgot-password-link');
            const forgotPasswordModal = document.getElementById('forgot-password-modal');
            const closeModal = document.getElementById('close-modal');

            // Form Steps
            const step1Form = document.getElementById('step-1-form');
            const step2Form = document.getElementById('step-2-form');
            const step3Form = document.getElementById('step-3-form');

            // Step Indicators
            const step1Indicator = document.getElementById('step-1');
            const step2Indicator = document.getElementById('step-2');
            const step3Indicator = document.getElementById('step-3');

            // Step Lines
            const stepLine1 = document.querySelector('.step-line:nth-child(2)');
            const stepLine2 = document.querySelector('.step-line:nth-child(4)');

            // Buttons
            const backToEmailBtn = document.getElementById('back-to-email');
            const verifyOtpBtn = document.getElementById('verify-otp');
            const backToOtpBtn = document.getElementById('back-to-otp');
            const resendOtpLink = document.getElementById('resend-otp');

            // Forms
            const emailVerificationForm = document.getElementById('email-verification-form');
            const newPasswordForm = document.getElementById('new-password-form');

            // OTP Inputs
            const otpInputs = document.querySelectorAll('.otp-input');

            // Countdown Timer
            const countdownElement = document.getElementById('countdown');

            // Password Strength
            const passwordStrengthBar = document.getElementById('password-strength');
            const passwordStrengthText = document.getElementById('password-strength-text');
            const passwordMatchText = document.getElementById('password-match');
            const newPasswordInput = document.getElementById('new-password');
            const confirmPasswordInput = document.getElementById('confirm-password');

            // Variables
            let countdown;
            let countdownTime = 120; // 2 minutes in seconds
            let currentStep = 1;
            let userEmail = '';
            let generatedOtp = '';

            // Open modal when "Forgot Password" is clicked
            forgotPasswordLink.addEventListener('click', function (e) {
                e.preventDefault();
                resetForgotPasswordFlow();
                forgotPasswordModal.classList.add('active');
            });

            // Close modal when X button is clicked
            closeModal.addEventListener('click', function () {
                forgotPasswordModal.classList.remove('active');
                resetForgotPasswordFlow();
            });

            // Close modal when clicking outside the modal content
            forgotPasswordModal.addEventListener('click', function (e) {
                if (e.target === forgotPasswordModal) {
                    forgotPasswordModal.classList.remove('active');
                    resetForgotPasswordFlow();
                }
            });

            // Handle email verification form submission
            emailVerificationForm.addEventListener('submit', function (e) {
                e.preventDefault();
                userEmail = document.getElementById('reset-email').value;

                // Simple email validation
                if (!userEmail || !isValidEmail(userEmail)) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please enter a valid email address.',
                        icon: 'error'
                    });
                    return;
                }

                // Simulate sending OTP (in a real app, this would be an API call)
                generatedOtp = generateOtp();
                console.log(`OTP for ${userEmail}: ${generatedOtp}`); // For testing purposes

                // Show success message and move to next step
                Swal.fire({
                    title: 'Verification Code Sent!',
                    text: `A 6-digit code has been sent to ${userEmail}`,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    goToStep(2);
                    startCountdown();
                });
            });

            // Handle OTP input navigation
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function () {
                    // Move to next input if current input has value
                    if (this.value.length === 1) {
                        this.classList.add('filled');
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    } else {
                        this.classList.remove('filled');
                    }

                    // Enable verify button if all inputs are filled
                    const allFilled = Array.from(otpInputs).every(input => input.value.length === 1);
                    verifyOtpBtn.disabled = !allFilled;
                });

                input.addEventListener('keydown', function (e) {
                    // Move to previous input on backspace if current input is empty
                    if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });
            });

            // Handle OTP verification
            verifyOtpBtn.addEventListener('click', function () {
                const enteredOtp = Array.from(otpInputs).map(input => input.value).join('');

                if (enteredOtp === generatedOtp) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Code verified successfully.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        goToStep(3);
                        clearInterval(countdown);
                    });
                } else {
                    Swal.fire({
                        title: 'Invalid Code!',
                        text: 'The verification code you entered is incorrect.',
                        icon: 'error'
                    });
                }
            });

            // Handle new password form submission
            newPasswordForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const newPassword = newPasswordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (newPassword !== confirmPassword) {
                    passwordMatchText.classList.remove('hidden');
                    return;
                }

                // Simulate password reset (in a real app, this would be an API call)
                Swal.fire({
                    title: 'Success!',
                    text: 'Your password has been reset successfully.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    forgotPasswordModal.classList.remove('active');
                    resetForgotPasswordFlow();
                });
            });

            // Handle back to email step
            backToEmailBtn.addEventListener('click', function () {
                goToStep(1);
                clearInterval(countdown);
                countdownElement.textContent = '02:00';
                resendOtpLink.classList.add('hidden');
            });

            // Handle back to OTP step
            backToOtpBtn.addEventListener('click', function () {
                goToStep(2);
                startCountdown();
            });

            // Handle OTP resend
            resendOtpLink.addEventListener('click', function (e) {
                e.preventDefault();

                // Generate new OTP
                generatedOtp = generateOtp();
                console.log(`New OTP for ${userEmail}: ${generatedOtp}`); // For testing purposes

                // Reset countdown
                clearInterval(countdown);
                countdownTime = 120;
                startCountdown();

                // Clear OTP inputs
                otpInputs.forEach(input => {
                    input.value = '';
                    input.classList.remove('filled');
                });
                otpInputs[0].focus();
                verifyOtpBtn.disabled = true;

                Swal.fire({
                    title: 'Code Resent!',
                    text: 'A new verification code has been sent to your email.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            });

            // Password strength indicator
            newPasswordInput.addEventListener('input', function () {
                const password = this.value;
                const strength = checkPasswordStrength(password);

                // Update strength bar
                passwordStrengthBar.className = 'password-strength';
                passwordStrengthBar.classList.add(`strength-${strength.level}`);

                // Update strength text
                passwordStrengthText.textContent = strength.text;
                passwordStrengthText.className = 'text-xs mt-1';

                switch (strength.level) {
                    case 'weak':
                        passwordStrengthText.classList.add('text-red-500');
                        break;
                    case 'medium':
                        passwordStrengthText.classList.add('text-yellow-500');
                        break;
                    case 'strong':
                        passwordStrengthText.classList.add('text-green-500');
                        break;
                    case 'very-strong':
                        passwordStrengthText.classList.add('text-secondary');
                        break;
                }

                // Check password match
                if (confirmPasswordInput.value) {
                    if (password !== confirmPasswordInput.value) {
                        passwordMatchText.classList.remove('hidden');
                    } else {
                        passwordMatchText.classList.add('hidden');
                    }
                }
            });

            // Confirm password validation
            confirmPasswordInput.addEventListener('input', function () {
                if (this.value !== newPasswordInput.value) {
                    passwordMatchText.classList.remove('hidden');
                } else {
                    passwordMatchText.classList.add('hidden');
                }
            });

            // Function to navigate between steps
            function goToStep(step) {
                // Hide all steps
                step1Form.classList.remove('active');
                step2Form.classList.remove('active');
                step3Form.classList.remove('active');

                // Reset step indicators
                step1Indicator.className = 'step';
                step2Indicator.className = 'step';
                step3Indicator.className = 'step';
                stepLine1.className = 'step-line';
                stepLine2.className = 'step-line';

                // Show current step and update indicators
                if (step === 1) {
                    step1Form.classList.add('active');
                    step1Indicator.classList.add('active');
                    currentStep = 1;
                } else if (step === 2) {
                    step2Form.classList.add('active');
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('active');
                    stepLine1.classList.add('completed');
                    currentStep = 2;
                } else if (step === 3) {
                    step3Form.classList.add('active');
                    step1Indicator.classList.add('completed');
                    step2Indicator.classList.add('completed');
                    step3Indicator.classList.add('active');
                    stepLine1.classList.add('completed');
                    stepLine2.classList.add('completed');
                    currentStep = 3;
                }
            }

            // Function to start countdown timer
            function startCountdown() {
                countdownTime = 120; // Reset to 2 minutes
                updateCountdownDisplay();

                countdown = setInterval(function () {
                    countdownTime--;
                    updateCountdownDisplay();

                    if (countdownTime <= 0) {
                        clearInterval(countdown);
                        resendOtpLink.classList.remove('hidden');
                    }
                }, 1000);
            }

            // Function to update countdown display
            function updateCountdownDisplay() {
                const minutes = Math.floor(countdownTime / 60);
                const seconds = countdownTime % 60;
                countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            // Function to generate a 6-digit OTP
            function generateOtp() {
                return Math.floor(100000 + Math.random() * 900000).toString();
            }

            // Function to validate email format
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            // Function to check password strength
            function checkPasswordStrength(password) {
                let score = 0;
                let text = '';
                let level = 'weak';

                if (password.length >= 8) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^a-zA-Z0-9]/.test(password)) score++;

                if (score <= 2) {
                    level = 'weak';
                    text = 'Weak password';
                } else if (score === 3) {
                    level = 'medium';
                    text = 'Medium strength password';
                } else if (score === 4) {
                    level = 'strong';
                    text = 'Strong password';
                } else {
                    level = 'very-strong';
                    text = 'Very strong password';
                }

                return { level, text };
            }

            // Function to reset the forgot password flow
            // function resetForgotPasswordFlow() {
            //     goToStep(1);
            //     clearInterval(countdown);
            //     countdownTime = 120;
            //     countdownElement.textContent = '02:00';
            //     resendOtpLink.classList.add('hidden');
            //     emailVerificationForm.reset();
            //     newPasswordForm.reset();
            //     otpInputs.forEach(input => {
            //         input.value = '';
            //         input.classList.remove('filled');
            //     });
            //     passwordStrengthBar.className = 'password-strength';
            //     passwordStrengthText.textContent = '';
            //     passwordMatchText.classList.add('hidden');
            //     userEmail = '';
            //     generatedOtp = '';
            // }
        });
    </script>
</body>

</html>
<?php
if (isset($_POST['btnsignin'])) {
    $uname = trim($_POST['uname']);
    $password = trim($_POST['password']);
    $error = "";

    if (empty($uname)) {
        $error .= "Email is required. ";
    }
    if (empty($password)) {
        $error .= "Password is required.";
    }

    if (empty($error)) {
        $con = mysqli_connect("localhost", "root", "", "fitcheck");
        if (!$con) {
            echo "<script>Swal.fire('Error!', 'Database connection failed.', 'error');</script>";
            exit;
        }

        if ($uname == 'admin' && $password == 'admin') {
            $_SESSION['user_id'] = 0;
            $_SESSION['user_name'] = 'Admin';
            echo "<script>
              Swal.fire({
                title: 'Welcome Admin!',
                text: 'Login successful.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'admin_dash.php';
              });
            </script>";
            exit;

        }

        $query = "SELECT * FROM `tbl_user` WHERE username='$uname' AND password='$password' LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['username'];

            echo "<script>
              Swal.fire({
                title: 'Welcome back!',
                text: 'Login successful.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
              }).then(() => {
                window.location.href = 'index.php';
              });
            </script>";
        } else {
            echo "<script>
              Swal.fire({
                title: 'Invalid!',
                text: 'Incorrect email or password.',
                icon: 'error'
              });
            </script>";
        }
    } else {
        echo "<script>
          Swal.fire({
            title: 'Validation Error',
            text: '$error',
            icon: 'warning'
          });
        </script>";
    }
}
?>