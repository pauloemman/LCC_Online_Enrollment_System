<?php session_start();
include('includes/header.php'); ?>

<!-- NAVBAR -->
<div class="navbar bg-base-100 shadow-md px-4">
    <div class="flex-1">
        <a class="text-xl font-bold text-blue-600">
            LCC Online Enrollment System
        </a>
    </div>
</div>

<!-- CENTERED LOGIN FORM -->
<div class="min-h-screen flex items-center justify-center bg-base-200">

    <div class="card w-full max-w-md shadow-lg bg-base-100">
        <div class="card-body">

            <h2 class="text-2xl font-bold text-center text-blue-600">
                Login
            </h2>

            <input type="email" id="login_email" placeholder="Email" class="input input-bordered w-full" required>

            <input type="password" id="login_password" placeholder="Password" class="input input-bordered w-full"
                required>

            <button type="button" class="btn btn-primary w-full --btn-login"> Login </button>

            <!-- REGISTER LINK -->
            <p class="text-center text-sm mt-4">
                Don’t have an account?
                <a href="registerForm.php" class="text-blue-600 font-semibold hover:underline">
                    Register now
                </a>
            </p>

        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>