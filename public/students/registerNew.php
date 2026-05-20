<?php
include('includes/newHeader.php'); ?>

<div class="min-h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed flex flex-col justify-center items-center p-4 md:p-8"
    style="background-image: url('../../img/studentBG.jpg');">

    <!-- Form Container Card -->
    <div
        class="w-full max-w-4xl bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 p-6 md:p-8 my-8">

        <!-- Form Header -->
        <div class="mb-6 flex flex-row items-center justify-between border-b border-gray-200/60 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Student Enrollment</h1>
                <p class="text-xs text-gray-500 mt-0.5">Please fill out all required fields to complete your enrollment
                    application.</p>
            </div>
            <a href="enrollNow.php"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-600 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        <!-- Registration Form -->
        <form id="createForm" action="process_registration.php" method="POST" class="space-y-6">

            <!-- Section 1: Personal Information -->
            <div>
                <h2 class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-3">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    <!-- First Name -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">First
                                Name</span></label>
                        <input type="text" id="fname" name="fname" placeholder="John"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10"
                            required>
                    </div>

                    <!-- Middle Name -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Middle
                                Name</span></label>
                        <input type="text" id="mname" name="mname" placeholder="Doe"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10">
                    </div>

                    <!-- Last Name -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Last
                                Name</span></label>
                        <input type="text" id="lname" name="lname" placeholder="Smith"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10"
                            required>
                    </div>
                </div>
            </div>

            <!-- Row 2: Gender & Birthdate & Contact -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Gender -->
                <div class="form-control w-full">
                    <label class="label py-1"><span
                            class="label-text font-bold text-slate-600 uppercase text-[10px]">Gender</span></label>
                    <select id="gender" name="gender"
                        class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10 min-h-0"
                        required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <!-- Birthdate -->
                <div class="form-control w-full">
                    <label class="label py-1"><span
                            class="label-text font-bold text-slate-600 uppercase text-[10px]">Birthdate</span></label>
                    <input type="date" id="bday" name="bday"
                        class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10"
                        required>
                </div>

                <!-- Contact Number -->
                <div class="form-control w-full">
                    <label class="label py-1"><span
                            class="label-text font-bold text-slate-600 uppercase text-[10px]">Contact
                            Number</span></label>
                    <input type="text" id="cNum" name="cNum" placeholder="09XXXXXXXXX"
                        class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10"
                        required>
                </div>
            </div>

            <!-- Row 3: Full Address -->
            <div class="form-control w-full">
                <label class="label py-1"><span
                        class="label-text font-bold text-slate-600 uppercase text-[10px]">Address</span></label>
                <input type="text" id="address" name="address" placeholder="House No., Street, Barangay, City, Province"
                    class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10"
                    required>
            </div>

            <div class="border-t border-gray-200/60 pt-4"></div>

            <!-- Section 2: Academic Details -->
            <div>
                <h2 class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-3">Academic Enrollment Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Department -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Department</span></label>
                        <select id="departmentId" name="departmentId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10 min-h-0"
                            required>
                            <option value="" disabled selected>Select Department</option>
                            <?php foreach ($departments as $department) { ?>
                            <option value="<?php echo $department['id']; ?>">
                                <?php echo htmlspecialchars($department['department_name']); ?>
                                (<?php echo htmlspecialchars($department['department_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Course -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Course</span></label>
                        <select id="courseId" name="courseId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10 min-h-0"
                            required>
                            <option value="" disabled selected>Select Course</option>
                            <?php foreach ($courses as $course) { ?>
                            <option value="<?php echo $course['id']; ?>"
                                data-department="<?php echo $course['department_id']; ?>">
                                <?php echo htmlspecialchars($course['course_name']); ?>
                                (<?php echo htmlspecialchars($course['course_code']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Curriculum -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Curriculum</span></label>
                        <select id="curriculumId" name="curriculumId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10 min-h-0"
                            required>
                            <option value="" disabled selected>Select Curriculum</option>
                            <?php foreach ($curriculums as $curriculum) { ?>
                            <option value="<?php echo $curriculum['id']; ?>"
                                data-course="<?php echo $curriculum['course_id']; ?>"
                                data-year="<?php echo $curriculum['year_level']; ?>"
                                data-semester="<?php echo $curriculum['semester']; ?>">
                                <?php echo htmlspecialchars($curriculum['course_name']); ?>
                                (<?php echo htmlspecialchars($curriculum['year_level']); ?>,
                                <?php echo htmlspecialchars($curriculum['semester']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Section -->
                    <div class="form-control w-full">
                        <label class="label py-1"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Section</span></label>
                        <select id="sectionId" name="sectionId"
                            class="select select-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all text-sm h-10 min-h-0"
                            required>
                            <option value="" disabled selected>Select Section</option>
                            <?php foreach ($sections as $section) { ?>
                            <option value="<?php echo $section['id']; ?>"
                                data-course="<?php echo $section['course_id']; ?>"
                                data-year="<?php echo $section['year_level']; ?>"
                                data-semester="<?php echo $section['semester']; ?>">
                                <?php echo htmlspecialchars($section['course_code']); ?> -
                                <?php echo htmlspecialchars($section['section_name']); ?>
                                (<?php echo htmlspecialchars($section['year_level']); ?>,
                                <?php echo htmlspecialchars($section['semester']); ?>)
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Form Submission Action Buttons -->
            <div
                class="flex flex-col-reverse sm:flex-row justify-end items-center gap-3 pt-4 border-t border-gray-200/60">
                <button type="submit"
                    class="btn btn-blue bg-blue-600 hover:bg-blue-700 border-none text-white btn-sm w-full sm:w-auto px-6 normal-case --btn-register">Submit
                    Registration</button>
            </div>

        </form>
    </div>

</div>

<?php include('includes/newFooter.php'); ?>