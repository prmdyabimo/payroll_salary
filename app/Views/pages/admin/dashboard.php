<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<div class="py-14">
    <div class="mx-auto sm:px-6 lg:px-8 flex flex-row gap-4 max-w-8xl">
        <div class="flex flex-col w-full mx-auto py-2 gap-4">
            <div class="w-full flex md:flex-row flex-col gap-4 justify-center md:px-0 px-4">
                <div class="lg:w-1/4 w-full flex flex-col bg-white border-b-8 border-[#ECFFBD] rounded-lg shadow-xl">
                    <div class="w-full p-6 flex flex-row justify-between items-center ">
                        <div class="flex flex-col">
                            <h5 class="text-xl font-bold tracking-tight  text-gray-700">Jumlah Karyawan</h5>
                            <p class="text-gray-400 text-[14px]">Berdasarkan input karyawan</p>
                        </div>
                        <i class="fas fa-chart-bar text-2xl bg-[#ECFFBD] text-white p-3 rounded-md"></i>
                    </div>
                    <div class="w-full px-6 pb-6 flex flex-row justify-between items-center">
                        <p class="font-extrabold text-gray-700 text-4xl"><?= count($employees); ?></p>
                    </div>
                </div>
                <div class="lg:w-1/4 w-full flex flex-col bg-white border-b-8 border-[#FCDFDE] rounded-lg shadow-xl">
                    <div class="w-full p-6 flex flex-row justify-between items-center ">
                        <div class="flex flex-col">
                            <h5 class="text-xl font-bold tracking-tight  text-gray-700">Jumlah Kehadiran</h5>
                            <p class="text-gray-400 text-[14px]">Berdasarkan input kehadiran</p>
                        </div>
                        <i class="fas fa-chart-bar text-2xl bg-[#FCDFDE] text-white p-3 rounded-md"></i>
                    </div>
                    <div class="w-full px-6 pb-6 flex flex-row justify-between items-center">
                        <p class="font-extrabold text-gray-700 text-4xl"><?= count($presences); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>