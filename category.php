<?php
include 'header.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

// Check if connection was successful
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM `tbl_category`";
$result = mysqli_query($con, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$arr = [];
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = $row;
}
?>
<!-- Category Section -->
<section id="categories" class="category-section mt-10 py-16 px-4 md:px-8 lg:px-16">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Shop by Category</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">Explore our wide range of health and fitness
                categories to find the perfect products for your wellness journey</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <?php
            if (count($arr) > 0) {
                foreach ($arr as $index => $a) {
                    $cat_id = $a['cat_id'];
                    $cat_name = $a['cat_name'];
                    $cat_pic = $a['cat_pic'];

                    // Count products in this category
                    $count_query = "SELECT COUNT(*) as product_count FROM tbl_product WHERE category ='$cat_name'";
                    $count_result = mysqli_query($con, $count_query);

                    if ($count_result) {
                        $count_data = mysqli_fetch_assoc($count_result);
                        $product_count = $count_data['product_count'];
                    } else {
                        $product_count = 0;
                    }

                    // Generate a gradient color based on category ID for fallback
                    $gradients = [
                        'from-blue-400 to-blue-600',
                        'from-green-400 to-green-600',
                        'from-purple-400 to-purple-600',
                        'from-red-400 to-red-600',
                        'from-yellow-400 to-yellow-600',
                        'from-indigo-400 to-indigo-600',
                        'from-pink-400 to-pink-600',
                        'from-teal-400 to-teal-600'
                    ];
                    $gradient_index = $index % count($gradients);
                    $gradient = $gradients[$gradient_index];
                    ?>
                    <div class="category-card bg-white rounded-xl overflow-hidden">
                        <div class="relative overflow-hidden">
                            <?php if (!empty($cat_pic) && file_exists($cat_pic)): ?>
                                <img src="<?php echo $cat_pic; ?>" alt="<?php echo $cat_name; ?>" class="category-image w-full">
                            <?php else: ?>
                                <div class="bg-gradient-to-r <?php echo $gradient; ?> h-48 flex items-center justify-center">
                                    <i class="fas fa-tag text-white text-4xl"></i>
                                </div>
                            <?php endif; ?>
                            <span class="category-badge"><?php echo $product_count; ?> items</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo $cat_name; ?></h3>
                            <p class="text-gray-600 mb-4">Explore our collection of <?php echo $product_count; ?>
                                <?php echo $cat_name; ?> products
                            </p>
                            <a href="products.php?category=<?php echo $cat_name; ?>"
                                class="text-primary font-semibold flex items-center hover:underline">
                                <span>Shop Now</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-span-4 text-center py-12"><p class="text-gray-500 text-lg">No categories found.</p></div>';
            }
            ?>
        </div>

        <!-- CTA Section -->
        <div class="gradient-bg rounded-2xl p-10 text-center text-white">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Can't Find What You're Looking For?</h3>
            <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto">Our team is here to help you find the
                perfect products for your fitness journey.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact.php"
                    class="px-8 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                    Contact Us
                </a>
                <a href="products.php"
                    class="px-8 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary transition duration-300">
                    View All Products
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Animation for category cards
    document.addEventListener('DOMContentLoaded', function () {
        const categoryCards = document.querySelectorAll('.category-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        categoryCards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    });
</script>
<?php
// Close connection
mysqli_close($con);
?>
<?php
include 'footer.php';
?>