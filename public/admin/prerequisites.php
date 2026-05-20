<?php session_start();
include('header.php'); ?>

<?php
include('../../classes/admin.php');

$data = new admins();
$row = $data->viewSubjectPrerequisite();
$subjects = $data->viewSubjects();
?>

<div class="min-h-screen bg-slate-50">

    <!-- Sticky Navigation Top Bar -->
    <div class="navbar bg-base-100 shadow-sm border-b border-slate-200 px-4 md:px-8 sticky top-0 z-30">
        <div class="flex-1">
            <a href="home.php" class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Enrollment Dashboard
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">
                Curriculum Requirements & Rules
            </h1>
        </div>

        <div class="flex-1 justify-end flex">
            <button onclick="createModal.showModal()" class="btn btn-primary btn-sm shadow-md shadow-blue-200 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Map New Requirement
            </button>
        </div>
    </div>

    <!-- Main Dynamic Layout Container -->
    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <!-- Title Header Area -->
        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Course Prerequisites
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Configure mandatory passing conditions required for online student enrollment validation.
                </p>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3">
                <?php echo count($row); ?> Active Rules Enforced
            </div>
        </div>

        <!-- Academic Rules Data Table Container -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Target Course</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Required
                                Prerequisite</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 text-right">System
                                Configuration</th>
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
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-lg font-semibold tracking-tight">No curriculum rules map
                                        found.</span>
                                    <span class="text-sm text-slate-400">All courses currently open for immediate
                                        validation.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <?php foreach ($row as $items) { ?>
                        <tr class="hover:bg-blue-50/40 transition-all duration-200 group">

                            <td class="py-4 px-6 font-semibold text-slate-700">
                                <span class="inline-flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    <?php echo htmlspecialchars($items['subject_name']); ?>
                                </span>
                            </td>

                            <td class="py-4 px-6 text-slate-600">
                                <span
                                    class="bg-slate-100 px-2.5 py-1 rounded text-xs font-medium border border-slate-200/60">
                                    <?php echo htmlspecialchars($items['prerequisite_subject_name']); ?>
                                </span>
                            </td>

                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <button
                                        class="btn btn-sm btn-ghost hover:bg-white hover:text-blue-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-blue-200 --btn-edit"
                                        data-id="<?php echo $items['id']; ?>"
                                        data-cid="<?php echo $items['subject_id']; ?>"
                                        data-pid="<?php echo $items['prerequisite_subject_id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Modify Rule
                                    </button>

                                    <button
                                        class="btn btn-sm btn-ghost text-rose-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 --btn-delete"
                                        data-id="<?php echo $items['id']; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Drop Rule
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

    <!-- CREATE NEW PREREQUISITE RULE MODAL -->
    <dialog id="createModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Add Enrollment Requirement</h2>
                <p class="text-xs text-blue-100 mt-1">Restrict registration until student validates dependencies</p>
            </div>

            <div class="p-6">
                <div id="formAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100"></div>

                <form id="createForm" class="space-y-4">

                    <!-- Target Subject Dropdown -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Selected Course
                            </span>
                        </label>
                        <select id="subjectId" name="subjectId" class="select select-bordered w-full" required>
                            <option value="">-- Choose Advanced/Target Subject --</option>
                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (<?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Required Prior Subject Dropdown -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Required Passing Entry Course
                            </span>
                        </label>
                        <select id="prerequisiteSubjectId" name="prerequisiteSubjectId"
                            class="select select-bordered w-full" required>
                            <option value="">-- Choose Dependent Core Subject --</option>
                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (<?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="createModal.close()">
                            Dismiss
                        </button>
                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-register">
                            Apply Constraint
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <!-- EDIT PREREQUISITE RULE MODAL -->
    <dialog id="editModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Modify Requirement Constraint</h2>
                <p class="text-xs text-blue-100 mt-1">Adjust required foundational sequences for registration rules</p>
            </div>

            <div class="p-6">
                <div id="editFormAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100"></div>

                <form id="editForm" class="space-y-4">
                    <!-- HIDDEN PRIMARY KEY -->
                    <input type="hidden" id="id" name="id">

                    <!-- Target Subject Dropdown -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Target Course
                            </span>
                        </label>
                        <select id="editSubjectId" name="editSubjectId" class="select select-bordered w-full" required>
                            <option value="">-- Search Subject --</option>
                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (<?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Required Prior Subject Dropdown -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Prerequisite Passing Dependency
                            </span>
                        </label>
                        <select id="editPrerequisiteSubjectId" name="editPrerequisiteSubjectId"
                            class="select select-bordered w-full" required>
                            <option value="">-- Search Prerequisite Subject --</option>
                            <?php foreach ($subjects as $subject) { ?>
                            <option value="<?php echo $subject['id']; ?>">
                                <?php echo htmlspecialchars($subject['subject_name']); ?>
                                (<?php echo htmlspecialchars($subject['subject_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="editModal.close()">
                            Dismiss
                        </button>
                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-update">
                            Update Rule
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
<?php include('includes/preFooter.php'); ?>