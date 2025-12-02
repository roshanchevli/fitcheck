<!-- Footer -->
<footer class="bg-gradient-to-r from-dark to-[#3a3b45] text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h5 class="text-lg font-bold uppercase mb-4">FitCheck Health Portal</h5>
                <p class="text-gray-300">Your comprehensive solution for tracking health metrics, setting goals, and
                    achieving wellness.</p>
            </div>
            <div>
                <h5 class="text-lg font-bold uppercase mb-4">Links</h5>
                <ul class="space-y-2">
                    <li><a href="index.php" class="text-gray-300 hover:text-white">Home</a></li>
                    <li><a href="#features" class="text-gray-300 hover:text-white">Features</a></li>
                    <li><a href="#about" class="text-gray-300 hover:text-white">About</a></li>
                    <li><a href="#contact" class="text-gray-300 hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-lg font-bold uppercase mb-4">Resources</h5>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white">Help Center</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-lg font-bold uppercase mb-4">Contact Us</h5>
                <div class="space-y-2">
                    <p class="flex items-center text-gray-300"><i class="fas fa-envelope mr-2"></i>chevlir115@gmail.com
                    </p>
                    <p class="flex items-center text-gray-300"><i class="fas fa-phone mr-2"></i> +91 9016055880</p>
                    <p class="flex items-center text-gray-300"><i class="fas fa-map-marker-alt mr-2"></i> 123, local
                        St,Surat City</p>
                </div>
            </div>
        </div>
        <hr class="border-gray-600 my-8">
        <div class="text-center">
            <p class="text-gray-300">© 2023 FitCheck Health Portal. All rights reserved.</p>
        </div>
    </div>
</footer>
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modal when clicking outside
    document.querySelectorAll('[id$="Modal"]').forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeModal(modal.id);
            }
        });
    });
</script>
</body>

</html>