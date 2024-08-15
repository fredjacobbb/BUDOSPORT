<?php use Leaf\Flash; ?>

<?php ob_start(); ?>

<div class="overflow-x-scroll d-flex">
    <?php foreach($students->ages as $student): ?>
        <div class="minw-100">
            <h2 class="text-light fs-1 bg-red ps-4 py-3"><?= $student->age_tranche ?></h2>
            <?php foreach($student->disciplines as $discipline): ?>
                <?php if (count($discipline->students) > 0): ?>
                    <table class="table table-dark p-5 w-75 mx-auto my-5">
                        <h3 class="text-light text-center px-3 fs-1 m-5"><?= ucfirst($discipline->discipline_name) ?></h3>
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Profil</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach($discipline->students as $students): ?>
                                <tr>
                                    <td><?= $students->student_name ?></td>
                                    <td><?= $students->student_firstname ?></td>
                                    <td><?= $students->student_email ?></td>
                                    <td><?= $students->grade_id ?></td>
                                    <td>
                                        <a class="btn btn-success" href="">profil</a>
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