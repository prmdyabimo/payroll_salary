<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="mt-20 px-6 shadow-lg">
    <div class="py-6">
        <div class="my-4">
            <h1 class="text-xl font-bold">Edit Data Pegawai</h1>
        </div>
        <form action="<?= base_url('/employee/update/' . $employee['id']); ?>" method="post" id="formEdit">
            <?= csrf_field(); ?>
            <!-- NIK -->
            <?php if (validation_show_error('nik')): ?>
                <div class="text-red-500 text-sm font-medium">
                    <?= validation_show_error('nik'); ?>
                </div>
            <?php endif; ?>
            <div class="relative mb-3" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                    id="exampleFormControlInput1" placeholder="NIK" name="nik" value="<?= $employee['nik']; ?>" />
                <label for="exampleFormControlInput1"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">NIK
                </label>
            </div>
            <!-- NAME -->
            <?php if (validation_show_error('name')): ?>
                <div class="text-red-500 text-sm font-medium">
                    <?= validation_show_error('name'); ?>
                </div>
            <?php endif; ?>
            <div class="relative mb-3" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                    id="exampleFormControlInput1" placeholder="Nama" name="name" value="<?= $employee['name']; ?>" />
                <label for="exampleFormControlInput1"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Nama
                </label>
            </div>
            <!-- POSITION -->
            <?php if (validation_show_error('position')): ?>
                <div class="text-red-500 text-sm font-medium">
                    <?= validation_show_error('position'); ?>
                </div>
            <?php endif; ?>
            <div class="relative mb-3" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                    id="exampleFormControlInput1" placeholder="Posisi" name="position"
                    value="<?= $employee['position']; ?>" />
                <label for="exampleFormControlInput1"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Posisi
                </label>
            </div>
            <!-- SALARY -->
            <?php if (validation_show_error('salary')): ?>
                <div class="text-red-500 text-sm font-medium">
                    <?= validation_show_error('salary'); ?>
                </div>
            <?php endif; ?>
            <div class="relative mb-3" data-te-input-wrapper-init>
                <input type="text"
                    class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                    id="exampleFormControlInput1" placeholder="Gaji" name="salary" value="<?= $employee['salary']; ?>" />
                <label for="exampleFormControlInput1"
                    class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Gaji
                </label>
            </div>
            <div
                class="flex flex-shrink-0 flex-wrap items-center justify-start rounded-b-md border-t-2 border-neutral-100 border-opacity-100">
                <button type="button" id="btnEdit"
                    class="mt-2 inline-block rounded bg-blue-500 px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                    data-te-ripple-init data-te-ripple-color="light">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>