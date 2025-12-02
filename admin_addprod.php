<?php
include "connect.php";

// Fetch categories for the dropdown
$category_result = $con->query("SELECT * FROM tbl_category");
$categories = [];
while ($row = $category_result->fetch_assoc()) {
    $categories[] = $row;
}

// Handle form submission
if (isset($_POST['btnsubmit'])) {
    $pname = $_POST['txtpname'];
    $pdesc = $_POST['txtpdesc'];
    $price = $_POST['txtprice'];
    $category = $_POST['txtcategory'];

    // Handle file upload
    $pic = "";
    if (isset($_FILES['txtpic']) && $_FILES['txtpic']['error'] == 0) {
        $target_dir = "images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_extension = pathinfo($_FILES['txtpic']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES['txtpic']['tmp_name'], $target_file)) {
            $pic = $target_file;
        }
    }

    // Insert into database
    if (!empty($pname) && !empty($pdesc) && !empty($price) && !empty($category) && !empty($pic)) {
        $query = "INSERT INTO tbl_product (pname, pdesc, price, category, pic) 
                  VALUES ('$pname', '$pdesc', '$price', '$category', '$pic')";

        if ($con->query($query)) {
            echo "<script>alert('Product added successfully!');</script>";
            echo "<script>window.location.href='admin_products.php'</script>";
        } else {
            echo "<script>alert('Error adding product: " . $con->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill all fields and upload an image');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Product</title>
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

        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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
                    <li>
                        <a href="admin_cat.php"
                            class="flex items-center py-3 px-4 rounded-lg text-white hover:bg-white hover:bg-opacity-10 transition">
                            <i class="fas fa-tags w-6 text-center"></i>
                            <span class="nav-text ml-3">Categories</span>
                        </a>
                    </li>
                    <li class="active-tab">
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
                    <h2 class="text-2xl font-bold text-gray-800">Product Management</h2>
                    <nav class="text-sm text-gray-600 mt-1">
                        <a href="admin_dash.php" class="text-primary hover:underline">Dashboard</a> /
                        <a href="admin_products.php" class="text-primary hover:underline">Products</a> /
                        <span>Add Product</span>
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

            <!-- Add Product Form -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-3">Add New Product</h3>

                <form method="POST" enctype="multipart/form-data" class="max-w-3xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="productName" class="block text-sm font-medium text-gray-700 mb-2">
                                Product Name *
                            </label>
                            <input type="text" id="productName" name="txtpname" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                                placeholder="Enter product name">
                        </div>

                        <div>
                            <label for="productCategory" class="block text-sm font-medium text-gray-700 mb-2">
                                Category *
                            </label>
                            <select id="productCategory" name="txtcategory" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition">
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['cat_name']) ?>">
                                        <?= htmlspecialchars($category['cat_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="productPrice" class="block text-sm font-medium text-gray-700 mb-2">
                                Price *
                            </label>
                            <input type="number" id="productPrice" name="txtprice" step="0.01" min="0" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                                placeholder="0.00">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Product Image *
                            </label>
                            <div class="file-upload relative border border-gray-300 rounded-lg p-4 text-center">
                                <div
                                    class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600 mb-1">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (max. 5MB)</p>
                                    <input type="file" id="productImage" class="file-upload-input" name="txtpic"
                                        accept="image/*" required>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2" id="fileName">No file chosen</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="productDescription" class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea id="productDescription" name="txtpdesc" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                            placeholder="Enter product description"></textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Image Preview
                        </label>
                        <div class="image-preview" id="imagePreview">
                            <i class="fas fa-image text-4xl text-gray-300"></i>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <div class="flex justify-end space-x-3">
                        <a href="admin_products.php"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition font-medium flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Products
                        </a>
                        <button type="submit" name="btnsubmit"
                            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                            <i class="fas fa-plus mr-2"></i> Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        });

        // File upload display
        const fileInput = document.getElementById('productImage');
        const fileName = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');

        fileInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                fileName.textContent = this.files[0].name;

                // Show image preview
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                reader.readAsDataURL(this.files[0]);
            } else {
                fileName.textContent = 'No file chosen';
                imagePreview.innerHTML = '<i class="fas fa-image text-4xl text-gray-300"></i>';
            }
        });

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            const requiredFields = form.querySelectorAll('[required]');
            let valid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!valid) {
                e.preventDefault();
                alert('Please fill all required fields');
            }
        });
    </script>
</body>

</html>