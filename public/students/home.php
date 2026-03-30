<?php session_start();
include('header.php'); ?>

<div class="drawer">
    <input id="drawer-toggle" type="checkbox" class="drawer-toggle" />

    <!-- MAIN CONTENT -->
    <div class="drawer-content flex flex-col">

        <!-- NAVBAR -->
        <div class="navbar bg-base-100 shadow-md px-4">
            <div class="flex-none">
                <label for="drawer-toggle" class="btn btn-square btn-ghost">
                    <!-- MENU ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block h-5 w-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>

            <div class="flex-1">
                <span class="text-xl font-bold text-blue-600">
                    LCC Enrollment System
                </span>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <p>Welcome to your student dashboard.</p>
        </div>

    </div>

    <!-- SIDEBAR -->
    <div class="drawer-side">
        <label for="drawer-toggle" class="drawer-overlay"></label>

        <ul class="menu p-4 w-64 min-h-full bg-base-200 text-base-content">

            <li class="text-lg font-bold mb-2">Menu</li>

            <li><a href="home.php">🏠 Home</a></li>
            <li><a href="grades.php">📊 View Grades</a></li>
            <li><a href="status.php">📋 Enrollment Status</a></li>
            <li><a href="profile.php">👤 Profile</a></li>

            <div class="divider"></div>

            <li><a href="logout.php" class="text-red-500">🚪 Logout</a></li>

        </ul>
    </div>
</div>

<?php
include('footer.php'); ?>