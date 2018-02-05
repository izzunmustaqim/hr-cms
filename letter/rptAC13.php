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

    $mpdf = new mPDF('', '', 0, '', 25, 20, 20, 5, 9, 9, 'P');
    ob_start();
    $mpdf->ignore_invalid_utf8 = true;


    $str = $user[0]['FullName'];
    $first_letters = strtolower(substr(get_first_letters($str), 0));

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; color:#000; font-size: 22pt; font-family: tahoma;">AC13</div>');

    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">' . $first_letters . '</td>

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
            line-sp
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
                <td><?php upper($result['address1']);?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?> <?php upper($result['city']);?>,<?php if($result['state']!=NULL){ echo "<br>"; upper($result['state']);echo ","; }?><br><?php getCountry($result['country_id'],$db);?></td>
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
    <table width="100%" class="spacebar">
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
         <td><b>APPOINTMENT AS EXTERNAL ASSESSOR FOR <?php getFacultyUpper($result['department_id'],$db);?></b> 
               <br>
                <?php $i = 1;?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $i;?>. <?php getProgram($result['program_id'],$db);?>
                <?php if($result['program_id2']!=NULL){ $i = $i + 1; echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $i;?>. <?php getProgram($result['program_id2'],$db); }?>
                <?php if($result['program_id3']!=NULL){ $i = $i + 1; echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $i;?>. <?php getProgram($result['program_id3'],$db); }?>
                <?php if($result['program_id4']!=NULL){ $i = $i + 1; echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";echo $i;?>. <?php getProgram($result['program_id4'],$db);}?>
            </td>
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
            <td align="justify" height=""><p>
                    On behalf of the Senate of City University College, we are pleased to appoint you as the External Assessor for the above mentioned programs at <?php getFaculty($result['department_id'],$db);?>.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    This appointment shall be for a duration of one (1) year with effect from <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?> and will be
                    reviewed at the end of the one (1) year period.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Your roles & responsibility as the External Assessor are as follows:
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">
            <p>a) To check on the relevant and appropriateness of a new program</p>
            <p>b) To suggest appropriate amendments to the program if applicable</p>
            <p>c) To involve in upgrading syllabus for MQA and to review any amendments purposed by MQA until approval from MQA is received</p>
            </td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Your appointment as an External Assessor is honorary, however you shall be paid an honorarium of <b>RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?>  only)</b> per meeting.
                </p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td align="justify" height=""><p>
                    Thank you for accepting the honorary role of External Assessor and we look forward to your associateship with us for mutual benefit.
                </p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Regards.
                </p></td>
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
            <td align="justify" height="100">&nbsp;</td>
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
    <table width="100%" class="spacebar">
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
            <td align="justify"><p>I................................................., (NRIC No:.....................................), having read and understood the contents of this letter do agree the same.</p></td>
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
            <td width="30%">
                <hr class="signature">
            </td>
        </tr>
        <tr>
            <td width="30%">Signature</td>
        </tr>
        <tr>
            <td width="30%">Date : </td>
        </tr>
    </table>
   
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%" border="0">
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="10%">&nbsp;</td>
            <td width="60%">&nbsp;</td>
        </tr>
        <tr>
            <td width="">c.c</td>
            <td width="">:</td>
			<td width=""><?php upper($result['cc_name']);?><br>
            			<?php upper($result['cc_position']);?><br>
                        <?php echo $result['cc_address1'];?>,<?php if($result['cc_address2']!=NULL){ echo "<br>"; upper($result['cc_address2']);echo ","; }?><br><?php echo $result['cc_postcode'];?><?php if($result['cc_city']){ echo " ";upper($result['cc_city']);} ;?>,<?php if($result['cc_state']){ echo "<br>";upper($result['cc_state']);};?>
            
            </td>
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