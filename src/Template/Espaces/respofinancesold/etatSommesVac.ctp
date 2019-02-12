<?php $this->layout='AdminLTE.print'; include 'N2TEXT.php';?>
<html>
<head>

    <style>
        @page { size: auto;  margin: 0mm; }

    </style>
    <style media="print" type="text/css">
        .colorer {
            background-color: #C0C0C0 !important;
        }
    </style>
</head>

<body style="    padding-left: 20px;padding-top: 20px;">
<table cellspacing="0" border="0">
    <colgroup span="7" width="107"></colgroup>
    <tr>
        <td colspan=3 height="21" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua">UNIVERSITE HASSAN 1ER</font></td>

        <td  colspan=5 align="right"  valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua">
                <?php
                $dateD = date_create($paimentvac->dateDebut);
                $dateD=date_format($dateD, 'd/m/Y');
                $dateF = date_create($paimentvac->dateFin);
                $dateF=date_format($dateF, 'd/m/Y');
                echo "Ex . Du ".$dateD." AU ".$dateF;

                ?>  N° de Compte : 61354410
            </font></td>
    </tr>
    <tr>
        <td colspan=2 height="21" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua">ENSA KHOURIBGA</font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td colspan=5 align="center" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td colspan=3 height="21" align="center" valign=bottom bgcolor="#FFFFFF"> </td>

        <td colspan=5 align="center" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua">APPLICATION DECRET N° 2.08.11</font></td>
    </tr>
    <tr>
        <td colspan=2 height="21" align="center" valign=bottom bgcolor="#FFFFFF"></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td colspan=4 align="center" valign=bottom bgcolor="#FFFFFF"><font face="Book Antiqua">Du 05 Rajab 1429  </font></td>
    </tr>
    <tr>
        <td height="21" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td colspan=2 align="center" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" color="#000000">       b-o N° 5649 ( 21/07/2008)</font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td colspan=7 height="21" align="center" valign=bottom bgcolor="#FFFFFF"><b><u><font face="Times New Roman" size=3>Etat des sommes dues pour vacations .</font></u></b></td>
    </tr>

    <tr>
        <td height="21"   align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="20" colspan=2 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">NOM &amp; PRENOM&nbsp; </font></td>
        <td height="20" colspan=2 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font> : <?php echo $vacataire->nom_vacataire." ".$vacataire->prenom_vacataire;?></td>

        <td height="20" colspan=2 align="right" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">S.O.M&nbsp;</font></td>
        <td height="20" colspan=1 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"> : <?php echo $vacataire->somme?></font></td>
    </tr>
    <tr>
        <td height="21" colspan="2" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">GRADE&nbsp;    </font></td>
        <td align="left" colspan=5 valign=bottom bgcolor="#FFFFFF"><font face="Calibri">: <?php echo $gradenom?></font></td>
        <td style="border-top: 1px solid #ffffff; border-bottom: 1px solid #ffffff; border-left: 1px solid #ffffff; border-right: 1px solid #ffffff" colspan=5 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Cambria"></font></td>
    </tr>
    <tr>
        <td height="21"  colspan="2" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">CATEGORIE </font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"> :<?php echo $categorie?></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21"  colspan="2" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">MATIERE&nbsp; </font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"> :<?php echo $vacataire->specialite?></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" colspan=2 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Open Sans">ETABLISSEMENT D’ORIGINE&nbsp;    </font></td>
        <td align="left" colspan=3 align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri">:<?php echo $vacataire->universite?></font></td>


    </tr>
    <tr>
        <td height="21" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri" size=3></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21"  align="left" valign=bottom bgcolor="#FFFFFF"><font face="Times New Roman">REFERENCE&nbsp;:</font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" colspan=6 width="250px" align="left" valign=bottom bgcolor="#FFFFFF"><font face="Times New Roman">NOMBRE D’HEURES ASSUREES :<?php echo $nbHeures?></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
        <td align="left" valign=bottom bgcolor="#FFFFFF"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #000000" height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"  align="center" valign=bottom bgcolor="#C0C0C0"><b><font face="Times New Roman">MOIS   </font></b></td>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#C0C0C0"><b>ANNEE</b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom bgcolor="#C0C0C0"><b><font face="Times New Roman">NOMBRE D’HEURES DE VACCATIONS</font></b></td>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#C0C0C0"><b>TAUX HORAIRE </b></td>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#C0C0C0"><b>TOTAL</b></td>
    </tr>

    <?php
    $c=0;
    $total=0;
    $months = array (1=>'Janvier',2=>'février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'juillet',8=>'aout',9=>'septembre',10=>'octobre',11=>'novembre',12=>'décembre');
    $q=floor(count($paimentvac->vacations)/2);

    foreach ($paimentvac->vacations as $vacation){
        echo '<tr height="15">';
        echo '<td style="border: 1px solid #000000;padding-top: -12px;" height="15" align="center" valign=bottom><font face="Calibri">'.$months[$vacation->mois].'</font></td>';
        echo '<td style="border: 1px solid #000000; padding-top: -12px;border-right: 1px solid #000000;border-left: 1px solid #000000" align="center" valign=bottom sdval="2016" sdnum="1033;"><font face="Calibri" color="#000000">'.$vacation->annee.'</font></td>';

        echo '<td style="border-top: 1px solid #000000;padding-top: -12px; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=bottom><font face="Cambria">'.$vacation->nbHeure.'</font></td>';
        if($c==$q)
            echo '<td style=" border-right: 1px solid #000000;padding-top: -12px;" align="center" valign=bottom sdval="180" sdnum="1033;"><font face="Calibri" color="#000000">'.$taux.'</font></td>';
        else
            echo '<td style="border-right: 1px solid #000000;padding-top: -12px;" align="center" valign=bottom sdval="180" sdnum="1033;"><font face="Calibri" color="#000000"></font></td>';
        echo '<td style="border-bottom: 1px solid #000000;padding-top: -12px; border-right: 1px solid #000000" align="center" valign=bottom sdval="0" sdnum="1033;"><font face="Calibri" color="#000000">'.number_format((float)($vacation->nbHeure*$taux), 2, ',', '').'</font></td>';
        echo '</tr>';
        $c++;
        $total+=$vacation->nbHeure*$taux;
    }
    ?>



    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-right: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td class="colorer" style="border: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><font face="Calibri" color="#000000">TOTAL</font></td>
        <td class="colorer" style="border: 1px solid #000000;" align="center" valign=bottom sdval="0" sdnum="1033;0;#,##0.00"><font face="Times New Roman"><?php echo number_format((float)($total), 2, ',', '')?></font></td>
    </tr>
    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td colspan=5 height="21" align="left" valign=bottom><b><font face="Open Sans">Arrêté à la somme de&nbsp;: </font></b></td>
        <td align="right" valign=bottom sdval="0" sdnum="1033;0;#,##0.00"><font face="Calibri" color="#000000"><?php echo number_format((float)($total), 2, ',', '')?></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" colspan="2" align="left" valign=bottom><font face="Open Sans">L’ENSEIGNANT&nbsp;:</font></td>
        <td align="left" colspan="3" valign=bottom><font face="Calibri"><?php echo $vacataire->nom_vacataire." ".$vacataire->prenom_vacataire;?></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri" color="#000000">                  </font></td>
    </tr>

    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td colspan=7 height="21" align="center" valign=bottom><b><u><font face="Open Sans">Décompte des heures de vacation</font></u></b></td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #000000" height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td style="border-bottom: 1px solid #000000" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="left" valign=bottom bgcolor="#C0C0C0"><font face="Open Sans">Montant brut</font></td>
        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom bgcolor="#C0C0C0"><font face="Open Sans">Impôts à 17 % </font></td>
        <td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom bgcolor="#C0C0C0"><font face="Open Sans">Montant Net</font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="21" align="center" valign=bottom sdval="0" sdnum="1033;0;#,##0.00"><font face="Open Sans"><?php echo number_format((float)($total), 2, ',', '')?></font></td>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom sdnum="1033;0;_-* #,##0.00 _€_-;-* #,##0.00 _€_-;_-* &quot;-&quot;?? _€_-;_-@"><font face="Calibri" color="#000000"><?php echo number_format((float)($total*17/100), 2, ',', '')?></font></td>
        <td class="colorer" style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom sdval="0" sdnum="1033;0;#,##0.00"><font face="Calibri" color="#000000"><?php echo number_format((float)($total-($total*17/100)), 2, ',', '')?></font></td>
        <td style="border-bottom: 0px solid #000000;"><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td  height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td  align="left" valign=bottom><font face="Calibri"></font></td>
        <td  align="left" valign=bottom><font face="Calibri"></font></td>
        <td  align="left" valign=bottom><font face="Calibri"></font></td>
        <td  align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td colspan=2 height="21"  align="left" valign=bottom><font face="Open Sans">Arrêté à la somme de : </font>

        <td height="21" colspan=4 align="left" * valign=bottom><font face="Calibri"><?php

                $number = number_format((float)($total-($total*17/100)), 2, ',', '');
                $num=(string)$number;
                $pieces = explode(",", $num);
                $t = new ConvertNumberToText();$d =$t->Convert($pieces[0]);
                $p=explode("(", $d);

                    echo strtoupper($p[0])." DIRHAMS ".$pieces[1]." CTS";
                ?></font></td>


    </tr>

    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri" color="#000000">                                                         </font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri" color="#000000">                                                         </font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" colspan=5 valign=bottom><font face="Open Sans">KHOURIBGA LE : <?php // echo $newDate = date("d/m/Y", strtotime($paimentvac->datepaiment));?></font></td>
        <td align="left" valign=bottom sdnum="1033;1033;M/D/YYYY"><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>

    <tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri" color="#000000">                                                         </font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr><tr>
        <td height="21" align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri" color="#000000">                                                         </font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
    <tr>
        <td height="21" colspan="2" align="center" valign=bottom><font face="Open Sans">LE PRESIDENT </font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td colspan=3 align="left" weidth="120" valign=bottom><font face="Open Sans">LE DIRECTEUR</font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
        <td align="left" valign=bottom><font face="Calibri"></font></td>
    </tr>
</table>

</body>

</html>
