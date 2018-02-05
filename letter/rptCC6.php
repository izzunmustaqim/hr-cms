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

    $mpdf = new mPDF('', '', 0, '', 20, 20, 20, 5, 9, 9, 'P');
    ob_start();
    $mpdf->ignore_invalid_utf8 = true;


    $str = $user[0]['FullName'];
    $first_letters = strtolower(substr(get_first_letters($str), 0));

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 22pt;  ">CC6</div>');

    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">'.$first_letters.'</td>

</tr></table>

');

    ?>
    <style>
        body {
            font-family:tahoma;
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
            <td><b><?php uppercase($result['title']);?> <?php uppercase($result['name']);?></b></td>
        </tr>
        <?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
            <tr>
                <td><?php upper($result['address1']);?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?> <?php upper($result['city']);?>,<?php if($result['state']!=NULL){ echo "<br>"; upper($result['state']);}?></td>
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
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>CONTRACT OF SERVICE</b></td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr> 
    </table>
	<table width="100%">
    <tr>
    <td align="justify" colspan="4" class="spacebar">We are pleased to engage your services on a fixed term of three (3) months on the following terms and conditions:-</td>
    </tr>
    <tr><td  colspan="3">&nbsp;</td></tr>
     <tr>
    <td>1) Position</td>
    <td>:</td>
    <td><?php getPosition($result['position_id'],$db);?>&nbsp;(<i>Consultant for Project Base</i>)</td>
    </tr>
    <tr><td  colspan="3">&nbsp;</td></tr>
     <tr>
    <td>2) Duration</td>
    <td>:</td>
    <td><?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?> -  <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?></td>
    </tr>
    <tr><td  colspan="3">&nbsp;</td></tr>
     <tr>
    <td>3) Work Days/Hrs</td>
    <td>:</td>
    <td align="justify"><?php upper($result['duration_day']);?> days per week on an aggregate of <?php upper($result['duration_hours']);?> hours per week.
</td>
    </tr>
    <tr><td  colspan="3">&nbsp;</td></tr>
     <tr>
    <td>4) Location</td>
    <td>:</td>
    <td>Menara City University, Petaling Jaya (PJ)</td>
    </tr>
    <tr><td  colspan="3">&nbsp;</td></tr>
    <tr>
    <td>5) Service Fee</td>
    <td>:</td>
    <td class="spacebar">RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) per month.</td>
    </tr>
    </table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
    <td width="23%">6) Scope of Service</td>
    <td width="2%">:</td>
    <td width="75%"><?php if($result['service1']!=NULL){ echo 'a) '; echo $result['service1'];}?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($result['service2']!=NULL){ echo 'b) '; echo $result['service2'];}?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($result['service3']!=NULL){ echo 'c) '; echo $result['service3'];}?></td>
    </tr>
    <tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td>
    <td><?php if($result['service4']!=NULL){ echo 'd) '; echo $result['service4'];}?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php if($result['service5']!=NULL){ echo 'e) '; echo $result['service5'];}?></td>
    </tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td align="justify">We look forward to your contribution towards the progress and development of City University.</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>Thank you.</td>
</tr>
</table>
<table width="100%">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">Sincerely,</td>
        </tr>
        <tr>
            <td align="justify"><b>CITY UNIVERSITY</b></td>
        </tr>
    </table>
    <table border="0">
        <tr>
            <td align="justify" height="60"></td>
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
    <table width="100%">
        <tr>
            <td align="center"><b>ACKNOWLEDGEMENT</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>I agree to my appointment as <?php getPosition($result['position_id'],$db);?> and the terms and conditions contained in this service contract.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
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
            <td width="30%">&nbsp;
               
            </td>
        </tr>
        <tr>
            <td width="30%" height="44">Signed</td>
            <td width="40%">&nbsp;</td>
            <td width="30%">&nbsp;</td>
        </tr>
        <tr>
            <td width="30%" height="32">Name :</td>
            <td width="40%">&nbsp;</td>
            <td width="30%">&nbsp;</td>
        </tr>
        <tr>
            <td width="30%" height="32">NRIC/Passport No :</td>
            <td width="40%">&nbsp;</td>
            <td width="30%">&nbsp;</td>
        </tr>
         <tr>
            <td width="30%" height="32">Date :</td>
            <td width="40%">&nbsp;</td>
            <td width="30%">&nbsp;</td>
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
}
?>