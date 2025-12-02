<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: signin.php");
    exit;
}

include 'connect.php';

// Get cart items for the current user with status 0 (in cart)
$username = $_SESSION['user_name'];
$query = "SELECT * FROM tbl_order WHERE username = '$username' AND status = 0 ORDER BY oid DESC";
$result = mysqli_query($con, $query);

// Calculate total
$total = 0;
$cart_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
    $total += $row['price'] * $row['qty'];
}

// Handle quantity updates
if (isset($_POST['update_quantity'])) {
    $oid = $_POST['oid'];
    $new_qty = $_POST['qty'];

    // Get the product price
    $price_query = "SELECT price FROM tbl_order WHERE oid = $oid";
    $price_result = mysqli_query($con, $price_query);
    $price_row = mysqli_fetch_assoc($price_result);
    $price = $price_row['price'];

    // Update quantity and recalculate price
    $update_query = "UPDATE tbl_order SET qty = $new_qty WHERE oid = $oid";
    mysqli_query($con, $update_query);

    header("Location: cart.php");
    exit;
}

// Handle item removal
if (isset($_GET['remove'])) {
    $oid = $_GET['remove'];
    $delete_query = "DELETE FROM tbl_order WHERE oid = $oid";
    mysqli_query($con, $delete_query);

    header("Location: cart.php");
    exit;
}

// Handle checkout
if (isset($_POST['checkout'])) {
    // Update status of all items to 1 (purchased)
    $checkout_query = "UPDATE tbl_order SET status = 1 WHERE username = '$username' AND status = 0";
    mysqli_query($con, $checkout_query);

    $_SESSION['checkout_success'] = true;
    header("Location: cart.php");
    exit;
}

mysqli_close($con);
include 'header.php';
?>

<section class="cart-section py-16 px-4 md:px-8 lg:px-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Your Shopping Cart</h2>

        <?php if (isset($_SESSION['checkout_success'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <p>Thank you for your purchase! Your order has been placed successfully.</p>
            </div>
            <?php unset($_SESSION['checkout_success']); ?>
        <?php endif; ?>

        <?php if (count($cart_items) > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-4 bg-gray-100 font-semibold">
                            <div class="col-span-5">Product</div>
                            <div class="col-span-2 text-center">Price</div>
                            <div class="col-span-2 text-center">Quantity</div>
                            <div class="col-span-2 text-center">Total</div>
                            <div class="col-span-1 text-center">Action</div>
                        </div>

                        <?php foreach ($cart_items as $item): ?>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-6 border-b border-gray-200 items-center">
                                <div class="md:col-span-5 flex items-center">
                                    <img src="<?php echo $item['pic']; ?>" alt="<?php echo $item['pname']; ?>"
                                        class="w-16 h-16 object-cover rounded">
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-800"><?php echo $item['pname']; ?></h3>
                                    </div>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span class="md:hidden font-medium mr-2">Price:</span>
                                    <span class="text-gray-600">$<?php echo number_format($item['price'], 2); ?></span>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span class="md:hidden font-medium mr-2">Quantity:</span>
                                    <form method="POST" class="flex items-center justify-center">
                                        <input type="hidden" name="oid" value="<?php echo $item['oid']; ?>">
                                        <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1"
                                            class="w-16 py-1 px-2 border border-gray-300 rounded text-center">
                                        <button type="submit" name="update_quantity"
                                            class="ml-2 text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span class="md:hidden font-medium mr-2">Total:</span>
                                    <span
                                        class="font-medium text-primary">$<?php echo number_format($item['price'] * $item['qty'], 2); ?></span>
                                </div>

                                <div class="md:col-span-1 text-center">
                                    <a href="cart.php?remove=<?php echo $item['oid']; ?>"
                                        class="text-red-500 hover:text-red-700"
                                        onclick="return confirm('Are you sure you want to remove this item?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h3>

                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-800">$<?php echo number_format($total, 2); ?></span>
                        </div>

                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-gray-800">$<?php echo $total > 0 ? number_format(5.00, 2) : '0.00'; ?></span>
                        </div>

                        <div class="flex justify-between mb-4 pt-4 border-t border-gray-200">
                            <span class="text-lg font-bold text-gray-800">Total</span>
                            <span
                                class="text-lg font-bold text-primary">$<?php echo number_format($total > 0 ? $total + 5 : 0, 2); ?></span>
                        </div>

                        <form method="POST">
                            <button type="submit" name="checkout"
                                class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                                Proceed to Checkout
                            </button>
                        </form>

                        <div class="mt-4 text-center">
                            <a href="products.php" class="text-primary hover:underline">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <i class="fas fa-shopping-cart text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Looks like you haven't added any items to your cart yet.</p>
                <a href="products.php"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Start Shopping
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>