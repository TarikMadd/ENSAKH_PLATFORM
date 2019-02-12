<?php
/**
  * @var \App\View\AppView $this
  */
    use Cake\I18n\Time;
   
?>

<div class="profpermanents view large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __("les informations du professeur permanent") ?></legend>
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <style type="text/css">

table {
border:3px solid #6495ed;
border-collapse:collapse;
width:90%;
margin:auto;
}
thead, tfoot {
background-color:#D0E3FA;
background-image:url(sky.jpg);
border:1px solid #6495ed;
}
tbody {
background-color:#FFFFFF;
border:1px solid #6495ed;
}
th {
font-family:monospace;
border:1px dotted #6495ed;
padding:7px;
background-color:#EFF6FF;
width:40%;
}
td {
font-family:sans-serif;
font-size:100%;
border:1px solid #6495ed;
padding:5px;
text-align:left;
}
caption {
font-family:sans-serif;
}    
          </style>
    </head>
    <body>
    <table class="vertical-table">
       
        <tr>
            <th scope="row"><?= __('Somme') ?></th>
            <td><?= h($profpermanent->somme) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Nom Prof') ?></th>
            <td><?= h($profpermanent->nom_prof) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Prof') ?></th>
            <td><?= h($profpermanent->prenom_prof) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diplome') ?></th>
            <td><?= h($profpermanent->diplome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specialite') ?></th>
            <td><?= h($profpermanent->specialite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situation Familiale') ?></th>
            <td><?= h($profpermanent->situation_familiale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lieu Naissance') ?></th>
            <td><?= h($profpermanent->Lieu_Naissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Prof') ?></th>
            <td><?= h($profpermanent->email_prof) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($profpermanent->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cadre') ?></th>
            <td><?= h($profpermanentgrade->cadre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($profpermanentgrade->sous_grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelon') ?></th>
            <td><?= $this->Number->format($profpermanentgrade->echelon) ?></td>
        </tr>
      
        <tr>
            <th scope="row"><?= __('Etat') ?></th>
            <td><?= h($profpermanent->etat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($profpermanent->age) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= h($profpermanent->CIN) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Date Recrut') ?></th>
            <td><?= Time::parse($profpermanent->date_Recrut)->nice('Europe/Paris', 'fr-FR')?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= Time::parse($profpermanent->dateNaissance)->nice('Europe/Paris', 'fr-FR') ?></td>
        </tr>
    </table>
    </body>
    </html> 
</div>
    