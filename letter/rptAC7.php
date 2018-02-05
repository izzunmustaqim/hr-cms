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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC7</div>');
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
    <table width="100%">
    <tr>
    <td align="center"><b>Supervisor Contract for the</b></td>
    </tr>
    <tr>
    <td align="center"><b>City University</b></td>
    </tr>
    <tr>
    <td align="center"><b><?php if($result['prog_lvlid']==1){ echo 'Doctor of Philosophy (Business Administration)(Phd)';} else if($result['prog_lvlid']==2){ echo 'Doctor of Business Administration (DBA)';}?></b></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td><b>BETWEEN</b></td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>CITY UNIVERSITY</td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
     <tr>
    <td><b>AND</b></td>
    </tr>  
    </table>
    <br>
        <table width="100%" class="adress">
        <tr>
            <td><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
        </tr>
        <?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
            <tr>
                <td><?php echo upper($result['address1']);?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?><?php if($result['city']){ echo " ";upper($result['city']);} ;?>,<?php if($result['state']){ echo "<br>";upper($result['state']);};?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td>&nbsp;-present-</td>
            </tr>
        <?php } ?>
        </table>
        <br>
        <table width="100%" class="spacebar">
        <tr>
        <td width="19%">Contact Phone:</td>
        <td width="81%"><?php uppercase($result['sup_contact']);?></td>
        </tr>
        <tr>
        <td width="19%">Email Address:</td>
        <td width="81%"><u><?php echo $result['sup_email'];?></u></td>
        </tr>
        </table>
        <br>
    <table width="100%" class="spacebar">
        <tr>
        <td><b>Engagement:</b></td>
        </tr>
        <tr>
        <td height="68" align="justify">City University agrees to engage the Supervisor pursuant to this Contract and the Supervisor agrees to supervise <b><?php upper($result['student_name']);?> (I.D: <?php upper($result['student_id']);?>)</b> a <?php if($result['prog_lvlid']==1){ echo 'Phd';} else if($result['prog_lvlid']==2){ echo 'DBA';}?> student of City University in accordance with the terms and conditions contained in this contract.</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td><b>Term of Contract:</b></td>
        </tr>
          <tr>
        <td height="68" align="justify">Subject to the earlier termination of this contract, this contract will conclude upon the successful completion of the <?php if($result['prog_lvlid']==1){ echo 'Phd';} else if($result['prog_lvlid']==2){ echo 'DBA';}?> Thesis by the <?php if($result['prog_lvlid']==1){ echo 'Phd';} else if($result['prog_lvlid']==2){ echo 'DBA';}?> candidate <b><?php upper($result['student_name']);?> (I.D: <?php upper($result['student_id']);?>)</b>.</td>
        </tr>
        </table>
     <div style='page-break-after:always'>&nbsp;</div>
     <htmlpageheader name="secondpage" style="display:none">
     </htmlpageheader>
    <sethtmlpageheader name="secondpage" value="on" show-this-page="1"/>
       <table width="100%" class="spacebar">
        <tr>
        <td><b>Payment:</b></td>
        </tr>
        <tr>
        <td height="68" align="justify">Payment by cheque wil be made at the conclusion of the stages referred below by the submission of a claim for the completion of the agreed duties commensurate with the stage. Approval of the Director, Postgraduate Programme will be required before payment can be made, to ensure that the agreed work has been completed to a satisfactory level.</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
         <tr>
        <td><b>Gross remuneration: <u>Ringgit Malaysia: <?php upper($obj->words) ?> Only (RM <?php money($result['salary']);?>)</u></b></td>
        <tr>
        <td>
        	<table width="100%" class="spacebar">
            <tr>
            <td width="33%" align="center">Stage 1</td>
            <td width="46%">Research Proposal</td>
            <td width="21%">RM <?php money($result['sup_stage1']);?></td>
            </tr>
            <tr>
            <td width="33%" align="center">Stage 2</td>
            <td width="46%">Literature Review</td>
            <td width="21%">RM <?php money($result['sup_stage2']);?></td>
            </tr>
             <tr>
            <td width="33%" align="center">Stage 3</td>
            <td width="46%">Research Methodology</td>
            <td width="21%">RM <?php money($result['sup_stage3']);?></td>
            </tr>
            <tr>
            <td width="33%" align="center">Stage 4</td>
            <td width="46%">Data Analysis</td>
            <td width="21%">RM <?php money($result['sup_stage4']);?></td>
            </tr>
            <tr>
            <td width="33%" align="center">Stage 5</td>
            <td width="46%">Conclusion</td>
            <td width="21%">RM <?php money($result['sup_stage5']);?></td>
            </tr>
            <tr>
            <td width="33%" align="center">Stage 6</td>
            <td width="46%">Thesis Submission</td>
            <td width="21%">RM <?php money($result['sup_stage6']);?></td>
            </tr>
            <tr>
            <td width="33%" align="center">Stage 7</td>
            <td width="46%">Staisfactory Completion</td>
            <td width="21%">RM <?php money($result['sup_stage7']);?></td>
            </tr>
            </table>
        </td>
        </tr>
          <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td><b>Intellectual Property:</b></td>
        </tr>
         <tr>
        <td height="68" align="justify">All intellectual property (which shall include a wide range of legal rights including copyright, a patent, a registered design, a trademark, or any know-how or invention) arising directly from the work remain the sole property of City University.</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td><b>Confidentiality:</b></td>
        </tr>
         <tr>
        <td height="68" align="justify">The Supervisor shall maintain complete secrecy of all confidential information entrusted to him and shall not use or attempt to use any such information in a manner which may injure or cause loss either directly or indirectly to City University.</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        </tr>
        <tr>
        <td height="68" align="justify">The Supervisor will, upon expiration or termination of this contract with the City University, surrender to the City University all documents belonging to the City University.</td>
        </tr>
       </table>
 <div style='page-break-after:always'>&nbsp;</div>
	<div style="border-width: 1px; border-style: solid;">
 	<table width="100%" class="spacebar">
    <tr>
    <td align="center"><b>Signed on behalf of City University</b></td>
    </tr>
    <tr>
    <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td align="left">Name:...................................</td>
    </tr>
    <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Datin Rohaidah Shaari</td>
    </tr>
    <tr>
    <td align="center">&nbsp;</td>
    </tr>
    <tr>
    <td align="left">Post: Executive Director</td>
    </tr>
     <tr>
    <td align="left">Date: </td>
    </tr>
    <tr>
    <td align="center">&nbsp;</td>
    </tr>
    </table>
    </div>
<br><br>
	<div style="border-width: 1px; border-style: solid;">
 	<table width="100%" class="spacebar">
    <tr>
    <td align="center" colspan="3"><b>Acceptance</b></td>
    </tr>
    <tr>
    <td align="center" colspan="3">&nbsp;</td>
    </tr>
    <tr>
    <td width="3%">&nbsp;</td>
    <td width="94%" align="justify">I accept this contract for the supervision of the <?php if($result['prog_lvlid']==1){ echo 'Phd';} else if($result['prog_lvlid']==2){ echo 'DBA';}?> Thesis by the <?php if($result['prog_lvlid']==1){ echo 'Phd';} else if($result['prog_lvlid']==2){ echo 'DBA';}?> candidate <b><?php upper($result['student_name']);?> (I.D: <?php upper($result['student_id']);?>)</b> on the basis of terms ans conditions as set out. </td>
    <td width="3%">&nbsp;</td>
    </tr>
     <tr>
    <td align="center" colspan="3">&nbsp;</td>
    </tr>
     <tr>
    <td align="center" colspan="3">&nbsp;</td>
    </tr>
    <tr>
    <td width="3%">&nbsp;</td>   
    <td width="94%">
    .................................................
    </td>
    <td width="3%">&nbsp;</td>
    </tr>
    <tr>
    <td width="3%" height="50">&nbsp;</td>   
    <td width="94%">
    Signature of Supervisor
    </td>
    <td width="3%">&nbsp;</td>
    </tr>
    <tr>
    <td width="3%" height="50">&nbsp;</td>   
    <td width="94%">Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ...........................</td>
    <td width="3%">&nbsp;</td>
    </tr>
    <tr>
    <td width="3%" height="50">&nbsp;</td>   
    <td width="94%">Date of Acceptance: ...........................</td>
    <td width="3%">&nbsp;</td>
    </tr>
    </table>
    </div>
 
    </body>

<?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

}
?>
