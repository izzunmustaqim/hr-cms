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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC17</div>');
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
         <td><b>CONTRACT FOR SERVICE – VISITING PROFESSOR FOR <?php getFacultyUpper($result['department_id'],$db);?></b></td>
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
                    The above matter refers.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height=""></td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                   Following advice from the Vice-Chancellor, I am pleased to offer you an appointment as a Visiting Professor in City University commencing on the <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?> and concluding on <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end'])) ;?>. 
                   
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    The terms of your appointment are as detailed below. 
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">
            	
                <table width="100%" class="spacebar">
            <tr>
            <td width="4%" align="right">1.</td>
            <td width="96%" align="justify">For all purposes of courtesy and on ceremonial occasions, you will be regarded as an academic staff member of the University. However, you are not eligible to be a member of the Academic Board.</td>
            </tr>
                  <tr>
            <td width="4%" align="right">2.</td>
            <td width="96%" align="justify">When used in any documentation, including business cards, correspondence and publications, the title of Visiting Professor must be used in its entirety so it is clear that the appointment is of a visiting nature.</td>
            </tr>
             <tr>
            <td width="4%" align="right">3.</td>
            <td width="96%" align="justify">This appointment is without remuneration. However, should the opportunity arise for the University to avail itself of your services, as a lecturer or as a supervisor an appropriate payment may be negotiated.</td>
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
            <td width="4%" align="right">4.</td>
            <td width="96%" align="justify">In accordance with the University policy, either party may cease this appointment with one month’s written notice. In exceptional circumstances the Vice-Chancellor reserves the right to withdraw an appointment by letter.</td>
            </tr>
            </table>    
    </td>
    </tr>
        <tr>
            <td align="justify" height=""><p>
                   Should you wish to accept the above offer, please sign the enclosed copy of this letter and return to Human Resources Department by <?php expiredofferdate($result['date_offer_end']); ?>.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                   The University looks forward to continuing its association with you.
                </p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>Thank you.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
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
            <td align="justify" height="60">&nbsp;</td>
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
            <td align="justify"><p>I................................................., (NRIC/Passport No:.......................................),<br> have read and understood the above terms and conditions of the contract herein stated, do hereby accept this offer of appointment on a fixed term basis.</p></td>
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
   
    </body>
<?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}
?>