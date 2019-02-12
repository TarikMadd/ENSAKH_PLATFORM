<?php
/**
  * @var \App\View\AppView $this
  */
    use Cake\I18n\Time;
   
?>
<div class="vacataires view large-9 medium-8 columns content">
<fieldset>
        <legend><?= __("les informations du professeur vacataire") ?></legend>
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
            <td><?= h($vacataire->somme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Vacataire') ?></th>
            <td><?= h($vacataire->nom_vacataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Vacataire') ?></th>
            <td><?= h($vacataire->prenom_vacataire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LieuNaissance') ?></th>
            <td><?= h($vacataire->LieuNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diplome') ?></th>
            <td><?= h($vacataire->diplome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Universite') ?></th>
            <td><?= h($vacataire->universite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specialite') ?></th>
            <td><?= h($vacataire->specialite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= h($vacataire->CIN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situation Familiale') ?></th>
            <td><?= h($vacataire->situationFamiliale) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Nombre d\'heures') ?></th>
            <td><?= $this->Number->format($vacataire->nb_heures) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cadre') ?></th>
            <td><?= h($vacatairegrade->cadre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grade') ?></th>
            <td><?= h($vacatairegrade->sous_grade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelon') ?></th>
            <td><?= $this->Number->format($vacatairegrade->echelon) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Date Recrutement') ?></th>
            <td><?= Time::parse($vacataire->dateRecrut)->nice('Europe/Paris', 'fr-FR') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date de naissance') ?></th>
            <td><?= Time::parse($vacataire->dateNaissance)->nice('Europe/Paris', 'fr-FR')?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date d\'Affectation') ?></th>
            <td><?= Time::parse($vacataire->dateAffectation)->nice('Europe/Paris', 'fr-FR') ?></td>
        </tr>
    </table>
   </body>
    </html> 
</div>
