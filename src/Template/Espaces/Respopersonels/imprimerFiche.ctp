<?php echo $this->Html->image('logo.png'); ?>
<?php $this->layout = 'AdminLTE.print'; ?>

 <style>
        table {
    width: 100%;
}
        p{    vertical-align: top;
}
td {
    vertical-align: top;
}
.d1 {
    text-align: left;
    padding-left: 60px;

}
        .left{    text-align: left;
}
.d2 {
    text-align:center;
         padding-right: 280px;

}
.center {    text-align:center;
}
.d3 {
    text-align:right;
        padding-right: 60px;

}
 .right {    text-align:right;
}
.copy {
    visibility: hidden;
}
.copy, .d3 {
    white-space: nowrap;
}
        
    </style>
<!-- Main content -->
<section class="invoice">
    <!-- title row -->

    <div class="row">
        <div class="col-xs-12">
      <h2 class="page-header">
        <i></i><center> كشف الدخل <br><br>FICHE DE SALAIRE</center>
        <?php
        foreach($profpermanentsDocuments as $ligne)
        {
        ?>

        <?php
        $id=$ligne->profpermanent->id;
        $nom=$ligne->profpermanent->nom_prof;
        $prenom=$ligne->profpermanent->prenom_prof;
        $daterec=$ligne->profpermanent->date_Recrut;
        $somme=$ligne->profpermanent->somme;
        $cin=$ligne->profpermanent->CIN;



      }
      $k=1;
      foreach($tabGrade as $Grade)
      {
      if($k==$nbGrade)
      {
       $nomGrade=$Grade['cadre'];
       $sousgrade=$Grade['sous_grade'];
       break;
      }
      else
      {
      $k++;
      }
      }
        ?>
      </h2>
        </div>
    <!-- /.col -->
    </div>
    <!-- info row -->
    <div >
        <div  >
        <table>
         <p class="right">: (يشهد مدير المدرسة الوطنية للعلوم التطبيقية بخريبكة أن السيد(ة 
             </p><p class="left">
                Le Directeur de l’Ecole Nationale des Sciences Appliquées de Khouribga  atteste que Mr/Mme :</p>
            </table>
            
           <table>
             <tr>
                 <td class="d1">
                        NOM :</td> <td class="d2"> <?= $nom ?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: الإسم العائلي</td>
             </tr>
            </table>
            
            <table>
             <tr>
                 <td class="d1">
                        PRENOM :</td> <td class="d2"> <?= $prenom ?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: الإسم الشخصي</td>
             </tr>
            </table>
         
            <table>
             <tr>
                 <td class="d1">
                        N° de C.I.N :</td> <td class="d2"> <?= $cin ?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: رقم بطاقة الهوية الوطنية</td>
             </tr>
            </table>
         
            <table>
             <tr>
                 <td class="d1">
                       N° de  P.P.R :</td> <td class="d2"> <?= $somme ?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: رقم التأجير</td>
             </tr>
            </table>
          
            <table>
             <tr>
                 <td class="d1">
                       GRADE :<?= $nomGrade ?></td> <td class="d2">  et de sous grade : <?= $sousgrade?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: الإطار</td>
             </tr>
            </table>
            <table>
             <tr>
                 <td class="d1">
                       DATE DE RECRUTEMENT :</td> <td class="d2"> <?= $daterec ?></td>
        
         <div class="copy">right text</div>
        
                <td class="d3">: تاريخ ولوج الوظيفة العمومية</td>
                 
             </tr>
            </table>
           
            <table>
                <tr><td class="d1">LIEU DE TRAVAIL ENSA Khouribga </td>
                    <div class="copy">right text</div>
        
                <td class="d3"> مقر العمل : المدرسة الوطنية للعلوم التطبيقية بخريبكة</td>
                 
                </tr></table><br><br>
            <table>
            <p class="d3">سلمت هذه الشهادة للمعنية بالأمر بطلب منها للإدلاء بها، و استعمالها على الوجه المشروع</p><br>
           <p class="d1"> La présente fiche est délivrée à l’intéressé pour servir et valoir ce que de droit.</p>
            </table><br>
           <p class="center">Khouribga le :  <?=h($ligne->dateDemande)?></p><br><br><br>

    </div><br><br><br>
    <?php echo $this->Html->image('footer.png'); ?>
    <!-- /.row -->

    </div>


</section>

<ol class="breadcrumb">
        <li>
        <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'consultationDemande',$id], ['escape' => false]) ?>
        </li>
      </ol>
