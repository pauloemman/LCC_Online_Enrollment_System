<?php session_start();
include('header.php'); ?>

<?php
include('../../classes/registrar.php');

$data = new registrar();
$row = $data->viewCurriculumSubjects();
$curriculums = $data->viewCurriculum();
$subjects = $data->viewSubjects();
?>

<div class="min-h-screen bg-slate-50">

    <div class="navbar bg-base-100 shadow-sm border-b border-slate-200 px-4 md:px-8 sticky top-0 z-30">
        <div class="flex-1">
            <a href="curriculum.php" class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Home
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Curriculum Subjects Management
            </h1>
        </div>

        <div class="flex-1 justify-end flex">
            <button onclick="createModal.showModal()" class="btn btn-primary btn-sm shadow-md shadow-blue-200 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Subject to Curriculum
            </button>
        </div>
    </div>

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Curriculum Subjects
                </h2>
                <p class="text-slate-500 text-sm mt-1">Manage Curriculum Subjects.</p>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3">
                <?php echo count($row); ?> Total Curriculum Subjects
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Course Name</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Year Level</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Semester</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">School Year</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Subject</th>
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
                                    <span class="text-lg font-semibold tracking-tight">No curriculum found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <?php foreach ($row as $items) { ?>
                        <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                        <?php echo htmlspecialchars($items['course_name']); ?>
                                        (
                                        <?php echo htmlspecialchars($items['course_code']); ?>)
                                    </span>
                                </div>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['year_level']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['semester']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['school_year']); ?>
                            </td>

                            <td class="py-4 px-6 text-slate-500 font-medium italic">
                                <?php echo htmlspecialchars($items['subject_code']); ?>
                                -
                                <?php echo htmlspecialchars($items['subject_name']); ?>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="btn btn-sm btn-ghost hover:bg-white hover:text-blue-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-blue-200 --btn-edit"
                                        data-id="<?php echo $items['id']; ?>"
                                        data-cid="<?php echo $items['curriculum_id']; ?>"
                                        data-sid="<?php echo $items['subject_id']; ?>">
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

    <!-- CREATE NEW CURRICULUM SUBJECT -->
    <dialog id="createModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Create New Curriculum Subject</h2>
            </div>

            <div class="p-6">
                <div id="formAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100"></div>

                <form id="createForm" class="space-y-4">

                    <!-- Curriculum -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Curriculum
                            </span>
                        </label>

                        <select id="curriculumId" name="curriculumId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>

                            <option value="">Select Curriculum</option>

                            <?php foreach ($curriculums as $curriculum) { ?>
                            <option value="<?php echo $curriculum['id']; ?>">

                                <?php echo htmlspecialchars($curriculum['course_name']); ?>

                                (<?php echo htmlspecialchars($curriculum['year_level']); ?>,
                                <?php echo htmlspecialchars($curriculum['semester']); ?>)

                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- subjects -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Subject
                            </span>
                        </label>

                        <select id="subjectId" name="subjectId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>

                            <option value="">Select Subject</option>

                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (
                                <?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="createModal.close()">
                            Cancel
                        </button>
                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-register">
                            ADD
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <!-- EDIT CURRICULUM SUBJECT -->
    <dialog id="editModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Edit Curriculum Subject</h2>
            </div>

            <div class="p-6">

                <div id="editFormAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100">
                </div>

                <form id="editForm" class="space-y-4">

                    <!-- HIDDEN ID -->
                    <input type="hidden" id="id" name="id">

                    <!-- Curriculum -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Curriculum
                            </span>
                        </label>

                        <select id="editCurriculumId" name="editCurriculumId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>

                            <option value="">Select Curriculum</option>

                            <?php foreach ($curriculums as $curriculum) { ?>
                            <option value="<?php echo $curriculum['id']; ?>">

                                <?php echo htmlspecialchars($curriculum['course_name']); ?>

                                (<?php echo htmlspecialchars($curriculum['year_level']); ?>,
                                <?php echo htmlspecialchars($curriculum['semester']); ?>)

                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- subjects -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Subject
                            </span>
                        </label>

                        <select id="editSubjectId" name="editSubjectId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>

                            <option value="">Select Subject</option>

                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (
                                <?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-6">

                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="editModal.close()">
                            Cancel
                        </button>

                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-update">
                            Update Department
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

<?php include('includes/curSubFooter.php'); ?>