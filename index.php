<?php include 'header.php' ?>

<!-- Hero Section -->
<section class="hero-section py-24 text-white mt-[70px]">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Premium Health & Fitness Products</h1>
        <p class="text-xl mb-10 max-w-2xl mx-auto">Discover top-quality fitness equipment, supplements, and wellness
            products to enhance your health journey</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100"
                href="products.php">Shop Now</a>
            <a href="category.php"
                class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition">Browse
                Categories</a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section id="featured-products" class="py-16">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-4xl font-bold text-center mb-8 text-gray-800">Featured Products</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Check out our most popular health and fitness
            products</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Product 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative">
                    <img src="https://cdn.mos.cms.futurecdn.net/gPFZp5JRS3sWAFJxECveXT.jpg" alt="Smart Fitness Tracker"
                        class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">SALE</span>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">Smart Fitness Tracker</h3>
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400 mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600 text-sm">(128 reviews)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-primary font-bold text-xl">$89.99</span>
                            <span class="text-gray-400 text-sm line-through ml-2">$119.99</span>
                        </div>
                        <button class="bg-primary text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative">
                    <img src="https://images.meesho.com/images/products/439815737/pvvrf_512.jpg" alt="Yoga Mat"
                        class="w-full h-48 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">Premium Yoga Mat</h3>
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400 mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600 text-sm">(97 reviews)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-primary font-bold text-xl">$45.99</span>
                        </div>
                        <button class="bg-primary text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative">
                    <img src="https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcTVuYRDSFQiufMOYEOQtrvU1nbcX4bO-toP-m0ZGkmkxNhBAkaK0FKeb124W7EnJaP7iHXSJ_TrlfYudkL9cFs3aXniB_9Jt75EBV4xKCmjX9z6gn8M9Rzk"
                        alt="Protein Powder" class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded">NEW</span>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">Whey Protein Powder</h3>
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400 mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600 text-sm">(215 reviews)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-primary font-bold text-xl">$39.99</span>
                        </div>
                        <button class="bg-primary text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <div class="relative">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1qM0pnILpNQm3I3TvRMPZrfnjvFSUOJTrJA&s"
                        alt="Dumbbell Set" class="w-full h-48 object-cover">
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">Adjustable Dumbbell Set</h3>
                    <div class="flex items-center mb-2">
                        <div class="text-yellow-400 mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600 text-sm">(143 reviews)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-primary font-bold text-xl">$129.99</span>
                        </div>
                        <button class="bg-primary text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="products.php"
                class="inline-block bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                View All Products
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-4xl font-bold text-center mb-8 text-gray-800">Shop by Category</h2>
        <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Browse our wide range of health and fitness
            categories</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <a href="#"
                class="category-card bg-white rounded-lg p-6 text-center shadow-md hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dumbbell text-2xl text-primary"></i>
                </div>
                <h4 class="font-bold text-gray-800">Fitness Equipment</h4>
                <p class="text-sm text-gray-600 mt-2">126 products</p>
            </a>

            <a href="#"
                class="category-card bg-white rounded-lg p-6 text-center shadow-md hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-capsules text-2xl text-primary"></i>
                </div>
                <h4 class="font-bold text-gray-800">Supplements</h4>
                <p class="text-sm text-gray-600 mt-2">89 products</p>
            </a>

            <a href="#"
                class="category-card bg-white rounded-lg p-6 text-center shadow-md hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-2xl text-primary"></i>
                </div>
                <h4 class="font-bold text-gray-800">Health Monitors</h4>
                <p class="text-sm text-gray-600 mt-2">57 products</p>
            </a>

            <a href="#"
                class="category-card bg-white rounded-lg p-6 text-center shadow-md hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tshirt text-2xl text-primary"></i>
                </div>
                <h4 class="font-bold text-gray-800">Workout Wear</h4>
                <p class="text-sm text-gray-600 mt-2">204 products</p>
            </a>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="py-16">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-4xl font-bold text-center mb-8 text-gray-800">Special Offers</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div
                class="bg-gradient-to-r from-red-500 to-red-600 rounded-xl p-8 text-white flex flex-col md:flex-row items-center">
                <div class="flex-1 mb-6 md:mb-0">
                    <h3 class="text-2xl font-bold mb-2">Summer Sale</h3>
                    <p class="mb-4">Up to 40% off on selected fitness equipment</p>
                    <a href="#"
                        class="inline-block bg-white text-red-600 px-4 py-2 rounded font-semibold hover:bg-gray-100 transition">Shop
                        Now</a>
                </div>
                <div class="flex-1">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                        alt="Summer Sale" class="rounded-lg">
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-8 text-white flex flex-col md:flex-row items-center">
                <div class="flex-1 mb-6 md:mb-0">
                    <h3 class="text-2xl font-bold mb-2">New Arrivals</h3>
                    <p class="mb-4">Check out our latest health and wellness products</p>
                    <a href="#"
                        class="inline-block bg-white text-blue-600 px-4 py-2 rounded font-semibold hover:bg-gray-100 transition">Explore</a>
                </div>
                <div class="flex-1">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQOfIelAx9Rc_jAmojxtcOnMcljhl-FbvH4nA&s"
                        alt="New Arrivals" class="rounded-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-3xl font-bold text-center mb-12">What Our Customers Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-xl p-8">
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic mb-6">"The fitness tracker I bought is amazing! It's helped me stay on
                    top of my health goals. The delivery was quick too!"</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/43.jpg" class="w-12 h-12 rounded-full mr-4"
                        alt="Customer">
                    <div>
                        <h5 class="font-bold">Sarah Johnson</h5>
                        <p class="text-gray-500 text-sm">Verified Customer</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-8">
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-gray-600 italic mb-6">"The protein powder is of excellent quality. I've been using it for
                    months now and have seen real improvements in my recovery."</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-12 h-12 rounded-full mr-4"
                        alt="Customer">
                    <div>
                        <h5 class="font-bold">Michael Chen</h5>
                        <p class="text-gray-500 text-sm">Verified Customer</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-8">
                <div class="text-yellow-400 mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 italic mb-6">"The yoga mat is perfect - non-slip and comfortable. I recommend
                    FitCheck to all my yoga students!"</p>
                <div class="flex items-center">
                    <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-12 h-12 rounded-full mr-4"
                        alt="Customer">
                    <div>
                        <h5 class="font-bold">Emma Rodriguez</h5>
                        <p class="text-gray-500 text-sm">Verified Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h2>
        <p class="mb-8 max-w-2xl mx-auto">Get the latest updates on new products, special offers, and health tips</p>
        <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
            <input type="email" placeholder="Your email address" class="flex-1 px-4 py-3 rounded text-gray-800">
            <button type="submit"
                class="bg-white text-primary px-6 py-3 rounded font-semibold hover:bg-gray-100 transition">Subscribe</button>
        </form>
    </div>
</section>

<?php include 'footer.php' ?>