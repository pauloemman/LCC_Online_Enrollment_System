<?php session_start();
include('header.php'); ?>

<div class="p-6 md:p-10 bg-base-200 min-h-screen">

    <div class="max-w-7xl mx-auto mb-10">
        <h1 class="text-3xl font-black tracking-tight italic uppercase">Administrative Overview</h1>
        <p class="text-base-content opacity-60">Manage student records and system verifications.</p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="card bg-base-100 shadow-xl border-t-4 border-primary hover:shadow-2xl transition-all duration-300">
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <h2 class="card-title text-primary font-bold">Enrollments</h2>
                    <div class="badge badge-primary badge-outline">Active</div>
                </div>
                <p class="text-sm opacity-70 mt-2">Process new and returning student enrollment applications.</p>
                <div class="card-actions justify-end mt-6">
                    <a href="manage_enrollments.php" class="btn btn-primary btn-sm btn-block">Open Module</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border-t-4 border-info hover:shadow-2xl transition-all duration-300">
            <div class="card-body">
                <h2 class="card-title text-info font-bold">Exam Passers</h2>
                <p class="text-sm opacity-70 mt-2">Manage the list of successful examinees and admission status.</p>
                <div class="card-actions justify-end mt-6">
                    <a href="exam_passers.php" class="btn btn-info btn-sm btn-block text-white">View List</a>
                </div>
            </div>
        </div>

        <div
            class="card bg-base-100 shadow-xl border-t-4 border-secondary hover:shadow-2xl transition-all duration-300">
            <div class="card-body">
                <h2 class="card-title text-secondary font-bold">Student Grades</h2>
                <p class="text-sm opacity-70 mt-2">Input and finalize academic records and semester grades.</p>
                <div class="card-actions justify-end mt-6">
                    <a href="manage_grades.php" class="btn btn-secondary btn-sm btn-block">Update Grades</a>
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border-t-4 border-accent hover:shadow-2xl transition-all duration-300">
            <div class="card-body">
                <div class="flex justify-between items-start">
                    <h2 class="card-title text-accent font-bold">Verifications</h2>
                    <div class="badge badge-accent badge-sm">New</div>
                </div>
                <p class="text-sm opacity-70 mt-2">Validate identity and credentials for new user registrations.</p>
                <div class="card-actions justify-end mt-6">
                    <a href="verify_accounts.php" class="btn btn-accent btn-sm btn-block text-white">Review Now</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('footer.php'); ?>