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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 22pt;  ">TDP(M)</div>');

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
        <tr>
            <td>Dear <?php upper($result['title']);?>. <?php upper($result['short_name']);?>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td border="0010"><b>RE: ENGAGEMENT AS GRADUATE TRAINEE UNDER CITY U TALENT DEVELOPMENT PROGRAM (TDP)</b></td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr> 
    </table>
<table width="100%" class="spacebar">
<tr>
<td colspan="2">We are pleased to offer you the above mentioned engagement on the following terms and conditions</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td width="7%"><b>1.0</b></td>
<td width="93%"><b>Engagement</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">You shall be engaged as a Graduate Trainee under the City U Talent Development Program (TDP) and shall be based at Menara Ciy U, No. 8 Jalan 51A/223, 46100 Petaling Jaya, Selangor Darul Ehsan (the premises) from the commencement date mentioned under item 3.0 herein.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">During your period of Duration of Engagement, your service with the Company may be terminated at any time by either party giving to the other one (1) month’s written notice without assigning any reason whatsoever or one (1) month’s salary in lieu of such notice.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td><b>2.0</b></td>
<td><b>Salary</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">Your monthly salary will be RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) and shall be prorated where applicable. The salary is subjected to all relevant statutory deductions and shall be paid to you on monthly basis at the end of each month commencing from the subsequent month of the Commencement Date.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td width="7%"><b>3.0</b></td>
<td width="93%"><b>Duration of Engagement</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">The term of engagement herein shall commence on <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?>. The City U Talent Development Program tenure is for one (1) year and shall end on <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end']));?>, subject however to prior termination as otherwise provided herein.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td><b>4.0</b></td>
<td><b>Scope, Manner and Performance of Duties</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">You shall at all times faithfully, industriously and to the best of your ability, experience and talent perform all duties that may be required of and from you pursuant to the express and implicit terms hereof, to the reasonable satisfaction of the management of the Company. Such duties shall be rendered at the above mentioned premise or such other place or places as the Company shall in good faith require or as in the interests, needs, business and opportunities of the Company shall require or make advisable. Periodical reviews shall be conducted to assess your performance.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td><b>5.0</b></td>
<td><b>Paid Leave</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">The Company shall grant and you shall be entitled to take paid leave of fourteen (14) days prorated on the number of completed months of your engagement and if you fail to take such leave by the End Date, you shall be deemed to have waived your entitlement thereto. The grant of this paid leave shall be subject to the exigencies of the Company’s business.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">You will be entitled to a paid holiday on all Federal and State Gazetted Holidays and on any public holiday extraordinarily gazette but may be required to work on such public holidays without additional remuneration.</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr>
<td><b>6.0</b></td>
<td><b>Sick Leave, Medical Benefits</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="spacebar" align="justify">You will be granted paid:</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">a)</td>
<td width="86%" align="justify">Outpatient medical leave of up to 14 days per annum. Hospitalization medical leave will be granted up to a maximum of sixty (60) days per annum.
The aforementioned outpatient and Hospitalization medical leave will be granted up to a maximum of sixty (60) days per annum.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">b)</td>
<td width="86%" align="justify">Upon registration with the Human Resource Department, you will be covered under the Company’s Healthcare Plan.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">c)</td>
<td width="86%" align="justify">The Company shall not be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts, treatment of any sexually transmitted diseases (including AIDS) or injury suffered arising from participation in any dangerous sports such as hang gliding, mountain climbing and scuba diving.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">d)</td>
<td width="86%" align="justify">Medical benefits shall cover medical consultation, hospitalization and emergency treatment in approved hospitals or clinics, which are all subject to the Company’s sole and absolute discretion.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">e)</td>
<td width="86%" align="justify">The Company shall provide outpatient and other medical expenses for you up to a limit of RM 800.00 (Ringgit Malaysia: Eight Hundred Only) per annum.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">e)</td>
<td width="86%" align="justify">If you are certified by a medical practitioner or the Company’s doctor to be ill enough to need to be hospitalized but not hospitalized for any reason whatsoever, you shall be deemed to be hospitalized for the purposed of the medical benefits mentioned herein.
</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">f)</td>
<td width="86%" align="justify">In the event of an emergency, any nearby registered medical practitioner may, when the Company’s doctor is not available, act in place of the Company’s doctor with regard to medical attention sought.
</td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="center">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>7.0</b></td>
<td width="93%"><b>Insurance coverage</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">You shall be eligible to be covered by the Company’s Group Personal Accident / Group Term Life Insurance, the premium for which shall be borne by the Company.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="center">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>8.0</b></td>
<td width="93%"><b>Non-disclosure and Confidentiality</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">You shall never at any time during and after your engagement with the Company disclose or divulge to any third party any information or matters relating to the </td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">
Company or its business partners. This includes but not limited to the Company’s business plans, strategies, program contents or trade secrets.<br><br>
You shall not, except with prior written consent of the Chairman of the Board of Directors make direct or indirect statements public, whether to the press of in books, magazines, periodicals or by advertisement, radio, televisions, film, internet or any other medium with respect to any matter which might impair or injure the reputation of the Company or the relations of the Company’s companies, customers, or any other parties with whom the Company is working with or any Government or Regulatory Body. A breach of this clause, shall result in the Company instituting actions or remedies that it deems fit to safeguard its interest.<br><br>
This may include the immediate termination of your engagement and/or the instituting of legal action.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>9.0</b></td>
<td width="93%"><b>Publication / Social Media</b></td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">a)</td>
<td width="86%" align="justify">Except with the written permission of the Company, you shall not publish or write or cause to be published or cause to be written any book, circulate in social media any information or other works which is based on information related and/or incidental to the Company, its subsidiaries and its associated companies.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">b)</td>
<td width="86%" align="justify">With regard to (a) of above, where such permission is granted it shall be subject to an implied condition that no statement or comment contained in the publication or social media is or maybe calculated to cause embarrassment to Company, its subsidiaries, its associated companies, the Malaysian Government or Malaysia.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">c)</td>
<td width="86%" align="justify">Except with written permission of the Company, you shall not either orally or in writing divulge to anyone or discuss publicly any measures taken by the Company on any official matters taken or carried out by you, the management or an employee of the Company.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td width="7%"><b>10.0</b></td>
<td width="93%"><b>Notices</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">All notices hereunder shall be made in writing and sent to the other party either in person, via an authorized representative or by A.R. Registered post. Unless otherwise specified herein, the notice shall be deemed to have been received seven (7) working days after being deposited at the post office.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>11.0</b></td>
<td width="93%"><b>Termination of Service</b></td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">11.1</td>
<td width="86%">Not withstanding any provision to the contrary, termination of service by either party will require one (1) month written notice or salary in lieu thereof.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">11.2</td>
<td width="86%">Notwithstanding the above, under the City U Talent Development Program one (1) year tenure, forthwith if you should be found guilty of misdemeanor, misconduct, serious inadequate or breach of any existing terms and conditions of service, rules and regulations expressed or implied. The Company may also exercise its right to terminate your services forthwith in the event that any information or documentation provide by you in the course of the selection process and your engagement with us is false.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="7%" align="center">11.3</td>
<td width="86%">You shall upon termination of this Agreement immediately deliver up to the Company all correspondence, documents and property belonging to the Company and/or its subsidiaries, that may be in your possession or under your control</td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td width="7%"><b>12.0</b></td>
<td width="93%"><b>Other Commitments</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">You shall not at anytime during your service with the Company, directly or indirectly without your Superior’s written consent first obtained, engage or interest yourself whether for reward or gratuitously in any work or business other than in respect of your duties to the Company or undertake any such office notwithstanding that your engagement or interest in such office would not interfere with the performance of your duties with the Company.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
<table width="100%" class="spacebar">
<tr>
<td width="7%"><b>13.0</b></td>
<td width="93%"><b>Entire Contract</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">This Agreement constitutes the entire understanding between the Parties and supersedes all negotiations, commitments and writings prior to the date hereof pertaining to the subject matter of the Agreement.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>14.0</b></td>
<td width="93%"><b>Non Waiver</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">The failure of a Party to give timely notice of breach of any term or condition of this Agreement shall not constitute a waiver thereof, nor shall the waiver of any breach of any terms or conditions of this Agreement constitute a waiver of any other breach of that or any other term or condition hereof.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>15.0</b></td>
<td width="93%"><b>Governing Law and Jurisdiction</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">This Agreement shall be governed by and construed in all respects in accordance with the laws of Malaysia and the parties submit to the jurisdiction of the Courts of Malaya.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>16.0</b></td>
<td width="93%"><b>Severability</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">If any part of any provision of this Agreement or any other agreement, document or writing given pursuant to or in connection with this Agreement shall be held to be invalid or unenforceable under any applicable law, such part shall be ineffective to the extent of such invalidity or unenforceability only, without in any way affecting the remaining parts of the said provision or any remaining provisions.</td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%">&nbsp;</td>
</tr>
<tr>
<td width="7%"><b>17.0</b></td>
<td width="93%"><b>Alteration</b></td>
</tr>
<tr>
<td width="7%">&nbsp;</td>
<td width="93%" align="justify">If, for any reasons whatsoever, the Company wishes to alter these terms and conditions in any way, it reserves the right to do so entirely at its discretion. Any alterations, amendments or additions to these terms and conditions of service shall be advised to you in writing.</td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td>Should the above terms and conditions of engagement be acceptable to you, kindly sign on the duplicate copy of this letter and return the same to us by <?php expiredofferdate($result['date_offer_end']); ?>, failing which the offer herein shall lapse.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<br>
 <table width="100%">
        <tr>
            <td align="justify">Yours faithfully,</td>
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
    <br><br>
    <table width="100%" class="spacebar">
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
            <td align="justify"><p style="line-height:1.5;">I....................................................., (NRIC/Passport No:..........................................),
          <br>hereby have read, understood and accept the above terms and conditions of my engagement under the City U Talent Development Program.</p></td>
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
// Now collect the output buffer into a variable
    $html = ob_get_contents();
    ob_end_clean();

// send the captured HTML from the output buffer to the mPDF class for processing
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}
?>
