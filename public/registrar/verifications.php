<?php session_start();
include('includes/verHeader.php'); ?>

<?php
include('../../classes/registrar.php');

$data = new registrar();
$row = $data->viewPending();
?>

<div class="min-h-screen bg-slate-50">

    <div class="navbar bg-base-100 shadow-sm border-b border-slate-200 px-4 md:px-8 sticky top-0 z-30">
        <div class="flex-1">
            <a href="home.php" class="btn btn-ghost btn-sm gap-2 text-slate-600 hover:bg-slate-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Home
            </a>
        </div>

        <div class="flex-none hidden lg:block">
            <h1 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Account Management</h1>
        </div>

    </div>

    <div class="max-w-6xl mx-auto p-6 md:p-10">

        <div class="flex flex-col md:flex-row items-baseline justify-between mb-8 gap-2">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    Pending <span class="text-blue-600">Accounts</span>
                </h2>
            </div>
            <div class="badge badge-lg bg-blue-50 text-blue-700 border-blue-100 font-medium px-4 py-3">
                <?php echo count($row); ?> Total Accounts
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Name</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Email Address</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200">Status</th>
                            <th class="py-4 px-6 text-slate-600 font-bold border-b border-slate-200 text-right">Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        <?php if (empty($row)) { ?>
                            <tr>
                                <td colspan="3" class="text-center py-20">
                                    <div class="flex flex-col items-center opacity-40">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-lg font-semibold tracking-tight">No accounts found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($row as $items) { ?>
                                <tr class="hover:bg-blue-50/50 transition-all duration-200 group">

                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                                <?php echo htmlspecialchars($items['name']); ?>
                                            </span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 text-slate-500 font-medium italic">
                                        <?php echo htmlspecialchars($items['email']); ?>
                                    </td>

                                    <td class="py-4 px-6 text-slate-500 font-medium italic">
                                        <?php echo htmlspecialchars($items['status']); ?>
                                    </td>

                                    <td class="py-4 px-6 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                class="btn btn-sm btn-ghost hover:bg-white hover:text-green-600 hover:shadow-sm text-slate-500 border border-transparent hover:border-green-200 --btn-verify"
                                                data-id="<?php echo $items['id']; ?>">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>

                                                Verify
                                            </button>

                                            <button
                                                class="btn btn-sm btn-ghost text-rose-400 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 --btn-delete"
                                                data-id="<?php echo $items['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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

    <!---- CREATE REGISTRAR ACCOUNT ---->
    <dialog id="createModal" class="modal">
        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Create New Registrar</h2>
                <p class="text-blue-100 text-xs mt-1 uppercase tracking-widest">Employee Credentials</p>
            </div>

            <div class="p-6">
                <div id="formAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100"></div>

                <form id="createForm" class="space-y-4">
                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Full
                                Name</span></label>
                        <input type="text" id="name" name="name" placeholder="John Doe"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Email
                                Address</span></label>
                        <input type="email" id="email" name="email" placeholder="john@example.com"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <div class="form-control">
                        <label class="label"><span
                                class="label-text font-bold text-slate-600 uppercase text-[10px]">Security
                                Password</span></label>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <div class="flex gap-3 pt-6">
                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="createModal.close()">
                            Cancel
                        </button>
                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-register">
                            Register Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <!-- EDIT REGISTRAR -->
    <dialog id="editModal" class="modal">

        <div class="modal-box w-full max-w-md bg-white p-0 overflow-hidden rounded-2xl shadow-2xl">

            <div class="bg-blue-600 p-6 text-center">
                <h2 class="text-xl font-bold text-white">Edit Registrar</h2>
                <p class="text-blue-100 text-xs mt-1 uppercase tracking-widest">
                    Update Account Details
                </p>
            </div>

            <div class="p-6">

                <div id="editFormAlert"
                    class="hidden mb-4 text-sm p-3 rounded-lg bg-rose-50 text-rose-600 border border-rose-100">
                </div>

                <form id="editForm" class="space-y-4">

                    <!-- NAME -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Full Name
                            </span>
                        </label>

                        <input type="text" id="editName" name="editName" placeholder="John Doe"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100"
                            required>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                Email Address
                            </span>
                        </label>

                        <input type="email" id="editEmail" name="editEmail" readonly
                            class="input input-bordered w-full bg-slate-100 text-slate-500">
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-slate-600 uppercase text-[10px]">
                                New Password
                            </span>
                        </label>

                        <input type="password" id="editPassword" name="editPassword"
                            placeholder="Leave blank if unchanged"
                            class="input input-bordered w-full bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-100">
                    </div>

                    <div class="flex gap-3 pt-6">

                        <button type="button"
                            class="btn flex-1 bg-slate-100 border-none text-slate-600 hover:bg-slate-200"
                            onclick="editModal.close()">
                            Cancel
                        </button>

                        <button type="button" class="btn flex-1 btn-primary shadow-lg shadow-blue-200 --btn-update">
                            Update Account
                        </button>

                    </div>

                </form>

            </div>
        </div>

        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>

    </dialog>

</div>

<?php include('includes/verFooter.php'); ?>