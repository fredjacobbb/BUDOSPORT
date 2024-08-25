<?php ob_start() ?>

<?php use Leaf\Flash; ?>

<?php 
    $days = ['lundi','mardi','mercredi', 'jeudi','vendredi','samedi'];
?>

<?php if(!empty($_SESSION['budosport']['schedule_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("schedule_success"); ?></p>
    </div>
<?php endif; ?>
<?php if(!empty($_SESSION['budosport']['schedule_error'])): ?>
    <div class="alert alert-error text-center text-light flash flash-error d-flex align-items-center justify-content-center" role="alert">
        <p class="m-0"><?= Flash::display("schedule_error"); ?><p class="fs-3 ps-2">&#128560</p></p>
    </div>
<?php endif; ?>

<!-- <h3 class="text-light fs-0 mt-5 mb-0 text-center text-dark fw-bolder py-2 bg-light py-3">Gérer les horaires</h3> -->

<div class="overflow-x-scroll my-5">
    <div class="d-flex">
        <?php foreach($schedules->ages as $key => $schedule): ?>
            <div class="minw-100 bg-light p-0 m-0 dashb-slide-sched">
                <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= $schedule->age_tranche ?> ans</h2>
                <form  method="POST" action="./?real=admin&action=add-schedule" class="d-flex flex-wrap flex-md-nowrap justify-content-center">
                    <input type="hidden" name="age_id" value="<?= $schedule->age_id ?>">
                    <input type="hidden" name="age_id" value="<?= $schedule->age_id ?>">
                    <select name="day" id="">
                        <?php foreach($days as $key => $day): ?> 
                            <option value="<?= $key + 1 ?>"><?= $day ?></option>
                        <?php endforeach ?> 
                    </select>
                    <select name="discipline_id" id="">
                        <?php foreach($disciplines as $discipline): ?>
                            <option value="<?= $discipline->discipline_id ?>"><?= $discipline->discipline_name ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="d-flex fs-6">
                        <input name="start_at" type="time">
                        <input name="end_at" type="time">
                        <button class="btn btn-success fs-6 ms-3" type="submit">Ajouter</button>
                    </div>
                </form>
                <div class="d-flex flex-wrap">
                    <?php foreach($schedule->disciplines as $discipline): ?>
                        <h3 class="text-dark col-12 text-center fw-bolder my-5">- <?= strtoupper($discipline->discipline_name) ?> -</h3>
                        <?php foreach($discipline->schedules as $key => $schedule): ?>
                            <div class="d-flex align-items-center justify-content-around flex-wrap align-content-center text-dark w-100">
                                <p class="fs-5 day fw-medium"><?= ucfirst($days[$schedule->day - 1]) ?></p>
                                <div class="d-flex">
                                    <p class="fs-4 m-0 w-100 pe-4"><?= substr($schedule->start_at, 0,-3) ?></p><i class="fs-4">-</i><p class="fs-4 m-0 ps-4"><?= substr($schedule->end_at,0,-3) ?></p>
                                </div>
                                <div class="my-4 my-md-0">
                                    <a class="btn btn-secondary" href="">éditer</a>
                                    <a class="btn btn-danger" href="./?real=admin&action=delete-schedule&schedule-id=<?= $schedule->schedule_id ?>">supprimer</a>
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