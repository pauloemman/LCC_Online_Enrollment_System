<?php session_start();
include('header.php');
include('../../classes/registrar.php');

$data = new registrar();

$student_id = $_GET['student_id'];
$section_id = $_GET['section_id'];
$enrollment_id = $_GET['enrollment_id'];

$student = $data->getStudentById($student_id);

$subjects = $data->getSectionSubjects($section_id);
?>

<div class="min-h-screen bg-slate-50">
    <div class="navbar bg-base-100 shadow-sm border-b border-slate-200 px-4 md:px-8 sticky top-0 z-30">
        <div class="flex-1">
            <a href="search_students.php" class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Search
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Grade Processing Terminal</h1>
        </div>

        <div class="flex-1 justify-end flex">
            <button type="submit" form="gradeForm"
                class="btn btn-primary btn-sm shadow-md shadow-blue-200 gap-2 --btn-submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Save Grades
            </button>
        </div>
    </div>
    <div class="max-w-6xl mx-auto p-6 md:p-10">
        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Grade <span class="text-blue-600">Encoding</span>
                </h2>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-bold px-4 py-3 tracking-wide">
                <?php echo htmlspecialchars($student['student_no']); ?> &mdash;
                <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
            </div>
        </div>

        <div id="formAlert" class="hidden mb-6 text-sm p-4 rounded-xl border"></div>

        <form id="gradeForm">
            <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>">
            <input type="hidden" name="section_id" value="<?php echo htmlspecialchars($section_id); ?>">
            <input type="hidden" name="enrollment_id" value="<?php echo htmlspecialchars($enrollment_id); ?>">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full border-separate border-spacing-0">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Subject</th>
                                <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Instructor</th>
                                <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 w-44">Grade</th>
                                <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 w-48">Remarks
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            <?php foreach ($subjects as $sub) { ?>
                            <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                                <td class="py-4 px-6">
                                    <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                        <?php echo htmlspecialchars($sub['subject_name']); ?>
                                    </span>
                                    <input type="hidden" name="subject_id[]"
                                        value="<?php echo htmlspecialchars($sub['subject_id']); ?>">
                                </td>

                                <td class="py-4 px-6 text-slate-500 font-medium italic">
                                    <?php echo htmlspecialchars($sub['instructor']); ?>
                                </td>

                                <td class="py-4 px-6">
                                    <input type="text" name="grade[]" placeholder="e.g. 1.75"
                                        class="input input-bordered input-sm w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 font-semibold"
                                        required>
                                </td>

                                <td class="py-4 px-6">
                                    <select name="remarks[]"
                                        class="select select-bordered select-sm w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 font-medium"
                                        required>
                                        <option value="">Select Result</option>
                                        <option value="Passed">Passed</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </td>

                            </tr>
                            <?php ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end items-center gap-3 mt-6">
                <a href="search_students.php" class="btn bg-slate-100 border-none text-slate-600 hover:bg-slate-200">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary px-8 shadow-lg shadow-blue-200">
                    Save Student Grades
                </button>
            </div>
        </form>
    </div>
</div>


<?php include('includes/exPassersFooter.php'); ?>