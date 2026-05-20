<?php
session_start();

include('includes/newHeader.php');
require_once('../../classes/connection.php');

$db = new Dbh();
$conn = $db->connect();

$userId = $_SESSION['id'] ?? null;

if (!$userId) {
    die("You are not logged in.");
}

// =====================================================
// GET STUDENT + COURSE + PROGRESS INFO
// =====================================================
$stmt = $conn->prepare("
    SELECT id, course_id, current_year_level, current_semester
    FROM students
    WHERE user_id = ?
    LIMIT 1
");

$stmt->bind_param("i", $userId);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    die("Student record not found.");
}

$student = $res->fetch_assoc();

$studentId = $student['id'];
$studentCourseId = $student['course_id'];
$currentYear = (int) $student['current_year_level'];
$currentSem = (int) $student['current_semester'];

// =====================================================
// ENROLLMENT PROGRESSION RULE
// =====================================================
if ($currentSem == 1) {
    $allowedYear = $currentYear;
    $allowedSem = 2;
} else {
    $allowedYear = $currentYear + 1;
    $allowedSem = 1;
}

// =====================================================
// CURRICULUM (FILTERED BY COURSE + PROGRESSION)
// =====================================================
$curriculumQuery = mysqli_query($conn, "
    SELECT curriculum.*, courses.course_name
    FROM curriculum
    INNER JOIN courses ON curriculum.course_id = courses.id
    WHERE curriculum.course_id = $studentCourseId
    AND curriculum.year_level = $allowedYear
    AND curriculum.semester = $allowedSem
");

$curriculums = mysqli_fetch_all($curriculumQuery, MYSQLI_ASSOC);

// =====================================================
// SECTIONS (FILTERED BY COURSE + PROGRESSION)
// =====================================================
$sectionQuery = mysqli_query($conn, "
    SELECT sections.*, courses.course_code
    FROM sections
    INNER JOIN courses ON sections.course_id = courses.id
    WHERE sections.course_id = $studentCourseId
    AND sections.year_level = $allowedYear
    AND sections.semester = $allowedSem
");

$sections = mysqli_fetch_all($sectionQuery, MYSQLI_ASSOC);
?>

<div class="min-h-screen bg-slate-50 flex items-center justify-center p-4 sm:p-6 antialiased">

    <div class="w-full max-w-xl bg-white rounded-2xl border border-slate-100 shadow-xl shadow-slate-200/50 p-6 sm:p-8">

        <!-- Header Block -->
        <div class="mb-8 border-b border-slate-100 pb-5">
            <h1
                class="text-2xl sm:text-3xl font-extrabold text-slate-800 tracking-tight bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">
                Student Enrollment
            </h1>
            <p class="text-sm text-slate-500 mt-1.5">
                Select your designated curriculum and section to complete your enrollment.
            </p>
        </div>

        <form id="studentEnrollForm" class="space-y-6">

            <!-- CURRICULUM -->
            <div>
                <label for="curriculumId"
                    class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-2">
                    Curriculum
                </label>
                <div class="relative">
                    <select id="curriculumId"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium text-sm transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none appearance-none cursor-pointer">
                        <option value="" disabled selected>Select Curriculum</option>
                        <?php foreach ($curriculums as $c) { ?>
                        <option value="<?= $c['id']; ?>">
                            <?= htmlspecialchars($c['course_name']); ?> —
                            Yr. <?= htmlspecialchars($c['year_level']); ?> /
                            Sem <?= htmlspecialchars($c['semester']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- SECTION -->
            <div>
                <label for="sectionId" class="block text-xs font-semibold tracking-wider text-slate-600 uppercase mb-2">
                    Section
                </label>
                <div class="relative">
                    <select id="sectionId"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium text-sm transition-all duration-200 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 focus:outline-none appearance-none cursor-pointer">
                        <option value="" disabled selected>Select Section</option>
                        <?php foreach ($sections as $s) { ?>
                        <option value="<?= $s['id']; ?>">
                            <?= htmlspecialchars($s['course_code']); ?> —
                            <?= htmlspecialchars($s['section_name']); ?>
                            (Yr. <?= htmlspecialchars($s['year_level']); ?>,
                            Sem <?= htmlspecialchars($s['semester']); ?>)
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <!-- BUTTON GROUP -->
            <div class="flex flex-col-reverse sm:flex-row items-center gap-3 pt-4">
                <a href="enrollNow.php"
                    class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 text-slate-600 hover:text-slate-800 hover:bg-slate-50 font-semibold text-sm transition-all duration-200 text-center">
                    Back
                </a>

                <button type="button"
                    class="--btn-enroll w-full sm:flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold text-sm py-3 px-5 rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 active:scale-[0.98] transition-all duration-200">
                    Submit Enrollment
                </button>
            </div>

        </form>

    </div>

</div>

<?php include('includes/newFooter.php'); ?>