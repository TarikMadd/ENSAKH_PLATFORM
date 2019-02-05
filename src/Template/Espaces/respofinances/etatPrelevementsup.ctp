<?php $this->layout='AdminLTE.print';include 'N2TEXT.php';?>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title></title>
    <meta name="generator" content="LibreOffice 4.4.7.2 (Linux)"/>
    <meta name="created" content="2017-03-08T03:53:39"/>
    <meta name="changedby" content="boutalat abdelfattah"/>
    <meta name="changed" content="2017-03-08T15:37:56"/>
    <meta name="AppVersion" content="16.0300"/>

    <style type="text/css">
        body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Arial";}
        @page { size: auto;  margin: 10mm; }
    </style>
    <style media="print" type="text/css">
        .colorer {
            background-color: #C0C0C0 !important;
        }
    </style>

</head>

<body>
<table cellspacing="0" border="0">
    <colgroup width="406"></colgroup>
    <colgroup width="859"></colgroup>
    <colgroup width="434"></colgroup>
    <colgroup width="426"></colgroup>
    <colgroup width="430"></colgroup>
    <colgroup width="1028"></colgroup>
    <colgroup span="7" width="74"></colgroup>
    <tr>
        <td height="21" align="left" valign=bottom><b><i><font face="Andalus">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                                                  </font></i></b></td>
        <td align="left" valign=bottom><b><i><font face="Andalus">ROYAUME DU MAROC</font></i></b></td>
        <td align="left" valign=middle><b><i><font face="Garamond"><br></font></i></b></td>
        <td colspan=3 align="center" valign=middle><b><i><u><font face="Garamond"> EXERCICE DU <?php
                            $dateD = date_create($prelevement->dateDebut);
                            $dateD=date_format($dateD, 'd/m/Y');
                            $dateF = date_create($prelevement->dateFin);
                            $dateF=date_format($dateF, 'd/m/Y');
                            echo " ".$dateD." AU ".$dateF;

                            ?></font></u></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td colspan=2 height="21" align="center" valign=middle><b><i><font face="Andalus">UNIVERSITE HASSAN 1ER</font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td colspan=2 height="21" align="center" valign=middle><b><i><font face="Andalus">SETTAT</font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td colspan=2 height="21" align="center" valign=middle><b><i><font face="Andalus">ENSA  KHOURIBGA </font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td height="21" align="center" valign=middle><b><i><font face="Andalus"><br></font></i></b></td>
        <td align="center" valign=middle><b><i><font face="Andalus"><br></font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td colspan=5 height="20" align="center" valign=middle><b><i><font face="Times New Roman">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;                                            &nbsp; ETAT DE PRELEVEMENT</font></i></b></td>
        <td align="center" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td align="center" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td colspan=5 height="20" align="left" valign=middle><b><i><font face="Times New Roman">Indemnités Horaires pour travaux supplémentaires</font></i></b></td>

        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td height="20" align="left" valign=middle><b><br></b></td>
        <td colspan=4 align="center" valign=middle><b><i><font face="Times New Roman">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;N° de Compte : 61713020</font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td height="18" align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>

    <tr>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 3px double #000000; border-right: 1px solid #000000" height="59" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>OP</font></i></b></td>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>Bénéficiaire</font></i></b></td>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>Montant Brut</font></i></b></td>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>Taux IGR 38%</font></i></b></td>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>Montant NET</font></i></b></td>
        <td class="colorer" style="border-top: 3px double #000000; border-bottom: 3px double #000000; border-left: 1px solid #000000; border-right: 3px double #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond" size=3>Mode  de paiement</font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
<?php
$totalBrut=0;
$totalImpot=0;
$totalNet=0;
foreach ($paimentsupss as $paimentvac) {
    echo '<tr>';
    echo '<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="28" align="center" valign=bottom><b><i><font face="Garamond" size=3>N°&nbsp;'.$paimentvac->Numero.'</font></i></b></td>
        <td  style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom bgcolor="#FFFFFF"><b><i><font face="Garamond">'.$paimentvac->professeur->nom_prof.' '.$paimentvac->professeur->prenom_prof.'</font></i></b></td>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom sdnum="1033;0;#,##0.00"><b><i><font face="Garamond">'.number_format((float)($paimentvac->montantBrut), 2, ',', '').'</font></i></b></td>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom sdnum="1033;0;#,##0.00"><b><i><font face="Garamond">'.number_format((float)($paimentvac->Impot), 2, ',', '').'</font></i></b></td>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom sdnum="1033;0;#,##0.00"><b><i><font face="Garamond">'.number_format((float)($paimentvac->MontantNet), 2, ',', '').'</font></i></b></td>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><b><i><font face="Garamond">&nbsp;&nbsp;ChqN°:&nbsp;'.$paimentvac->Numero.'</font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>';
    $totalBrut=number_format((float)($totalBrut+$paimentvac->montantBrut), 2, '.', '');
    $totalImpot=number_format((float)($totalImpot+$paimentvac->Impot), 2, '.', '');
    $totalNet=number_format((float)($totalNet+$paimentvac->MontantNet), 2, '.', '');

}
?>

    <tr>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="24" align="left" valign=middle><b><font face="Garamond" size=3><br></font></b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond">Total</font></i></b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0" sdval="0" sdnum="1033;0;#,##0.00"><b><i><font  face="Garamond"> <?php echo number_format((float)($totalBrut), 2, ',', '');?></font></i></b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0" sdval="0" sdnum="1033;0;#,##0.00"><b><i><font face="Garamond"><?php echo number_format((float)($totalImpot), 2, ',', '');?></font></i></b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0" sdval="0" sdnum="1033;0;#,##0.00"><b><i><font face="Garamond"><?php echo number_format((float)($totalNet), 2, ',', '');?></font></i></b></td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td height="33" align="left" valign=middle><br></td>
        <td align="left" valign=middle><i><br></i></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0"><b><i><font face="Garamond">TOTAL IGR</font></i></b></td>
        <td class="colorer" style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#C0C0C0" sdval="0" sdnum="1033;0;#,##0.00"><b><i><font face="Garamond" size=4><?php echo $totalImpot;?></font></i></b></td>
        <td align="left" valign=middle><i><br></i></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
    <tr>
        <td height="18" align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="center" valign=middle bgcolor="#FFFFFF"><b><i><font face="Garamond"><br></font></i></b></td>
        <td align="center" valign=middle bgcolor="#FFFFFF" sdnum="1033;0;#,##0.00"><b><i><font face="Garamond" size=4><br></font></i></b></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
    </tr>
    <tr>
        <td height="18" align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="center" valign=middle bgcolor="#FFFFFF"><b><i><font face="Garamond"><br></font></i></b></td>
        <td align="center" valign=middle bgcolor="#FFFFFF" sdnum="1033;0;#,##0.00"><b><i><font face="Garamond" size=4><br></font></i></b></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
        <td align="left" valign=middle bgcolor="#FFFFFF"><br></td>
    </tr>
    <tr>
        <td colspan=6 height="20" align="left" valign=middle><b><i><font face="Andalus">Arrêté le présent état à la somme de :&nbsp;&nbsp;<?php

                        $number = number_format((float)($totalImpot), 2, ',', '');
                        $num=(string)$number;
                        $pieces = explode(",", $num);
                        $t = new ConvertNumberToText();$d =$t->Convert($pieces[0]);
                        $p=explode("(", $d);

                        echo strtoupper($p[0])." DIRHAMS ".$pieces[1]." CTS";
                        ?>
                    </font></i></b></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
        <td align="left" valign=middle><br></td>
    </tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>
