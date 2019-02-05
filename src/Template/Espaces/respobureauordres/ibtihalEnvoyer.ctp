<section class="content-header">
  <h1>
    Message
    <small><?= __('') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'ibtihalMessagesEnvoyes'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Ecrire un nouveau message') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <!--$this->Form->create($messages, array('role' => 'form'))-->
        <!-- echo $this->Form->create($message);?>-->
        <?php echo $this->Form->create($message, ['type' => 'file']);?>

          <div class="box-body">
          

           <div class="form-group">

                   <?php echo $this->Form->input('user_id', ['options' => $users, 'empty' => true,'required'=>'required']);
                  // echo $this->Form->input('user_id',array('type' => 'textarea','class'=>'forminput-new',"placeholder"=>"(entrez l'id du user)",'style'=>'height:30px',));

                      ?>
                
              </div>   
              <div class="form-group">
           <?php echo $this->Form->input('contenu',array('type' => 'textarea','class'=>'forminput-new',"placeholder"=>"(Tapez votre message)",'style'=>'height:300px','required'=>'required')); ?>


  </div>


          <?php  
            echo $this->Form->file('attachement',['allowEmpty'=>false]);
            
          ?>
          </div>


          <!-- /.box-body -->
          <div class="box-footer">
          <div class="pull-right">
          <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
          <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
          <?= $this->Form->button(__('Envoyer'),array('class'=>"fa fa-envelope-o") )?>
          <?= $this->Form->end() ?>
          </div>
          
        
      </div>
    </div>
  </div>
</section>
