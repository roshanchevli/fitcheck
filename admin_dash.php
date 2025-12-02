<?php
include 'connect.php';

$c_query = "SELECT * FROM tbl_category";
$p_query = "SELECT * FROM tbl_product";
$u_query = "SELECT * FROM tbl_user";
$o_query = "SELECT * FROM tbl_order WHERE status=1";

$result_c = mysqli_query($con, $c_query);
$result_p = mysqli_query($con, $p_query);
$result_u = mysqli_query($con, $u_query);
$result_o = mysqli_query($con, $o_query);

$count_cat = mysqli_num_rows($result_c);
$count_prod = mysqli_num_rows($result_p);
$count_users = mysqli_num_rows($result_u);
$count_order = mysqli_num_rows($result_o);
// fetch active orders (status=1)
$query = "SELECT * FROM tbl_order WHERE status=1";
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
    <title>Admin Dashboard - FitCheck</title>
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

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
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
                    <li class="active-tab">
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
                <a href="index.php" class="flex items-center text-white hover:text-gray-200">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-text ml-3">Back to Site</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content w-full p-5">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Admin Dashboard</h2>
                <div class="flex items-center space-x-4">

                    <div class="flex items-center">

                        <div class="ml-2">
                            <p class="text-sm font-medium">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white rounded-lg shadow p-6 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-primary">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500">Total Users</p>
                            <h3 class="text-2xl font-bold"><?= $count_users ?></h3>
                        </div>
                    </div>

                </div>

                <div class="stat-card bg-white rounded-lg shadow p-6 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-secondary">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500">Total Products</p>
                            <h3 class="text-2xl font-bold"><?= $count_prod ?></h3>
                        </div>
                    </div>

                </div>
                <div class="stat-card bg-white rounded-lg shadow p-6 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-secondary">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500">Total Category</p>
                            <h3 class="text-2xl font-bold"><?= $count_cat ?></h3>
                        </div>
                    </div>

                </div>

                <div class="stat-card bg-white rounded-lg shadow p-6 transition duration-300">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500">Total Orders</p>
                            <h3 class="text-2xl font-bold"><?= $count_order ?></h3>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Recent Activities and Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Orders -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Recent Orders</h3>
                        <a href="#" class="text-primary text-sm">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Order ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        IUserName</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (empty($arr)): ?>
                                    <tr>
                                        <td colspan="4">No active orders found</td>
                                    </tr>
                                <?php else: ?>
                                    <?php
                                    $i = 1;
                                    foreach ($arr as $order): ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <?php echo $i++; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo htmlspecialchars($order['pname']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo htmlspecialchars($order['qty']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo htmlspecialchars($order['price']); ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <?php echo htmlspecialchars($order['username']); ?>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold mb-6">Quick Actions</h3>
                    <div class="space-y-4">
                        <a href="admin_addprod.php"
                            class="flex items-center p-3 bg-blue-50 text-primary rounded-lg hover:bg-blue-100 transition">
                            <i class="fas fa-plus-circle mr-3"></i>
                            <span>Add New Product</span>
                        </a>
                        <a href="admin_cat.php"
                            class="flex items-center p-3 bg-green-50 text-secondary rounded-lg hover:bg-green-100 transition">
                            <i class="fas fa-tags mr-3"></i>
                            <span>Manage Categories</span>
                        </a>
                        <a href="admin_user.php"
                            class="flex items-center p-3 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition">
                            <i class="fas fa-users-cog mr-3"></i>
                            <span>User Management</span>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
        });

        // Tab switching functionality
        const tabItems = document.querySelectorAll('.sidebar ul li');
        tabItems.forEach(item => {
            item.addEventListener('click', function () {
                tabItems.forEach(tab => tab.classList.remove('active-tab'));
                this.classList.add('active-tab');
            });
        });

        // Responsive sidebar for mobile
        if (window.innerWidth < 768) {
            document.querySelector('.sidebar').classList.add('collapsed');
            document.querySelector('.main-content').classList.add('collapsed');
        }
    </script>
</body>

</html>