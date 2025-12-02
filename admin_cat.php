<?php

include 'connect.php';
$query = "SELECT * FROM `tbl_category`";

$result = mysqli_query($con, $query);
$arr = [];

while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Category Management</title>
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
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .modal {
            transition: opacity 0.3s ease;
        }

        .modal-container {
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal.active .modal-container {
            transform: scale(1);
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
                <a href="logout.php" class="flex items-center text-white hover:text-gray-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text ml-3">Back to Site</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content w-full p-5">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Category Management</h2>
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
                <!-- Add Category Card -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Add New Category</h3>
                    <form id="addCategoryForm" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-1">Category
                                Name</label>
                            <input type="text" id="categoryName" name="txtcatname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                                placeholder="Enter category name" required>
                        </div>
                        <div>
                            <label for="categoryImage" class="block text-sm font-medium text-gray-700 mb-1">Category
                                Image</label>
                            <input type="file" id="categoryImage" name="txtcatpic"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                                accept="image/*">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" name="btnsubmit"
                                class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
                                <i class="fas fa-plus mr-2"></i> Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </form>
            <!-- Categories Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Categories List</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Sr No.</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category Pic</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $i = 1;
                            foreach ($arr as $a) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $i++ ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $a['cat_name'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <img src="<?= $a['cat_pic'] ?>" alt="<?= $a['cat_name'] ?>"
                                                class="category-image">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="update_category.php?id=<?= $a['cat_id'] ?>"
                                            class="edit-btn bg-blue-100 text-blue-700 py-1 px-3 rounded-md mr-2 hover:bg-blue-200 transition">
                                            <i class="fas fa-edit mr-1"></i> EDIT
                                        </a>
                                        <a href="delete_category.php?id=<?= $a['cat_id'] ?>"
                                            class="delete-btn bg-red-100 text-red-700 py-1 px-3 rounded-md hover:bg-red-200 transition">
                                            <i class="fas fa-trash mr-1"></i> DELETE
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <!-- <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 opacity-0 pointer-events-none"
        id="editModal">
        <div class="modal-container bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Category</h3>
                <form id="editCategoryForm">
                    <div class="mb-4">
                        <label for="editCategoryName" class="block text-sm font-medium text-gray-700 mb-1">Category
                            Name</label>
                        <input type="text" id="editCategoryName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                            value="Pizza">
                    </div>
                    <div class="mb-4">
                        <label for="editCategoryImage" class="block text-sm font-medium text-gray-700 mb-1">Category
                            Image</label>
                        <input type="file" id="editCategoryImage"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                            accept="image/*">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button"
                            class="cancel-edit-btn px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700">Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- Delete Confirmation Modal -->
    <!-- <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 opacity-0 pointer-events-none"
        id="deleteModal">
        <div class="modal-container bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Confirm Delete</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this category? This action cannot be
                    undone.</p>
                <div class="flex justify-end space-x-3">
                    <button type="button"
                        class="cancel-delete-btn px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button type="button"
                        class="confirm-delete-btn px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </div> -->

    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        });

        // Modal functionality
        const editModal = document.getElementById('editModal');
        const deleteModal = document.getElementById('deleteModal');
        const editButtons = document.querySelectorAll('.edit-btn');
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const cancelEditBtn = document.querySelector('.cancel-edit-btn');
        const cancelDeleteBtn = document.querySelector('.cancel-delete-btn');
        const confirmDeleteBtn = document.querySelector('.confirm-delete-btn');

        // Open edit modal
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                editModal.classList.add('active');
            });
        });

        // Open delete modal
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                deleteModal.classList.add('active');
            });
        });

        // Close modals
        cancelEditBtn.addEventListener('click', () => {
            editModal.classList.remove('active');
        });

        cancelDeleteBtn.addEventListener('click', () => {
            deleteModal.classList.remove('active');
        });

        confirmDeleteBtn.addEventListener('click', () => {
            deleteModal.classList.remove('active');
            // Here you would typically handle the delete action
            alert('Category deleted successfully!');
        });

        // Close modal when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === editModal) {
                editModal.classList.remove('active');
            }
            if (e.target === deleteModal) {
                deleteModal.classList.remove('active');
            }
        });

        // Form submission
        document.getElementById('addCategoryForm').addEventListener('submit', (e) => {
            e.preventDefault();
            // Here you would typically handle the form submission
            alert('Category added successfully!');
            document.getElementById('addCategoryForm').reset();
        });

        document.getElementById('editCategoryForm').addEventListener('submit', (e) => {
            e.preventDefault();
            // Here you would typically handle the form submission
            editModal.classList.remove('active');
            alert('Category updated successfully!');
        });
    </script>
</body>

</html>
<?php

if (isset($_POST['btnsubmit'])) {

    $catname = $_POST['txtcatname'];
    $tmp_name = $_FILES['txtcatpic']['tmp_name'];
    $name = "images/" . $_FILES['txtcatpic']['name'];

    if (empty($catname)) {
        echo "<script>alert('please enter category name');</script>";
    } else if (empty($tmp_name)) {
        echo "<script>alert('please enter category pic');</script>";
    } else {

        include 'connect.php';

        $query = "INSERT INTO `tbl_category` (`cat_id`, `cat_name`, `cat_pic`) VALUES (NULL, '$catname', '$name');";

        $result = mysqli_query($con, $query);
        if ($result > 0) {
            move_uploaded_file($tmp_name, $name);
            echo "<script>alert('Inserted Successfully');</script>";
            echo "<script>window.location.href='admin_cat.php'</script>";
        } else {
            echo "<script>alert('Not Inserted');</script>";
        }

    }

}


?>