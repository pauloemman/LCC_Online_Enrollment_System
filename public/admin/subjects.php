<?php session_start();
include('includes/subHeader.php'); ?>

<?php
include('../../classes/admin.php');

$data = new admins();
$row = $data->viewSubjects();
$courses = $data->viewCourses();
?>

<!-- OnlineEnrollment UI Viewport Lock & Dynamic Background -->
<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col"
    style="background-image: url('../../img/adminBG.jpg');">

    <!-- Deep Translucent Overlay with Scroll Layer -->
    <div
        class="h-full w-full bg-slate-950/50 backdrop-blur-[2px] flex flex-col overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <!-- Fixed Navbar Elements tailored to the Admin UI Theme -->
        <div
            class="navbar bg-blue-700/90 backdrop-blur-xl shadow-2xl border-b border-blue-400/30 px-6 md:px-8 sticky top-0 z-50 flex-none">
            <div class="flex-1">
                <a href="home.php"
                    class="btn btn-ghost btn-sm gap-2 text-white hover:bg-blue-600/50 font-bold rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="flex-none hidden lg:block">
                <h1 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-100/70">Subjects Management
                    Directory</h1>
            </div>

            <div class="flex-1 justify-end flex">
                <button onclick="createModal.showModal()"
                    class="btn btn-sm bg-white text-blue-700 hover:bg-blue-50 hover:scale-105 border-none font-black rounded-xl transition-all shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Subject
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="p-6 md:p-10 max-w-7xl w-full mx-auto flex-grow">

            <!-- Dynamic Header Profile Section -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-5xl font-black text-white tracking-tighter italic uppercase drop-shadow-2xl">
                        Academic <span class="text-blue-400 italic">Subjects</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-2">
                        <div class="h-[2px] w-12 bg-blue-500"></div>
                        <p class="text-blue-100 text-[10px] font-bold uppercase tracking-[0.3em] opacity-80">
                            Configure Curricular Units, Course Assignments, and Semestral Rotations
                        </p>
                    </div>
                </div>
                <div
                    class="badge badge-lg bg-blue-900/40 border border-blue-400/30 backdrop-blur-md text-blue-200 font-black px-4 py-4 uppercase text-xs tracking-wider rounded-xl">
                    <?php echo count($row); ?> Total Subjects
                </div>
            </div>

            <!-- Master Subject Data Table Container -->
            <div class="bg-white/95 rounded-2xl border-b-4 border-blue-600 shadow-2xl backdrop-blur-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full border-separate border-spacing-0">
                        <thead class="bg-slate-100/80">
                            <tr>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Subject Code</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Subject Name</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Lec Units</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Lab Units</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Year Level</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Semester</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200">
                                    Date Created</th>
                                <th
                                    class="py-4 px-6 text-slate-800 font-black uppercase text-[11px] tracking-wider border-b border-slate-200 text-right">
                                    Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            <?php if (empty($row)) { ?>
                            <tr>
                                <td colspan="8" class="text-center py-24">
                                    <div class="flex flex-col items-center text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-3 text-slate-300"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <span class="text-lg font-bold tracking-tight text-slate-500">No active subject
                                            nodes map to the current matrix index.</span>
                                    </div>
                                </td>
                            </tr>
                            <?php } else { ?>
                            <?php foreach ($row as $items) { ?>
                            <tr class="hover:bg-blue-50/60 transition-all duration-200 group">

                                <td class="py-4 px-6">
                                    <span
                                        class="badge font-black bg-blue-50 border border-blue-100 text-blue-600 px-3 py-2.5 rounded-lg text-xs uppercase tracking-wider">
                                        <?php echo htmlspecialchars($items['subject_code']); ?>
                                    </span>
                                </td>

                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-2 h-2 rounded-full bg-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <span
                                            class="font-black text-slate-800 group-hover:text-blue-700 tracking-tight transition-colors">
                                            <?php echo htmlspecialchars($items['subject_name']); ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-slate-700 font-bold text-sm">
                                    <?php echo htmlspecialchars($items['lecture_units']); ?>
                                </td>

                                <td class="py-4 px-6 text-slate-700 font-bold text-sm">
                                    <?php echo htmlspecialchars($items['lab_units']); ?>
                                </td>

                                <td class="py-4 px-6 text-slate-600 font-bold text-xs uppercase tracking-wider">
                                    <?php echo htmlspecialchars($items['year_level']); ?>
                                </td>

                                <td class="py-4 px-6 text-slate-600 font-bold text-xs uppercase tracking-wider">
                                    <?php echo htmlspecialchars($items['semester']); ?>
                                </td>

                                <td class="py-4 px-6 text-slate-500 font-semibold text-sm">
                                    <?php echo htmlspecialchars($items['created_at']); ?>
                                </td>

                                <td class="py-4 px-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button
                                            class="btn btn-xs bg-slate-100 text-slate-700 border-none hover:bg-blue-600 hover:text-white font-black rounded-lg transition-all shadow-sm gap-1 py-1 px-2.5 --btn-edit"
                                            data-id="<?php echo $items['id']; ?>"
                                            data-code="<?php echo $items['subject_code']; ?>"
                                            data-name="<?php echo $items['subject_name']; ?>"
                                            data-lecture="<?php echo $items['lecture_units']; ?>"
                                            data-lab="<?php echo $items['lab_units']; ?>"
                                            data-year="<?php echo $items['year_level']; ?>"
                                            data-semester="<?php echo $items['semester']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            EDIT
                                        </button>

                                        <button
                                            class="btn btn-xs bg-slate-100 text-rose-500 border-none hover:bg-rose-500 hover:text-white font-black rounded-lg transition-all shadow-sm gap-1 py-1 px-2.5 --btn-delete"
                                            data-id="<?php echo $items['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            DELETE
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
        </main>
    </div>
</div>

<!-- CREATE NEW SUBJECT MODAL -->
<dialog id="createModal" class="modal">
    <div
        class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl border border-blue-400/20">
        <div class="bg-blue-700 p-6 relative">
            <h2 class="text-lg font-black text-white uppercase tracking-wider text-center">Create Subject Unit Vector
            </h2>
            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-blue-400"></div>
        </div>

        <div
            class="p-6 bg-slate-50/50 max-h-[75vh] overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
            <div id="formAlert"
                class="hidden mb-4 text-xs font-bold uppercase tracking-wide p-3 rounded-xl bg-rose-50 text-rose-600 border border-rose-100">
            </div>

            <form id="createForm" class="space-y-4">

                <!-- COURSE MAP -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Course</span></label>
                    <select id="courseId" name="courseId"
                        class="select select-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                        <option value="" disabled selected class="text-slate-400">Select Degree Context</option>
                        <?php foreach ($courses as $course) { ?>
                        <option value="<?php echo $course['id']; ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                            (<?php echo htmlspecialchars($course['course_code']); ?>)
                        </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- CODE -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Subject
                            Code</span></label>
                    <input type="text" id="subCode" name="subCode" placeholder="e.g., ITS 101"
                        class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl uppercase"
                        required>
                </div>

                <!-- SUBJECT NAME -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Subject
                            Name</span></label>
                    <input type="text" id="subName" name="subName" placeholder="e.g., Introduction to Computing"
                        class="input input-bordered w-full bg-white border-slate-200 font-bold text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- LECTURE UNITS -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Lecture
                                Units</span></label>
                        <input type="number" id="lecUnits" name="lecUnits" placeholder="3" min="0" max="10"
                            class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                            required>
                    </div>

                    <!-- LAB UNITS -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Laboratory
                                Units</span></label>
                        <input type="number" id="labUnits" name="labUnits" placeholder="0" min="0" max="10"
                            class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                            required>
                    </div>
                </div>

                <!-- YEAR LEVEL -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Year
                            Level Curricular Bracket</span></label>
                    <select id="yearLevel" name="yearLevel"
                        class="select select-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                        <option value="" disabled selected class="text-slate-400">Select Academic Tier</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>

                <!-- SEMESTER -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Semestral
                            Rotation Term</span></label>
                    <select id="semester" name="semester"
                        class="select select-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                        <option value="" disabled selected class="text-slate-400">Select Term Matrix</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button"
                        class="btn flex-1 bg-slate-200 border-none text-slate-700 hover:bg-slate-300 font-black rounded-xl uppercase tracking-wider text-xs"
                        onclick="createModal.close()">
                        Cancel
                    </button>
                    <button type="button"
                        class="btn flex-1 btn-primary bg-blue-600 hover:bg-blue-700 border-none shadow-lg shadow-blue-200 text-white font-black rounded-xl uppercase tracking-wider text-xs --btn-register">
                        Confirm Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop bg-slate-950/60 backdrop-blur-sm">
        <button>close</button>
    </form>
</dialog>

<!-- EDIT SUBJECT MODAL -->
<dialog id="editModal" class="modal">
    <div
        class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl border border-blue-400/20">
        <div class="bg-blue-700 p-6 relative">
            <h2 class="text-lg font-black text-white uppercase tracking-wider text-center">Modify Subject Parameter
                Matrix</h2>
            <div class="absolute bottom-0 left-0 w-full h-[3px] bg-blue-400"></div>
        </div>

        <div
            class="p-6 bg-slate-50/50 max-h-[75vh] overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">
            <div id="editFormAlert"
                class="hidden mb-4 text-xs font-bold uppercase tracking-wide p-3 rounded-xl bg-rose-50 text-rose-600 border border-rose-100">
            </div>

            <form id="editForm" class="space-y-4">
                <input type="hidden" id="id" name="id">

                <!-- SUBJECT CODE -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Subject
                            Code</span></label>
                    <input type="text" id="editSubCode" name="editSubCode"
                        class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl uppercase"
                        required>
                </div>

                <!-- SUBJECT NAME -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Subject
                            Name</span></label>
                    <input type="text" id="editSubName" name="editSubName"
                        class="input input-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- LECTURE UNITS -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Lecture
                                Units</span></label>
                        <input type="number" id="editLecUnits" name="editLecUnits" min="0" max="10"
                            class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                            required>
                    </div>

                    <!-- LAB UNITS -->
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Laboratory
                                Units</span></label>
                        <input type="number" id="editLabUnits" name="editLabUnits" min="0" max="10"
                            class="input input-bordered w-full bg-white border-slate-200 font-black text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                            required>
                    </div>
                </div>

                <!-- YEAR LEVEL -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Year
                            Level</span></label>
                    <select id="editYearLevel" name="editYearLevel"
                        class="select select-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>

                <!-- SEMESTER -->
                <div class="form-control">
                    <label class="label"><span
                            class="label-text font-black text-slate-700 uppercase text-[10px] tracking-widest">Semester</span></label>
                    <select id="editSemester" name="editSemester"
                        class="select select-bordered w-full bg-white border-slate-200 font-bold text-slate-800 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 rounded-xl"
                        required>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button"
                        class="btn flex-1 bg-slate-200 border-none text-slate-700 hover:bg-slate-300 font-black rounded-xl uppercase tracking-wider text-xs"
                        onclick="editModal.close()">
                        Cancel
                    </button>
                    <button type="button"
                        class="btn flex-1 btn-primary bg-blue-600 hover:bg-blue-700 border-none shadow-lg shadow-blue-200 text-white font-black rounded-xl uppercase tracking-wider text-xs --btn-update">
                        Apply System Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop bg-slate-950/60 backdrop-blur-sm">
        <button>close</button>
    </form>
</dialog>

<?php include('includes/subFooter.php'); ?>