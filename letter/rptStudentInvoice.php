<?php 
session_start();
include ("../../mpdf/mpdf.php");
include ("StudentInvoice.inc.php");
include ("../inc/convert.php");

	$mpdf=new mPDF('','', 0, '', 15, 15, 5, 5, 9, 9, 'P');
	ob_start();
	$mpdf->ignore_invalid_utf8 = true;
	
	$Student = Get_Student();
	$rowStud = mysqli_fetch_array($Student,MYSQL_ASSOC);
	$DateRegister = $rowStud['DateRegister'];	
	$StudName = $rowStud['StudName'];	
	$StudNRICPassportNo = $rowStud['StudNRICPassportNo'];	
	$ProgramName = $rowStud['ProgramName'];	
	$YearRegister = $rowStud['YearRegister'];
	$ProgramRegId = $_GET['ProgramRegId'];
	$Staff_FullName = $_SESSION["Staff_FullName"];
	
	//die('x,x'.$Staff_FullName);
	/*
	$StudentInvoice = Get_StudentInvoice();
	$rowInvoice = mysqli_fetch_array($StudentInvoice,MYSQL_ASSOC);
	$StudentInvoicesId = $rowStud['StudentInvoicesId'];

	if(empty($StudentInvoicesId)){
	InsertStudInvoice($ProgramRegId,$YearRegister);	
	}*/
	
?>
<style>
body { 
font-family: arial; 
font-size: 9pt; 
margin-top: 0px;

}

.checkbox { 
font-family: arial; 
font-size: 19px; 
}

.header { 
font-family: arial; 
font-size: 14px; 
}

.tabheader{
	margin-right:10em;
}
.table{
	border-left:thin solid #000;
	border-top:thin solid #000;
	border-bottom:thin solid #000;
	border-right:thin solid #000;
}

</style>
<body>
<br><br><br><br><br><br><br><br><br><br><br>
<table  width="100%">
<tr>
<td><font class="header" color=""><big>U.C.I EDUCATION SDN BHD</big><small>(457626-U)</small></font></td>
<td align="right"><font class="header" color=""><big>TAX INVOICE</big></font></td>
</tr>
<tr>
<td><font class="header" color="">(GST NO:002087669760)</font></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">Date: <?php echo $DateRegister?></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="right">Invoice no: <?php echo $YearRegister ?>/UCI/AFEE/<?php echo $ProgramRegId ?></td>
</tr>
</table>
<table width="100%">
<tr>
<td width="19%">To:</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td>Student Name </td>
<td width="81%">: <?php echo $StudName ?></td>
</tr>
<tr>
<td>NRIC/Passport </td>
<td>: <?php echo $StudNRICPassportNo ?></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td colspan="2"><strong><u>ANNUAL FEE</u></strong></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
    <td>Program </td>
    <td>: <?php echo $ProgramName ?></td>
</tr>
<tr>
    <td>Year </td>
    <td>: <?php echo $YearRegister ?></td>
</tr>
<tr>
	<td colspan="2"><hr style="color:#000000; size:10;" ></td>
</tr>
</table>

<table width="100%" class="table"  cellpadding="0" cellspacing="0" border="0">
<tr>
    <td width="14%" height="27" align="center" style="border-bottom:thin solid #000; " ><b>Tax Code</b></td>
    <td width="69%" style="border-bottom:thin solid #000; border-right:thin solid #000; border-left:thin solid #000;" ><b>&nbsp;Description</b></td>
    <td width="17%" align="center" style="border-bottom:thin solid #000;" ><b>Amount (RM)</b></td>
</tr>
<?php
	$fee = Get_Fee();
	$x = 0;
	while($rowFee = mysqli_fetch_array($fee,MYSQL_ASSOC)){
	$x++;
	$rowcount = mysqli_num_rows($fee);
	$space= "- ";
	$rownum = $rowFee['rownum'];
	$feetypename = $space.$rowFee['feetypename'];
	$SemesterFees = $rowFee['SemesterFees'];
	$rownumberstr = $rowFee['rownumberstr'];
	$TotSemesterFees += $SemesterFees;
	
	echo '<tr>';
	if($rowcount > 1){
	if($x == 1){
		echo '<td align="center" rowspan="'.$rowcount.'" >ES</td>';
	}	
	}else{
		echo '<td align="center" style="border-bottom:thin solid #000;">ES</td>';	
	}
	$RMToWord = int_to_words($TotSemesterFees);
    
	echo '<td height="50" style="border-right:thin solid #000; border-left:thin solid #000;">'.$feetypename.' for '. $rownumberstr .' Year </td>';
	echo '<td align="right" >'.number_format($SemesterFees,2).'&nbsp;</td>';	
	echo '</tr>';
	}
	
	echo '<tr><td>&nbsp;</td><td  style="border-left:thin solid #000;border-right:thin solid #000;">'.'&nbsp;Malaysian Ringgit :<br>&nbsp;'.ucwords($RMToWord).' Only </td></tr>';
	///$SemesterFees = int_to_words($SemesterFees);	
	
?>

<tr>
<td height="28" colspan="2" align="right" style="border-bottom:thin solid #000; border-top:thin solid #000; border-right:thin solid #000;" >SUBTOTAL&nbsp;</td>
<td align="right" style="border-bottom:thin solid #000;  border-top:thin solid #000;"><?php echo number_format($TotSemesterFees,2) ?>&nbsp;</td>
</tr>
<tr>
<td height="29" colspan="2" align="right" style="border-bottom:thin solid #000; border-right:thin solid #000;" >GST 6%&nbsp;</td>
<td align="right" style="border-bottom:thin solid #000; " ><b>-</b>&nbsp;</td>
</tr>
<tr>
<td height="28" colspan="2" align="right" style="border-right:thin solid #000;">GRAND TOTAL&nbsp;</td>
<td align="right" ><b><?php echo number_format($TotSemesterFees,2) ?>&nbsp;</b></td>
</tr>
</table>
<br><br>
<i>** All payment by cheque or bank draf payable to <b>U.C.I EDUCATION SDN BHD</b></i>

<br><br><br><br>
<table width="100%">
<tr>
<td width="81%">Prepared by:</td>
<td width="19%" align="center">Received by:</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>.......................................</td>
<td align="center">............................</td>
</tr>
<tr>
<td><b><i><?php echo $Staff_FullName ?></i></b></td>
<td align="center"><b><i>Signature  </i></b></td>
</tr>
<tr>
<td></td>
</tr>
</table>

</body>
<?php

// Now collect the output buffer into a variable
$html = ob_get_contents();
ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;
?>
