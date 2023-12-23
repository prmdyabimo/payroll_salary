<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="mt-20 px-6 shadow-lg">
    <div class="w-full flex justify-end my-4">
        <button type="button"
            class="inline-block rounded bg-blue-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
            data-te-toggle="modal" data-te-target="#exampleModalCenter" data-te-ripple-init>
            Rekap per Bulan
        </button>
    </div>
    <table id="datatable" class="display nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Mode</th>
                <th>Status</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Gaji Awal</th>
                <th>Waktu Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($presences as $presence): ?>
                <tr>
                    <td>
                        <?= $no++; ?>
                    </td>
                    <td>
                        <?= $presence['mode']; ?>
                    </td>
                    <td class="<?= ($presence['status'] == "Terlambat") ? "text-red-500" : "text-green-500"; ?>">
                        <?= $presence['status']; ?>
                    </td>
                    <td>
                        <?= $presence['nik']; ?>
                    </td>
                    <td>
                        <?= $presence['name']; ?>
                    </td>
                    <td>
                        <?= $presence['position']; ?>
                    </td>
                    <td>
                        <?= $presence['salary']; ?>
                    </td>
                    <td>
                        <?= $presence['created_at']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div data-te-modal-init
    class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
    <div data-te-modal-dialog-ref
        class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
        <div
            class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none">
            <div
                class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4">
                <!--Modal title-->
                <h5 class="text-xl font-medium leading-normal text-neutral-800" id="exampleModalCenterTitle">
                    Rekap Absen per Bulan
                </h5>
                <!--Close button-->
                <button type="button"
                    class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-te-modal-dismiss aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!--Modal body-->
            <div class="relative p-4">
                <form action="<?= base_url('/recap-presences-by-month'); ?>" method="post" id="formDownload">
                    <?= csrf_field(); ?>
                    <!-- MONTH -->
                    <?php if (validation_show_error('month')): ?>
                        <div class="text-red-500 text-sm font-medium">
                            <?= validation_show_error('month'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="relative mb-3" data-te-input-wrapper-init>
                        <input type="month"
                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none"
                            id="exampleFormControlInput1" placeholder="Bulan" name="month" value="<?= old('month'); ?>" />
                        <label for="exampleFormControlInput1"
                            class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none">Bulan
                        </label>
                    </div>
                </form>
            </div>

            <!--Modal footer-->
            <div
                class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4">
                <button type="button" id="btnDownload"
                    class="ml-1 inline-block rounded bg-blue-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                    data-te-ripple-init data-te-ripple-color="light">
                    Tambah
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>