<?php
/**
 * @var \App\View\AppView $this
 */
?>

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">filtrage</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <form method="post" action="">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>Du mois :</label>
                                <select name="moisD" class="form-control" >

                                    <?php
                                    $months = array (1=>'Janvier',2=>'février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'juillet',8=>'aout',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');
                                    for($j=1;$j<=12;$j++){
                                        if($j==$moisInf)
                                            echo "<option value='$j' selected>$months[$j]</option>";
                                        else
                                            echo "<option value='$j'>$months[$j]</option>";
                                    }
                                    ?>
                                </select>
                                </br>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Au mois :</label>
                                <select name="moisP" class="form-control">
                                    <?php
                                    for($j=1;$j<=12;$j++){
                                        if($j==$moissup)
                                            echo "<option value='$j' selected>$months[$j]</option>";
                                        else
                                            echo "<option value='$j'>$months[$j]</option>";
                                    }
                                    ?>
                                </select>
                                </br>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Annee</label>
                                <?php

                                echo "<select name=\"annee\" class=\"form-control\">";
                                foreach($annees as $annee){
                                    if($annee==$anni)
                                        echo "<option selected>".$annee."</option>";
                                    else
                                        echo "<option>".$annee."</option>";
                                }
                                echo "<select>";
                                ?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Heures supplémentaires </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th scope="col">Nom et prénom</th>
                                <th scope="col">Diplome</th>
                                <th scope="col">Matiére</th>
                                <th scope="col">établissement</th>
                                <th scope="col">S.O.M</th>
                                <th scope="col">Grade</th>

                                <?php

                                for($j=(int)$moisInf;$j<=$moissup;$j++){
                                    echo "<th scope=\"col\">$months[$j]</th>";
                                }
                                ?>
                                <th scope="col">NB Heures</th>
                                <th scope="col">Taux</th>
                                <th scope="col">Brute</th>
                                <th scope="col">impot</th>
                                <th scope="col">net</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($professeurs as $professeur): ?>
                                <tr>
                                    <td><?= h($professeur->nom_prof) ?>  <?= h($professeur->prenom_prof) ?></td>

                                    <td><?= h($professeur->diplome) ?></td>
                                    <td><?= h($professeur->specialite) ?></td>
                                    <td><?= h($professeur->universite) ?></td>
                                    <td><?= h($professeur->somme) ?></td>


                                    <?php
                                    $date=$professeur->grades[0]['_joinData']['date_grade'];
                                    $taux=$professeur->grades[0]['taux'];
                                    $gra=$professeur->grades[0]['categorie'];
                                    foreach ($professeur->grades as $grade) {
                                        if (($grade['_joinData']['date_grade'] <  $date)) {
                                            $taux = $grade->taux;
                                            $date = $grade['_joinData']['date_grade'];
                                            $gra = $grade->categorie;
                                        }
                                    }
                                    foreach ($professeur->grades as $grade){
                                        $s="01-$moisInf-".$anni;
                                        $d=date_format(date_create($s), 'Y-m-d');;

                                        if(($grade['_joinData']['date_grade'] > $date)  and ($grade['_joinData']['date_grade']->format('Y-m-d') <=$d )){
                                            $taux=$grade->taux;
                                            $date=$grade['_joinData']['date_grade'];
                                            $gra=$grade->categorie;
                                        }
                                    }
                                    echo "<td>$gra</td>";
                                    $tab=null;$t=null;$nbHeure=0;
                                    foreach ($professeur->sup_heures as $vacations)
                                        if($vacations->annee==$anni){
                                            if($vacations->mois<=$moissup and $vacations->mois>=$moisInf){

                                                $tab[]=$vacations->mois;
                                                $t[]=$vacations->nbHeure;
                                            }
                                        }

                                    for($j=$moisInf;$j<=$moissup;$j++) {
                                        $bol = true;
                                        for ($i = 0; $i < count($tab); $i++) {
                                            if ($j == $tab[$i]) {
                                                $bol=false;
                                                echo "<td>$t[$i]</td>";
                                                $nbHeure+=$t[$i];
                                                break;
                                            }
                                        }
                                        if($bol){
                                            echo "<td></td>";
                                        }

                                    }
                                    echo "<td>$nbHeure</td>";

                                    echo "<td>".$taux."</td>";
                                    $brut=number_format((float)($nbHeure*$taux), 2, '.', '');
                                    $impot=number_format((float)($brut*38/100), 2, '.', '');
                                    $net=number_format((float)($brut-$impot), 2, '.', '');
                                    echo "<td>".$brut."</td>";
                                    echo "<td>".$impot."</td>";
                                    echo "<td>".$net."</td>";


                                    ?>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?php
$this->Html->css([
    'AdminLTE./plugins/datatables/dataTables.bootstrap',
],
    ['block' => 'css']);

$this->Html->script([
    'AdminLTE./plugins/datatables/jquery.dataTables.min',
    'AdminLTE./plugins/datatables/dataTables.bootstrap.min',

    'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js',
    'https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js',
    'https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js',
    'https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.min.js',
    '//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js',
    '//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js',
    '//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js',
    '//cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js',

],
    ['block' => 'script']);
?>

<?php $this->start('scriptBotton'); ?>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                lengthChange: true,
                buttons: ['excel' , 'pdf', 'colvis' ]
            } );

            table.buttons().container()
                .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
        } );
    </script>
<?php $this->end(); ?>