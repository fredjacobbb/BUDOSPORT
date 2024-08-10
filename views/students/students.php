<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php foreach($students->ages as $student): ?>
    <h2 class="text-light"><?= var_dump($student->age_tranche) ?></h2>
    <?php foreach($student->disciplines as $discipline): ?>
        <h3 class="text-light"><?= $discipline->discipline_name ?></h3>
        <?php foreach($discipline->students as $students): ?>
            <h4 class="text-light"><?= var_dump($students->student_email); ?></h4>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endforeach ?>


<?php $view = ob_get_clean() ?>