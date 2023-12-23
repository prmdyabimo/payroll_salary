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

    <?= $this->renderSection('content'); ?>

    <!-- SCRIPTS -->
    <?= $this->include('utils/script'); ?>

</body>

</html>