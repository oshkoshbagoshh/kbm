<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influencer Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-6 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">Join Our Influencer Community</h1>
            <p class="text-lg md:text-xl mb-8">
                Share your expertise, connect with brands, and grow your influence. Sign up today to become a writer!
            </p>
            <a href="#signup-form" class="bg-white text-blue-600 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition">
                Sign Up Now
            </a>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Latest Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Article 1 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Top 10 Quick Meal Prep Tips for Busy Moms</h3>
                    <p class="text-gray-600 mb-4">Learn how to save time and prepare healthy meals for your family with these quick tips.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
                <!-- Article 2 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">The Best Kitchen Gadgets for Home Cooks</h3>
                    <p class="text-gray-600 mb-4">Discover the must-have kitchen gadgets to make cooking fun and easy.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
                <!-- Article 3 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">How to Stay Healthy While Traveling</h3>
                    <p class="text-gray-600 mb-4">Tips and tricks for staying fit and eating healthy on the go.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
                <!-- Article 4 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Budget-Friendly Fashion Tips</h3>
                    <p class="text-gray-600 mb-4">Look stylish without breaking the bank with these fashion hacks.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
                <!-- Article 5 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Top Travel Destinations for 2025</h3>
                    <p class="text-gray-600 mb-4">Explore the most exciting travel destinations to visit this year.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
                <!-- Article 6 -->
                <div class="bg-gray-50 shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Why Self-Care Matters</h3>
                    <p class="text-gray-600 mb-4">Learn how prioritizing self-care can improve your overall well-being.</p>
                    <a href="#" class="text-blue-600 font-medium hover:underline">Read More</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Sign-Up Form Section -->
    <section id="signup-form" class="bg-gray-50 py-16">
        <div class="container mx-auto px-6 max-w-lg bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Sign Up to Become a Writer</h2>
            <form action="/submit" method="POST" class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your Name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Bio -->
                <div>
                    <label for="bio" class="block text-gray-700 font-medium mb-2">Bio</label>
                    <textarea id="bio" name="bio" placeholder="Tell us about yourself..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                </div>

                <!-- Product Group -->
                <div>
                    <label for="product_group" class="block text-gray-700 font-medium mb-2">Product Group</label>
                    <select id="product_group" name="product_group" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select a Category</option>
                        <option value="Mom_A">Mom_A</option>
                        <option value="Women_A">Women_A</option>
                        <option value="Men_A">Men_A</option>
                        <option value="Men_B">Men_B</option>
                        <option value="Tech_A">Tech_A</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Klutch Products | All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>