<?php session_start();
include('header.php'); ?>

<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col"
    style="background-image: url('../../img/studentBG.jpg');">

    <div class="h-full w-full bg-slate-900/40 backdrop-blur-[2px] flex flex-col">

        <div class="drawer lg:drawer-open h-full overflow-hidden">
            <input id="drawer-toggle" type="checkbox" class="drawer-toggle" />

            <div
                class="drawer-content flex flex-col bg-transparent h-full overflow-y-auto scroll-smooth [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

                <div
                    class="navbar bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200 px-6 sticky top-0 z-30 lg:hidden">
                    <div class="flex-none">
                        <label for="drawer-toggle" class="btn btn-square btn-ghost text-slate-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block h-6 w-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="flex-1 ml-2">
                        <span class="text-sm font-bold uppercase tracking-widest text-slate-500">
                            LCC <span class="text-blue-600">Student</span>
                        </span>
                    </div>
                </div>

                <main class="p-6 md:p-12 max-w-6xl w-full mx-auto flex-grow">

                    <div class="mb-10">
                        <h1 class="text-4xl font-extrabold text-white tracking-tight drop-shadow-2xl italic">
                            Student <span class="text-blue-400">Portal</span>
                        </h1>
                        <p class="text-blue-50 text-sm mt-2 font-medium">Empowering your academic journey for the next
                            semester.</p>
                    </div>

                    <div
                        class="card lg:card-side bg-white/95 backdrop-blur-md shadow-2xl border border-white/20 overflow-hidden rounded-3xl">

                        <div class="card-body lg:w-2/3 p-8 md:p-12">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="badge badge-primary font-bold px-4 py-3">OPEN</div>
                                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em]">S.Y. 2025-2026
                                </h2>
                            </div>

                            <h3 class="card-title text-4xl font-black text-slate-900 mb-4 leading-tight">
                                Ready to <span
                                    class="text-blue-600 underline decoration-blue-200 underline-offset-8">Enroll</span>?
                            </h3>

                            <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                                Join the LCC community this semester. Secure your slots in Information Technology,
                                Business, and Arts. Fast, digital, and hassle-free.
                            </p>

                            <div class="overflow-x-auto w-full mb-10">
                                <ul
                                    class="steps steps-horizontal w-full text-[10px] font-black uppercase tracking-tighter text-slate-400">
                                    <li class="step step-primary">Information</li>
                                    <li class="step step-primary">Subjects</li>
                                    <li class="step">Payment</li>
                                    <li class="step">Complete</li>
                                </ul>
                            </div>

                            <div class="card-actions justify-start gap-4">
                                <a href="enrollment_form.php"
                                    class="btn btn-primary btn-lg rounded-2xl px-12 shadow-xl shadow-blue-200 transition-all hover:scale-105 active:scale-95">
                                    Enroll Now
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                                <button class="btn btn-ghost btn-lg text-slate-500 rounded-2xl border-slate-200 border">
                                    Curriculum
                                </button>
                            </div>
                        </div>

                        <div
                            class="bg-slate-50/80 p-8 lg:w-1/3 border-l border-slate-100 flex flex-col justify-between">
                            <div>
                                <h4
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-8 text-center">
                                    Announcements</h4>

                                <div class="space-y-4">
                                    <div
                                        class="alert bg-white border border-slate-200 shadow-sm rounded-2xl flex items-center gap-4">
                                        <div
                                            class="h-10 w-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center font-bold">
                                            15</div>
                                        <div class="text-xs">
                                            <p class="font-bold text-slate-800 leading-none">Registration Deadline</p>
                                            <p class="text-slate-400 mt-1">April 2026</p>
                                        </div>
                                    </div>

                                    <div class="p-5 bg-white border border-slate-200 shadow-sm rounded-2xl">
                                        <p class="text-[10px] font-bold text-blue-600 mb-3 uppercase tracking-widest">
                                            Requirements</p>
                                        <div class="flex flex-col gap-3">
                                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                                                <input type="checkbox" checked
                                                    class="checkbox checkbox-xs checkbox-success rounded-md pointer-events-none" />
                                                Birth Certificate
                                            </div>
                                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                                                <input type="checkbox"
                                                    class="checkbox checkbox-xs rounded-md pointer-events-none" />
                                                Report Card
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <button
                                    class="btn btn-block btn-outline btn-primary rounded-xl text-xs uppercase tracking-widest">
                                    Contact Registrar
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <div class="drawer-side z-40">
                <label for="drawer-toggle" class="drawer-overlay"></label>
                <div class="w-72 min-h-full bg-white border-r border-slate-200 p-6 flex flex-col shadow-2xl">

                    <div class="mb-12 px-4 mt-4">
                        <span class="text-xl font-black text-slate-800 tracking-tighter">
                            LCC <span class="text-blue-600 uppercase">Enrollment</span>
                        </span>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Student
                            Dashboard</p>
                    </div>

                    <ul class="menu menu-md p-0 space-y-2 flex-grow">
                        <li class="menu-title px-4 mb-2 font-bold text-slate-400 text-[10px] uppercase tracking-widest">
                            Main Menu</li>
                        <li>
                            <a href="home.php"
                                class="flex items-center gap-4 py-3 px-4 rounded-xl font-bold text-blue-600 bg-blue-50 border border-blue-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="grades.php"
                                class="flex items-center gap-4 py-3 px-4 rounded-xl font-bold text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                View Grades
                            </a>
                        </li>
                    </ul>

                    <div class="pt-10 px-4 mb-4 border-t border-slate-100">
                        <a href="logout.php"
                            class="flex items-center gap-4 text-rose-500 font-bold hover:text-rose-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>