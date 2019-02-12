
<div class="fonctionnaires index large-9 medium-6 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Administrateurs</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                <th><?= $this->Paginator->sort('Specialite') ?></th>
                                <th><?= $this->Paginator->sort('Echelle') ?></th>
                                <th><?= $this->Paginator->sort('Grade') ?></th>
                                <th><?= $this->Paginator->sort('Anciennete') ?></th>


                                <th ><?= __('Actions') ?></th>

                            </tr>
                            <?php $j=1;
                            foreach ($res['query'] as $query)
                            {
                            if(!isset($suivant[$j+1])||$suivant[$j+1]<>$res['query']->fonctionnaire_id)
                            {?>
                                <tr>
                                    <td> <?php echo $query['nom_fct'];?> </td>
                                    <td><?php echo $query['prenom_fct']; ?></td>
                                    <td><?php echo $query['specialite']; ?></td>
                                    <td><?php echo $query['echelle']; ?></td>
                                    <td><?php echo $query['nomGrade']; ?></td>
                                    <td><?php echo $query['nbAnciennete']; ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('Grade suivant'), ['action' => 'passerNextEchelleAdmin'], ['class'=>'btn btn-warning btn-xs']  ) ?>

                                    </td>
                                </tr>
                                <?php
                                $j++;
                            }
                            else{
                                $j++;}
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="fonctionnaires index large-9 medium-6 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Ingénieurs</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                <th><?= $this->Paginator->sort('Specialite') ?></th>
                                <th><?= $this->Paginator->sort('Echelle') ?></th>
                                <th><?= $this->Paginator->sort('Grade') ?></th>
                                <th><?= $this->Paginator->sort('Anciennete') ?></th>

                                <th ><?= __('Actions') ?></th>

                            </tr>
                            <?php
                            foreach ($res['query4'] as $query)
                            {?>
                                    <tr>
                                        <td> <?php echo $query['nom_fct'];?> </td>
                                        <td><?php echo $query['prenom_fct']; ?></td>
                                        <td><?php echo $query['specialite']; ?></td>
                                        <td><?php echo $query['echelle']; ?></td>
                                        <td><?php echo $query['nomGrade']; ?></td>
                                        <td><?php echo $query['nbAnciennete']; ?></td>

                                        <td class="actions" style="white-space:nowrap">
                                            <?= $this->Html->link(__('Grade suivant'), ['action' => 'passerNextGradeIng'], ['class'=>'btn btn-warning btn-xs']  ) ?>
                                        </td>
                                    </tr>
                          <?php   }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Techniciens</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                <th><?= $this->Paginator->sort('Specialite') ?></th>
                                <th><?= $this->Paginator->sort('Echelle') ?></th>
                                <th><?= $this->Paginator->sort('Grade') ?></th>
                                <th><?= $this->Paginator->sort('Anciennete') ?></th>


                                <th ><?= __('Actions') ?></th>

                            </tr>
                            <?php
                            $j=1;
                            foreach ($res['query1'] as $query)
                            {
                                if(!isset($suivant[$j+1])||$suivant[$j+1]<>$res['query1']->fonctionnaire_id)
                                {?>
                                <tr>
                                    <td> <?php echo $query['nom_fct'];?> </td>
                                    <td><?php echo $query['prenom_fct']; ?></td>
                                    <td><?php echo $query['specialite']; ?></td>
                                    <td><?php echo $query['echelle']; ?></td>
                                    <td><?php echo $query['nomGrade']; ?></td>
                                    <td><?php echo $query['nbAnciennete']; ?></td>


                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('Echelle suivant'), ['action' => 'passerNextEchelleTec'], ['class'=>' btn bg-purple btn-xs']  ) ?>

                                    </td>
                                </tr>
                            <?php
                            $j++;
                            }
                            else{
                                $j++;}
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="fonctionnaires index large-9 medium-8 columns content">
    <section class="content">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Aide Techniciens</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col_md-6 col-lg-12">
                        <table class="table table-user-information">
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                <th><?= $this->Paginator->sort('Specialite') ?></th>
                                <th><?= $this->Paginator->sort('Echelle') ?></th>
                                <th><?= $this->Paginator->sort('Grade') ?></th>
                                <th><?= $this->Paginator->sort('Anciennete') ?></th>

                                <th ><?= __('Actions') ?></th>
                            </tr>
                            <?php
                            foreach ($res['query2'] as $query):
                            ?>
                                <tr>
                                    <td> <?php echo $query['nom_fct'];?> </td>
                                    <td><?php echo $query['prenom_fct']; ?></td>
                                    <td><?php echo $query['specialite']; ?></td>
                                    <td><?php echo $query['echelle']; ?></td>
                                    <td><?php echo $query['nomGrade']; ?></td>
                                    <td><?php echo $query['nbAnciennete']; ?></td>
                                    <td class="actions" style="white-space:nowrap">
                                        <?= $this->Html->link(__('Grade suivant'), ['action' => 'passerNextGradeATec'], ['class'=>'btn btn-warning btn-xs']  ) ?>

                                    </td>
                                </tr>
                            <?php endforeach ;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="fonctionnaires index large-9 medium-8 columns content">
        <section class="content">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Aide Administrateurs</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col_md-6 col-lg-12">
                            <table class="table table-user-information">
                                <tbody>
                                <tr>
                                    <th scope="col"><?= $this->Paginator->sort('Nom ') ?></th>
                                    <th><?= $this->Paginator->sort('Prenom ') ?></th>
                                    <th><?= $this->Paginator->sort('Specialite') ?></th>
                                    <th><?= $this->Paginator->sort('Echelle') ?></th>
                                    <th><?= $this->Paginator->sort('Grade') ?></th>
                                    <th><?= $this->Paginator->sort('Anciennete') ?></th>


                                    <th ><?= __('Actions') ?></th>

                                </tr>
                                <?php
                                $j=1;
                                foreach ($res['query3'] as $query)
                                {
                                    if(!isset($suivant[$j+1])||$suivant[$j+1]<>$res['query1']->fonctionnaire_id)
                                    {?>
                                        <tr>
                                            <td> <?php echo $query['nom_fct'];?> </td>
                                            <td><?php echo $query['prenom_fct']; ?></td>
                                            <td><?php echo $query['specialite']; ?></td>
                                            <td><?php echo $query['echelle']; ?></td>
                                            <td><?php echo $query['nomGrade']; ?></td>
                                            <td><?php echo $query['nbAnciennete']; ?></td>


                                            <td class="actions" style="white-space:nowrap">
                                                <?= $this->Html->link(__('Grade suivant'), ['action' => 'passerNextGradeAAdmin'], ['class'=>' btn bg-purple btn-xs']  ) ?>

                                            </td>
                                        </tr>
                                        <?php
                                        $j++;
                                    }
                                    else{
                                        $j++;}
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

