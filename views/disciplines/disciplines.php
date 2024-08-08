<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>

<div class="text-center">
    <h2 class="text-light fs-0 text-center bg-red py-3 d-inline-block p-3 mt-5">Nos disciplines</h2>
</div>
<div class="container-disciplines p-0 p-md-5 d-flex flex-wrap justify-content-center">
    <?php foreach($disciplines as $discipline): ?>
        <div class="text-light d-flex flex-wrap container-discipline col-12 col-lg-4">
            <h3 class="fs-0 text-decoration-"><?= ucfirst($discipline->discipline_name) ?></h3>
            <div class="">
                <h4 class=""><?= $discipline->accroche_discipline ?></h4>
                <p><?= $discipline->description_discipline ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php $view = ob_get_clean() ?>