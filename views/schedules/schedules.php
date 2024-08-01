<?php ob_start() ?>

<?php foreach($schedules as $schedule): ?>
    <p><pre><?= var_dump($schedule['age']); ?></pre></p>
<?php endforeach;die; ?>

<?php $view = ob_get_clean(); ?>