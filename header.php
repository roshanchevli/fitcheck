<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCheck - Health Portal</title>
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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .about-section {
            scroll-margin-top: 80px;
        }

        .floating-card {
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .floating-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4e73df, #224abe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .team-member {
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .team-img {
            transition: all 0.5s ease;
        }

        .team-member:hover .team-img {
            transform: scale(1.05);
        }

        .values-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin-bottom: 1.5rem;
        }

        .contact-section {
            scroll-margin-top: 80px;
        }

        .floating-card {
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .floating-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .form-input {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);

            .category-section {
                scroll-margin-top: 80px;
            }

            .category-card {
                transition: all 0.3s ease;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .category-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            }

            .category-image {
                transition: all 0.5s ease;
                height: 200px;
                object-fit: cover;
            }

            .category-card:hover .category-image {
                transform: scale(1.05);
            }

            .gradient-bg {
                background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            }

            .category-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(255, 255, 255, 0.9);
                padding: 5px 12px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.8rem;
            }

            .products-section {
                scroll-margin-top: 80px;
            }

            .product-card {
                transition: all 0.3s ease;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            }

            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            }

            .product-image {
                transition: all 0.5s ease;
                height: 200px;
                object-fit: cover;
            }

            .product-card:hover .product-image {
                transform: scale(1.05);
            }

            .gradient-bg {
                background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            }

            .product-badge {
                position: absolute;
                top: 15px;
                left: 15px;
                padding: 5px 12px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.8rem;
                z-index: 10;
            }

            .rating {
                color: #fbbf24;
            }

            .add-to-cart-btn {
                transition: all 0.3s ease;
            }

            .add-to-cart-btn:hover {
                transform: scale(1.05);
            }

            .price-range {
                -webkit-appearance: none;
                appearance: none;
                width: 100%;
                height: 5px;
                background: #e5e7eb;
                outline: none;
                border-radius: 5px;
            }

            .price-range::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: #4e73df;
                cursor: pointer;
            }

            .price-range::-moz-range-thumb {
                width: 20px;
                height: 20px;
                border-radius: 50%;
                background: #4e73df;
                cursor: pointer;
            }

            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Navigation styles */
            .nav-item {
                position: relative;
                padding: 0.5rem 0;
            }

            .nav-item::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background-color: white;
                transition: all 0.3s ease;
                transform: translateX(-50%);
            }

            .nav-item:hover::after {
                width: 70%;
            }

            .nav-item.active::after {
                width: 70%;
            }
        }
    </style>
    <link rel="stylesheet" href="index.css">

    <link rel="shortcut icon" href="assest\fitcheck-high-resolution-logo.png" type="image/x-icon">
</head>

<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="bg-gradient-to-r from-primary to-[#2a3e9d] shadow-md py-4 fixed w-full z-10 top-0">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <a class="flex items-center text-white text-xl font-bold" href="index.php">
                    <i class="fas fa-heartbeat text-2xl mr-2"></i>
                    <span>FitCheck Health Portal</span>
                </a>

                <div class="hidden md:flex items-center space-x-6">
                    <a class="nav-item text-white font-medium hover:text-gray-200" href="index.php">Home</a>
                    <a class="nav-item text-white font-medium hover:text-gray-200" href="category.php">Category</a>
                    <a class="nav-item text-white font-medium hover:text-gray-200 active"
                        href="products.php">Products</a>
                    <a class="nav-item text-white font-medium hover:text-gray-200" href="about.php">About</a>
                    <a class="nav-item text-white font-medium hover:text-gray-200" href="contact.php">Contact</a>
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        ?>
                        <a class="nav-item text-white font-medium hover:text-gray-200" href="cart.php">
                            <i class="fas fa-shopping-cart mr-1"></i> Cart
                        </a>
                        <a class="nav-item text-white font-medium hover:text-gray-200" href="myorder.php">
                            <i class="fa-solid fa-truck mr-1"></i> myorders
                        </a>
                        <a class="nav-item text-white font-medium hover:text-gray-200" href="index.php">
                            <?php echo $_SESSION['user_name'] ?>
                        </a>
                        <a class="bg-white text-primary px-4 py-2 rounded font-medium hover:bg-gray-100"
                            href="logout.php">Logout</a>
                        <?php
                    } else {
                        ?>
                        <a class="nav-item text-white font-medium hover:text-gray-200" href="signin.php">Login</a>
                        <a class="bg-white text-primary px-4 py-2 rounded font-medium hover:bg-gray-100"
                            href="signup.php">Sign Up</a>
                        <?php
                    }
                    ?>
                </div>

                <button class="md:hidden text-white">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>