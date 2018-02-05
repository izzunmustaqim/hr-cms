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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC15</div>');
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
    </table>
    <table width="100%" class="spacebar">
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
         <td><b>APPOINTMENT AS A MEMBER OF THE BOARD OF STUDY FOR <?php getFacultyUpper($result['department_id'],$db);?></b></td>
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
                    On behalf of the Senate of City University, we are pleased to appoint you as a member of the Board of Study for <?php getFaculty($result['department_id'],$db);?>.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    This appointment shall be for a duration of one (1) year with effect from <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?> and will be
                    reviewed at the end of the one year period.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    You roles & responsibility as the Board member are as follows:
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">
            <p>a) To provide views and advise concerning the setting up of new faculties</p>
            <p>b) To provide advise on formulating new programs</p>
            <p>c) To provide the needful views and advise on in conducting academic program </p>
            </td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Being a Member of the Board, you are requested to visit the faculty at least twice per year.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                   Your appointment as a Member of the Board is honorary, however you shall be paid an honorarium of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?>  only) for the duration of your appointment.
                </p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%" class="spacebar">
        <tr>
            <td align="justify" height=""><p>
                    Thank you for accepting the role of Member of the Board and we look forward to your associateship with us for mutual benefit.
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
            <td align="justify"><p>I................................................., (NRIC/Passport No:..........................................),
            <br>having read and understood the contents of this letter do agree the same.</p></td>
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