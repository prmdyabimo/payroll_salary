<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title; ?>
    </title>

    <!-- LINKS -->
    <?= $this->include('utils/link'); ?>

</head>

<body>

    <!-- NAVBAR -->
    <?= $this->include('components/navbar'); ?>

    <!-- SIDEBAR -->
    <?= $this->include('components/sidebar'); ?>

    <?= $this->renderSection('content'); ?>

    <!-- SCRIPTS -->
    <?= $this->include('utils/script'); ?>

</body>

</html>