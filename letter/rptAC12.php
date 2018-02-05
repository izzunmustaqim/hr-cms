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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; color:#000; font-size: 22pt; font-family: tahoma;">AC12</div>');

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
    </table>
    <table width="100%" class="spacebar">
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><b>RE: APPOINTMENT AS EXTERNAL EXAMINER IN THE <?php getFacultyUpper($result['department_id'],$db);?></b> <b>FOR</b><br>
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
                    We are pleased to appoint you as an External Examiner for <?php getFaculty($result['department_id'],$db);?>.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height=""></td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    This appointment shall be for a duration of one (1) year with effect from <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?> and will be
                    reviewed at the end of the one (1) year period.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height=""></td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Please refer to Appendix A, attached herewith with regard to your appointment as External Examiner.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height=""></td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Many thanks for accepting the honorary role of External Examiner and we look forward to your
                    associateship with us for mutual benefit.
                </p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
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
            <td colspan="2">
                <hr class="hr">
            </td>
        </tr>
        <tr>
            <td align="center"><b>ACKNOWLEDGEMENT</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><p>I,  .................................................... (NRIC/Passport No.: ...................................), having read and understood the contents of this letter and appendix A do agree to the same.</p></td>
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
        <?php /*if($result['external_extra']!=NULL){*/?><!--
        <tr>
            <td colspan="2">CC : <?php /*echo $result['external_extra'];*/?></td>
        </tr>
        --><?php /*} */?>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <htmlpageheader name="secondpage" style="display:none">
        <table width="100%">
            <tr>
                <td><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
                <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?></td>
            </tr>
        </table>
        <table width="100%" class="table">
            <tr>
                <td><b>Appendix A</b></td>
            </tr>
        </table>
    </htmlpageheader>
    <sethtmlpageheader name="secondpage" value="on" show-this-page="1"/>
    <br><br>
    <table width="100%" class="spacebar">
        <tr>
            <td align="center">1.</td>
            <td><b>Your roles and responsibility as an External Examiner are as follows:</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <table width="100%">
                    <tr>
                        <td align="center" valign="top">a)</td>
                        <td align="justify">To assess the programs and examination in order to ensure quality</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">b)</td>
                        <td align="justify">To vet all exam questions, to check on the appropriateness of level of
                            assessment, marking scheme and module answers
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">c)</td>
                        <td align="justify">To give an assessment to exam questions, syllabus requirement, adequacy and
                            quality of lectures
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">d)</td>
                        <td align="justify">To assess the adequacy and quality of the physical facility to support the
                            program
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">e)</td>
                        <td align="justify">To give views on the overall appropriateness quality of the program</td>
                    </tr><tr>
                        <td align="center" valign="top">f)</td>
                        <td align="justify">To advice and help with MQA compliance</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center">2.</td>
            <td><b>Ex-gratia payment</b></td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td align="justify">The External Examiner shall be eligible for an ex-gratia payment of RM250.00 per
                visit.
            </td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="center">3.</td>
            <td><b>Visit</b></td>
        </tr>
        <tr>
            <td align="center">&nbsp;</td>
            <td align="justify">Minimum Four (4) visits/meetings per year.</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">&nbsp;</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="35%" align="left"><b>CITY UNIVERSITY</b></td>
            <td width="30%" align="left">&nbsp;</td>
            <td width="35%" align="left">Accepted by,</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="40%" align="left">&nbsp;</td>
            <td width="25%" align="right">&nbsp;</td>
            <td width="35%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td width="40%" align="left">&nbsp;</td>
            <td width="25%" align="right">&nbsp;</td>
            <td width="35%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td width="40%" align="left">
                <hr class="signature">
            </td>
            <td width="25%" align="right">&nbsp;</td>
            <td width="35%" align="right">
                <hr class="signature">
            </td>
        </tr>
        <tr>
            <td align="left"><b>DATIN ROHAIDAH SHAARI</b></td>
            <td align="right">&nbsp;</td>
            <td align="left">Signature:</td>
        </tr>
        <tr>
            <td align="left">Executive Director</td>
            <td align="right">&nbsp;</td>
            <td align="left">NRIC/Passport No:</td>
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