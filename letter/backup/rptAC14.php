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

    $obj = new convert_money($result['salary']);
    $staff_id = $result['user_id'];
    $user = $db->query("SELECT * FROM tbluser WHERE UserId = $staff_id");

    $mpdf = new mPDF('', '', 0, '', 25, 20, 20, 5, 9, 9, 'P');
    ob_start();
    $mpdf->ignore_invalid_utf8 = true;


    $str = $user[0]['FullName'];
    $first_letters = strtolower(substr(get_first_letters($str), 0));

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; color:#000; font-size: 22pt; font-family: tahoma;">AC14</div>');

    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">' . $first_letters . '</td>

</tr></table>

');

    ?>
    <style>
        body {
            font-family: tahoma;
            font-size: 12pt;
            margin-top: 0px;

        }

        .adress td {
            line-height: 100%;
            vertical-align: top;
        }

        td {

            line-height: 170%;
            vertical-align: top;

        }

        .checkbox {
            font-family: arial;
            font-size: 19px;
        }

        .header {
            font-family: arial;
            font-size: 14px;
        }

        .tabheader {
            margin-right: 10em;
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
            font-family: Tahoma;
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
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-AC14</td>
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
    <table width="100%">
        <tr>
            <td>Dear <?php upper($result['title']);?> <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><b>RE: APPOINTMENT AS INDUSTRY ADVISORY PANEL MEMBER FOR <?php getProgramfacultyBold($result['program_id'],$db);?><?php if($result['program_id2']!=NULL){ echo ", ";}?><?php getProgramfacultyBold($result['program_id2'],$db);?><?php if($result['program_id3']!=NULL){ echo ", ";}?><?php getProgramfacultyBold($result['program_id3'],$db);?><?php if($result['program_id4']!=NULL){ echo ", ";}?><?php getProgramfacultyBold($result['program_id4'],$db);?> PROGRAMMES:</b><br>
                <?php $i = 1;?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $i;?>. <?php getProgram($result['program_id'],$db);?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($result['program_id2']!=NULL){ $i = $i + 1; echo $i;}?>. <?php getProgram($result['program_id2'],$db);?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($result['program_id3']!=NULL){ $i = $i + 1; echo $i;}?>. <?php getProgram($result['program_id3'],$db);?><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($result['program_id4']!=NULL){ $i = $i + 1; echo $i;}?>. <?php getProgram($result['program_id4'],$db);?>
            </td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr>
    </table>
    </br>
    <table width="100%">
        <tr>
            <td align="justify" height=""><p>
                    On behalf of the Senate of City University College, we are pleased to appoint you as a member of the
                    Board of Advisors for <?php getProgram($result['program_id'],$db);?><?php if($result['program_id2']!=NULL){ echo ", ";getProgram($result['program_id2'],$db); }?><?php if($result['program_id3']!=NULL){ echo ", ";getProgram($result['program_id3'],$db); }?> <?php if($result['program_id4']!=NULL){ echo ", ";getProgram($result['program_id4'],$db); }?>  Programmes at <?php getProgramfaculty($result['program_id'],$db);?><?php if($result['program_id2']!=NULL){ echo ", "; getProgramfaculty($result['program_id2'],$db); }?><?php if($result['program_id3']!=NULL){ echo ", "; getProgramfaculty($result['program_id3'],$db); }?><?php if($result['program_id4']!=NULL){ echo ", "; getProgramfaculty($result['program_id4'],$db); }?>.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    This appointment shall be for duration of one (1) year with effect from <?php echo date('d F Y',strtotime($result['date_contract_start'])) ;?> and will be
                    reviewed at the end of the one year period.
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>
                    Your roles & responsibility as the Board member are as follows:
                </p></td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">
                <table width="100%">
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">a)</td>
                        <td>To provide views and advise concerning the setting up of new schools</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">b)</td>
                        <td>To provide advice on formulating new programs</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">c)</td>
                        <td>To provide the needful views and advise on conducting academic program</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">d)</td>
                        <td>Provide a continuing source of information <?php if($result['advisory_1']!=NULL){ echo "and insights regarding ";echo $result['advisory_1']; }?> and potential
                            challenges and opportunities for the University and its program
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <table width="100%">
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">e)</td>
                        <td>Advise and assist CUCST in shaping its goals, strategies, and priorities, appropriate with
                            requirements by regulatory bodies ;<?php if($result['advisory_2']!=NULL){ echo "i.e ";echo $result['advisory_2']; }?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">f)</td>
                        <td>Help CUCST to develop a distinct identity among the nation’s occupational safety and health
                            community, and build support among key constituencies for its programs in education,
                            research, and community service
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">g)</td>
                        <td>Advise and assist the college in assessing its programs and progress in relation to
                            established goals, priorities, and criteria
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td align="center">h)</td>
                        <td>Assist from time to time for the benefit of the programs, <?php if($result['advisory_3']!=NULL){ echo "e.g. ";echo $result['advisory_3']; }?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">Being a Member of the Board, you are requested to visit the School at least
                once per year.
            </td>
        </tr>
         <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">Your appointment as a Member of the Board is honorary, however you shall be
                paid an honorarium of RM250.00 (Ringgit Malaysia : Two Hundred Fifty Only) per meeting/visit.
            </td>
        </tr>
         <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">Thank you for accepting the role of Member of the Board and we look forward to
                your associateship with us for mutual benefit.
            </td>
        </tr>
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">Regards.</td>
        </tr>
        </table>
        <div style='page-break-after:always'>&nbsp;</div>
        <table width="100%">
        <tr>
            <td align="justify" height="">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height="">Yours faithfully,</td>
        </tr>
        <tr>
            <td align="justify" height=""><b>CITY UNIVERSITY COLLEGE OF SCIENCE & TECHNOLOGY</b></td>
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
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td align="left"><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
            <td align="right">Our Ref : CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?></td>
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
            <td align="justify"><p>I ........................................................, (I/C No:
                    ..........................................................),<br>having read and understood the
                    contents of this letter, I herewith accept the honorary appointment.</p></td>
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
            <td width="30%">
                <hr class="signature">
            </td>
        </tr>
        <tr>
            <td width="30%" height="44">Signature</td>
        </tr>
        <tr>
            <td width="30%">Date :</td>
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