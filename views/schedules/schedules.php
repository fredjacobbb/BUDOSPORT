<?php use Leaf\Flash ?>

<?php ob_start() ?>

<?php 
    $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];
?>

<div class="accordion accordion-flush mx-3" id="accordionFlushExample">
    <h2 class="text-red p-0 m-0 text-end fs--1 my-5">Nos horaires</h2>
    <?php foreach($schedules->ages as $key => $schedule): ?>
        <div class="accordion-item bg-dark">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?= $key ?>" aria-expanded="false" aria-controls="flush-collapse-<?= $key ?>">
                    <?= $schedule->age_tranche ?> ans<i class="text-success ms-3 fs-3"></i>
                </button>
            </h2>
            <div id="flush-collapse-<?= $key ?>" class="accordion-collapse collapse text-light" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <?php foreach($schedule->disciplines as $discipline): ?>
                        <div class="bg-dark">
                            <h3 class="text-light col-12 bg-red text-light p-3 m-0 text-center fw-bolder">- <?= strtoupper($discipline->discipline_name) ?> -</h3>
                            <?php foreach($discipline->schedules as $key => $schedule): ?>
                                <div class="d-flex py-5 bg-dark text-light shadow align-items-center justify-content-around flex-wrap align-content-center text-light w-100">
                                    <p class="fs-5 day fw-medium"><?= ucfirst($days[$schedule->day - 1]) ?></p>
                                    <div class="d-flex">
                                        <p class="fs-4 m-0 w-100 pe-4"><?= substr($schedule->start_at, 0,-3) ?></p><i class="fs-4">-</i><p class="fs-4 m-0 ps-4"><?= substr($schedule->end_at,0,-3) ?></p>
                                    </div>
                                </div>
                                <hr class="text-dark w-75 mx-auto ">
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $view = ob_get_clean() ?>