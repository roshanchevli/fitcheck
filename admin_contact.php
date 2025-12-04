<?php
session_start();
include 'connect.php';

// Check if admin is logged in (add this security check - adjust as needed)
// if (!isset($_SESSION['admin_logged_in'])) {
//     header('Location: admin_login.php');
//     exit();
// }

$query = "SELECT * FROM messages ORDER BY created_at DESC";
$result = mysqli_query($con, $query);

// Handle mark as read action
if (isset($_GET['mark_read_id'])) {
    $mark_read_id = mysqli_real_escape_string($con, $_GET['mark_read_id']);
    $update_query = "UPDATE messages SET status='read' WHERE id='$mark_read_id'";
    mysqli_query($con, $update_query);

    // Refresh the page
    header("Location: admin_contact.php");
    exit();
}

// Handle mark as unread action
if (isset($_GET['mark_unread_id'])) {
    $mark_unread_id = mysqli_real_escape_string($con, $_GET['mark_unread_id']);
    $update_query = "UPDATE messages SET status='unread' WHERE id='$mark_unread_id'";
    mysqli_query($con, $update_query);

    // Refresh the page
    header("Location: admin_contact.php");
    exit();
}

if (isset($_POST['update_notes'])) {
    $msg_id = mysqli_real_escape_string($con, $_POST['msg_id']);
    $admin_notes = mysqli_real_escape_string($con, $_POST['admin_notes']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    // First, check if admin_notes column exists, if not add it
    $check_column = mysqli_query($con, "SHOW COLUMNS FROM messages LIKE 'admin_notes'");
    if (mysqli_num_rows($check_column) == 0) {
        $alter_query = "ALTER TABLE messages ADD COLUMN admin_notes TEXT AFTER status";
        mysqli_query($con, $alter_query);
    }

    $update_query = "UPDATE messages 
                     SET admin_notes='$admin_notes', status='$status' 
                     WHERE id='$msg_id'";
    mysqli_query($con, $update_query);

    // Refresh the page
    header("Location: admin_contact.php");
    exit();
}

// Delete message
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete_id']);
    $delete_query = "DELETE FROM messages WHERE id='$delete_id'";
    mysqli_query($con, $delete_query);

    // Refresh the page
    header("Location: admin_contact.php");
    exit();
}

// Count messages by status
$count_unread = mysqli_num_rows(mysqli_query($con, "SELECT * FROM messages WHERE status='unread'"));
$count_total = mysqli_num_rows(mysqli_query($con, "SELECT * FROM messages"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - FitCheck Admin</title>
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

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-unread {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-read {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        .status-replied {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .floating-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .floating-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar (same as admin_dash.php) -->
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
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Contact Messages</h2>
                    <p class="text-gray-600">Manage customer inquiries and feedback</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-100 text-primary px-4 py-2 rounded-lg">
                        <span class="font-bold"><?php echo $count_total; ?></span> Total Messages
                    </div>
                    <?php if ($count_unread > 0): ?>
                        <div class="bg-red-100 text-red-600 px-4 py-2 rounded-lg">
                            <span class="font-bold"><?php echo $count_unread; ?></span> Unread Messages
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Messages Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name / Email
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr class="<?php echo $row['status'] == 'unread' ? 'bg-blue-50' : ''; ?>">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #<?php echo $row['id']; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($row['name']); ?>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                <?php echo htmlspecialchars($row['email']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-medium">
                                                <?php echo !empty($row['subject']) ? htmlspecialchars($row['subject']) : '(No Subject)'; ?>
                                            </div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs">
                                                <?php echo substr(htmlspecialchars($row['message']), 0, 100); ?>...
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                                            <br>
                                            <span class="text-xs">
                                                <?php echo date('h:i A', strtotime($row['created_at'])); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="status-badge status-<?php echo $row['status']; ?>">
                                                <?php echo ucfirst($row['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <?php if ($row['status'] == 'unread'): ?>
                                                <!-- Mark as Read button for unread messages -->
                                                <a href="?mark_read_id=<?php echo $row['id']; ?>"
                                                    class="text-primary hover:text-blue-800 mr-3">
                                                    <i class="fas fa-check-circle"></i> Mark as Read
                                                </a>
                                            <?php else: ?>
                                                <!-- Mark as Unread button for read messages -->
                                                <a href="?mark_unread_id=<?php echo $row['id']; ?>"
                                                    class="text-yellow-600 hover:text-yellow-800 mr-3">
                                                    <i class="fas fa-eye-slash"></i> Mark as Unread
                                                </a>
                                            <?php endif; ?>


                                            <a href="?delete_id=<?php echo $row['id']; ?>"
                                                onclick="return confirm('Are you sure you want to delete this message?')"
                                                class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No contact messages found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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