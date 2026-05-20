<?php session_start();
include('includes/regHeader.php'); ?>

<?php
include('../../classes/admin.php');

$data = new admins();
$row = $data->viewRegistrars();
?>

<!-- Added style attribute for adminBG.jpg background and supporting Tailwind layout classes -->
<div class="min-h-screen bg-cover bg-center bg-no-repeat relative font-sans antialiased"
    style="background-image: url('adminBG.jpg');">

    <!-- Navbar Container with a slight blur to isolate it from the moving background -->
    <div
        class="navbar bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-200/60 px-4 md:px-8 sticky top-0 z-30 transition-all">
        <div class="flex-1">
            <a href="home.php"
                class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100 rounded-xl transition-all duration-200 transform hover:-translate-x-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium tracking-wide">Back to Home</span>
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1
                class="text-xs font-bold uppercase tracking-widest text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200/50">
                Account Management</h1>
        </div>

        <div class="flex-1 justify-end flex">
            <button onclick="createModal.showModal()"
                class="btn btn-primary btn-sm rounded-xl px-4 font-semibold shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 gap-2 border-none bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Create Account
            </button>
        </div>
    </div>

    <!-- Added an overlay/blur wrapper to guarantee high text contrast against the background image -->
    <div
        class="min-h-[calc(100vh-65px)] bg-gradient-to-b from-slate-900/40 to-slate-900/60 backdrop-blur-xs p-6 md:p-12">
        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                <div>
                    <!-- Replaced text-slate-800 with white to stand out sharply against dark/vibrant image zones -->
                    <h2 class="text-3xl font-black text-white tracking-tight drop-shadow-md">
                        Registrar <span
                            class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">Accounts</span>
                    </h2>
                    <p class="text-slate-200 text-sm mt-1.5 font-medium drop-shadow-sm opacity-90">Manage and oversee
                        staff access levels and
                        credentials.</p>
                </div>
                <div
                    class="badge badge-lg bg-white/10 backdrop-blur-md text-white border-white/20 font-semibold px-4 py-4 shadow-xl tracking-wide text-xs">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse mr-2"></span>
                    <?php echo count($row); ?> Total Members
                </div>
            </div>

            <div
                class="bg-white/90 backdrop-blur-xl rounded-2xl border border-slate-200/80 shadow-2xl overflow-hidden transition-all duration-300">
                <div class="overflow-x-auto">
                    <table class="table w-full border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-slate-50/75 border-b border-slate-200/60">
                                <th
                                    class="py-4.5 px-6 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200/60">
                                    Name</th>
                                <th
                                    class="py-4.5 px-6 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200/60">
                                    Email Address</th>
                                <th
                                    class="py-4.5 px-6 text-slate-500 font-bold uppercase tracking-wider text-[11px] border-b border-slate-200/60 text-right">
                                    Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100/80">
                            <?php if (empty($row)) { ?>
                            <tr>
                                <td colspan="3" class="text-center py-24 bg-white/50">
                                    <div class="flex flex-col items-center max-w-sm mx-auto p-6 text-slate-400">
                                        <div class="p-4 bg-slate-100 rounded-2xl mb-3 text-slate-400/80">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-base font-bold text-slate-700 tracking-tight">No accounts
                                            found.</span>
                                    </div>
                                </td>
                            </tr>
                            <?php } else { ?>
                            <?php foreach ($row as $items) { ?>
                            <tr
                                class="hover:bg-blue-50/40 transition-all duration-200 group transform hover:-translate-y-[2px] hover:shadow-md">

                                <td class="py-4 px-6 border-b border-slate-100/60">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase group-hover:bg-blue-600 group-hover:text-white transition-all duration-200">
                                            <?php echo substr(htmlspecialchars($items['name']), 0, 2); ?>
                                        </div>
                                        <span
                                            class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors tracking-wide">
                                            <?php echo htmlspecialchars($items['name']); ?>
                                        </span>
                                    </div>
                                </td>

                                <td class="py-4 px-6 text-slate-500 font-medium border-b border-slate-100/60">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs bg-slate-100 text-slate-600 font-mono tracking-tight group-hover:bg-blue-50 group-hover:text-blue-700 transition-colors">
                                        <?php echo htmlspecialchars($items['email']); ?>
                                    </span>
                                </td>

                                <td class="py-4 px-6 text-right border-b border-slate-100/60">
                                    <div class="flex justify-end gap-1.5">
                                        <button
                                            class="btn btn-xs h-8 min-h-[2rem] rounded-xl btn-ghost hover:bg-white hover:text-blue-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-slate-200 --btn-edit transition-all font-semibold gap-1.5 px-3"
                                            data-name="<?php echo $items['name']; ?>"
                                            data-email="<?php echo $items['email']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 stroke-[2]"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                            Edit
                                        </button>

                                        <button
                                            class="btn btn-xs h-8 min-h-[2rem] rounded-xl btn-ghost text-rose-500 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 --btn-delete transition-all font-semibold gap-1.5 px-3"
                                            data-id="<?php echo $items['id']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 stroke-[2]"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
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
    </div>

    <!---- CREATE REGISTRAR ACCOUNT MODAL ---->
    <dialog id="createModal" class="modal">
        <div
            class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl border border-slate-100">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-center">
                <h2 class="text-xl font-extrabold text-white tracking-tight">Create New Registrar</h2>
                <p class="text-blue-200 text-[10px] font-bold mt-1 uppercase tracking-widest opacity-90">Employee
                    Credentials</p>
            </div>

            <div class="p-6">
                <div id="formAlert"
                    class="hidden mb-4 text-sm font-medium p-3.5 rounded-xl bg-rose-50 text-rose-600 border border-rose-100/80 shadow-xs">
                </div>

                <form id="createForm" class="space-y-4">
                    <div class="form-control">
                        <label class="label pb-1.5"><span
                                class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">Full
                                Name</span></label>
                        <input type="text" id="name" name="name" placeholder="John Doe"
                            class="input input-bordered w-full h-11 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100/80 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700 font-medium"
                            required>
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5"><span
                                class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">Email
                                Address</span></label>
                        <input type="email" id="email" name="email" placeholder="john@example.com"
                            class="input input-bordered w-full h-11 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100/80 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700 font-medium"
                            required>
                    </div>

                    <div class="form-control">
                        <label class="label pb-1.5"><span
                                class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">Security
                                Password</span></label>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="input input-bordered w-full h-11 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100/80 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700 font-medium"
                            required>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200 rounded-xl font-semibold transition-all"
                            onclick="createModal.close()">
                            Cancel
                        </button>
                        <button type="button"
                            class="btn flex-1 btn-primary border-none bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl font-semibold shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5 --btn-register">
                            Register Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <!-- EDIT REGISTRAR MODAL -->
    <dialog id="editModal" class="modal">
        <div
            class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl border border-slate-100">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-center">
                <h2 class="text-xl font-extrabold text-white tracking-tight">Edit Registrar</h2>
                <p class="text-blue-200 text-[10px] font-bold mt-1 uppercase tracking-widest opacity-90">Update Account
                    Details</p>
            </div>

            <div class="p-6">
                <div id="editFormAlert"
                    class="hidden mb-4 text-sm font-medium p-3.5 rounded-xl bg-rose-50 text-rose-600 border border-rose-100/80 shadow-xs">
                </div>

                <form id="editForm" class="space-y-4">
                    <!-- NAME -->
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">Full
                                Name</span>
                        </label>
                        <input type="text" id="editName" name="editName" placeholder="John Doe"
                            class="input input-bordered w-full h-11 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100/80 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700 font-medium"
                            required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">Email
                                Address</span>
                        </label>
                        <input type="email" id="editEmail" name="editEmail" readonly
                            class="input input-bordered w-full h-11 bg-slate-100 border-slate-200/60 rounded-xl text-slate-400 font-semibold cursor-not-allowed shadow-inner">
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-control">
                        <label class="label pb-1.5">
                            <span class="label-text font-bold text-slate-500 uppercase text-[10px] tracking-wider">New
                                Password</span>
                        </label>
                        <input type="password" id="editPassword" name="editPassword"
                            placeholder="Leave blank if unchanged"
                            class="input input-bordered w-full h-11 bg-slate-50 border-slate-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-blue-100/80 focus:border-blue-500 transition-all placeholder:text-slate-400 text-slate-700 font-medium">
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200 rounded-xl font-semibold transition-all"
                            onclick="editModal.close()">
                            Cancel
                        </button>
                        <button type="button"
                            class="btn flex-1 btn-primary border-none bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-xl font-semibold shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5 --btn-update">
                            Update Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

</div>

<?php include('includes/regFooter.php'); ?>