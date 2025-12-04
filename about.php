<?php
include 'header.php';
?>

<!-- About Section -->
<section id="about" class="about-section mt-10 py-16 px-4 md:px-8 lg:px-16">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">About FitCheck</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">Discover how FitCheck is revolutionizing the way
                people approach health and wellness through technology and personalized guidance.</p>
        </div>

        <div class="flex flex-col lg:flex-row items-center gap-12 mb-20">
            <div class="w-full lg:w-1/2">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Our Story</h3>
                <p class="text-gray-600 mb-4">Founded in 2020, FitCheck emerged from a simple idea: health tracking
                    should be accessible, intuitive, and empowering for everyone. Our team of fitness enthusiasts,
                    nutritionists, and tech experts came together to create a platform that simplifies health
                    management.</p>
                <p class="text-gray-600 mb-6">We believe that everyone deserves to have the tools and knowledge to
                    take control of their health journey, regardless of their fitness level or experience.</p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="px-6 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                        Learn More
                    </a>
                    <a href="contact.php"
                        class="px-6 py-3 border border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                        alt="FitCheck Team" class="rounded-xl shadow-lg">
                    <div
                        class="absolute -bottom-6 -left-6 bg-white p-6 rounded-xl shadow-lg floating-card hidden md:block">
                        <div class="flex items-center">
                            <div class="text-3xl text-primary mr-4">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">5,000+</h4>
                                <p class="text-gray-600">Active Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
            <div class="bg-white rounded-xl p-6 text-center shadow-md floating-card">
                <div class="stat-number">10K+</div>
                <p class="text-gray-600">Happy Customers</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md floating-card">
                <div class="stat-number">500+</div>
                <p class="text-gray-600">Health Products</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md floating-card">
                <div class="stat-number">50+</div>
                <p class="text-gray-600">Expert Trainers</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center shadow-md floating-card">
                <div class="stat-number">5+</div>
                <p class="text-gray-600">Years Experience</p>
            </div>
        </div>

        <!-- Our Values -->
        <div class="mb-16">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-12">Our Values</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 text-center shadow-md floating-card">
                    <div class="values-icon bg-blue-100 text-primary mx-auto">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Innovation</h4>
                    <p class="text-gray-600">We continuously explore new technologies and approaches to improve
                        health tracking and make it accessible to everyone.</p>
                </div>
                <div class="bg-white rounded-xl p-8 text-center shadow-md floating-card">
                    <div class="values-icon bg-green-100 text-secondary mx-auto">
                        <i class="fas fa-hands-helping text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Community</h4>
                    <p class="text-gray-600">We believe in the power of community support and shared experiences to
                        motivate and inspire health journeys.</p>
                </div>
                <div class="bg-white rounded-xl p-8 text-center shadow-md floating-card">
                    <div class="values-icon bg-purple-100 text-purple-600 mx-auto">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Trust</h4>
                    <p class="text-gray-600">We prioritize data security and privacy, ensuring your health
                        information remains confidential and protected.</p>
                </div>
            </div>
        </div>
        <!-- CTA Section -->
        <div class="gradient-bg rounded-2xl p-10 text-center text-white">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Ready to Start Your Health Journey?</h3>
            <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto">Join thousands of users who are achieving
                their health goals with FitCheck's comprehensive platform.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#"
                    class="px-8 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-300">
                    Get Started
                </a>
                <a href="#"
                    class="px-8 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary transition duration-300">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Animation for stats counting
    document.addEventListener('DOMContentLoaded', function () {
        const statElements = document.querySelectorAll('.stat-number');
        const stats = [10000, 500, 50, 5];
        const durations = [2000, 1500, 1000, 800];

        statElements.forEach((element, index) => {
            const target = stats[index];
            const duration = durations[index];
            const increment = target / (duration / 16);
            let current = 0;

            const updateCount = () => {
                if (current < target) {
                    current += increment;
                    if (current > target) current = target;
                    element.textContent = Math.round(current).toLocaleString() + '+';
                    requestAnimationFrame(updateCount);
                }
            };

            // Start counting when element is in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        observer.unobserve(entry.target);
                    }
                });
            });

            observer.observe(element);
        });
    });
</script>
<?php
include 'footer.php';
?>