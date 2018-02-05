<?php

require_once "Db.class.php";
include ("../mpdf/mpdf.php");

$db = new Db();
$id = $_GET['id'];$user_id = $_GET['user_id'];
define("MAJOR", 'Ringgit Malaysia');
define("MINOR", 'RM');

// LOG
$log = $db->query("INSERT INTO tblhrprintlog(date_log,offer_id,user_id) VALUES (NOW(),'$id','$user_id')");

include ("../letter/function.php");

$result = $db->query("SELECT * FROM tblhroffer WHERE id = :id", array("id"=>$id));
foreach($result as $result) {

    $obj = new convert_money($result['salary']);
    $staff_id = $result['user_id'];
    $user = $db->query("SELECT * FROM tbluser WHERE UserId = $staff_id");

    $mpdf=new mPDF('','', 0, '', 20, 20, 20, 5, 9, 9, 'P');
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
            font-family: tahoma;
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
            font-family: tahoma;
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
    <br>
    <table width="100%" class="adress">
        <tr>
            <td><b><?php uppercase($result['name']);?></b></td>
        </tr>
        <?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
            <tr>
                <td><?php echo $result['address1'];?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?><?php if($result['city']){ echo " ";upper($result['city']);} ;?>,<?php if($result['state']){ echo "<br>";upper($result['state']);};?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>&nbsp;-present-</td>
            </tr>
        <?php } ?>
    </table>
        <br>
    <table width="100%">
        <tr>
            <td>Dear <b><?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>Re: APPOINTMENT AS A PART TIME CLINICAL INSTRUCTOR</b></td>
        </tr>
        <tr>
            <td border="0010">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clinical Posting</td>
        </tr>
        <tr>
            <td border="0010">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For Diploma in Nursing (DIN) in the Faculty of Allied Health Sciences (FAHS)</td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr>
    </table>
<table width="100%" class="spacebar">
    <tr>
    <td height="45">The above refers.</td>
    </tr>
    <tr>
    <td height="45">We are pleased to appoint you as a part-time lecturer based on the below;</td>
    </tr>
    <tr>
    <td><b>1. DURATION</b></td>
    </tr>
    <tr>
    <td height="45">The appointment is for the period of <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?> to <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?>.</td>
    </tr>
    <tr>
    <td height="45"><b>2. SPECIFICATIONS OF TASKS</b></td>
    </tr>
    <tr>
    <td height="45">In agreeing to accept this appointment, you are required to;</td>
    </tr>
     <tr>
    <td height="45">
    	<table width="100%" class="spacebar">
        <tr>
        <td width="7%">&nbsp;</td>
        <td width="93%">a. Monitor the students during their practical class</td>
        </tr>
        <tr>
        <td width="7%">&nbsp;</td>
        <td width="93%">b. To teach when necessary</td>
        </tr>
        <tr>
        <td width="7%">&nbsp;</td>
        <td width="93%">c. Any other duties assigned to you from time to time by the Head of 
   Department
</td>
        </tr>
        </table>
        <br>
    </td>
    </tr>
    <tr>
    <td height="45" align="justify">You are required to register your attendance through the hospital registration system. You will also be required to submit the attendance sheet signed by students present in your classes as proof for claim purposes. The management may also issue you a time card which is to be used for computation of your fees only.</td>
    </tr>
    </table>
     <div style='page-break-after:always'>&nbsp;</div>
  <htmlpageheader name="fourthpage" style="display:none"> </htmlpageheader>
  <sethtmlpageheader name="fourthpage" value="on" show-this-page="1"/>
  <table width="100%" class="spacebar">
  <tr>
  <td height="45" align="justify"><b>3. POSTING LOCATION</b></td>
  </tr>
   <tr>
  <td height="45" align="justify">Based on the list of hospitals assigned by the Head of Department</td>
  </tr>
   <tr>
  <td height="45" align="justify"><b>4. TERMS OF PAYMENT</b></td>
  </tr>
   <tr>
  <td height="45" align="justify">In consideration for the service rendered (as specified in 2 above) you will be paid at a rate of RM<?php money($result['salary']);?> per shift<br><br>
  A single payment, calculated and based on the number of hours clocked in for the teaching will be paid upon you submitting your claims which must be accompanied by the reports of all registered students and the assessment during clinical posting. The university reserves the right to withhold payment until terms specified in “Clause 2” are fulfilled.<br> &nbsp;</td>
  </tr>
   <tr>
  <td height="45" align="justify"><b>5. OTHERS</b></td>
  </tr>
   <tr>
  <td height="45" align="justify">a. This is a fixed term contract for the completion of assignments as specified in 2 above. It supersedes and renders null and void any prior engagement, if any, related to the same. <br><br>
  b. The contract is non-transferable. You are not an employee of the University and the university shall not be held responsible for any third party claims arising out of this appointment.<br><br>
  c. You agree that this appointment shall not create any permanent employment relationship that falls within the EPF Act 1991 and the Employees Social Security Act 1969 or any amendments to them since.<br>&nbsp;</td>
  </tr>
    <tr>
  <td height="45" align="justify">The onus is on you to declare to Inland Revenue Department the payments you have received from us.<br>&nbsp;</td>
  </tr>
   <tr>
  <td height="45" align="justify">We look forward to your contribution towards the progress and development of City University.<br>&nbsp;</td>
  </tr>
  </table>
   <div style='page-break-after:always'>&nbsp;</div>
   <table width="100%" class="spacebar">
    <tr>
    <td align="justify">Thank you.<br>&nbsp;</td>
    </tr>
   <tr>
    <td align="justify">Yours sincerely,</td>
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
     <br><br><br><br><br><br><br><br>
    <table width="100%" class="spacebar">
    <tr>
            <td align="justify">
                <hr>
            </td>
        </tr>
        <tr>
            <td align="center"><b>ACKNOWLEDGEMENT</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">I herewith confirm i have read and agree to the content of this offer and to Appendix 1 attached.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
         <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>.................................................................</td>
        </tr>
        <tr>
            <td>Name :</td>
        </tr>
        <tr>
            <td>NRIC/Passport No :</td>
        </tr>
         <tr>
            <td>Date :</td>
        </tr>
    </table>
      <div style='page-break-after:always'>&nbsp;</div>
      <table width="100%">
      <tr>
      <td align="right"><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
      </tr>
       <tr>
      <td align="right">Date:<?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_offer'])) ;?></td>
      </tr>
      </table>
      <table width="100%" class="spacebar">
      <tr>
      <td><b>APPENDIX 1</b><br>&nbsp;</td>
      </tr>
      <tr>
      <td><b>ADDITIONAL TERMS AND CONDITIONS</b></td>
      </tr>
      <tr>
        <td align="justify">
                <hr class="hr">
            </td>
            </tr>
      </table>
     <table width="100%" class="spacebar">
     <tr>
     <td width="4%"><b>1.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>SCHEDULE/DAYS OF WORK</b></td>
     </tr>
     <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">The schedule shall be discussed with the Management for confirmation upon reporting for duty. City University(CU) practices a 5 day working week with Saturday and Sunday as off and rest days.<br>&nbsp;</td>
     </tr>
     <tr>
     <td width="4%"><b>2.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>RENEWAL OF CONTRACT</b></td>
     </tr>
      <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">Your contract may be renewed at the discretion of the Management of City University.<br>&nbsp;</td>
     </tr>
     <tr>
     <td width="4%"><b>3.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>ALLOWANCE</b></td>
     </tr>
       <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">The rate quoted in the offer letter shall fully cover remuneration for all work that you shall be performing in City University which includes preparations involved in teaching of subject(s)/ programme(s), administration and research work.  As such, there is no additional payment such as for setting test papers, marking of examination scripts or expenses involved in traveling to and from City University.<br>&nbsp;</td>
     </tr>
      <tr>
     <td width="4%"><b>4.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>BENEFIT AND ENTITLEMENT</b></td>
     </tr>
      <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">You shall not be entitled to any benefits provided to our full time employees except that you shall be given full support for travel, accommodation and daily allowances should you travel on City University official business as per the normal terms applicable for employees.<br>&nbsp;</td>
     </tr>
      <tr>
     <td width="4%"><b>5.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>CONFIDENTIALITY</b></td>
     </tr>
     <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">You shall not reveal to anyone any knowledge acquired during your part time appointment with City University. Upon ending your service with City University, you shall not at any time indicate or declare that you are still associated with or have <br>&nbsp;</td>
     </tr>
     </table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
  <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">any connection to City University. Neither shall you use any information concerning City University for your own benefit.<br>&nbsp;</td>
     </tr>
      <tr>
     <td width="4%"><b>6.</b></td>
     <td width="4%">&nbsp;</td>
     <td width="92%"><b>CODE OF CONDUCT</b></td>
     </tr>
      <tr>
     <td width="4%">&nbsp;</td>
     <td width="4%">&nbsp;</td>
     <td width="92%" align="justify">City University expects a certain code of conduct from you such as:<br><br>
     	<table width="100%" class="spacebar">
        <tr>
        <td>•</td>
        <td>to support the vision, mission, policies, procedures and practices of City University;</td>
        </tr>
        <tr>
        <td>•</td>
        <td>to discharge your responsibilities assigned to you to the best of your ability and that you shall promote and advance the interests of  City University at all times;</td>
        </tr>
        <tr>
        <td>•</td>
        <td>to conduct yourself with propriety and decorum at all times to reflect the good image of City University.</td>
        </tr>
        </table>
    </td>
     </tr>
      <tr>
     <td colspan="3" align="justify"><b>Note</b>: - City University may, if necessary, add or amend all or any of the provisions of these terms and conditions at its absolute discretion.</td>
     </tr>
</table>
    </br>
</body>
<?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

}
?>