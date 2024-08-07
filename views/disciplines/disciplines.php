<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php $user = $_SESSION['user_info'] ?? '' ?>

<h2 class="text-light fs-0 text-center bg-red py-3">Les disciplines</h2>
<div class="container-disciplines d-flex flex-wrap">
    <?php foreach($disciplines as $discipline): ?>
        <div class="text-light col-12 col-md-6 d-flex flex-wrap p-5 container-discipline col-6">
            <h3 class="fs-0"><?= ucfirst($discipline->discipline_name) ?></h3>
            <div class="">
                <h4 class=""><?= $discipline->accroche_discipline ?></h4>
                <p><?= $discipline->description_discipline ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php $view = ob_get_clean() ?>