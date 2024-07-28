<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUDOSPORT</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="node_modules/fontawesome-free/css/all.min.css">
</head>
<body class="bg-dark">

    <header>
        <img class="img header-logo" src="public/assets/img/header_logo.webp" alt="brand_icon">
    </header>

    <nav class="overflow-x-scroll">
        <?= $nav ?>
    </nav>

    <?= $view ?>

    <!-- <footer class="row h-100 bg-red">
        <div class="col-12 col-md-4">
            <p>Nous contacter</p>
            <p></p>
        </div>
        <div class="col-12 col-md-4"></div>
        <div class="col-12 col-md-4"></div>
    </footer> -->

    <script src="public/assets/js/flash_message.js"></script>
    <script src="public/assets/js/form.js"></script>
</body>
</html>