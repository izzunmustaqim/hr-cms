<?php

require_once "Db.class.php";
include ("../mpdf/mpdf.php");

$db = new Db();
$id = $_GET['id'];$user_id = $_GET['user_id'];
define("MAJOR", 'Ringgit Malaysia');
define("MINOR", 'RM');

// LOG
$log = $db->query("INSERT INTO tblhrprintlog(date_log,offer_id,user_id) VALUES (NOW(),'$id','$user_id')");

include ("../offerletter/function.php");

$result = $db->query("SELECT * FROM tblhroffer WHERE id = :id", array("id"=>$id));
foreach($result as $result) {


    $mpdf = new mPDF('', '', 0, '', 25, 20, 20, 5, 9, 9, 'P');
	ob_start();
	$mpdf->ignore_invalid_utf8 = true;

    $str = $user[0]['FullName'];
    $first_letters = strtolower(substr(get_first_letters($str),0));
	
	 $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC9</div>');
	
    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">'.$first_letters.'</td>

</tr></table>

');

?>
    <style>
     body {
            font-family: Tahoma, Verdana, Segoe, sans-serif;
            font-size: 12pt;
            margin-top: 0px;

        }

        p{
            line-height: 170%;
        }

        .hr {
            border: 0;
            margin-top: auto;
            border-top: 4px double #8c8c8c;
            text-align: center;
        }

        .signature {
            margin-bottom: auto;
            width: 5px;
        }

        .table {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 12pt;
            color: #000;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }

        .table th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }

        .table td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }

        td {
            vertical-align: top;
            text-align: justify;
        }

        .spacebar {
            line-height: 170%;
        }
    </style>
<body>
 <br><br>
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td align="right"><b>PRIVATE AND CONFIDENTIAL</b></td>
        </tr>
        </tbody>
    </table>
     <table width="100%">
        <tr>
            <td width=15%>Our Ref</td>
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>&nbsp;:&nbsp;<?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_offer'])) ;?></td>
        </tr>
    </table>
        <table width="100%" class="adress">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><b><?php uppercase($result['name']);?></b></td>
        </tr>
        <?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
            <tr>
                <td><?php echo $result['address1'];?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?><?php if($result['city']){ echo " ";upper($result['city']);} ;?>,<?php if($result['state']){ echo "<br>";upper($result['state']);echo ","; };?> <?php getCountry($result['country_id'],$db);?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>&nbsp;-present-</td>
            </tr>
        <?php } ?>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
        <table width="100%">
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>CONTRACT FOR SERVICE AS CLINICAL INSTRUCTOR</b></td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr>
    </table>
    </br>
    <table width="100%" class="spacebar">
    <tr>
    <td>We are pleased to appoint you as a Part-time Lecturer based on the following Terms and Conditions below;</td>
    </tr>
    </table>
    <br>
<table width="100%" class="spacebar">
    <tr>
    <td width="5%"><b>1.</b></td>
    <td width="95%"><b>DURATION</b></td>
    </tr>
      <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">The appointment is for the period <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?> to <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?>.</td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td width="5%"><b>2.</b></td>
    <td width="95%"><b>SPECIFICATIONS OF TASKS</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">In agreeing to accept this appointment, you are required to;</td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">a.&nbsp;&nbsp;Monitor the students during their practical class</td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">b.&nbsp;&nbsp;To teach when necessary</td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%">c.&nbsp;&nbsp;Any other duties assigned to you from time to time by the Head of Department</td>
    </tr>
     <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
     <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">You are required to register your attendance through the hospital registration system. You will also be required to submit the attendance sheet signed by students present in your classes as proof for claim purposes. The management may also issue you a time card which is to be used for computation of your fees only.</td>
    </tr>
      <tr>
    <td colspan="2">&nbsp;</td>
    </tr>

</table>
 <div style='page-break-after:always'>&nbsp;</div>
 <br>
 <table width="100%" class="spacebar">
 <tr>
<td width="5%"><b>3.</b></td>
<td width="95%"><b>POSTING LOCATION</b></td>
</tr>
<tr>
<td width="5%">&nbsp;</td>
<td width="95%">Based on the list of hospitals assigned by the Head of Department</td>
</tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
<td width="5%"><b>4.</b></td>
<td width="95%"><b>TERMS OF PAYMENT</b></td>
</tr>
<tr>
<td width="5%">&nbsp;</td>
<td width="95%">In consideration for the service rendered (as specified in “Clause 2” above) you will be paid at a rate of RM125.00 per shift</td>
</tr>
     <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
     <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">A single payment, calculated and based on the number of hours clocked in for the teaching will be paid upon you submitting your claims which must be accompanied by the reports of all registered students and the assessment during clinical posting. The university reserves the right to withhold payment until terms specified in “Clause 2” are fulfilled.</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="5%"><b>5.</b></td>
<td width="95%"><b>OTHERS</b></td>
</tr> 
<tr>
<td width="5%">&nbsp;</td>
<td width="95%">
<table width="100%" class="spacebar">
<tr>
<td>a.</td>
<td align="justify">This is a fixed term contract for the completion of assignments as specified in “Clause 2” above. It supersedes and renders null and void any prior engagement, if any, related to the same.</td>
</tr>
<tr>
<td>b.</td>
<td align="justify">The contract is non-transferable. You are not an employee of the University and the university shall not be held responsible for any third party claims arising out of this appointment.</td>
</tr>
<tr>
<td>c.</td>
<td align="justify">You agree that this appointment shall not create any permanent employment relationship that falls within the EPF Act 1991 and the Employees Social Security Act 1969 or any amendments to them since.</td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="5%">&nbsp;</td>
<td width="95%" align="justify">Other terms and conditions of employment shall be in accordance to the “Appendix 1” attached.</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="5%">&nbsp;</td>
<td width="95%" align="justify">The onus is on you to declare to Inland Revenue Department the payments you have received from us.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td>We look forward to your contribution towards the progress and development of City University.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Thank you.</td>
</tr>
  <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">Yours faithfully,</td>
        </tr>
        <tr>
            <td align="justify"><b>CITY UNIVERSITY</b></td>
        </tr>
</table>
   <table border="0">
        <tr>
            <td align="justify" height="100"></td>
        </tr>
        <tr>
            <td align="justify">
                <hr>
            </td>
        </tr>
        <tr>
            <td align="justify"><b>DATIN ROHAIDAH SHAARI</b></td>
        </tr>
        <tr>
            <td align="justify">Executive Director</td>
        </tr>
    </table>
     <br><br>
    <table width="100%">
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr>
    </table>
    <table width="100%" class="spacebar">
        <tr>
            <td align="center"><b>ACKNOWLEDGEMENT</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>
                    I hereby have read and agree to the content of this letter and to Appendix 1 (attached).</p></td>
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
            <td width="30%">
                <hr class="signature">
            </td>
            <td width="40%">&nbsp;</td>
            <td width="30%">
                <hr class="signature">
            </td>
        </tr>
        <tr>
            <td width="30%" height="44"><b>Signature</b></td>
            <td width="40%">&nbsp;</td>
            <td width="30%"><b>Date</b></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <htmlpageheader name="fourthpage" style="display:none">
    </htmlpageheader>
    <sethtmlpageheader name="fourthpage" value="on" show-this-page="1"/>
    <br>
    <table width="100%">
    <tr>
    <td align="right"><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
    </tr>
    <tr>
    <td align="right">Date: <?php echo date('j F Y',strtotime($result['date_offer'])) ;?></td>
    </tr>
    </table>
    <table width="100%" class="spacebar">
    <tr>
    <td><b>APPENDIX 1</b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td><b>ADDITIONAL TERMS AND CONDITIONS</b></td>
    </tr>
    </table>
    <hr class="hr">
    <br>
    <table width="100%" class="spacebar">
    <tr>
    <td width="5%"><b>1.</b></td>
    <td width="95%"><b>SCHEDULE/DAYS OF WORK</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">The schedule shall be discussed with the Management for confirmation upon reporting for duty. City University (CityU) practices a 5½ day working week with Sunday as rest days.</td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
      <tr>
    <td width="5%"><b>2.</b></td>
    <td width="95%"><b>RENEWAL OF CONTRACT</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">Your contract may be renewed at the discretion of the Management of City University.</td>
    </tr>
     <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
        <tr>
    <td width="5%"><b>3.</b></td>
    <td width="95%"><b>ALLOWANCE</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">The rate quoted in the offer letter shall fully cover remuneration for all work that you shall be performing in City University which includes preparations involved in teaching of subject(s)/ programme(s), administration and research work.  As such, there is no additional payment such as for setting test papers, marking of examination scripts or expenses involved in traveling to and fromCity University.</td>
    </tr>
     <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
        <tr>
    <td width="5%"><b>4.</b></td>
    <td width="95%"><b>BENEFIT AND ENTITLEMENT</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">You shall not be entitled to any benefits provided to our full time employees except that you shall be given full support for travel, accommodation and daily allowances should you travel on City University’s official business as per the normal terms applicable for employees.</td>
    </tr>
         <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
        <tr>
    <td width="5%"><b>5.</b></td>
    <td width="95%"><b>CONFIDENTIALITY</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">You shall not reveal to anyone any knowledge acquired during your part time appointment with City University. Upon ending your service with City University, you shall not at any time indicate or declare that you are still</td>
    </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%" class="spacebar">
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">associated with or have any connection to City University. Neither shall you use any information concerning CUCST for your own benefit.</td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td width="5%"><b>6.</b></td>
    <td width="95%"><b>CODE OF CONDUCT</b></td>
    </tr>
    <tr>
    <td width="5%">&nbsp;</td>
    <td width="95%" align="justify">City Universityexpects a certain code of conduct from you such as:
    <table width="100%" class="spacebar">
    <tr>
    <td>•</td>
    <td align="justify">to support the vision, mission, policies, procedures and practices of City University;</td>
    </tr>
    <tr>
    <td>•</td>
    <td align="justify">to discharge your responsibilities assigned to you to the best of your ability and that you shall promote and advance the interests of City University at all times;</td>
    </tr>
      <tr>
      <td>•</td>
    <td align="justify">to conduct yourself with propriety and decorum at all times to reflect the good image of City University.</td>
    </tr>
    </table>
    </td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
     <tr>
    <td colspan="2"><b>Note</b>: - City University may, if necessary, add or amend all or any of the provisions of these terms and conditions at its absolute discretion.</td>
    </tr>
    </table>
</body>
    <?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

}
?>
