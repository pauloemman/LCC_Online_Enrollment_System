<?php session_start();
include('header.php'); ?>

<div class="h-screen w-screen bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden flex flex-col"
    style="background-image: url('../../img/regbg.jpg');">

    <div
        class="h-full w-full bg-slate-950/50 backdrop-blur-[2px] flex flex-col overflow-y-auto [&::-webkit-scrollbar]:hidden [scrollbar-width:none]">

        <div
            class="navbar bg-blue-700/90 backdrop-blur-xl shadow-2xl border-b border-blue-400/30 px-8 sticky top-0 z-50">
            <div class="flex-1">
                <a href="home.php" class="flex flex-col group">
                    <span
                        class="text-sm font-black uppercase tracking-[0.4em] text-white group-hover:text-blue-200 transition-colors">
                        LCC <span class="text-blue-200 group-hover:text-white">Registrar</span>
                    </span>
                    <span class="text-[9px] text-blue-100/60 font-bold uppercase tracking-widest -mt-1">Administrative
                        Control Center</span>
                </a>
            </div>
            <div class="flex-none gap-6">
                <a href="home.php"
                    class="btn btn-ghost btn-sm text-blue-100 font-bold rounded-xl hover:bg-white/10 transition-all">
                    Main Dashboard
                </a>
            </div>
        </div>

        <main class="p-6 md:p-10 max-w-[95rem] w-full mx-auto flex-grow flex flex-col justify-center">

            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1
                        class="text-5xl md:text-6xl font-black text-white tracking-tighter italic uppercase drop-shadow-2xl">
                        Curriculum <span class="text-emerald-400 italic">Management</span>
                    </h1>
                    <div class="flex items-center gap-3 mt-4">
                        <div class="h-[2px] w-16 bg-emerald-500"></div>
                        <p class="text-emerald-100 text-xs font-bold uppercase tracking-[0.3em] opacity-80">
                            Academic Infrastructure Setup
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-6 w-full items-stretch">

                <a href="create_curriculum.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-emerald-500 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-emerald-500 text-white rounded-2xl shadow-xl shadow-emerald-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-emerald-50 border-none text-emerald-600 mb-3 px-3">
                            STRUCTURE</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Create Curriculum</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Establish official course
                            blueprints, basic educational paths, and academic timelines.</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between w-full">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">New
                            Curriculum</span>
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

                <a href="create_section.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-blue-600 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-blue-600 text-white rounded-2xl shadow-xl shadow-blue-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-blue-50 border-none text-blue-600 mb-3 px-3">
                            GROUPS</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Create Section</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Organize identity profiles
                            for class sections, block groupings, and maximum capacity numbers.</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between w-full">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">New Section</span>
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

                <a href="section_subjects.php"
                    class="group relative flex flex-col justify-between bg-white rounded-3xl border-b-4 border-cyan-500 shadow-2xl hover:-translate-y-3 transition-all duration-500 p-5 xl:p-6 min-h-[280px]">

                    <div
                        class="absolute -top-5 right-6 p-3.5 bg-cyan-500 text-white rounded-2xl shadow-xl shadow-cyan-500/40 group-hover:scale-110 transition-transform duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <div class="mt-4 flex-grow">
                        <div
                            class="inline-block badge badge-sm font-black bg-cyan-50 border-none text-cyan-600 mb-3 px-3">
                            SCHEDULES</div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-2">Section Subjects</h2>
                        <p class="text-[11px] text-slate-500 font-semibold leading-relaxed">Establish clean class time
                            management logs, room numbers, and instructor allocations.</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between w-full">
                        <span class="text-[10px] font-black text-cyan-600 uppercase tracking-widest">Manage
                            Classes</span>
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

            </div>
        </main>

    </div>
</div>

<?php include('footer.php'); ?>