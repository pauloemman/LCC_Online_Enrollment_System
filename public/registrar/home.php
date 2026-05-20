<?php session_start();
include('header.php'); ?>

<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col"
    style="background-image: url('../../img/regbg.jpg');">

    <div
        class="h-full w-full bg-slate-950/50 backdrop-blur-[2px] flex flex-col overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <div
            class="navbar bg-blue-700/90 backdrop-blur-xl shadow-2xl border-b border-blue-400/30 px-8 sticky top-0 z-50">
            <div class="flex-1">
                <div class="flex flex-col">
                    <span class="text-sm font-black uppercase tracking-[0.4em] text-white">
                        LCC <span class="text-blue-200">Registrar</span>
                    </span>
                    <span class="text-[9px] text-blue-100/60 font-bold uppercase tracking-widest -mt-1">Administrative
                        Control Center</span>
                </div>
            </div>
            <div class="flex-none gap-6">
                <a href="logout.php"
                    class="btn btn-ghost btn-sm text-white hover:bg-rose-500 hover:text-white font-black rounded-xl transition-all">
                    Sign Out
                </a>
            </div>
        </div>

        <main class="p-6 md:p-10 max-w-[95rem] w-full mx-auto flex-grow flex flex-col justify-center">

            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1
                        class="text-5xl md:text-6xl font-black text-white tracking-tighter italic uppercase drop-shadow-2xl">
                        Registrar <span class="text-blue-400 italic">Dashboard</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-4">
                        <div class="h-[2px] w-16 bg-blue-500"></div>
                        <p class="text-blue-100 text-xs font-bold uppercase tracking-[0.3em] opacity-80">
                            Academic Year 2025 - 2026
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 w-full items-stretch">

                <a href="manage_enrollments.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-blue-600 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-blue-600 text-white rounded-2xl shadow-xl shadow-blue-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-blue-50 border-none text-blue-600 mb-3 px-3">
                            QUEUE OPEN</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Enrollment</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Systematic validation of
                            student application forms.</p>
                    </div>

                    <div
                        class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between dynamic-footer w-full">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Access
                            Module</span>
                        <div
                            class="w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="exam_passers.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-cyan-500 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-cyan-500 text-white rounded-2xl shadow-xl shadow-cyan-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-cyan-50 border-none text-cyan-600 mb-3 px-3">
                            ADMISSION</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Exam Passers</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Release official admission
                            lists for qualified examinees.</p>
                    </div>

                    <div
                        class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between dynamic-footer w-full">
                        <span class="text-[10px] font-black text-cyan-600 uppercase tracking-widest">View Results</span>
                        <div
                            class="w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="search_students.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-indigo-600 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-indigo-600 text-white rounded-2xl shadow-xl shadow-indigo-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-indigo-50 border-none text-indigo-600 mb-3 px-3">
                            RECORDS</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Student Grades</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Secure processing of
                            permanent scholastic evaluations.</p>
                    </div>

                    <div
                        class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between dynamic-footer w-full">
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Update
                            Grades</span>
                        <div
                            class="w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="curriculum.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-emerald-500 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-emerald-500 text-white rounded-2xl shadow-xl shadow-emerald-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-emerald-50 border-none text-emerald-600 mb-3 px-3">
                            ACADEMICS</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Curriculum</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Design, structure, and
                            update official course syllabi and degree tracks.</p>
                    </div>

                    <div
                        class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between dynamic-footer w-full">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Manage
                            tracks</span>
                        <div
                            class="w-8 h-8 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>

            </div>
        </main>

    </div>
</div>

<?php include('footer.php'); ?>