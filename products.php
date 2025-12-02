<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

// Check if connection was successful
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the selected category from the URL parameter
$selected_category = isset($_GET['category']) ? mysqli_real_escape_string($con, $_GET['category']) : 'all';

// Get products from database with optional category filter
if ($selected_category !== 'all') {
    $query = "SELECT p.*, c.cat_name 
              FROM tbl_product p 
              LEFT JOIN tbl_category c ON p.category = c.cat_name 
              WHERE p.category = '$selected_category'
              ORDER BY p.pid DESC";
} else {
    $query = "SELECT p.*, c.cat_name 
              FROM tbl_product p 
              LEFT JOIN tbl_category c ON p.category = c.cat_name 
              ORDER BY p.pid DESC";
}

$result = mysqli_query($con, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Get categories for filter
$categories_query = "SELECT * FROM tbl_category";
$categories_result = mysqli_query($con, $categories_query);
$categories = [];
while ($row = mysqli_fetch_assoc($categories_result)) {
    $categories[] = $row;
}

mysqli_close($con);
include 'header.php';
?>
<!-- Products Section -->
<section id="products" class="products-section mt-5 py-16 px-4 md:px-8 lg:px-16">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Products</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">Discover our premium selection of health and fitness
                products to support your wellness journey</p>
        </div>

        <!-- Filters Section -->
        <div class="mb-12 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Filter Products</h3>
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <!-- Category Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <div class="flex flex-wrap gap-2">
                        <a href="?category=all"
                            class="category-filter <?php echo $selected_category === 'all' ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700'; ?> px-4 py-2 rounded-full text-sm font-medium transition-all">
                            All Products
                        </a>
                        <?php foreach ($categories as $category): ?>
                            <a href="?category=<?php echo $category['cat_name']; ?>"
                                class="category-filter <?php echo $selected_category === $category['cat_name'] ? 'bg-primary text-white' : 'bg-gray-200 text-gray-700'; ?> px-4 py-2 rounded-full text-sm font-medium transition-all">
                                <?php echo $category['cat_name']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>


            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-16" id="productsGrid">
            <?php
            if (count($products) > 0) {
                foreach ($products as $product) {
                    $product_id = $product['pid'];
                    $product_name = isset($product['pname']) ? $product['pname'] : 'Unnamed Product';
                    $product_desc = isset($product['pdesc']) ? $product['pdesc'] : 'No description available.';
                    $product_price = isset($product['price']) ? $product['price'] : 0;
                    $product_image = isset($product['pic']) ? $product['pic'] : '';
                    $category_name = isset($product['category']) ? $product['category'] : 'Uncategorized';
                    $product_stock = isset($product['pstock']) ? $product['pstock'] : 10;

                    // Check if image exists, if not use placeholder
                    $image_path = '';
                    if (!empty($product_image)) {
                        // Check if it's a full URL or a relative path
                        if (filter_var($product_image, FILTER_VALIDATE_URL)) {
                            $image_path = $product_image;
                        } else {
                            // Check if file exists in the server
                            if (file_exists($product_image)) {
                                $image_path = $product_image;
                            } else {
                                // Try to find the image in different common directories
                                $possible_paths = [
                                    'uploads/' . $product_image,
                                    'images/' . $product_image,
                                    'assets/images/' . $product_image,
                                    'img/' . $product_image,
                                    '../uploads/' . $product_image,
                                    '../images/' . $product_image,
                                ];

                                $found = false;
                                foreach ($possible_paths as $path) {
                                    if (file_exists($path)) {
                                        $image_path = $path;
                                        $found = true;
                                        break;
                                    }
                                }

                                if (!$found) {
                                    $image_path = 'https://via.placeholder.com/300x300?text=Product+Image';
                                }
                            }
                        }
                    } else {
                        // Use a placeholder image if no image is specified
                        $image_path = 'https://via.placeholder.com/300x300?text=Product+Image';
                    }

                    // Determine badge color based on stock
                    if ($product_stock > 20) {
                        $badge_class = "bg-green-100 text-green-800";
                        $stock_text = "In Stock";
                    } elseif ($product_stock > 0) {
                        $badge_class = "bg-yellow-100 text-yellow-800";
                        $stock_text = "Low Stock";
                    } else {
                        $badge_class = "bg-red-100 text-red-800";
                        $stock_text = "Out of Stock";
                    }

                    // Generate random rating for demo
                    $rating = rand(35, 50) / 10;
                    $full_stars = floor($rating);
                    $has_half_star = ($rating - $full_stars) >= 0.5;
                    $empty_stars = 5 - $full_stars - ($has_half_star ? 1 : 0);
                    ?>
                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-shadow"
                        data-category="<?php echo $category_name; ?>" data-price="<?php echo $product_price; ?>">
                        <div class="relative overflow-hidden">
                            <img src="<?php echo $image_path; ?>" alt="<?php echo $product_name; ?>"
                                class="product-image w-full h-48 object-cover">
                        </div>

                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span class="text-xs font-medium bg-blue-100 text-primary px-2 py-1 rounded">
                                    <?php echo $category_name; ?>
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-2 truncate"><?php echo $product_name; ?></h3>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                <?php echo substr($product_desc, 0, 80); ?>...
                            </p>

                            <div class="flex items-center mb-4">
                                <div class="rating flex text-yellow-400 mr-2">
                                    <?php for ($i = 0; $i < $full_stars; $i++): ?>
                                        <i class="fas fa-star text-sm"></i>
                                    <?php endfor; ?>

                                    <?php if ($has_half_star): ?>
                                        <i class="fas fa-star-half-alt text-sm"></i>
                                    <?php endif; ?>

                                    <?php for ($i = 0; $i < $empty_stars; $i++): ?>
                                        <i class="far fa-star text-sm"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-gray-500 text-sm">(<?php echo rand(15, 125); ?>)</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span
                                    class="text-2xl font-bold text-primary">$<?php echo number_format($product_price, 2); ?></span>

                                <?php if ($product_stock > 0): ?>
                                    <a href="add_cart.php?id=<?= $product_id ?>"
                                        class="-btn bg-primary text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-700 transition">
                                        Add to Cart
                                    </a>
                                <?php else: ?>
                                    <button class="bg-gray-300 text-gray-600 py-2 px-4 rounded-lg font-medium cursor-not-allowed"
                                        disabled>
                                        Out of Stock
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-span-4 text-center py-12"><p class="text-gray-500 text-lg">No products found.</p></div>';
            }
            ?>
        </div>

        <!-- CTA Section -->
        <div class="gradient-bg rounded-2xl p-10 text-center text-white">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Can't Find What You're Looking For?</h3>
            <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto">Contact our team for personalized
                recommendations and assistance</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="contact.php"
                    class="px-8 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                    Contact Us
                </a>
                <a href="category.php"
                    class="px-8 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary transition duration-300">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Animation for product cards
    document.addEventListener('DOMContentLoaded', function () {
        const productCards = document.querySelectorAll('.product-card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        productCards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });

        // Add to cart functionality
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const productCard = this.closest('.product-card');
                const productName = productCard.querySelector('h3').textContent;

                // Animation
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i>';
                this.classList.add('bg-green-500');

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('bg-green-500');
                }, 1500);

                // Show notification (in a real application, this would add to cart)
                alert(`${productName} added to cart!`);
            });
        });

        // Filter functionality - only for price and sort (category is handled server-side)
        const priceRange = document.getElementById('priceRange');
        const priceValue = document.getElementById('priceValue');
        const sortSelect = document.getElementById('sortSelect');
        const productsGrid = document.getElementById('productsGrid');
        const products = Array.from(document.querySelectorAll('.product-card'));

        // Update price value display
        priceRange.addEventListener('input', function () {
            priceValue.textContent = this.value;
            filterProducts();
        });

        // Sort select
        sortSelect.addEventListener('change', filterProducts);

        function filterProducts() {
            const maxPrice = parseInt(priceRange.value);
            const sortBy = sortSelect.value;

            // Filter products by price
            const filteredProducts = products.filter(product => {
                const productPrice = parseFloat(product.dataset.price);
                return productPrice <= maxPrice;
            });

            // Sort products
            filteredProducts.sort((a, b) => {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                const nameA = a.querySelector('h3').textContent.toLowerCase();
                const nameB = b.querySelector('h3').textContent.toLowerCase();

                switch (sortBy) {
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    case 'name':
                        return nameA.localeCompare(nameB);
                    default: // newest
                        return 0; // Already sorted by newest in PHP
                }
            });

            // Update grid with animation
            productsGrid.style.opacity = 0;
            setTimeout(() => {
                productsGrid.innerHTML = '';
                filteredProducts.forEach(product => {
                    productsGrid.appendChild(product);
                });

                // If no products match filters
                if (filteredProducts.length === 0) {
                    productsGrid.innerHTML = '<div class="col-span-4 text-center py-12"><p class="text-gray-500 text-lg">No products match your filters.</p></div>';
                }

                productsGrid.style.opacity = 1;
            }, 300);
        }
    });
</script>

<?php include 'footer.php'; ?>