<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="profpermanents form large-9 medium-8 columns content">
    <?= $this->Form->create($profpermanent) ?>
   <fieldset>
        <legend><?= __('Modifier un compte') ?></legend>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <style type="text/css">
.form-style-3{
    max-width: 1000px;
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 fieldset{
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    margin: 0px 0px 10px 0px;
    border: 1px solid #3498DB;
    padding: 50px;
    background: #D6EAF8;
    box-shadow: inset 0px 0px 15px #3498DB;
    -moz-box-shadow: inset 0px 0px 15px #3498DB;
    -webkit-box-shadow: inset 0px 0px 15px #3498DB;
}
.form-style-3 fieldset legend{
    color: #2E86C1  ;
    border-top: 1px solid #3498DB;
    border-left: 1px solid #3498DB;
    border-right: 1px solid #3498DB;
    border-radius: 5px 5px 0px 0px;
    -webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    background: #D6EAF8;
    padding: 0px 8px 3px 8px;
    box-shadow: -0px -1px 2px #3498DB;
    -moz-box-shadow:-0px -1px 2px #3498DB;
    -webkit-box-shadow:-0px -1px 2px #3498DB;
    font-weight: normal;
    font-size: 15px;
}
#contenu {
 max-width: 1000px;
}
#menu  {
 max-width: 500px;
}
.form-style-3 textarea{
    width:250px;
    height:100px;
}
        </style>
    </head>
    <body>

    <div class="form-style-3" id="menu">

    <fieldset>
        <legend>Informations de connexion</legend>
             <?php
  echo $this->Form->input('username',array(
                        'label' => "nom d'utilisateur ",
                        'style' => "background-color:#EBF5FB  ; color:#1B4F72; font-weight:bold",
                        ));?>
             <?php echo $this->Form->input('password',array(
                        'label' => 'mot de passe',
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));?>
    </fieldset>
    </div>
    <div class="form-style-3" id="contenu">
     <fieldset>
        <legend>Information de nouveau vacataire</legend>
        <?php
            echo $this->Form->input('somme',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('poste',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('echelle',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
                        echo $this->Form->input('echelon',array(
                                               'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                                               ));
          
            echo $this->Form->input('etat',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('date_Recrut',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('nom_prof',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('prenom_prof',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('age',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('diplome',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('specialite',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('universite',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('autresdiplomes',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('situation_familiale',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('code_situation_admin',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('dateNaissance',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('codeEtablissement',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('Lieu_Naissance',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('CIN',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('email_prof',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('phone',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('etat_attestation',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
            echo $this->Form->input('etatdemande',array(
                        'style' => "background-color:#EBF5FB; color:#1B4F72; font-weight:bold",
                        ));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
