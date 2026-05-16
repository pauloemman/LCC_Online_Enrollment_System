<?php session_start();
include('includes/header.php'); ?>

<div class="h-screen w-screen flex flex-col bg-cover bg-center bg-no-repeat bg-fixed overflow-hidden"
    style="background-image: url('../img/bgLCC.jpg');">

    <div class="flex-grow flex flex-col bg-slate-900/60 backdrop-blur-[2px]">

        <div
            class="navbar bg-blue-700/90 backdrop-blur-md shadow-2xl border-b border-blue-500/30 px-8 sticky top-0 z-50 h-20 flex-none">
            <div class="navbar-center w-full justify-center">
                <a class="flex flex-col items-center group cursor-default">
                    <span
                        class="text-2xl font-black uppercase tracking-[0.4em] text-white transition-all group-hover:tracking-[0.5em]">
                        LCC <span class="text-blue-300">Online Enrollment</span>
                    </span>
                    <div class="h-1 w-12 bg-blue-400 rounded-full mt-1 group-hover:w-20 transition-all duration-500">
                    </div>
                </a>
            </div>
        </div>

        <div class="flex-grow flex items-center justify-center p-4">
            <div
                class="card w-full max-w-sm bg-white/95 backdrop-blur-sm rounded-[2.5rem] border border-white/20 shadow-2xl shadow-blue-950/80 overflow-hidden transform transition-all duration-500">

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 text-center relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-blue-400/20 rounded-full blur-xl"></div>
                    <h2 class="text-3xl font-black text-white tracking-tight relative z-10 italic uppercase">
                        Sign <span class="text-blue-200">In</span>
                    </h2>
                    <p
                        class="text-blue-100 text-[9px] mt-2 uppercase tracking-[0.25em] font-bold opacity-75 relative z-10">
                        Academic Portal Access
                    </p>
                </div>

                <div class="card-body p-8 space-y-4">
                    <div class="form-control">
                        <label class="label pb-1">
                            <span
                                class="label-text font-black text-slate-400 uppercase text-[9px] tracking-[0.15em]">Email
                                Address</span>
                        </label>
                        <input type="email" id="login_email" placeholder="student@gmail.com"
                            class="input input-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all duration-300 rounded-2xl text-sm font-semibold"
                            required>
                    </div>

                    <div class="form-control">
                        <label class="label pb-1">
                            <span
                                class="label-text font-black text-slate-400 uppercase text-[9px] tracking-[0.15em]">Password</span>
                        </label>
                        <input type="password" id="login_password" placeholder="••••••••"
                            class="input input-bordered w-full bg-slate-50 border-slate-200 focus:border-blue-600 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all duration-300 rounded-2xl text-sm font-semibold"
                            required>
                        <div class="flex justify-end mt-2">
                            <a href="#"
                                class="text-[10px] font-black text-blue-600 hover:text-blue-800 transition-colors uppercase tracking-widest">Forgot
                                Password?</a>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="button"
                            class="btn btn-primary w-full h-12 shadow-xl shadow-blue-200 border-none bg-blue-600 text-white font-black text-xs uppercase tracking-[0.2em] hover:bg-blue-700 hover:scale-[1.03] active:scale-[0.97] transition-all rounded-2xl  --btn-login">
                            Sign In
                        </button>
                    </div>

                    <div
                        class="divider before:bg-slate-100 after:bg-slate-100 text-slate-300 text-[9px] font-black uppercase tracking-[0.3em]">
                        Or</div>

                    <p class="text-center text-xs text-slate-500 font-medium leading-relaxed">
                        No account?
                        <a href="registerForm.php"
                            class="text-blue-600 font-black hover:underline underline-offset-4 ml-1 uppercase tracking-tighter">
                            Create One
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <footer class="p-6 text-center flex-none">
            <p class="text-[10px] font-bold text-white/30 uppercase tracking-[0.6em]">
                LCC Online Enrollment System &bull; 2026
            </p>
        </footer>

    </div>
</div>

<?php include('includes/footer.php'); ?>