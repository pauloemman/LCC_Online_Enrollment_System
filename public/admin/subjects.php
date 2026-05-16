<?php session_start();
include('includes/subHeader.php'); ?>

<?php
include('../../classes/admin.php');

$data = new admins();
$row = $data->viewSubjects();
$courses = $data->viewCourses();
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
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Subjects Management</h1>
        </div>

        <div class="flex-1 justify-end flex">
            <button onclick="createModal.showModal()" class="btn btn-primary btn-sm shadow-md shadow-blue-200 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Subject
            </button>
        </div>
    </div>

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Subjects
                </h2>
                <p class="text-slate-500 text-sm mt-1">Manage Subjects.</p>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3">
                <?php echo count($row); ?> Total Subjects
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Subject Code</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Subject Name</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Lecture Units</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Lab Units</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Year Level</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Semester</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Date Created</th>
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
                                    <span class="text-lg font-semibold tracking-tight">No subjects found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <?php foreach ($row as $items) { ?>
                        <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['subject_code']); ?>
                            </td>

                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                        <?php echo htmlspecialchars($items['subject_name']); ?>
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['lecture_units']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['lab_units']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['year_level']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['semester']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['created_at']); ?>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="btn btn-sm btn-ghost hover:bg-white hover:text-blue-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-blue-200 --btn-edit"
                                        data-id="<?php echo $items['id']; ?>"
                                        data-code="<?php echo $items['subject_code']; ?>"
                                        data-name="<?php echo $items['subject_name']; ?>"
                                        data-lecture="<?php echo $items['lecture_units']; ?>"
                                        data-lab="<?php echo $items['lab_units']; ?>"
                                        data-year="<?php echo $items['year_level']; ?>"
                                        data-semester="<?php echo $items['semester']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
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

    <!-- CREATE NEW SUBJECT -->
    <dialog id="createModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Create New Subject</h2>
            </div>

            <div class="p-6">
                <div id="formAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100"></div>

                <form id="createForm" class="space-y-4">

                    <!-- COURSE -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Course
                            </span>
                        </label>

                        <select id="courseId" name="courseId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>

                            <option value="">Select Course</option>

                            <?php foreach ($courses as $course) { ?>
                            <option value="<?php echo $course['id']; ?>">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                                (
                                <?php echo htmlspecialchars($course['course_code']); ?>)
                            </option>
                            <?php } ?>

                        </select>
                    </div>

                    <!-- CODE -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Subject Code
                            </span></label>
                        <input type="text" id="subCode" name="subCode" placeholder="ITS 100"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- SUBJECT NAME -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Subject
                                Name</span></label>
                        <input type="text" id="subName" name="subName" placeholder="Programming 1"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- LECTURE UNITS -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Lecture
                                Units</span></label>
                        <input type="number" id="lecUnits" name="lecUnits" placeholder="3"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- LAB UNITS -->
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-slate-600 uppercase text-[10px]">Lab
                                Units</span></label>
                        <input type="number" id="labUnits" name="labUnits" placeholder="1"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- YEAR LEVEL -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Year
                                Level</span></label>
                        <input type="text" id="yearLevel" name="yearLevel" placeholder="1st Year"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- SEMESTER -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Semester</span></label>
                        <input type="text" id="semester" name="semester" placeholder="1st Semester"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="createModal.close()">
                            Cancel
                        </button>
                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-register">
                            Create Subject
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <!-- EDIT SUBJECT -->
    <dialog id="editModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Edit Subject</h2>
            </div>

            <div class="p-6">

                <div id="editFormAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100">
                </div>

                <form id="editForm" class="space-y-4">

                    <!-- HIDDEN ID -->
                    <input type="hidden" id="id" name="id">

                    <!-- SUBJECT CODE -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Subject Code
                            </span>
                        </label>

                        <input type="text" id="editSubCode" name="editSubCode"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- SUBJECT NAME -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Subject Name
                            </span>
                        </label>

                        <input type="text" id="editSubName" name="editSubName"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- LECTURE UNITS -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Lecture Units
                            </span>
                        </label>

                        <input type="number" id="editLecUnits" name="editLecUnits"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- LAB UNITS -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Lab Units
                            </span>
                        </label>

                        <input type="number" id="editLabUnits" name="editLabUnits"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- YEAR LEVEL -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Year Level
                            </span>
                        </label>

                        <input type="text" id="editYearLevel" name="editYearLevel"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- SEMESTER -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Semester
                            </span>
                        </label>

                        <input type="text" id="editSemester" name="editSemester"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <div class="flex gap-3 pt-6">

                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="editModal.close()">
                            Cancel
                        </button>

                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-update">
                            Update Subject
                        </button>

                    </div>

                </form>
            </div>
        </div>

        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

</div>

<?php include('includes/subFooter.php'); ?>