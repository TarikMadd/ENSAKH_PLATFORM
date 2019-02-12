<section class="content-header">
<h1>
<?php echo __('Parascolaire'); ?>
</h1>
<ol class="breadcrumb">
<li>
<?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'afficherClubs'], ['escape' => false])?>
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
<?= h($club->nom) ?>
</dd>
<dt><?= __('Mission') ?></dt>
<dd>
<?= h($club->mission) ?>
</dd>
<dt><?= __('Logo') ?></dt>
<dd>
<?= h($club->logo) ?>
</dd>



<dt><?= __('DatePost') ?></dt>
<dd>
<?= h($club->datePost) ?>
</dd>


<dt><?= __('Mot') ?></dt>
<dd>
<?= $this->Text->autoParagraph(h($club->mot)); ?>
</dd>
<dt><?= __('Texte') ?></dt>
<dd>
<?= $this->Text->autoParagraph(h($club->texte)); ?>
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
