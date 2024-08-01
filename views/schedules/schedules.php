<?php ob_start() ?>

<?php 
    $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];
?>

<div class="overflow-x-scroll">
    <div class="d-flex">
        <?php foreach($schedules->ages as $schedule): ?>
            <?php  ?>
            <div class="minw-100 bg-light">
                <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= $schedule->age_tranche ?> ans</h2>
                <div class="d-flex">
                    <select name="" id="">
                        <?php foreach($disciplines as $discipline): ?>
                            <option value="<?= $discipline->discipline_id ?>"><?= $discipline->discipline_name ?></option>
                        <?php endforeach ?>
                    </select>
                    <select name="" id=""></select>
                </div>
                <div class="d-flex flex-wrap">
                    <?php foreach($schedule->disciplines as $discipline): ?>
                        <h3 class="text-dark col-12 text-center fw-bolder my-5">- <?= strtoupper($discipline->discipline_name) ?> -</h3>
                        <?php foreach($discipline->schedules as $key => $schedule): ?>
                            <div class="d-flex align-items-center justify-content-around flex-wrap align-content-center text-dark w-100">
                                <p class="fs-5 day fw-medium"><?= ucfirst($days[$schedule->day]) ?></p>
                                <div class="d-flex">
                                    <p class="fs-4 m-0 w-100 pe-4"><?= substr($schedule->start_at, 0,-3) ?></p><i class="fs-4">-</i><p class="fs-4 m-0 ps-4"><?= substr($schedule->end_at,0,-3) ?></p>
                                </div>
                                <div class="mt-md-0 my-4">
                                    <a class="btn btn-secondary" href="">éditer</a>
                                    <a class="btn btn-danger" href="">supprimer</a>
                                </div>
                            </div>
                            <hr class="text-dark w-75 mx-auto ">
                            <?php  ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php $view = ob_get_clean(); ?>