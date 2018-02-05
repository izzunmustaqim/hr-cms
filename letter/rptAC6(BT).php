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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC6(BT)</div>');
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
<br>
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
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Dear <b><?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>Re: APPOINTMENT AS A PART TIME LECTURER</b><br>           
                    <?php if($result['subject_id1']!=NULL){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $result['subject_id1'];echo "<br>"; }?>
                    <?php if($result['subject_id2']!=NULL){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $result['subject_id2'];echo "<br>"; }?>
                    <?php if($result['subject_id3']!=NULL){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $result['subject_id3'];echo "<br>";}?>
                    <?php if($result['subject_id4']!=NULL){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $result['subject_id4'];echo "<br>";}?>
                    <?php if($result['subject_id5']!=NULL){ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $result['subject_id5'];echo "<br>";}?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;For the&nbsp;<?php getProgram($result['program_id'],$db);?> - (Block-Teaching)
                <?php if($result['program_id2']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id2'],$db); }?>
                <?php if($result['program_id3']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id3'],$db); }?>
                <?php if($result['program_id4']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id4'],$db);}?>
            </td>
        </tr>
         <tr>
           <td border="0010"></td>
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
    <td>The above refers.</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="justify"><p>We are pleased to appoint you as a part time lecturer based on the Terms and Conditions below;</p></td>
    </tr>
    <tr>
    <td>
    	<table width="100%" class="spacebar">
        <tr>
        <td><b>1.</b></td>
        <td><b>Duration</b></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td align="justify"><p>The appointment is for the <?php upper($result['tech_semester']);?> semester and will end upon you submitting to the University, the student’s final grades and delivering all the answer scripts. The full academic calendar of the semester is attached herewith. Commencement date shall be <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?> to <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?>.</p></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td><b>2.</b></td>
        <td><b>Specification of Tasks</b></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>In agreeing to accept this appointment, you are required to;<br><br>
        Teach the
		<?php if($result['subject_id1']!=NULL){echo $result['subject_id1']." (Class code: ".$result['classcode_1'].")";}?>
        <?php if($result['subject_id2']!=NULL){echo $result['subject_id2']." (Class code: ".$result['classcode_2'].")";}?>
        <?php if($result['subject_id3']!=NULL){echo $result['subject_id3']." (Class code: ".$result['classcode_3'].")";}?>
        <?php if($result['subject_id4']!=NULL){echo $result['subject_id4']." (Class code: ".$result['classcode_4'].")";}?>
        <?php if($result['subject_id5']!=NULL){echo $result['subject_id5']." (Class code: ".$result['classcode_5'].")";}?> for <?php getProgram($result['program_id'],$db);?>
                <?php if($result['program_id2']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id2'],$db); }?>
                <?php if($result['program_id3']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id3'],$db); }?>
                <?php if($result['program_id4']!=NULL){echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>. <?php getProgram($result['program_id4'],$db);}?>
        </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td align="justify">
        	<table width="100%" class="spacebar">
        	<tr>
            <td width="3%">&nbsp;</td>
        	<td width="3%">a.</td>
        	<td width="94%" align="justify"><p>Conduct a maximum of <?php upper($result['duration_extra']);?> hours of lectures for the semester;</p></td>
        	</tr>
        	</table>
        </td>
        </tr>
    	</table>
    </td>
    </tr>
</table>
     <div style='page-break-after:always'>&nbsp;</div>
     <table width="100%" class="spacebar">
     <tr>
    <td>
    <table width="100%" class="spacebar">
    <tr>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td>
    		<table width="100%" class="spacebar">
            <tr>
            <td width="3%">&nbsp;</td>
            <td width="3%">b.</td>
            <td align="justify"><p>Prepare assignments, tutorials and exam questions based on the format specified by the University. Mark them appropriately, grade them accordingly, submit to the University the final results based on the University grading structure and the final exam report in the format specified;</p></td>
            </tr>
            <tr>
            <td width="3%">&nbsp;</td>
            <td>c.</td>
            <td align="justify"><p>Submit all questions, mark all scripts, finalize the grading and submit the final exam report within the time specified by the University;</p></td>
            </tr>
            <tr>
            <td width="3%">&nbsp;</td>
            <td>d.</td>
            <td align="justify"><p>Invigilate the examination of the Paper you are teaching and attend the Examination Board Meeting, if the University so requires</p></td>
            </tr>
            </table>
    </td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="justify"><p>You will be issued an ID card and you are required to scan your attendance with the card system and you will also be required to submit attendance sheet signed by students present in your classes as proof for claim purposes.</p></td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
    <td><b>3.</b></td>
    <td><b>Terms of Payment</b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="justify"><p>In consideration for the service rendered (as specified in 2 above) you will be paid at a rate of RM<?php upper($result['salary']);?> per hour.<br><br>
    Your payment shall be calculated based on the number of hours clocked in for the teaching and you will be paid upon you submitting your claims which must be accompanied by the final grades of all registered students including the marked answer scripts of the final exam.<br><br>
    The payment shall be made on a monthly basis in the form of cheque. The University reserves the right to withhold payment until all terms specified in ‘Clause 2’ are fulfilled by you.
    </p></td>
    </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
     <tr>
    <td><b>4.</b></td>
    <td><b>Others</b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="justify">
    	<table width="100%" class="spacebar">
        <tr>
        <td>a.</td>
        <td align="justify"><p>Your service is on a fixed term contract of service and the completion of assignments as specified in 2 above. Obligations of both parties expire upon fulfillment of all terms in this appointment.</p></td>
        </tr>
        </table>
    </td>
    </tr>
    </table>
    </td>
    </tr>
     </table>
   <div style='page-break-after:always'>&nbsp;</div>
   <table width="100%" class="spacebar">
   <tr>
    <td>
    <table width="100%" class="spacebar">
    <tr>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td align="justify">
    	<table width="100%" class="spacebar">
        <tr>
        <td>b.</td>
        <td align="justify"><p>The contract is non-transferable. You are not a full time employee of the University and the University shall not be held responsible for any third party claims arising out of this appointment.</p></td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td align="justify">&nbsp;</td>
        </tr>
        <tr>
        <td>c.</td>
        <td align="justify"><p>You agree that this appointment shall not create any permanent employment relationship that falls under the definition of ‘employment’ within the meaning of EPF Act 1991 and the Employees Social Security Act 1969 or any amendments to them since.</p></td>
        </tr>
        </table>
    </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="justify"><p>You shall not at any time during or after the terms of this Agreement, divulge or allow to be divulged to any person, any confidential information relating to the business or affairs of City University other than any information which has entered into the public domain through no act or fault of your goodself.<br><br>
    Please note that as your appointed is on a fixed term assignment, you would not be issued with the EA Form with regard to income tax filing. The onus is on you to declare to Inland Revenue Department the payments you have received from us.<br><br>
    We look forward to working closely with you to ensure mutual benefit for both parties.<br><br>
    Kindly indicate your acceptance of the above terms and conditions of this offer by signing and returning the duplicate copy of this contract to us.
    </p></td>
    </tr>
    </table>
	</td>
    </tr>
   </table>
<table width="100%" class="spacebar">
   <tr>
   <td>&nbsp;</td>
   <td><i>Signed for and on behalf of the City University</i></td>
   </tr>
   <tr>
   <td>&nbsp;</td>
   <td><b>CITY UNIVERSITY</b></td>
   </tr>
   </table>
   <table width="280" border="0">
        <tr><td width="24">&nbsp;</td>
            <td width="202" height="60" align="justify"></td>
        </tr>
        <tr><td>&nbsp;</td>
            <td align="justify">
                <hr class="signature">
            </td>
        </tr>
        <tr><td>&nbsp;</td>
            <td align="justify"><b>DATIN ROHAIDAH SHAARI</b></td>
        </tr>
        <tr><td>&nbsp;</td>
            <td align="justify">Executive Director</td>
        </tr>
    </table>
       <div style='page-break-after:always'>&nbsp;</div>
       <table width="100%">
        <tr>
            <td align="left"><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
            <td align="right">Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?></td>
        </tr>
        <tr>
            <td colspan="2">
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
            <td align="justify"><p>I....................................................., (NRIC/Passport No:..........................................),
            <br>having read and understood the above terms and conditions of the contract herein stated, do hereby accept this offer of appointment on a fixed term contract for services basis.</p></td>
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
</body>
<?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

}
?>