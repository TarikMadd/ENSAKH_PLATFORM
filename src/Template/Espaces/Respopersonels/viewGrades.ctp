<section class="content-header">
    <h1>
        <?php echo __('Infos Supplémentaires'); ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'evolutionGrades'], ['escape' => false])?>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info"></i>
                    <h3 class="box-title"><?php echo __('Information'); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Nom') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->nom_fct) ?>
                        </dd>
                        <dt><?= __('Prénom') ?></dt>
                        <dd>
                            <?= h($fonctionnaire->prenom_fct) ?>
                        </dd>
                        <dt><?= __('Grades') ?></dt>
                        <dd>
                            <?= h($grade->codeGrade) ?>
                        </dd>






                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

</section>
