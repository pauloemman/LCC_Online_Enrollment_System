<?php session_start();
include('header.php'); ?>

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content flex flex-col">

        <div class="navbar bg-base-100 shadow-sm px-4 sticky top-0 z-30">
            <div class="flex-none lg:hidden">
                <label for="my-drawer" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-6 h-6 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <div class="flex-1 px-2 mx-2">
                <span class="text-lg font-bold">Admin<span class="text-primary">Panel</span></span>
            </div>
            <div class="flex-none gap-2">
                <div class="form-control hidden md:block">
                    <input type="text" placeholder="Search..." class="input input-sm input-bordered w-24 md:w-auto" />
                </div>

                <a href="logout.php" class="btn btn-ghost btn-circle text-error tooltip tooltip-bottom"
                    data-tip="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border border-base-300">
                        <div class="w-10 rounded-full">
                            <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Felix" alt="User Avatar" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="mt-3 z-40 p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li><a>Profile</a></li>
                        <li><a>Settings</a></li>
                        <li><a href="logout.php" class="text-error font-semibold">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <main class="p-6 md:p-10 space-y-8 bg-base-200 min-h-screen">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black tracking-tight italic">Control Center</h1>
                    <div class="text-sm breadcrumbs opacity-60">
                        <ul>
                            <li>Dashboard</li>
                            <li>Overview</li>
                        </ul>
                    </div>
                </div>
                <div class="stats shadow bg-base-100 hidden md:inline-flex">
                    <div class="stat py-2 px-6">
                        <div class="stat-title text-xs uppercase">Online Users</div>
                        <div class="stat-value text-primary text-xl">1.2K</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-t-4 border-primary">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <h2 class="card-title font-bold">Departments</h2>
                            <div class="badge badge-primary badge-outline font-mono">12</div>
                        </div>
                        <p class="text-sm opacity-70">Manage academic faculties and administrative divisions.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-primary btn-sm btn-outline px-6">Add New</button>
                        </div>
                    </div>
                </div>

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-t-4 border-primary">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <h2 class="card-title font-bold">Courses</h2>
                            <div class="badge badge-primary badge-outline font-mono">48</div>
                        </div>
                        <p class="text-sm opacity-70">Create, update, or remove degree programs.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-primary btn-sm btn-outline px-6">Add New</button>
                        </div>
                    </div>
                </div>

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-t-4 border-primary">
                    <div class="card-body">
                        <div class="flex justify-between items-center">
                            <h2 class="card-title font-bold">Subjects</h2>
                            <div class="badge badge-primary badge-outline font-mono">156</div>
                        </div>
                        <p class="text-sm opacity-70">Manage lesson modules and curriculum details.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-primary btn-sm btn-outline px-6">Add New</button>
                        </div>
                    </div>
                </div>

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-secondary">
                    <div class="card-body">
                        <h2 class="card-title font-bold text-secondary">Students</h2>
                        <p class="text-sm opacity-70">Manage student profiles, enrollment, and status.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-secondary btn-sm px-6">Manage</button>
                        </div>
                    </div>
                </div>

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-secondary">
                    <div class="card-body">
                        <h2 class="card-title font-bold text-secondary">Registrars</h2>
                        <p class="text-sm opacity-70">Account management for registrar office staff.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-secondary btn-sm px-6">Manage</button>
                        </div>
                    </div>
                </div>

                <div
                    class="card bg-base-100 shadow-xl hover:-translate-y-1 transition-all duration-300 border-l-4 border-accent">
                    <div class="card-body">
                        <h2 class="card-title font-bold text-accent">Admins</h2>
                        <p class="text-sm opacity-70">Configure system security and global admin users.</p>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn btn-accent btn-sm px-6">Settings</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <div class="drawer-side z-40">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="flex flex-col w-80 min-h-full bg-base-100">
            <ul class="menu p-4 flex-grow text-base-content space-y-2">
                <li class="menu-title font-bold text-sm mb-4">MAIN MENU</li>
                <li><a class="active">Dashboard</a></li>
                <li><a>Academic Records</a></li>
                <li><a>Staff Directory</a></li>
                <div class="divider"></div>
                <li class="menu-title font-bold text-sm">REPORTS</li>
                <li><a>Student Analytics</a></li>
                <li><a>Financial Logs</a></li>
            </ul>

            <div class="p-4 border-t border-base-200">
                <a href="logout.php" class="btn btn-error btn-outline btn-block gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>