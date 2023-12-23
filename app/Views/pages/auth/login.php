<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<section class="h-screen">
    <div class="w-full h-full px-6 py-24">
        <div class="g-6 flex h-full items-center justify-center">
            <div class="md:w-full lg:w-1/2">
                <div class="w-full flex flex-col items-center justify-center py-4 gap-4">
                    <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo" class="mx-auto" />
                    <h1 class="text-2xl font-bold">Login Admin</h1>
                </div>
                <form method="POST" action="<?= base_url('/auth-login'); ?>">
                    <!-- Username input -->
                    <?php if (validation_show_error('username')): ?>
                        <div id="alert_username" class="flex items-center p-2 mb-2 text-red-800 border-t-4 border-red-300 bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ml-3 text-sm font-medium">
                                <?= validation_show_error('username'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <input type="text"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                            id="exampleFormControlInput3" placeholder="Username" name="username" value="<?= old('username'); ?>"/>
                        <label for="exampleFormControlInput3"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Username
                        </label>
                    </div>

                    <!-- Password input -->
                    <?php if (validation_show_error('password')): ?>
                        <div id="alert_password" class="flex items-center p-2 mb-2 text-red-800 border-t-4 border-red-300 bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ml-3 text-sm font-medium">
                                <?= validation_show_error('password'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <input type="password"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                            id="exampleFormControlInput33" placeholder="Password" name="password"/>
                        <label for="exampleFormControlInput33"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[1.15rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Password
                        </label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit"
                        class="inline-block w-full rounded bg-blue-500 px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-blue-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                        data-te-ripple-init data-te-ripple-color="light">
                        Sign in
                    </button>

                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>