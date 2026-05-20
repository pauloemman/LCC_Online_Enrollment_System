<?php session_start();
include('header.php'); ?>

<?php
include('../../classes/registrar.php');

$data = new registrar();

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$students = $data->searchApprovedStudents($search);
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
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Student Grading System</h1>
        </div>

        <div class="flex-1 justify-end flex">
            <?php if (!empty($search)) { ?>
            <a href="?" class="btn btn-ghost btn-sm text-slate-500 gap-1 hover:bg-slate-100">
                Clear Search
            </a>
            <?php } ?>
        </div>
    </div>

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Approved <span class="text-blue-600">Students</span>
                </h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                <form method="GET" class="join w-full sm:w-auto">
                    <input type="text" name="search" placeholder="Search name or ID..."
                        value="<?php echo htmlspecialchars($search); ?>"
                        class="input input-bordered input-sm join-item w-full sm:w-64 bg-white focus:bg-white focus:ring-2 focus:ring-blue-100" />
                    <button type="submit" class="btn btn-primary btn-sm join-item shadow-md shadow-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <div
                    class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3 whitespace-nowrap">
                    <?php echo count($students); ?> Approved Records
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Student No</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Full Name</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Course</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Section</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 text-right">Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        <?php if (empty($students)) { ?>
                        <tr>
                            <td colspan="5" class="text-center py-20">
                                <div class="flex flex-col items-center opacity-40">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="text-lg font-semibold tracking-tight">No approved students
                                        found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>


                        <?php foreach ($students as $s) { ?>
                        <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                    <?php echo htmlspecialchars($s['student_no']); ?>
                                </span>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($s['first_name'] . ' ' . $s['middle_name'] . ' ' . $s['last_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($s['course_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($s['section_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end">
                                    <a href="grade_page.php?enrollment_id=<?php echo $s['enrollment_id']; ?>&student_id=<?php echo $s['student_id']; ?>&section_id=<?php echo $s['section_id']; ?>"
                                        class="btn btn-sm btn-ghost hover:bg-white hover:text-blue-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-blue-200 gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Encode Grades
                                    </a>
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

<?php include('includes/exPassersFooter.php'); ?>