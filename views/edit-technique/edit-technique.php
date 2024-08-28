<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php $grade = ['blanche', 'jaune', 'orange', 'vert', 'bleu','marron','noir']; ?>

<ul class="list-unstyled d-flex flex-wrap mt-5 justify-content-center">
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none" href="?real=admin&action=dashboard-students">Dashboard Etudiants</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none" href="?real=admin&action=dashboard-schedules">Dashboard Horaires</a></li>
    <li class="p-3"><a class="mx-3 p-3 text-light text-decoration-none active" href="?real=admin&action=dashboard-techniques">Dashboard Techniques</a></li>
</ul>

<form class="form-techniques mx-auto my-5" method="POST">

    <input type="hidden" name="technique_id" value="<?= $technique->technique_id ?>">
    <input type="hidden" name="technique_category" value="<?= $technique->technique_category ?>">
    <input type="hidden" name="grade_id" value="<?= $technique->grade_id ?>">
    
    <label for="technique_name" class="form-label">Nom de la technique</label>
    <input type="text" name="technique_name" value="<?= $technique->technique_name ?>" class="form-control" id="technique_name">

    <label for="technique_description" class="form-label">Description de la technique</label>
    <input name="technique_description" class="form-control" id="technique_description">


    <div class="text-center my-3">
        <button class="btn btn-success mx-auto my-2">Valider</button>
    </div>
</form>

<?php $view = ob_get_clean() ?>