<div class="fonctionnaires view large-9 medium-8 columns content">
    <fieldset>
        <legend><?= __("Afficher les informations d'un fonctionnaire") ?></legend>
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
            <td><?= h($fonctionnaire->somme) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $fonctionnaire->has('user') ? $this->Html->link($fonctionnaire->user->id, ['controller' => 'Users', 'action' => 'view', $fonctionnaire->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nom Fct') ?></th>
            <td><?= h($fonctionnaire->nom_fct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prenom Fct') ?></th>
            <td><?= h($fonctionnaire->prenom_fct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Specialite') ?></th>
            <td><?= h($fonctionnaire->specialite) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Situation Familiale') ?></th>
            <td><?= h($fonctionnaire->situation_Familiale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($fonctionnaire->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CIN') ?></th>
            <td><?= h($fonctionnaire->CIN) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Genre') ?></th>
            <td><?= h($fonctionnaire->genre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UeDiplome') ?></th>
            <td><?= h($fonctionnaire->ueDiplome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($fonctionnaire->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelle') ?></th>
            <td><?= $this->Number->format($fonctionnaire->echelle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelon') ?></th>
            <td><?= $this->Number->format($fonctionnaire->echelon) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Salaire') ?></th>
            <td><?= $this->Number->format($fonctionnaire->salaire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('LieuNaissance') ?></th>
            <td><?= $this->Number->format($fonctionnaire->lieuNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat Attestation') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat_attestation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Etat Fiche') ?></th>
            <td><?= $this->Number->format($fonctionnaire->etat_fiche) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= $this->Number->format($fonctionnaire->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Age') ?></th>
            <td><?= $this->Number->format($fonctionnaire->age) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CodeGrade') ?></th>
            <td><?= $this->Number->format($fonctionnaire->codeGrade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CdPays') ?></th>
            <td><?= $this->Number->format($fonctionnaire->cdPays) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CdDiplome') ?></th>
            <td><?= $this->Number->format($fonctionnaire->cdDiplome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date Recrut') ?></th>
            <td><?= h($fonctionnaire->date_Recrut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= h($fonctionnaire->dateNaissance) ?></td>
        </tr>
    </table>
   </body>
    </html> 
</div>
