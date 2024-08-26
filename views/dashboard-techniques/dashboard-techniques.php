<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php $grade = ['blanche', 'jaune', 'orange', 'vert', 'bleu','marron','noir']; ?>

<ul class="list-unstyled d-flex flex-wrap mt-5 justify-content-center">
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none" href="?real=admin&action=dashboard-students">Dashboard Etudiants</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none" href="?real=admin&action=dashboard-schedules">Dashboard Horaires</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none active" href="?real=admin&action=dashboard-techniques">Dashboard Techniques</a></li>
</ul>

<div class="overflow-x-scroll d-flex my-5 dashb-container" id="dashb">
    <?php foreach($techniques->disciplines as $discipline_key => $discipline): ?>
        <div class="minw-100">
            <div>
                <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= ucfirst($discipline->discipline_name) ?></h2>
            </div>
            <div class="text-end">
                <button class="btn btn-dark next mx-3">NEXT</button>
            </div>
            <div class="d-flex flex-wrap justify-content-evenly align-items-center align-content-center">
                <?php foreach($techniques->disciplines[$discipline_key]->grades as $grade_key => $grade): ?>
                    <form action="POST" class="p-2 p-md-5 w-100">
                        <div class="text-center">
                            <img class="w-25" src="public/assets/img/<?= $grade->grade_name ?>.png">
                        </div>
                        <select name="technique_id" class="form-select w-25" id="">
                            <?php foreach($techniques->disciplines[$discipline_key]->grades[$grade_key]->techniques as $technique): ?>
                                <p><?= ucfirst($technique->technique_name) ?></p>
                                <option value="<?= $technique->technique_id ?>"><?= $technique->technique_name ?></option>
                            <?php endforeach ?>
                        </select>
                    </form>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?php $view = ob_get_clean() ?>