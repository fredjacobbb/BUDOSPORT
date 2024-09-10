<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>

<h2 class="fs--1 text-red text-end my-5">Nos disciplines</h2>
<div class="container-disciplines p-0 p-md-5 d-flex flex-wrap align-items-center justify-content-center">
    <?php foreach($disciplines as $discipline): ?>
        <div class="text-light d-flex flex-wrap justify-content-between align-items-center m-md-3 container-discipline col-12">
            <div class="col-12 col-md-5 px-2 px-md-5 h-100">
                <h3 class="fs-0 m-0"><?= ucfirst($discipline->discipline_name) ?></h3>
                <div>
                    <h4><?= $discipline->accroche_discipline ?></h4>
                    <p class="my-2"><?= $discipline->description_discipline ?></p>
                    <div class="text-center m-5">
                        <a class="btn bg-red text-light" href="?q=schedules">Nos horaires</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <p class="p-0 m-0 text-center d-none d-md-block">
                    <img class="img-fluid" src="public/assets/img/disciplines/<?= $discipline->discipline_name ?>.jpg" alt="">
                </p>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php $view = ob_get_clean() ?>