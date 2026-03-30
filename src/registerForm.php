<?php session_start();
include('includes/header.php'); ?>

<!-- NAVBAR -->
<div class="navbar bg-base-100 shadow-md px-4">
    <div class="flex-1">
        <a href="index.php" class="text-xl font-bold text-blue-600">
            LCC Online Enrollment System
        </a>
    </div>
</div>

<!-- CENTERED REGISTER FORM -->
<div class="min-h-screen flex items-center justify-center bg-base-200">

    <div class="card w-full max-w-md shadow-lg bg-base-100">
        <div class="card-body">

            <h2 class="text-2xl font-bold text-center text-blue-600">
                Create Account
            </h2>

            <input type="text" id="name" placeholder="Full Name" class="input input-bordered w-full" required>

            <input type="email" id="email" placeholder="Email" class="input input-bordered w-full" required>

            <input type="password" id="password" placeholder="Password" class="input input-bordered w-full" required>


            <button type="button" class="btn btn-primary w-full --btn-register">
                Register
            </button>

            <!-- LOGIN LINK -->
            <p class="text-center text-sm mt-4">
                Already have an account?
                <a href="home.php" class="text-blue-600 font-semibold hover:underline">
                    Login here
                </a>
            </p>

        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>