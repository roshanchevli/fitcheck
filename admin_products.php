<?php
include "connect.php";
$result = $con->query("SELECT * FROM tbl_product");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Product Management</title>
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

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
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
                <h2 class="text-2xl font-bold text-gray-800">Product Management</h2>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">

                        <div class="ml-2">
                            <p class="text-sm font-medium">Admin User</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="bg-white rounded-lg shadow p-4 mb-6 flex justify-between items-center">
                <div class="flex items-center w-1/2">
                    <div class="relative w-full">
                        <input type="text" placeholder="Search products..."
                            class="search-box w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <a id="addProductBtn" href="admin_addprod.php"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i> Add Product
                </a>
            </div>

            <!-- Products Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Products List</h3>
                    <span class="text-sm text-gray-600">Total: 5 products</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $i = 1;
                            while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $i++ ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($row['pname']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars(substr($row['pdesc'], 0, 50)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="<?= htmlspecialchars($row['pic']) ?>" class="img-thumbnail"
                                            style="max-width: 80px; height: auto;"
                                            alt="<?= htmlspecialchars($row['pname']) ?>">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= number_format($row['price'], 2) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <?= htmlspecialchars($row['category']) ?>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="update_product.php?id=<?= $row['pid'] ?>"
                                            class="edit-btn bg-blue-100 text-blue-700 py-1 px-3 rounded-md mr-2 hover:bg-blue-200 transition">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="del_product.php?id=<?= $row['pid'] ?>"
                                            class="delete-btn bg-red-100 text-red-700 py-1 px-3 rounded-md hover:bg-red-200 transition">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Add Product Modal -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 opacity-0 pointer-events-none"
                    id="addProductModal">
                    <div class="modal-container bg-white rounded-lg shadow-xl w-full max-w-2xl">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Add New Product</h3>
                            <form id="addProductForm">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="productName"
                                            class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                        <input type="text" id="productName" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    </div>
                                    <div>
                                        <label for="productCategory"
                                            class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                        <select id="productCategory" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                            <option value="">Select Category</option>
                                            <option value="fitness">Fitness Gadgets</option>
                                            <option value="yoga">Yoga</option>
                                            <option value="weights">Weights</option>
                                            <option value="footwear">Footwear</option>
                                            <option value="nutrition">Nutrition</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="productPrice"
                                            class="block text-sm font-medium text-gray-700 mb-1">Price
                                        </label>
                                        <input type="number" id="productPrice" step="0.01" min="0" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    </div>
                                    <div>
                                        <label for="productStock"
                                            class="block text-sm font-medium text-gray-700 mb-1">Stock
                                            Quantity</label>
                                        <input type="number" id="productStock" min="0" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="productDescription"
                                        class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea id="productDescription" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="productImage"
                                        class="block text-sm font-medium text-gray-700 mb-1">Product
                                        Image</label>
                                    <input type="file" id="productImage" accept="image/*"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                </div>
                                <div class="flex justify-end space-x-3">
                                    <button type="button"
                                        class="cancel-add-btn px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700">Add
                                        Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Edit Product Modal -->
            <!-- <div class="modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 opacity-0 pointer-events-none"
                id="editProductModal">
                <div class="modal-container bg-white rounded-lg shadow-xl w-full max-w-2xl">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Edit Product</h3>
                        <form id="editProductForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="editProductName"
                                        class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                    <input type="text" id="editProductName" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                                        value="Fitness Tracker Pro">
                                </div>
                                <div>
                                    <label for="editProductCategory"
                                        class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select id="editProductCategory" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                        <option value="fitness" selected>Fitness Gadgets</option>
                                        <option value="yoga">Yoga</option>
                                        <option value="weights">Weights</option>
                                        <option value="footwear">Footwear</option>
                                        <option value="nutrition">Nutrition</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="editProductPrice"
                                        class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                                    <input type="number" id="editProductPrice" step="0.01" min="0" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                                        value="89.99">
                                </div>
                                <div>
                                    <label for="editProductStock"
                                        class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                                    <input type="number" id="editProductStock" min="0" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                                        value="45">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="editProductDescription"
                                    class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea id="editProductDescription" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">Advanced fitness tracker with heart rate monitoring and GPS.</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="editProductImage"
                                    class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                                <input type="file" id="editProductImage" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                <div class="mt-2 flex items-center">
                                    <img src="https://via.placeholder.com/60" alt="Current Product"
                                        class="product-image mr-2">
                                    <span class="text-sm text-gray-500">Current image</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="editProductStatus"
                                    class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="editProductStatus"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button"
                                    class="cancel-edit-btn px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                                <button type="submit"
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-700">Save
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
                        <p class="text-gray-600 mb-6">Are you sure you want to delete this product? This action cannot
                            be undone.
                        </p>
                        <div class="flex justify-end space-x-3">
                            <button type="button"
                                class="cancel-delete-btn px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">Cancel</button>
                            <a href="del_product.php?id=<?= $row['pid'] ?>"
                                class="confirm-delete-btn px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</a>
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
                const addProductModal = document.getElementById('addProductModal');
                const editProductModal = document.getElementById('editProductModal');
                const deleteModal = document.getElementById('deleteModal');
                const addProductBtn = document.getElementById('addProductBtn');
                const editButtons = document.querySelectorAll('.edit-btn');
                const deleteButtons = document.querySelectorAll('.delete-btn');
                const cancelAddBtn = document.querySelector('.cancel-add-btn');
                const cancelEditBtn = document.querySelector('.cancel-edit-btn');
                const cancelDeleteBtn = document.querySelector('.cancel-delete-btn');
                const confirmDeleteBtn = document.querySelector('.confirm-delete-btn');

                // Open add product modal
                addProductBtn.addEventListener('click', () => {
                    addProductModal.classList.add('active');
                });

                // Open edit modal
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        editProductModal.classList.add('active');
                    });
                });

                // Open delete modal
                deleteButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        deleteModal.classList.add('active');
                    });
                });

                // Close modals
                cancelAddBtn.addEventListener('click', () => {
                    addProductModal.classList.remove('active');
                });

                cancelEditBtn.addEventListener('click', () => {
                    editProductModal.classList.remove('active');
                });

                cancelDeleteBtn.addEventListener('click', () => {
                    deleteModal.classList.remove('active');
                });

                confirmDeleteBtn.addEventListener('click', () => {
                    deleteModal.classList.remove('active');
                    // Here you would typically handle the delete action
                    alert('Product deleted successfully!');
                });

                // Close modal when clicking outside
                window.addEventListener('click', (e) => {
                    if (e.target === addProductModal) {
                        addProductModal.classList.remove('active');
                    }
                    if (e.target === editProductModal) {
                        editProductModal.classList.remove('active');
                    }
                    if (e.target === deleteModal) {
                        deleteModal.classList.remove('active');
                    }
                });

                // Form submission
                document.getElementById('addProductForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    // Here you would typically handle the form submission
                    addProductModal.classList.remove('active');
                    alert('Product added successfully!');
                });

                document.getElementById('editProductForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    // Here you would typically handle the form submission
                    editProductModal.classList.remove('active');
                    alert('Product updated successfully!');
                });

                // Search functionality
                const searchBox = document.querySelector('.search-box');
                searchBox.addEventListener('keyup', function () {
                    const searchText = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const name = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const category = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                        const price = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

                        if (name.includes(searchText) || category.includes(searchText) || price.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            </script>
</body>

</html>