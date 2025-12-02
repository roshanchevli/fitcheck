<?php
include 'header.php';
?>

<!-- Contact Section -->
<section id="contact" class="contact-section mt-10 py-16 px-4 md:px-8 lg:px-16">
    <div class="container mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Contact Us</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">Have questions or need support? Our team is here to
                help you on your health and wellness journey.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-16">
            <!-- Contact Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl p-8 shadow-md floating-card h-full">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h3>
                    <p class="text-gray-600 mb-8">We'd love to hear from you. Reach out to us through any of the
                        following channels.</p>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="contact-icon bg-blue-100 text-primary mr-5">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">Address</h4>
                                <p class="text-gray-600">123, Pramukh Street, Citylight<br>Surat, 390039
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="contact-icon bg-green-100 text-secondary mr-5">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">Phone</h4>
                                <p class="text-gray-600">+91 9016055880<br>+91 9873457654 </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="contact-icon bg-purple-100 text-purple-600 mr-5">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">Email</h4>
                                <p class="text-gray-600">info@fitcheck.com<br>support@fitcheck.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="contact-icon bg-yellow-100 text-yellow-600 mr-5">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-1">Hours</h4>
                                <p class="text-gray-600">Monday-Friday: 9am - 6pm<br>Saturday: 10am - 4pm<br>Sunday:
                                    Closed</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center hover:bg-pink-600 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-blue-100 text-primary flex items-center justify-center hover:bg-primary hover:text-white transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl p-8 shadow-md floating-card h-full">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h3>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your
                                    Name</label>
                                <input type="text" id="name" class="form-input" placeholder="Enter your name" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Address</label>
                                <input type="email" id="email" class="form-input" placeholder="Enter your email"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" class="form-input" placeholder="What is this regarding?">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your
                                Message</label>
                            <textarea id="message" rows="5" class="form-input" placeholder="Type your message here..."
                                required></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="mb-16">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-12">Frequently Asked Questions
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-md floating-card">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">How do I create an account?</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">Creating an account is simple! Click on the "Sign Up" button at the top
                        right corner, fill in your details, and you'll be ready to start your fitness journey.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-md floating-card">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">What payment methods do you accept?</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">We accept all major credit cards, PayPal, and Apple Pay. All
                        transactions are secure and encrypted for your protection.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-md floating-card">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">Can I cancel my subscription?</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">Yes, you can cancel your subscription at any time from your account
                        settings. There are no cancellation fees.</p>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-md floating-card">
                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 text-primary p-2 rounded-lg mr-4">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">Do you offer personalized training
                                plans?</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">Yes! Our premium members get access to personalized training plans
                        tailored to their goals, fitness level, and available equipment.</p>
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="#" class="text-primary font-semibold hover:underline flex items-center justify-center">
                    <span>View all FAQs</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="gradient-bg rounded-2xl p-10 text-center text-white">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">Stay Updated with FitCheck</h3>
            <p class="text-white text-opacity-90 mb-8 max-w-2xl mx-auto">Subscribe to our newsletter for the latest
                health tips, product updates, and exclusive offers.</p>

            <form class="flex flex-col sm:flex-row justify-center gap-4 max-w-2xl mx-auto">
                <input type="email" placeholder="Enter your email address"
                    class="px-6 py-3 rounded-lg border-0 focus:ring-2 focus:ring-white focus:ring-opacity-50 text-gray-900 flex-grow">
                <button type="submit"
                    class="px-8 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-300 whitespace-nowrap">
                    Subscribe Now
                </button>
            </form>

            <p class="text-white text-opacity-70 text-sm mt-4">We respect your privacy. You can unsubscribe at any
                time.</p>
        </div>
    </div>
</section>

<script>
    // Form validation and submission
    document.addEventListener('DOMContentLoaded', function () {
        const contactForm = document.querySelector('form');

        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Basic validation
                const nameInput = document.getElementById('name');
                const emailInput = document.getElementById('email');
                const messageInput = document.getElementById('message');

                let isValid = true;

                if (!nameInput.value.trim()) {
                    isValid = false;
                    highlightError(nameInput);
                } else {
                    removeHighlight(nameInput);
                }

                if (!emailInput.value.trim() || !isValidEmail(emailInput.value)) {
                    isValid = false;
                    highlightError(emailInput);
                } else {
                    removeHighlight(emailInput);
                }

                if (!messageInput.value.trim()) {
                    isValid = false;
                    highlightError(messageInput);
                } else {
                    removeHighlight(messageInput);
                }

                if (isValid) {
                    // Simulate form submission
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
                    submitBtn.disabled = true;

                    setTimeout(() => {
                        alert('Thank you for your message! We will get back to you soon.');
                        contactForm.reset();
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    }, 1500);
                }
            });
        }

        function highlightError(input) {
            input.style.borderColor = '#e53e3e';
            input.style.boxShadow = '0 0 0 3px rgba(229, 62, 62, 0.2)';
        }

        function removeHighlight(input) {
            input.style.borderColor = '#e2e8f0';
            input.style.boxShadow = 'none';
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>
<?php
include 'footer.php';
?>