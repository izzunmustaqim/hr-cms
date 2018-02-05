<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
ob_start();
session_start();
if(!isset($_SESSION['cms_UserId'])){
 // header("Location: ../index.php");
}
include_once"../../common/database.inc.php";
define('FPDF_FONTPATH','font/');
require('lib/pdftable.inc.php');

$txtDateFrom = $_POST['txtDateFrom'];
$DateFrom= date('Y-m-d',strtotime($txtDateFrom));
$txtDateFrom = NewDateFormat($txtDateFrom); 

$p = new PDFTable('P', 'mm');
$p->SetMargins(20,25,20);
$p->AddPage('P');
$p->SetFont('Arial','',12);
//$p->MultiCell('', 10, 'Time Table Active Classes for ' .date('l',strtotime( $txtDateFrom)).' - '. date('d-m-Y',strtotime( $txtDateFrom)));

//$p->defaultFontSize=10;

/*$Class=mysql_query($stmt);

while($row = mysql_fetch_array($Class))    {
$ClassCode = $row['ClassCode'];
$ClassId = $row['ClassId'];

$CTime ="";

$CTime_res=mysql_query($CTime);
$count1_num_rows = mysql_num_rows($CTime_res); 

$SubjectCode 	= $row['SubjectCode'];

}

$content.="<tr> ";
$content.="<td align=center rowspan=$count1_num_rows>$ClassCode</td>";
$content.="<td align=center rowspan=$count1_num_rows>$TotStud</td>";
$content.="<td rowspan=$count1_num_rows>$SubjectCode</td>";
$content.="<td rowspan=$count1_num_rows>$SubjectName</td>";
$content.="<td rowspan=$count1_num_rows>$LecturerName</td>";
$content.="</tr> ";
$content.="</table width=138 border=1>";
*/  
$content.="
<table width=100% border=0>
  <tbody>
    <tr>
      <td align=right><font style=bold>PRIVATE AND CONFIDENTIAL</font></td>
    </tr>
  </tbody>	
</table>";

$content.="
<table width=100% border=0>
  	<tr>
      <td width=15%>Our Ref</td>
	  <td>&nbsp;:&nbsp;CITYU/HRA/EXT/2016-xxx-A1</td>
    </tr>
	<tr>
	  <td>Date</td>
	  <td>&nbsp;:&nbsp;!@#$%^&*()_+</td>
    </tr>
</table>";
$content.="";
$content.="
<table width=100% border=0>
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
      <td>Dear Mr/Mrs,</td>
    </tr>
	<tr>
      <td border='0010'><font style=bold>LETTER OF APPOINTMENT</font></td>
    </tr>
</table>";

$content.="
<table width=100% border=0>
  	<tr>
      <td align=justify>We are pleased to confirm our offer of employment to you as  xxxxxx (position) under Faculty of  xxxxxxxxx with City University College of Science and Technology (“The Company”). You will report to Dean, xxxxxxxxxxx or any other officer as appointed by the Company. This position is based at the Petaling Jaya Main Campus at Menara City University College.</td>
    </tr>

	<tr>
      <td align=justify>Your appointment with the Company is subject to you obtaining a satisfactory medical report including a chest X-ray from the Company’s appointed clinic and you being certified medically fit for employment.</td>
    </tr>

	<tr>
      <td align=justify>Apart from the foregoing, as an educational institution we have to strictly comply with government regulation with regard to matters concerning teaching permit etc. You are herewith requested to note that, if for any reason your teaching permit application is rejected by the ministry concerned or if there is any objection from government authorities concerning your employment, your continued employment by us shall cease with immediate effect and the question of any payment of compensation shall not arise.</td>
    </tr>
	
	<tr>
      <td>You shall be paid a salary of RMxxxx (Ringgit Malaysia: xxxxxxxx) per month less statutory deductions.</td>
    </tr>
</table>";

$content.="<tr pbr></tr>";

$content.="
<table width=100% border=0>
	<tr>
      <td>The terms and conditions applicable to this appointment are contained in attachment (Appendix A).</td>
    </tr>
  	<tr>
      <td>This letter is given to you in duplicate. Your signature on the duplicate of this letter shall confirm your understanding and acceptance of terms and conditions of your employment.</td>
    </tr>
	<tr>
	  <td>Kindly return the duplicate of this letter, duly signed to the Human Resource Department by Day, xxxxxxxxxxx failing which, this offer shall lapse. </td>
    </tr>
	<tr>
      <td>You are also to note that once acceptance of this employment offer is confirmed by you and if you do not report to work on the specified date in Appendix A, you may subject yourself to legal action by CITY University College of Science & Technology.</td>
    </tr>
</table>";
// I set margins out of class
//$p->AddFont('vni_times');
//$p->AddFont('vni_times', 'B');
//$p->AddFont('vni_times', 'I');
//$p->AddFont('vni_times', 'BI');
$p->SetFont($p->defaultFontFamily, $p->defaultFontStyle, $p->defaultFontSize);
$p->htmltable($content);
$p->Output();
?>