<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<?php $grade = ['blanche', 'jaune', 'orange', 'vert', 'bleu','marron','noir']; ?>

<?php if(!empty($_SESSION['budosport']['deletion_success'])): ?>
    <div class="alert alert-success text-center text-light flash flash-success" role="alert">
        <p class="m-0"><?= Flash::display("deletion_success"); ?></p>
    </div>
<?php endif; ?>
<?php if(!empty($_SESSION['budosport']['deletion_error'])): ?>
    <div class="alert alert-red text-center text-light flash flash-error" role="alert">
        <p class="m-0"><?= Flash::display("deletion_error"); ?></p>
    </div>
<?php endif; ?>

<div class="overflow-x-scroll d-flex my-5">
    <?php foreach($students->ages as $student): ?>
        <div class="minw-100 dashb-slide">
            <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= $student->age_tranche ?> ans</h2>
            <?php foreach($student->disciplines as $discipline): ?>
                <?php if (count($discipline->students) > 0): ?>
                    <table class="table table-dark p-5 w-75 mx-auto my-5">
                        <h3 class="text-light text-center px-3 fs-1 m-5"><?= ucfirst($discipline->discipline_name) ?></h3>
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ceinture</th>
                                <th scope="col">Profil</th>
                                <th scope="col">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach($discipline->students as $students): ?>
                                <tr>
                                    <td><?= ucfirst($students->student_name) ?></td>
                                    <td><?= ucfirst($students->student_firstname) ?></td>
                                    <td><?= $students->student_email ?></td>
                                    <td><?= $grade[$students->grade_id] ?></td>
                                    <td>
                                        <a class="btn btn-red text-light" href="/?real=admin&action=student&student_token=<?= $students->student_token ?>">profil</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-red text-light" href="/?real=admin&action=delete&student_token=<?= $students->student_token ?>">supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>


<?php $view = ob_get_clean() ?>