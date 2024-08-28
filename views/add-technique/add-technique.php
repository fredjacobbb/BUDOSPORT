<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<a href="/?real=admin&action=dashboard-techniques" class="text-light m-5 d-inline-block "><i class="fa fa-arrow-left px-3"></i>Liste techniques</a>

<form class="form-techniques form-login bg-light text-dark" action="" method="POST">
    <h2 class="fs-2 fw-semibold mb-3 text-dark text-center">Ajouter technique</h2>

    <label for="disciplines" class="form-label my-3">Disciplines</label>
    <select name="discipline_id" id="disciplines" class="form-select">
        <?php foreach($disciplines as $discipline): ?>
            <option value="<?= $discipline->discipline_id ?>"><?= $discipline->discipline_name ?></option>
        <?php endforeach ?>
    </select>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['discipline_id']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['discipline_id'] ?? '' ?></p>

    <label for="grades" class="form-label my-3">Grades</label>
    <select name="grade_id" id="grades" class="form-select">
        <?php foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= $grade->grade_name ?></option>
        <?php endforeach ?>
    </select>
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['grade_id']) ? 'text-danger' : 'd-none'?>"><?= Validator::$errors['grade_id'] ?? '' ?></p>


    <label for="categories" class="form-label my-3">Catégories</label>
    <select name="category" id="categories" class="form-select">
        <?php foreach($categories as $category): ?>
            <option value="<?= $category ?>"><?= $category ?></option>
        <?php endforeach ?>
    </select>
    
    
    <label for="technique_name" class="form-label my-3">Nom de la technique</label>
    <input type="text" name="technique_name" class="form-control" id="technique_name">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['technique_name']) ? 'text-danger' : 'd-none'?>">
        <?= Validator::$errors['technique_name'] ?? '' ?>
    </p>

    <label for="technique_description" class="form-label">Description de la technique</label>
    <input type="text" name="technique_description" class="form-control" id="technique_description">
    <p class="fw-light fs-6 mx-2 <?= !empty(Validator::$errors['technique_name']) ? 'text-danger' : 'd-none'?>">
        <?= Validator::$errors['technique_description'] ?? '' ?>
    </p>

    <div class="mx-auto text-center">
        <button class="btn btn-red text-light mt-5 mb-3">Ajouter</button>
    </div>
</form>

<?php $view = ob_get_clean() ?>