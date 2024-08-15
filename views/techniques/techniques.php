<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<form class="form-techniques" action="" method="POST">
    <label for="disciplines" class="form-label">Disciplines</label>
    <select name="discipline_id" id="disciplines" class="form-select">
        <?php foreach($disciplines as $discipline): ?>
            <option value="<?= $discipline->discipline_id ?>"><?= $discipline->discipline_name ?></option>
        <?php endforeach ?>
    </select>
    <label for="grades" class="form-label">Grades</label>
    <select name="grade_id" id="grades" class="form-select">
        <?php foreach($grades as $grade): ?>
            <option value="<?= $grade->grade_id ?>"><?= $grade->grade_name ?></option>
        <?php endforeach ?>
    </select>
    <label for="categories" class="form-label">Catégories</label>
    <select name="category" id="categories" class="form-select">
        <?php foreach($categories as $category): ?>
            <option value="<?= $category ?>"><?= $category ?></option>
        <?php endforeach ?>
    </select>
    
    <label for="technique_name" class="form-label">Nom de la technique</label>
    <input type="text" name="technique_name" class="form-control" id="technique_name">

    <label for="technique_description" class="form-label">Description de la technique</label>
    <input type="text" name="technique_description" class="form-control" id="technique_description">


    <button>Valider</button>
</form>

<?php $view = ob_get_clean() ?>