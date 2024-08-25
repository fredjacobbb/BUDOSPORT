<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php 
    // echo '<pre>';var_dump($student);echo '</pre>';
?>

<a href="/?real=admin&action=dashboard-students" class="text-light m-5 d-inline-block "><i class="fa fa-arrow-left px-3"></i>Liste étudiants</a>

<div class="my-md-5">
    <div class="my-md-5 d-flex flex-wrap flex-md-nowrap align-items-center justify-content-evenly">
        <div class="my-5 shadow bg-red">
            <h2 class="text-center fs-0 first-letter-red"><?= ucfirst($student->discipline->discipline_name) ?></h2>
            <p class="text-center p-3">
                <?php $img = $student->grade_name; ?>
                <img class="w-50" src="public/assets/img/<?= strval($img->grade_name) ?>.png" alt="">
            </p>
        </div>
        <div id="pgBar" class="fs-1 fw-bold" data-techniques="<?= $student->nbTechniques ?>" data-valid="<?= $student->validTechniques ?>" percentage-score="<?= intval(($student->validTechniques * 100) / $student->nbTechniques) ?>" data-value="20" data-preset="circle">

        </div>
    </div>

    <form method="POST" class="my-5">
        <div class="d-flex flex-wrap justify-content-evenly col-12">
            <?php foreach($student->categories as $key_category => $category): ?>
                <div class="col-12 col-md-3 card-category shadow my-3">
                    <p class="fs-1 p-3"><?= ucfirst($category->technique_category) ?></p>
                    <?php foreach($category->techniques as $technique): ?>
                        <div class="ms-3 d-flex align-items-center">
                            <?php if (!$technique->valid): ?>
                                <input class="form-check-input fs-3 m-3 p-0" name="techniques_ids[]" value="<?= $technique->technique_id ?>" type="checkbox">   
                            <?php else: ?>
                                <i class="fa fa-check text-success fs-3 m-3 p-0"></i>
                            <?php endif ?>
                            <label class="form-check-label fs-5"><?= ucfirst($technique->technique_name) ?></label>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        </div>
        <div class="text-center my-5">
            <button class="btn fs-4 btn-success" onclick="window.location.reload()">Valider</button>
        </div>
    </form>

</div>


<?php $view = ob_get_clean() ?>

