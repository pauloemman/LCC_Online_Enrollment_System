<?php session_start();
include('header.php'); ?>

<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col justify-center items-center p-6"
    style="background-image: url('../../img/studentBG.jpg');">

    <!-- Dashboard Container -->
    <div class="w-full max-w-4xl bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl p-8">

        <!-- Dashboard Header -->
        <div class="mb-8 flex flex-row items-center justify-between border-b border-gray-200/50 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Enrollment Portal</h1>
            </div>

            <!-- Back to Home Button -->
            <a href="home.php"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-600 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Card 1: New Student -->
            <div
                class="flex flex-col justify-between p-6 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-200">
                <div class="text-center md:text-left">
                    <div
                        class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3 mx-auto md:mx-0 text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">New Student</h2>
                    <p class="text-xs font-medium text-blue-600 mt-0.5">1st Year & Transferees</p>
                </div>
                <div class="mt-6">
                    <a href="registerNew.php"
                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Enroll Now
                    </a>
                </div>
            </div>

            <!-- Card 2: Existing Student -->
            <div
                class="flex flex-col justify-between p-6 bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-200">
                <div class="text-center md:text-left">
                    <div
                        class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center mb-3 mx-auto md:mx-0 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800">Existing Student</h2>
                    <p class="text-xs font-medium text-emerald-600 mt-0.5">2nd to 4th Years</p>
                </div>
                <div class="mt-6">
                    <a href="student_enroll.php"
                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 transition-colors duration-200">
                        Enroll Now!
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>

<?php include('footer.php'); ?>