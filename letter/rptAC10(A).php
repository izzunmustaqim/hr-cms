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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 22pt;  ">AC10(A)</div>');

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
    <table width="100%">
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>CONTRACT FOR SERVICE</b></td>
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
            <td align="justify" height=""><p>We are pleased to engage you on a contract for service basis on the
                    following terms and conditions:-</p>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td align="left" width="24%" class="spacebar">1) Position</td>
            <td align="center" width="10%" class="spacebar">:</td>
            <td align="left" width="66%" class="spacebar">
<?php getPosition($result['position_id'],$db);?>
                   <!-- Lecturer for <br>
                    <ol>
                    <?php //if($result['subject_id1']!=NULL){ echo "<li>&nbsp;";echo $result['subject_id1'];echo "</li>"; }?>
                    <?php //if($result['subject_id2']!=NULL){ echo "<li>&nbsp;";echo $result['subject_id2'];echo "</li>"; }?>
                    <?php //if($result['subject_id3']!=NULL){ echo "<li>&nbsp;";echo $result['subject_id3'];echo "</li>";}?>
                    <?php //if($result['subject_id4']!=NULL){ echo "<li>&nbsp;";echo $result['subject_id4'];echo "</li>";}?>
                    <?php //if($result['subject_id5']!=NULL){ echo "<li>&nbsp;";echo $result['subject_id5'];echo "</li>";}?>
                    </ol>
                <p>&nbsp;</p><br>-->
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top" class="spacebar">2) Reporting line</td>
            <td align="center" width="10%" valign="top" class="spacebar">:</td>
            <td align="justify" width="66%" class="spacebar" valign="top"><p>You shall report to the <?php echo $result['report_to_id'];?> or to any other person designated by the Company
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">3) Duration</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%" valign="top"><p><?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?> to – <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?></p>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top" class="spacebar">4) Location</td>
            <td align="center" width="10%" valign="top" class="spacebar">:</td>
            <td align="justify" width="66%" class="spacebar" valign="top"><p>Menara City University, Petaling Jaya (PJ)</p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top" class="spacebar">5) Working Day</td>
            <td align="center" width="10%" valign="top" class="spacebar">:</td>
            <td align="justify" width="66%" class="spacebar" valign="top"><p><?php echo $result['duration_day'];?> days per week</p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top" class="spacebar">6) Fees</td>
            <td align="center" width="10%" valign="top" class="spacebar">:</td>
            <td align="justify" width="66%" valign="top" class="spacebar"><p>RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) per duration.</p></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <htmlpageheader name="secondpage" style="display:none">

    </htmlpageheader>
    <sethtmlpageheader name="secondpage" value="on" show-this-page="1"/>
    <table width="100%" class="spacebar">
        <tr>
            <td valign="top" align="left">7)</td>
            <td valign="top" align="left">Termination of Contract</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>During the Contract Period this contract for Service can be terminated
                    by either party giving to the other one (1) month notice or one (1) month's fees in lieu of
                    notice. You are however to note that should you wish to terminate the contract, it will only be
                    considered and accepted at the end of current academic calendar. You are however to note that should
                    you wish to terminate the contract, your last day of service should coincide with the end of current
                    academic calendar or the day immediately preceding the commencement of the semester.</p></td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="left">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="left">
            	<table width="100%" class="spacebar">
                <tr>
                <td>&nbsp;</td>
                <td align="center">7.1</td>
                <td>Your contract with City University may be terminated without prior
                notice if you:-</td>
                </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" class="spacebar">
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
            	<table width="100%" class="spacebar">
                <tr>
                <td width="6%">&nbsp;</td>
                <td width="3%">7.2</td>
                <td width="91%" align="justify">Upon termination of your contract for service pursuant to Section 7.1 and
                under any one (1) of the clauses, you shall not be entitled to any payment by way of compensation and
                you will be required to pay City University a penalty equivalent to the sum of three (3) month of the service fee, except for 7.1(e).</td>
                </tr>
                </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%" class="spacebar">
        <tr>
            <td valign="top" align="left">8)</td>
            <td valign="top" align="justify">Relocation</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>The Company may at its discretion relocate you to another location,
                    section, department, division, region, branch, subsidiaries or associate company that is in
                    existence or to be created in the future where your service is required.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">9)</td>
            <td valign="top" align="justify">Duties and responsibility</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>You shall devote full commitment to the service of City University
                    and shall endeavour to the utmost in your capacity to promote the interest and good name of
                    City University. The service you provide shall be subject to the provisions of the
                    Constitution, Statutes, Acts and Rules and Regulations of City University that may be
                    amended from time to time and to the Laws of Malaysia. Your duties and responsibilities with regard
                    to your contract for service is attached herewith (Appendix A)</p></td>
        </tr>
    </table>
    <br>
    <table width="100%" class="spacebar">
        <tr>
            <td width="4%">&nbsp;</td>
            <td width="7%" valign="top" align="center">9.1</td>
            <td width="90%" align="justify"><p>Your service shall include work connected with the service activity of
                    City University of which shall be deemed to include public and professional services.</p>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" class="spacebar">
        <tr>
            <td valign="top" align="left">10)</td>
            <td valign="top" align="justify">Secrecy/Confidentiality</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p>You shall maintain and observe complete secrecy/confidentiality in
                    respect of any information about City University or City University activities,
                    plans and strategies throughout your service, and shall be liable for any acts in breach of this
                    provision.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">11)</td>
            <td valign="top" align="justify">Disclosure of Information</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><p> Except with the written permission of the University, the you
                    shall not divulge, disclose, make use of or impart to any third party any information or knowledge
                    gained during your services to the University. This information includes, but is not limited
                    to, trade secrets, patented or secret processes, intellectual property rights, proprietary
                    equipment, machinery, business affairs, transactions or property of the University College. Your
                    further agree that you will not, except with the prior written consent of the University to
                    make directly or indirectly any statement public whether to the press or in books, magazines,
                    periodicals or by advertisement, radio, televisions, film, facsimile, internet or any other medium with respect to any matter which might impair or injure the reputation of the University or the relations of the
                    </p></td>
        </tr>
    </table>
    <table width="100%" class="spacebar">
        <tr>
            <td width="7%" align="left" valign="top">&nbsp;</td>
            <td width="93%" align="justify" valign="top"><p>University, the University's companies, customers or subcontractors or any other
                    employers with whom The University is working with or with any Government
                    representatives.
                     </p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top" align="left">12)</td>
            <td valign="top" align="justify">Others</td>
        </tr>
        <tr>
            <td valign="top" align="left">&nbsp;</td>
            <td valign="top" align="justify"><table width="100%" class="spacebar">
<tr>
<td valign="top">a.</td>
<td align="justify">This is a fixed term contract for the completion of assignments as
                    specified in 3 above. It supersedes and renders null and void any prior engagement, if any, related
                    to the same.</td>
</tr>
<tr>
<td valign="top">b.</td>
<td align="justify">The contract is non-transferable. You are not an employee of the University and the university
                    shall not be held responsible for any third party claims arising out of this appointment.</td>
</tr>
<tr>
<td valign="top">c.</td>
<td align="justify">You agree that this appointment shall not create any permanent employment relationship that falls
                    within the EPF Act 1991 and the Employees Social Security Act 1969 or any amendments to them
                    since.</td>
</tr>
</table></td>
        </tr>
    </table>
    <br>
    <table width="100%">
    <tr>
            <td align="justify">Other terms and conditions of employment shall be in accordance to the “Appendix 1” attached.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">The onus is on you to declare to Inland Revenue Department the payments you have received from us.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
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
    <table width="100%" class="spacebar">
        <tr>
            <td align="center"><b>ACKNOWLEDGEMENT</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>I .....................................................,
                    (NRIC/Passport No: .........................................),<br>
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
