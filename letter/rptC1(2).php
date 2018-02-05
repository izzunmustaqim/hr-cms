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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 22pt;  ">C1(2)</div>');

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
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-C1(2)</td>
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
            <td border="0010"><b>LETTER OF APPOINTMENT</b></td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr> 
    </table>
 <p align="justify">
We are pleased to confirm our offer of employment to you as <?php getUnit($result['unitid'],$db);?> <?php getPosition($result['position_id'],$db);?> with City University (“The Company”). You will report to the <?php echo $result['report_to_id'];?>, <?php getFaculty($result['department_id'],$db);?> or any other Officer as appointed by the Company. This position is based at the Petaling Jaya Main Campus at Menara City University.<br><br>
Your appointment with the Company is subject to you obtaining a satisfactory medical report including a chest X-ray from the Company’s appointed clinic and you being certified medically fit for employment.<br><br>
You shall be paid a salary of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) per month less statutory deductions.<br><br>
The terms and conditions applicable to this appointment is attached herewith (Appendix A).<br><br>
This letter is given to you in duplicate. Your signature on the duplicate of this letter shall confirm your understanding and acceptance of terms and conditions of your employment.
</p> 
<div style='page-break-after:always'>&nbsp;</div>
<p align="justify">
Kindly return the duplicate of this letter; duly signed to the Human Resource Department by <?php expiredofferdate($result['date_offer_end']); ?> failing which, this offer shall lapse.<br><br>
You are also to note that once acceptance of this employment offer is confirmed by you and if you do not report to work on the specified date in Appendix A, you may subject yourself to legal action by City University.
</p>    
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
    <br>
    <table width="100%">
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
          <br>hereby accept the terms and conditions of employment with City University as set forth in Appendix A and confirm herewith I shall report to work on the date specified. I am also fully aware and agree that if my services are not confirmed at the end of the probationary period, the question of giving me any notice with regard to termination of employment shall not arise.</p></td>
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
    <?php $mpdf->PageNumSubstitutions[] = ['from' => 3, 'reset' => 1, 'type' => '1', 'suppress' => 'off']; ?>
    <div style='page-break-after:always'>&nbsp;</div>
      <htmlpageheader name="fourthpage" style="display:none">
    <table width="100%">
        <tr>
            <td><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-C1(2)</td>
        </tr>
    </table>
        <table width="100%" class="table">
        <tr>
            <td align="center" width="50%"><b>TERMS & CONDITIONS OF SERVICE</b></td>
            <td align="center" width="50%"><b>APPENDIX A</b></td>
        </tr>
    </table>
    </htmlpageheader>
    <sethtmlpageheader name="fourthpage" value="on" show-this-page="1"/>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="6%" class="spacebar"><b>No</b></td>
            <td align="center" width="32%" class="spacebar"><b>Item</b></td>
            <td align="center" width="62%" class="spacebar"><b>Description</b></td>
        </tr>
        <tr>
            <td align="center" width="6%" class="spacebar">1</td>
            <td align="left" width="32%" valign="top" class="spacebar">Name</td>
            <td align="left" width="62%" class="spacebar"><?php upper($result['name']);?></td>
        </tr>
        <tr>
            <td align="center" width="6%" class="spacebar">2</td>
            <td align="left" width="32%" valign="top" class="spacebar">Position</td>
            <td align="left" width="62%" class="spacebar"><?php getUnit($result['unitid'],$db);?> <?php getPosition($result['position_id'],$db);?> ( Job Grade: <?php getPositionGrade($result['position_id'],$db);?> )</td>
        </tr>
          <tr>
            <td align="center" width="6%" valign="top" class="spacebar">3</td>
            <td align="left" width="32%" valign="top" class="spacebar">Employement Status</td>
            <td align="left" width="62%" class="spacebar">Permanent</td>
        </tr>
        <tr>
            <td align="center" width="6%">4</td>
            <td align="left" width="32%" valign="top">Commencement Date</td>
            <td align="left" width="62%"><?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?></td>
        </tr>
<tr>
            <td align="center" width="6%" class="spacebar">5</td>
            <td align="left" width="32%" valign="top" class="spacebar">Probation</td>
            <td align="left" width="62%" class="spacebar">Your probationary period is six (6) months. </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top" class="spacebar">6</td>
            <td align="left" width="32%" valign="top" class="spacebar">Reporting Line</td>
            <td align="left" width="62%" class="spacebar">You shall report to the <?php echo $result['report_to_id'];?>, <?php getFaculty($result['department_id'],$db);?> or any other officer as appointed by
                the Company.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top" class="spacebar">7</td>
            <td align="left" width="32%" valign="top" class="spacebar">Working Hours</td>
            <td align="justify" width="62%" class="spacebar"><p>Monday to Thursday – 9.00 am to 5.00 pm<br>(lunch break 1.00 pm to 2.00 pm)<br>
                    Friday – 9.00 am to 5.30 pm <br>(Lunch break 12.30 pm to 2.45 pm)<br>
                    Saturday - 9.00 am to 1.00 pm<br>
                    You maybe required to work on your off and rest days with no additional payment. Please note that
                    the working hours maybe subject to change due to operational requirements by the Company.
                </p></td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top" class="spacebar">8</td>
            <td align="left" width="32%" valign="top" class="spacebar">Duties & Responsibilities</td>
            <td align="left" width="62%" valign="top" class="spacebar">Please refer to your Job Description (Attached)</td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top" class="spacebar">9</td>
            <td align="left" width="32%" valign="top" class="spacebar">Annual leave</td>
            <td align="justify" width="62%" class="spacebar"><?php getEntitlementName($result['position_id'],$db);?> (<?php getEntitlement($result['position_id'],$db);?>) working days per completed year of service. Leave shall be
                applied 7 days in advance.<br><br>
                Half of your unutilized leave accrued for the year may be carried forward to the subsequent calendar year.<br><br>

				Annual Leave benefit is only applicable after you have been confirmed in your employment.<br><br>
            </td>
        </tr>
    </table>
       <div style='page-break-after:always'>&nbsp;</div>
       <br><br>
    <table width="100%" class="table spacebar">
        <tr>
            <td align="center" width="6%" valign="top">10</td>
            <td align="left" width="32%" valign="top">Sick Leave and Hospitalization leave</td>
            <td align="justify" width="62%">You will be granted paid outpatient medical leave of up to Fourteen (14) days per
                annum. Hospitalization medical leave will be granted up to a maximum of sixty (60) days per annum.<br>
                The aforementioned outpatient and Hospitalization medical leave will be granted up to a maximum of sixty
                (60) days per completed year of service.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">11</td>
            <td align="left" width="32%" valign="top">Transfer/Secondment</td>
            <td align="justify" width="62%">You may be transferred or seconded to another department/division or any of the associate or subsidiary companies within the Group based on business needs and depending on your experience, knowledge and skills.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">12</td>
            <td align="left" width="32%" valign="top">Termination of Employment</td>
            <td align="justify" width="62%">  
                <u>During Probation</u><br>
                <?php getProbation($result['position_id'],$db);?> notice from either party or <?php getProbation($result['position_id'],$db);?> salary in lieu of such notice.<br><br>
                If an employee's services are terminated at the end of the probationary period, kindly note that the question of giving notice with regard to termination of employment shall not arise.<br><br>
                
                <u>Upon confirmation</u><br>
                <?php getConfirm($result['position_id'],$db);?> notice from either party or <?php getConfirm($result['position_id'],$db);?> salary in lieu of such notice. <br><br>
The Company reserves the right to either reduce or waive the notice period by either party if the Management deems that it would be in the Company’s interest to do so.<br><br>
Kindly note with regard to this offer of employment you fully understand and agree that should you resign without giving the due notice or salary in lieu,</td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table spacebar">
     <tr>
            <td align="center" width="6%" valign="top">&nbsp;</td>
            <td align="left" width="32%" valign="top">&nbsp;</td>
            <td align="justify" width="62%">
             City University reserves the right to inform your new employer that you quit without giving due notice and legal action is being pursued by City University.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">13</td>
            <td align="left" width="32%" valign="top">Medical Benefits</td>
            <td align="justify" width="62%">Upon registration with the Human Resources Department, you will be covered
                under the Company’s Healthcare Plan.<br><br>
                You shall be granted medical benefits as stated in the Employee Handbook. The Company shall not
                be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts, treatment of
                any sexually transmitted diseases (including AIDS) or injury suffered arising from participation in any
                dangerous sports such as hand gliding, mountain climbing and scuba diving.<br><br>

                Medical benefits shall cover medical consultation, hospitalization and emergency treatment in approved
                hospitals or clinics, which are all subject to the Company’s sole and absolute discretion.<br><br>
                The Company shall provide outpatient and other medical expenses for you and your immediate family (legal spouse and children) up to a combined limit of RM 800.00 (Ringgit Malaysia: Eight Hundred Only) per annum.
            </td>
        </tr>
          <tr>
                <td align="center" width="6%" valign="top">14</td>
                <td align="left" width="32%" valign="top">Non-Disclosure and
                    Confidentiality
                </td>
                <td align="justify" width="62%">
                    You shall never at any time during and after your employment with the Company disclose or divulge to
                    any third party any information or matters relating to the Company or its business partners. This
                    includes but not limited to the Company’s business plans, strategies, program contents or trade
                    secrets.<br>

                    You shall not, except with prior written consent of
                    </td>
            </tr>
    </table>

    <div style='page-break-after:always'>&nbsp;</div>
        <br><br>
        <table width="100%" class="table spacebar">
            <tr>
                <td align="center" width="6%" valign="top">&nbsp;</td>
                <td align="left" width="32%" valign="top">&nbsp;
                </td>
                <td align="justify" width="62%">
                     the Chairman of the Board of Directors make direct or indirect statements public, whether to the
                    press or in
                books, magazines, periodicals or by advertisement, radio, televisions, film, internet or
                   any other medium with respect to any matter which might impair or injure the reputation of the
                   Company or the relations of the Company’s companies, customers, or any other parties with whom the
                   Company is working with or any Government or Regulatory Body. A breach of this clause, shall result
                   in the Company instituting actions or remedies that it deems fit to safeguard its interest.<br><br>
                    This may include the immediate termination of your employment and/or the instituting of legal
                    action.
                </td>
            </tr>
            <tr>
                <td align="center" width="6%" valign="top">15</td>
                <td align="left" width="32%" valign="top">Proprietary Rights</td>
                <td align="justify" width="62%">The Company shall have the sole and exclusive right to all intellectual
                    property rights that you have gained and/or acquired while performing your duties during your
                    employment period. The intellectual properties shall include discoveries, innovations and inventions
                    made and stored physically or electronically such as printed materials, computer software,
                    presentation material, etc.<br><br>
                    The Company has the sole and exclusive right to use these intellectual properties at its discretion in
                whatever form, manner or purpose. You shall not use these intellectual properties for any purpose other
                than for serving the Company, its subsidiaries or associated companies and shall not use them for your
                own gain or for any other employer without the prior authorization in writing from the Chairman of the
                Board of Directors.      
                </td>
            </tr>
            </table>
                <div style='page-break-after:always'>&nbsp;</div>
        <br><br>
        <table width="100%" class="table spacebar">
            <tr>
            <td align="center" width="6%" valign="top">16</td>
            <td align="left" width="32%" valign="top">Publication / Social Media</td>
            <td align="justify" width="62%">
                a)&nbsp; Except with the written permission of the Company, you shall not publish or write or cause to
                be published or cause to be written any book, circulate in social media any information or other works
                which is based on information related and/or incidental to the Company, its subsidiaries and its
                associated companies.<br><br>

                b)&nbsp; With regard to (a) of above, where such permission is granted it shall be subject to an implied
                condition that no statement or comment contained in the publication or social media is or maybe
                calculated to cause embarrassment to Company, its subsidiaries, its associated companies, the Malaysian
                Government or Malaysia.<br><br>

                c)&nbsp; Except with the written permission of the Company, you shall not either orally or in writing
                divulge to anyone or discuss publicly any measures taken by the Company on any official matters taken or
                carried out by you, the management or an employee of the Company.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">17</td>
            <td align="left" width="32%" valign="top">Notices</td>
            <td align="justify" width="62%">
                All notices hereunder shall be made in writing and sent to the other party either in person, via an
                authorized representative or by A.R. Registered post.
                Unless otherwise specified herein, the notice shall be deemed to have been received seven (7) working
                days after being duly deposited at the post office.<br><br><br><br><br><br><br>
            </td>
        </tr>
        </table>

       <div style='page-break-after:always'>&nbsp;</div>
       <br><br>
         <table width="100%" class="table spacebar">
      
         <tr>
            <td align="center" width="6%" valign="top">18</td>
            <td align="left" width="32%" valign="top">Alteration</td>
            <td align="justify" width="62%">
                If, for any reasons whatsoever, the Company wishes to alter these terms and conditions in any way, it
                reserves the right to do so entirely at its discretion. Any alterations, amendments or additions to
                these terms and conditions of service shall be advised to you in writing.
            </td>
        </tr>
          <tr>
            <td align="center" width="6%" valign="top">19</td>
            <td align="left" width="32%" valign="top">Other Terms
                & Conditions
            </td>
            <td align="justify" width="62%">
                During your employment with City University, we will naturally wish your conduct to be such as not to discredit you or the Company and you will be expected to perform the duties assigned to you in a loyal, efficient, trustworthy and honest fashion.<br><br>
                During the continuance of your employment with us, you will at all times faithfully and diligently perform and observe such duties as may from time to time be assigned to you by your superior and devote the whole of your time and attention to the discharge of the duties and functions devolved upon you.<br><br>
                Whilst under our employment, you are not allowed to be involved directly or indirectly in any business contrary to Company’s interest without formal approval of the Chairman of the Board of Directors.  Breaching this would be a violation of your employment contract and could result in the termination of your employment.  You shall not divulge any matters, which may come to your knowledge, relating to the affairs of the Company or its employees.<br><br><br><br><br><br>
            </td>
        </tr>
    </table>
           <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table spacebar">
         <tr>
            <td align="center" width="6%" valign="top">20</td>
            <td align="left" width="32%" valign="top">Severance</td>
            <td align="justify" width="62%">
                If any clause contained in this letter is illegal or unenforceable, it may be rendered void, without
                affecting the enforceability of the other clauses in this letter.
            </td>
        </tr>
        </table>
        <table width="100%">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><b>CITY UNIVERSITY</b></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="45%" align="left">&nbsp;</td>
            <td width="21%" align="left">&nbsp;</td>
            <td width="34%" align="left">Accepted by,</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="35%" align="left">&nbsp;</td>
            <td width="30%" align="right">&nbsp;</td>
            <td width="35%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%" align="left">&nbsp;</td>
            <td width="30%" align="right">&nbsp;</td>
            <td width="35%" align="right">&nbsp;</td>
        </tr>
        <tr>
            <td width="35%" align="left">
                <hr class="signature">
            </td>
            <td width="30%" align="right">&nbsp;</td>
            <td width="35%" align="right">
                <hr class="signature">
            </td>
        </tr>
        <tr>
            <td align="left"><b>DATIN ROHAIDAH SHAARI</b></td>
            <td align="right">&nbsp;</td>
            <td align="left">Name:</td>
        </tr>
        <tr>
            <td align="left">Executive Director</td>
            <td align="right">&nbsp;</td>
            <td align="left">NRIC/Passport No.:</td>
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
