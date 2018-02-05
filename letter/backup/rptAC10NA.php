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

      $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC10</div>');

    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma, arial, verdana, sans-serif; font-size: 10pt; color:#000;"><tr>

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

        td {
            text-align: justify;
            line-height: 170%;

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

        .table {
            border-left: thin solid #000;
            border-top: thin solid #000;
            border-bottom: thin solid #000;
            border-right: thin solid #000;
        }

        .hr {
            border: 0;
            margin-top: auto;
            border-top: 4px double #8c8c8c;
            text-align: center;
        }

        .signature {
            margin-bottom: auto;
            width: 20px;
        }

        .adress td {
            line-height: 100%;
            vertical-align: top;
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
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-AC10</td>
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
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>CONTRACT FOR SERVICE (NON-ACADEMIC)</b></td>
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
            <td align="justify" height=""><p>We are pleased to engage you on a contract for service basis on the
                    following terms and conditions:-</p>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td align="left" width="24%">1.0 Position</td>
            <td align="center" width="10%">:</td>
            <td align="left" width="66%"><p><?php getPosition($result['position_id'],$db);?></p></td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">2.0 Reporting line</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>You shall report to the <?php echo $result['report_to_id'];?> or to any other
                    Head of Department/Company or to any other person
                    designated by the Company.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">3.0 Duration</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p><?php echo date('d F Y',strtotime($result['date_contract_start']));?> to – <?php echo date('d F Y',strtotime($result['date_contract_end']));?></p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">4.0 Location</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>Menara City University College (PJ), Petaling Jaya</p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">5.0 Fees</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) <?php getDuration($result['duration_id'])?>.</p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td valign="top" align="left">6.0</td>
            <td valign="top" align="left"><b>Termination of Contract</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>During the Contract Period this contract for Service can be terminated
                    by either party giving to the other <?php getContract($result['contract_id'])?> notice or <?php getContract($result['contract_id'])?> fees in lieu of
                    notice.</p></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="left">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">6.1</td>
            <td valign="top" align="left">Your contract with City University College may be terminated without prior
                notice if you:-
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" align="center">a)</td>
            <td width="85%">commit any breach of the terms of the Contract for Service; or</td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">b)</td>
            <td width="85%" align="justify">be guilty of any misconduct or negligence especially in the discharge of
                your services; or
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">c)</td>
            <td width="85%" align="justify">become bankrupt or make any arrangement or composition with your creditors;
                or
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">d)</td>
            <td width="85%" align="justify">be convicted on a charge in respect of;</td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">&nbsp;</td>
            <td width="85%" align="justify">
                <table width="100%">
                    <tr>
                        <td>i.</td>
                        <td>an offence involving fraud, dishonesty or moral turpitude; or</td>
                    </tr>
                    <tr>
                        <td>ii.</td>
                        <td>an offence under the Malaysian law relating to corruption; or</td>
                    </tr>
                    <tr>
                        <td>iii.</td>
                        <td>any other criminal offence punishable with imprisonment or fine;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">e)</td>
            <td width="85%" align="justify">suffer debilitating ill health or become of unsound mind or is otherwise
                incapable of discharging your services; or
            </td>
        </tr>
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="5%" valign="top" align="center">f)</td>
            <td width="85%" align="justify">act in a manner which is detrimental, or calculated to be detrimental to the
                interest or good name of Malaysia, UCI or to the public.
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td valign="top" align="left">6.2</td>
            <td valign="top" align="justify">Upon termination of your contract for service pursuant to Section 6.1 and
                under any one (1) of the clauses, you shall not be entitled to any payment by way of compensation and
                you will be required to pay City University College a penalty equivalent to the sum of <?php getContract($result['contract_id'])?>
                of the service fee, except for 6.1(e).
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">7.0</td>
            <td valign="top" align="justify"><b>Relocation</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>The Company may at its discretion relocate you to another location,
                    section, department, division, region, branch, subsidiaries or associate company that is in
                    existence or to be created in the future where your service is required.</p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td valign="top" align="left">8.0</td>
            <td valign="top" align="justify"><b>Duties and responsibility</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>You shall devote full commitment to the service of City University
                    College and shall endeavour to the utmost in your capacity to promote the interest and good name of
                    City University College. The service you provide shall be subject to the provisions of the
                    Constitution, Statutes, Acts and Rules and Regulations of City University College that may be
                    amended from time to time and to the Laws of Malaysia. Your duties and responsibilities with regard
                    to your contract for service is attached herewith (Appendix A)</p></td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td width="4%">&nbsp;</td>
            <td width="7%" valign="top" align="center">8.1</td>
            <td width="90%" align="justify"><p>Your service shall include work connected with the service activity of
                    City University College of which shall be deemed to include public and professional services.</p>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td valign="top" align="left">9.0</td>
            <td valign="top" align="justify"><b>Secrecy/Confidentiality</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>You shall maintain and observe complete secrecy/confidentiality in
                    respect of any information about City University College or City University College’s activities,
                    plans and strategies throughout your service, and shall be liable for any acts in breach of this
                    provision.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">10.0</td>
            <td valign="top" align="justify"><b>Disclosure of Information</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p> Except with the written permission of the University College, the you
                    shall not divulge, disclose, make use of or impart to any third party any information or knowledge
                    gained during your services to the University College. This information includes, but is not limited
                    to, trade secrets, patented or secret processes, intellectual property rights, proprietary
                    equipment, machinery, business affairs, transactions or property of the University College. Your
                    further agree that you will not, except with the prior written consent of the University College to
                    make directly or indirectly any statement public whether to the press or in books, magazines,
                    periodicals or by advertisement, radio, televisions, film, facsimile, internet or any other medium
                    with respect to any matter which might impair or injure the reputation of the University College or
                    the relations of the University College, the University College’s companies, customers or
                    subcontractors or any other employers with whom The University College is working with or with any
                    Government representatives.</p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td valign="top" align="left">11.0</td>
            <td valign="top" align="justify"><b>Others</b></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>a. This is a fixed term contract for the completion of assignments as
                    specified in 3 above. It supersedes and renders null and void any prior engagement, if any, related
                    to the same.</p><br>

                <p>b. The contract is non-transferable. You are not an employee of the University and the university
                    shall not be held responsible for any third party claims arising out of this appointment.</p><br>

                <p>c. You agree that this appointment shall not create any permanent employment relationship that falls
                    within the EPF Act 1991 and the Employees Social Security Act 1969 or any amendments to them
                    since.</p></td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td align="justify"><p>Other terms and conditions of employment shall be in accordance to the <b>“Appendix
                        1”</b> attached.</p></td>
        </tr>
        <tr>
            <td align="justify">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>The onus is on you to declare to Inland Revenue Department the payments you have
                    received from us.</p></td>
        </tr>
        <tr>
            <td align="justify">&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">We look forward to your contribution towards the progress and development of City
                University College.
            </td>
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
    </table>
    <table width="100%">
        <tr>
            <td align="justify">Sincerely,</td>
        </tr>
        <tr>
            <td align="justify"><b>CITY UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY</b></td>
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
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-AC10</td>
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
                    ..........................................................),<br>
                    having read and understood the above terms and conditions of this letter do herewith agree to the
                    same and provide my expertise on a contract for service basis.</p></td>
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
            <td width="30%" height="44">Signed</td>
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
