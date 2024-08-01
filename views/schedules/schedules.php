<?php ob_start() ?>



<div class="overflow-x-scroll">
    <div class="d-flex">
        <?php foreach($schedules->ages as $schedule): ?>
            <div class="minw-100">
                <h2 class="text-light fs-1"><?= $schedule->age_tranche ?> ans</h2>
                <div>
                    <?php foreach($schedule->disciplines as $discipline): ?>
                        <h3 class="text-light"><?= $discipline->discipline_name ?></h3>
                        <p><?= $discipline- ?></p>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php $view = ob_get_clean(); ?>