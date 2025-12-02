<?php
$id = $_GET['id'];
include 'connect.php';

$query = "SELECT * FROM `tbl_category` WHERE `cat_id`=$id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category - Admin Panel</title>
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
        .sidebar {
            width: 250px;
            transition: all 0.3s;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed+.main-content {
            margin-left: 80px;
        }

        .sidebar.collapsed .nav-text {
            display: none;
        }

        .active-tab {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .nav-text {
                display: none;
            }

            .main-content {
                margin-left: 80px;
            }
        }

        .category-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .file-upload {
            position: relative;
            display: inline-block;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div
            class="sidebar bg-gradient-to-b from-primary to-[#2a3e9d] text-white h-screen fixed top-0 left-0 pt-5 overflow-y-auto">
            <div class="flex items-center justify-between px-4">
                <h1 class="text-xl font-bold flex items-center">
                    <i class="fas fa-heartbeat text-2xl mr-2"></i>
                    <span class="nav-text">FitCheck Admin</span>
                </h1>
                <button id="sidebarToggle" class="text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="mt-8">
                <ul class="space-y-2 px-3">
                    <li>
                        <a href="admin_dash.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-tachometer-alt w-6 text-center"></i>
                            <span class="nav-text ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_user.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-users w-6 text-center"></i>
                            <span class="nav-text ml-3">Users</span>
                        </a>
                    </li>
                    <li class="active-tab">
                        <a href="admin_cat.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-tags w-6 text-center"></i>
                            <span class="nav-text ml-3">Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_products.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-box w-6 text-center"></i>
                            <span class="nav-text ml-3">Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin_order.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-shopping-cart w-6 text-center"></i>
                            <span class="nav-text ml-3">Orders</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="absolute bottom-0 w-full p-4 border-t border-white border-opacity-20">
                <a href="../index.php" class="flex items-center text-white hover:text-gray-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text ml-3">Back to Site</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content w-full p-5">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                    <nav class="text-sm text-gray-600 mt-1">
                        <a href="admin_dash.php" class="text-primary hover:underline">Dashboard</a> /
                        <a href="admin_cat.php" class="text-primary hover:underline">Categories</a> /
                        <span>Update Category</span>
                    </nav>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">

                        <div class="ml-2">
                            <p class="text-sm font-medium">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- Update Category Form -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Update Category</h3>

                    <form id="updateCategoryForm" class="max-w-lg">
                        <div class="mb-6">
                            <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-2">
                                Category Name
                            </label>
                            <input type="text" id="categoryName" name="txtcatname"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                                value="<?= $row['cat_name']; ?>" placeholder="Enter Category Name" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Current Category Image
                            </label>
                            <div class="flex items-center space-x-4">
                                <img src="<?= $row['cat_pic']; ?>" alt="Current category" class="category-image">
                                <span class="text-sm text-gray-600">Current image preview</span>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Category Pic
                            </label>
                            <div class="file-upload relative border border-gray-300 rounded-lg p-4 text-center">
                                <div
                                    class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (max. 5MB)</p>
                                    <input type="file" id="categoryImage" class="file-upload-input" name="txtcatpic"
                                        accept="image/*">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2" id="fileName">No file chosen</p>
                        </div>

                        <hr class="my-6 border-gray-200">

                        <div class="flex justify-end">
                            <button type="submit" name="btnsubmit"
                                class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                                <i class="fas fa-sync-alt mr-2"></i> Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        });

        // File upload display
        const fileInput = document.getElementById('categoryImage');
        const fileName = document.getElementById('fileName');

        fileInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });

        // Form submission
        document.getElementById('updateCategoryForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Here you would typically handle the form submission to update the category
            const categoryName = document.getElementById('categoryName').value;

            // Simulate successful update
            alert(`Category "${categoryName}" updated successfully!`);
        });
    </script>
</body>

</html>

<?php

if (isset($_POST['btnsubmit'])) {

    $catname = $_POST['txtcatname'];


    $tmp_name = $_FILES['txtcatpic']['tmp_name'];
    $name = "images/" . $_FILES['txtcatpic']['name'];

    if (empty($tmp_name)) {
        $name = $row['cat_pic'];
    }

    if (empty($catname)) {
        echo "<script>alert('please enter category name');</script>";
    } else {

        include 'connect.php';

        $query = "UPDATE `tbl_category` SET `cat_name` = '$catname', `cat_pic` = '$name' WHERE `tbl_category`.`cat_id` = $id;";

        $result = mysqli_query($con, $query);
        if ($result > 0) {
            move_uploaded_file($tmp_name, $name);
            echo "<script>alert('Updated Successfully');</script>";
            echo "<script>window.location.href='admin_cat.php'</script>";
        } else {
            echo "<script>alert('Not Updated');</script>";
        }
    }
}
?>