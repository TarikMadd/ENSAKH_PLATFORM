<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="profpermanents view large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __("Afficher les informations d'un vacataire") ?></legend>
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
            <th scope="row"><?= __('Poste') ?></th>
            <td><?= h($profpermanent->poste) ?></td>
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
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($profpermanent->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelle') ?></th>
            <td><?= $this->Number->format($profpermanent->echelle) ?></td>
        </tr>
      
        <tr>
            <th scope="row"><?= __('Etat') ?></th>
            <td><?= $this->Number->format($profpermanent->etat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($profpermanent->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code Situation Admin') ?></th>
            <td><?= $this->Number->format($profpermanent->code_situation_admin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CodeEtablissement') ?></th>
            <td><?= $this->Number->format($profpermanent->codeEtablissement) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= $this->Number->format($profpermanent->CIN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat Attestation') ?></th>
            <td><?= $this->Number->format($profpermanent->etat_attestation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etatdemande') ?></th>
            <td><?= $this->Number->format($profpermanent->etatdemande) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Recrut') ?></th>
            <td><?= h($profpermanent->date_Recrut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= h($profpermanent->dateNaissance) ?></td>
        </tr>
    </table>
    </body>
    </html> 
</div>
    