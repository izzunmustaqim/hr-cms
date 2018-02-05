<?php 
session_start();
include ("../../mpdf/mpdf.php");
//include ("StudentInvoice.inc.php");

	$mpdf=new mPDF('','', 0, '', 25, 20, 20, 5, 9, 9, 'P');
	ob_start();
	$mpdf->ignore_invalid_utf8 = true;
	
/*	$Student = Get_Student();
	$rowStud = mysqli_fetch_array($Student,MYSQL_ASSOC);
	$DateRegister = $rowStud['DateRegister'];	
*/
	
?>
<style>
body { 
font-family: tahoma; 
font-size: 12pt; 
margin-top: 0px;

}

td{
text-align: justify;
line-height: 170%;
	
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

.hr {
  border: 0;
  margin-top:auto;
  border-top: 4px double #8c8c8c;
  text-align: center;
}


.signature {
  margin-bottom:auto;
  width:5px;
}

</style>
<body>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td align="right"><b>PRIVATE AND CONFIDENTIAL</b></td>
    </tr>
  </tbody>	
</table>

<table width="100%" >
  	<tr>
      <td width=15%>Our Ref</td>
	  <td>&nbsp;:&nbsp;CITYU/HRA/EXT/2016-xxx-AC3</td>
    </tr>
	<tr>
	  <td>Date</td>
	  <td>&nbsp;:&nbsp;!@#$%^&*()_+</td>
    </tr>
</table>

<table width="100%" >
	<tr>
      <td>&nbsp;</td>
    </tr>
  	<tr>
      <td>Siti Sara Kamal Affendi</td>
    </tr>
	<tr>
	  <td>36, Persiaran Wira Jaya Timur 50,<br>Taman Panglima,<br>31350 Ipoh,<br>Perak</td>
    </tr>
    <tr>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td>Dear Mr/Mrs,</td>
    </tr>
      <tr>
	  <td>&nbsp;</td>
    </tr>
	<tr>
      <td border="0010"><b>LETTER OF APPOINTMENT</b></td>
    </tr>
    <tr>
      <td><hr class="hr"></td>
      <!--<td style="border-top: 2px double #8c8b8b;">&nbsp;</td>-->
    </tr>
</table>
</br>
<table width="100%">
  	<tr>
      <td align="justify" height=""><p>We are pleased to confirm our offer of employment to you as  xxxxxx (position) under Faculty of  xxxxxxxxx with City University College of Science and Technology (&quot;The Company&quot;). You will report to Dean, xxxxxxxxxxx or any other officer as appointed by the Company. This position is based at the Petaling Jaya Main Campus at Menara City University College.</p></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="justify"><p>Your appointment with the Company is subject to you obtaining a satisfactory medical report including a chest X-ray from the Company’s appointed clinic and you being certified medically fit for employment.</p></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="justify"><p>Apart from the foregoing, as an educational institution we have to strictly comply with government regulation with regard to matters concerning teaching permit etc. You are herewith requested to note that, if for any reason your teaching permit application is rejected by the ministry concerned or if there is any objection from government authorities concerning your employment, your continued employment by us shall cease with immediate effect and the question of any payment of compensation shall not arise.</td>
    </tr>
	<tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="justify">You shall be paid a salary of RMxxxx (Ringgit Malaysia: xxxxxxxx) per month less statutory deductions.</td>
    </tr>
</table>
<!--<div style='page-break-after:always'>&nbsp;</div>-->
<table width="100%" >
	<tr>
      <td align="justify">The terms and conditions applicable to this appointment are contained in attachment (Appendix A).</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  	<tr>
      <td align="justify">This letter is given to you in duplicate. Your signature on the duplicate of this letter shall confirm your understanding and acceptance of terms and conditions of your employment.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
	  <td align="justify">Kindly return the duplicate of this letter, duly signed to the Human Resource Department by Day, xxxxxxxxxxx failing which, this offer shall lapse. </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="justify">You are also to note that once acceptance of this employment offer is confirmed by you and if you do not report to work on the specified date in Appendix A, you may subject yourself to legal action by CITY University College of Science & Technology.</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td align="justify">Yours faithfully,</td>
    </tr>
    <tr>
      <td align="justify"><b>CITY UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY</b></td>
    </tr>
</table>
<table border="0">
	<tr>
      <td align="justify" height="100"></td>
    </tr>
	<tr>
      <td align="justify"><hr></td>
    </tr>
    <tr>
      <td align="justify" ><b>DATIN ROHAIDAH SHAARI</b></td>
    </tr>
    <tr>
      <td align="justify">Executive Director</td>
    </tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%">
<tr>
<td align="left">Mr/Mrs</td>
<td align="right">Ref: CITYU/HRA/EXT/2016-xxx-AC3</td>
</tr>
<tr>
<td colspan="2"><hr class="hr"></td>
</tr>
</table>
<table width="100%">
<tr>
<td align="center"><b>ACKNOWLEDGEMENT</b></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td align="justify"><p>I ......................., (I/C No: ...................), hereby accept the terms and conditions of employment with City University College of Science and Technology as set forth in Appendix A and confirm herewith I shall report to work on the date specified.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
<br>
<table width="100%" border="0">
<tr>
<td width="30%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="30%">&nbsp;</td>
</tr>
<tr>
<td width="30%">&nbsp;</td>
<td width="40%">&nbsp;</td>
<td width="30%">&nbsp;</td>
</tr>
<tr>
<td width="30%"><hr class="signature"></td>
<td width="40%">&nbsp;</td>
<td width="30%"><hr class="signature"></td>
</tr>
<tr>
<td width="30%" height="44"><b>Signature</b></td>
<td width="40%">&nbsp;</td>
<td width="30%"><b>Date</b></td>
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
