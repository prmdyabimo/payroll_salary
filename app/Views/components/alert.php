<?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Successful',
            text: '<?= session()->getFlashdata('success'); ?>'
        });
    </script>
<?php elseif (session()->getFlashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: '<?= session()->getFlashdata('error'); ?>',
        })
    </script>
<?php endif; ?>