<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>

<section class="h-screen">
    <div class="w-full h-full px-6 py-24">
        <div class="g-6 flex h-full items-center justify-center">
            <div class="md:w-full lg:w-1/2">
                <div class="w-full flex flex-col items-center justify-center py-4 gap-4">
                    <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Logo" class="mx-auto" />
                    <h1 class="text-2xl font-bold">Absen Kehadiran</h1>
                </div>
                <form method="POST" action="<?= base_url('/add-presences'); ?>" class="flex flex-col gap-4">
                    <!-- MODE ABSEN -->
                    <?php if (validation_show_error('mode')): ?>
                        <div id="alert_mode"
                            class="flex items-center p-2 text-red-800 border-t-4 border-red-300 bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ml-3 text-sm font-medium">
                                <?= validation_show_error('mode'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <select name="mode" data-te-select-size="lg" data-te-select-init data-te-select-filter="true">
                        <option hidden value=""></option>
                        <option value="MASUK">MASUK</option>
                        <option value="PULANG">PULANG</option>
                    </select>
                    <label data-te-select-label-ref>Pilih Mode Absen</label>

                    <!-- Employee Id input -->
                    <?php if (validation_show_error('employee_id')): ?>
                        <div id="alert_employee_id"
                            class="flex items-center p-2 text-red-800 border-t-4 border-red-300 bg-red-50"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ml-3 text-sm font-medium">
                                <?= validation_show_error('employee_id'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <select name="employee_id" data-te-select-size="lg" data-te-select-init
                        data-te-select-filter="true">
                        <option hidden value=""></option>
                        <?php foreach ($employees as $employee): ?>
                            <option value="<?= $employee['id']; ?>">
                                <?= $employee['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label data-te-select-label-ref>Masukkan Nama Anda</label>

                    <!-- Submit button -->
                    <button type="submit"
                        class="inline-block w-full rounded bg-blue-500 px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-blue-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                        data-te-ripple-init data-te-ripple-color="light">
                        Absen
                    </button>

                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>