<section class="content-header">
  <h1>
    Commande
    <small><?= __('Nouvelle') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>
<?php $nbr=1; ?>
<!-- Main content -->
<section class="content">
 
  <div class="row">
    <!-- left column -->
    <?= $this->Form->create($devis, array('role' => 'form')) ?>
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Informations Du Fournisseur') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
           <?php
            echo $this->Form->input('nom_devis', ['required' => true]);
            echo $this->Form->input('nom_fournisseur', ['required' => true]);
            echo $this->Form->input('adresse_fournisseur', ['required' => true]);
            echo $this->Form->input('intitule', ['required' => true]);
          ?>
          </div>
          <div class="box-footer">
<button class="btn btn-block btn-success btn-lg" type="submit">Valider</button>          </div>
          </div>
          </div>

      <?= $this->Form->create($devis, array('role' => 'form')) ?>
      <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Articles') ?></h3>
        </div>
            <button style="width:250px; height: 35px; margin-left: 150px; " class="new_champs btn btn-block btn-primary btn-sm">Plus d'articles</button>
          <div class="box-body">
          <div id="block1" class="block">
          <div class="form-group text"><label for="Bloc1desigantion">Désignation (Article n°1)</label><input class="form-control" name="data[Bloc][1][desigantion]" type="text" id="Bloc1desigantion" required></div>
          <div class="input text"><label for="Bloc1quantite">Quantité</label><input class="form-control" name="data[Bloc][1][quantite]" type="number" id="Bloc1quantite"></div><hr\>
          </div> 
  </div></div></div></div>
  <?= $this->Form->end() ?>
</section>

      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
          var i = 1;
          $('body').on('click', '.new_champs', function() {
              var clone = $('#block'+i).clone();
              $(this).after(clone);
              ChangeIdBlock(i);
              return false;  
          });

            function ChangeIdBlock(nb) {
            $('div[id^=block]').each(function() {
              $(this).attr('id','block'+nb)
              .find('.block').attr('id','block'+nb)
              $(this).replaceWith('<div class="box-body"><div id="block'+nb+'" class="block"><div class="form-group text"><label for="Bloc'+nb+'desigantion">Désignation (Article n°'+nb+')</label><input class="form-control" name="data[Bloc]['+nb+'][desigantion]" type="text" id="Bloc'+nb+'desigantion" required></div><div class="input text"><label for="Bloc1quantite">Quantité</label><input class="form-control" name="data[Bloc]['+nb+'][quantite]" type="number" id="Bloc'+nb+'quantite"></div></div></div></div>');                
              nb++;
            });



          }                    
      </script>    
