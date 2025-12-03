<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: signin.php");
    exit;
}

include 'connect.php';

$username = $_SESSION['user_name'];
$query = "SELECT * FROM tbl_order WHERE username = '$username' AND status = 1 ORDER BY oid DESC";
$result = mysqli_query($con, $query);

$order_items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $order_items[] = $row;
}

if (isset($_GET['cancel'])) {
    $oid = $_GET['cancel'];

    $cancel_query = "DELETE FROM tbl_order WHERE oid = $oid AND username = '$username' AND status = 1";


    mysqli_query($con, $cancel_query);

    header("Location: myorder.php");
    exit;
}

mysqli_close($con);
include 'header.php';
?>

<section class="orders-section py-16 px-4 md:px-8 lg:px-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">My Orders</h2>

        <?php if (count($order_items) > 0): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-4 bg-gray-100 font-semibold">
                    <div class="col-span-1 text-center">Order ID</div>
                    <div class="col-span-4">Product</div>
                    <div class="col-span-1 text-center">Quantity</div>
                    <div class="col-span-2 text-center">Price</div>
                    <div class="col-span-2 text-center">Total</div>
                    <div class="col-span-2 text-center">Status/Actions</div>
                </div>

                <?php
                $grouped_orders = [];
                foreach ($order_items as $item) {
                    if (!isset($grouped_orders[$item['oid']])) {
                        $grouped_orders[$item['oid']] = [];
                    }
                    $grouped_orders[$item['oid']][] = $item;
                }
                ?>

                <?php foreach ($grouped_orders as $order_id => $items):
                    $order_total = 0;
                    foreach ($items as $item) {
                        $order_total += $item['price'] * $item['qty'];
                    }
                    $first_item = $items[0];
                    ?>
                    <div class="mb-6 border border-gray-200 rounded-lg">
                        <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold">Order #<?php echo $order_id; ?></span>
                                    <span class="text-gray-600 text-sm ml-4">
                                        <?php echo date('F d, Y', strtotime($first_item['order_date'] ?? date('Y-m-d H:i:s'))); ?>
                                    </span>
                                </div>
                                <div class="text-primary font-medium">
                                    Total: $<?php echo number_format($order_total, 2); ?>
                                </div>
                            </div>
                        </div>

                        <?php foreach ($items as $item): ?>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 items-center">
                                <div class="md:col-span-1 text-center hidden md:block">
                                    <span class="text-gray-600">#<?php echo $item['oid']; ?></span>
                                </div>

                                <div class="md:col-span-4 flex items-center">
                                    <img src="<?php echo $item['pic']; ?>" alt="<?php echo $item['pname']; ?>"
                                        class="w-16 h-16 object-cover rounded">
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-800"><?php echo $item['pname']; ?></h3>
                                        <div class="md:hidden text-sm text-gray-600">
                                            Price: $<?php echo number_format($item['price'], 2); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:col-span-1 text-center">
                                    <span class="md:hidden font-medium mr-2">Qty:</span>
                                    <span class="text-gray-600"><?php echo $item['qty']; ?></span>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span class="md:hidden font-medium mr-2">Price:</span>
                                    <span class="text-gray-600">$<?php echo number_format($item['price'], 2); ?></span>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span class="md:hidden font-medium mr-2">Total:</span>
                                    <span class="font-medium text-gray-800">
                                        $<?php echo number_format($item['price'] * $item['qty'], 2); ?>
                                    </span>
                                </div>

                                <div class="md:col-span-2 text-center">
                                    <span
                                        class="inline-block px-3 py-1 text-sm rounded-full 
                                        <?php echo $item['status'] == 1 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'; ?>">
                                        <?php
                                        switch ($item['status']) {
                                            case 0:
                                                echo 'In Cart';
                                                break;
                                            case 1:
                                                echo 'Ordered';
                                                break;
                                            case 2:
                                                echo 'Shipped';
                                                break;
                                            case 3:
                                                echo 'Delivered';
                                                break;
                                            case 4:
                                                echo 'Cancelled';
                                                break;
                                            default:
                                                echo 'Pending';
                                        }
                                        ?>
                                    </span>

                                    <?php if ($item['status'] == 1): ?>
                                        <div class="mt-2">
                                            <a href="myorder.php?cancel=<?php echo $item['oid']; ?>"
                                                class="text-red-500 hover:text-red-700 text-sm"
                                                onclick="return confirm('Are you sure you want to cancel this order?')">
                                                Cancel Order
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-8 flex justify-between items-center bg-white p-4 rounded-lg shadow-md">
                <div>
                    <p class="text-gray-600">
                        Showing <?php echo count($order_items); ?> item(s) in <?php echo count($grouped_orders); ?> order(s)
                    </p>
                </div>
                <div>
                    <a href="products.php"
                        class="bg-primary text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                        Continue Shopping
                    </a>
                </div>
            </div>

        <?php else: ?>
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No orders yet</h3>
                <p class="text-gray-600 mb-6">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                <a href="products.php"
                    class="bg-primary text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Start Shopping
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>