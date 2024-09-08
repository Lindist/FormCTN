<?php

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
} else if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
}

echo $admin_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.1.7/dist/full.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Sidebar for Desktop & Navbar for Mobile -->
    <div class="flex min-h-screen">
        
        <!-- Sidebar (Visible on Desktop) -->
        <aside class="w-64 bg-gray-800 text-gray-100 hidden md:block fixed h-full">
            <div class="p-4">
                <h1 class="text-2xl font-bold text-center">Admin Panel</h1>
            </div>
            <nav class="mt-5">
                <ul>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Users</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Reports</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Settings</a></li>
                    <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64">
            <!-- Navbar for Mobile (Visible on Mobile) -->
            <nav class="bg-gray-800 text-gray-100 p-4 md:hidden">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Admin Panel</h1>
                    <button id="mobileMenuToggle" class="text-gray-200 focus:outline-none">
                        ☰
                    </button>
                </div>

                <!-- Mobile Menu (Initially Hidden) -->
                <div id="mobileMenu" class="hidden mt-4">
                    <ul>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Users</a></li>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Reports</a></li>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Settings</a></li>
                        <li><a href="#" class="block py-2 px-4 hover:bg-gray-700">Logout</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Header -->
            <header class="bg-white shadow p-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
                    <button class="btn btn-outline btn-primary">New Action</button>
                </div>
            </header>

            <!-- Content Section -->
            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Card 1 -->
                    <div class="card bg-white shadow-md rounded-lg">
                        <div class="card-body">
                            <h3 class="text-lg font-semibold">Total Users</h3>
                            <p class="text-3xl font-bold">345</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="card bg-white shadow-md rounded-lg">
                        <div class="card-body">
                            <h3 class="text-lg font-semibold">Active Sessions</h3>
                            <p class="text-3xl font-bold">28</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="card bg-white shadow-md rounded-lg">
                        <div class="card-body">
                            <h3 class="text-lg font-semibold">Pending Reports</h3>
                            <p class="text-3xl font-bold">5</p>
                        </div>
                    </div>
                </div>

                <!-- Other content can go here -->
            </main>
        </div>
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
