<?php session_start();
include('header.php'); ?>

<?php
include('../../classes/registrar.php');

$data = new registrar();
$row = $data->viewEnrollments();
?>

<div class="min-h-screen bg-slate-50">

    <div class="navbar bg-base-100 shadow-sm border-b border-slate-200 px-4 md:px-8 sticky top-0 z-30">
        <div class="flex-1">
            <a href="home.php" class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Home
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Enrollment Management</h1>
        </div>

    </div>

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    <span class="text-blue-600">Enrollments</span>
                </h2>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3">
                <?php echo count($row); ?> Total Enrollments
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Student ID</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Course</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Full Name</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Section</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Year Level</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Semester</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Enrollment Status
                            </th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 text-right">Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($row)) { ?>
                        <tr>
                            <td colspan="3" class="text-center py-20">
                                <div class="flex flex-col items-center opacity-40">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="text-lg font-semibold tracking-tight">No enrollments found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <?php foreach ($row as $items) { ?>
                        <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                        <?php echo htmlspecialchars($items['student_no']); ?>
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['course_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['first_name']); ?>
                                <?php echo htmlspecialchars($items['middle_name']); ?>
                                <?php echo htmlspecialchars($items['last_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['section_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['year_level']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['semester']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['enrollment_status']); ?>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="btn btn-sm btn-ghost text-emerald-400 hover:text-emerald-600 hover:bg-emerald-50 border border-transparent hover:border-emerald-100 --btn-approve"
                                        data-id="<?php echo $items['id']; ?>">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>

                                        Approve
                                    </button>
                                    <button
                                        class="btn btn-sm btn-ghost text-rose-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 --btn-delete"
                                        data-id="<?php echo $items['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include('includes/enrollFooter.php'); ?>