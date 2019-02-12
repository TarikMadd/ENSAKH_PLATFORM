
<div class="vacataires view large-9 medium-8 columns content">
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
            <th scope="row"><?= __('SituationFamiliale') ?></th>
            <td><?= h($vacataire->situationFamiliale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CodeSituation') ?></th>
            <td><?= h($vacataire->codeSituation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($vacataire->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nb Heures') ?></th>
            <td><?= $this->Number->format($vacataire->nb_heures) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Echelle') ?></th>
            <td><?= $this->Number->format($vacataire->echelle) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('DateRecrut') ?></th>
            <td><?= h($vacataire->dateRecrut) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateNaissance') ?></th>
            <td><?= h($vacataire->dateNaissance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DateAffectation') ?></th>
            <td><?= h($vacataire->dateAffectation) ?></td>
        </tr>
    </table>
   </body>
    </html> 
</div>
