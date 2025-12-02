<?php
include 'connect.php';
$query = "SELECT * from tbl_user";

$result = mysqli_query($con, $query);
$user = [];
while ($row = mysqli_fetch_assoc($result)) {
    $user[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
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

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
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

        .search-box:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
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
                    <li class="active-tab">
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
                <h2 class="text-2xl font-bold text-gray-800">User Management</h2>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">

                        <div class="ml-2">
                            <p class="text-sm font-medium">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Users List</h3>
                    <span class="text-sm text-gray-600">Total: 3 users</span>
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
                                    Pic</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Username</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mobile No</th>


                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $i = 1;
                            foreach ($user as $u) { ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $i++ ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="user-avatar bg-blue-500"><?php echo substr($u['username'], 0, 1); ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $u['username']; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $u['email']; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $u['mobileno']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

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
                        alert('User deleted successfully!');
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
                    document.getElementById('editUserForm').addEventListener('submit', (e) => {
                        e.preventDefault();
                        // Here you would typically handle the form submission
                        editModal.classList.remove('active');
                        alert('User updated successfully!');
                    });

                    // Search functionality
                    const searchBox = document.querySelector('.search-box');
                    searchBox.addEventListener('keyup', function () {
                        const searchText = this.value.toLowerCase();
                        const rows = document.querySelectorAll('tbody tr');

                        rows.forEach(row => {
                            const username = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                            const email = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                            const mobile = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

                            if (username.includes(searchText) || email.includes(searchText) || mobile.includes(searchText)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                </script>
</body>

</html>