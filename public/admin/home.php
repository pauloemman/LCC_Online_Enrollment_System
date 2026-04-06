<?php session_start();
include('header.php'); ?>

<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col"
    style="background-image: url('../../img/adminBG.jpg');">

    <div
        class="h-full w-full bg-slate-950/50 backdrop-blur-[2px] flex flex-col overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <div
            class="navbar bg-blue-700/90 backdrop-blur-xl shadow-2xl border-b border-blue-400/30 px-8 sticky top-0 z-50 flex-none">
            <div class="flex-1">
                <div class="flex flex-col">
                    <span class="text-sm font-black uppercase tracking-[0.4em] text-white">
                        LCC <span class="text-blue-200">System</span>
                    </span>
                    <span class="text-[9px] text-blue-100/60 font-bold uppercase tracking-widest -mt-1">
                        Master Administrative Control
                    </span>
                </div>
            </div>
            <div class="flex-none gap-6">
                <a href="logout.php"
                    class="btn btn-ghost btn-sm text-white hover:bg-rose-500 hover:text-white font-black rounded-xl transition-all">
                    Sign Out
                </a>
            </div>
        </div>

        <main class="p-6 md:p-10 max-w-7xl w-full mx-auto flex-grow">

            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-5xl font-black text-white tracking-tighter italic uppercase drop-shadow-2xl">
                        Control <span class="text-blue-400 italic">Center</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-2">
                        <div class="h-[2px] w-12 bg-blue-500"></div>
                        <p class="text-blue-100 text-[10px] font-bold uppercase tracking-[0.3em] opacity-80">
                            Manage Departments and Users
                        </p>
                    </div>
                </div>

                <div
                    class="stats bg-blue-900/40 border border-blue-400/20 backdrop-blur-md text-white rounded-2xl hidden lg:inline-flex">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="departments.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-blue-600 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-blue-600 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-blue-50 border-none text-blue-600 mb-2 px-2">
                                STRUCTURE</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">Departments</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Manage academic faculties
                                and institutional divisions.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Configure</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="courses.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-cyan-500 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-cyan-500 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-cyan-50 border-none text-cyan-600 mb-2 px-2">
                                ACADEMICS</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">Courses</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Configure degree programs
                                and major specifications.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-[9px] font-black text-cyan-600 uppercase tracking-widest">Manage</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="subjects.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-indigo-600 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-indigo-600 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 002-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-indigo-50 border-none text-indigo-600 mb-2 px-2">
                                CURRICULUM</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">Subjects</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Maintain curriculum lesson
                                modules and prerequisites.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">Update</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="students.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-emerald-500 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-emerald-500 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-emerald-50 border-none text-emerald-600 mb-2 px-2">
                                USERS</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">Students</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Access student profiles,
                                grades, and enrollment status.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span
                                class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">Profiles</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="registrars.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-violet-600 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-violet-600 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-violet-50 border-none text-violet-600 mb-2 px-2">
                                STAFF</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">Registrars</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Manage registrar office
                                staff accounts and permissions.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span
                                class="text-[9px] font-black text-violet-600 uppercase tracking-widest">Authority</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="admins.php"
                    class="group relative card bg-white rounded-2xl border-b-4 border-slate-900 shadow-xl hover:-translate-y-2 transition-all duration-500">
                    <div class="card-body p-5">
                        <div
                            class="absolute -top-4 right-6 p-3 bg-slate-900 text-white rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <circle cx="12" cy="12" r="3" stroke-width="2.5" />
                            </svg>
                        </div>
                        <div class="mt-2">
                            <div class="badge badge-xs font-black bg-slate-100 border-none text-slate-800 mb-2 px-2">
                                MASTER</div>
                            <h2 class="text-lg font-black text-slate-800 tracking-tight mb-1">System Admins</h2>
                            <p class="text-[10px] text-slate-500 font-semibold leading-tight">Global system security and
                                master configuration settings.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-50 flex items-center justify-between">
                            <span class="text-[9px] font-black text-slate-900 uppercase tracking-widest">Global</span>
                            <div
                                class="w-6 h-6 bg-slate-50 rounded-full flex items-center justify-center group-hover:bg-slate-900 group-hover:text-white transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </main>

    </div>
</div>

<?php include('footer.php'); ?>