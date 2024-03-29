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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC3(1)</div>');
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
    </br>
    <table width="100%" class="spacebar">
        <tr>
            <td align="justify" height=""><p>We are pleased to confirm our offer of employment to you as <?php getPosition($result['position_id'],$db);?> under the <?php getFaculty($result['department_id'],$db);?> Department
           with City University (&quot;The Company&quot;). You will report to the <?php echo $result['report_to_id'];?> of <?php getFaculty($result['department_id'],$db);?> department
           or any other officer as appointed by the Company. This position is based at the Petaling Jaya Main Campus at Menara City University.</p></td>
        </tr>
        <br>
        <tr>
            <td align="justify"><p>Your appointment with the Company is subject to you obtaining a satisfactory medical
                    report including a chest X-ray from the Company’s appointed clinic and you being certified medically
                    fit for employment.</p></td>
        </tr>
        <br>
         <tr>
            <td align="justify"><p>Apart from the foregoing, as an educational institution we have to strictly comply with government regulation with regard to matters concerning teaching permit etc. You are herewith requested to note that, if for any reason your teaching permit application is rejected by the ministry concerned or if there is any objection from government authorities concerning your employment, your continued employment by us shall cease with immediate effect and the question of any payment of compensation shall not arise.</p></td>
        </tr>
        <br>
        <tr>
            <td align="justify">You shall be paid a salary of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?>) per month less
                statutory deductions.
            </td>
        </tr>
    </table>
      <div style='page-break-after:always'>&nbsp;</div><br>
      <table width="100%" class="spacebar">
       <tr>
            <td align="justify">The terms and conditions applicable to this appointment are contained in attachment
                (Appendix A).
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">This letter is given to you in duplicate. Your signature on the duplicate of this letter
                shall confirm your understanding and acceptance of terms and conditions of your employment.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">Kindly return the duplicate of this letter, duly signed to the Human Resources Department
                by <?php expiredofferdate($result['date_offer_end']); ?> failing which, this offer shall lapse.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">You are also to note that once acceptance of this employment offer is confirmed by you
                and if you do not report to work on the specified date in Appendix A, you may subject yourself to legal
                action by City University.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">Yours faithfully,</td>
        </tr>
        <tr>
            <td align="justify"><b>City UNIVERSITY</b></td>
        </tr>
    </table>
    <table border="0">
        <tr>
            <td align="justify" height="60"></td>
        </tr>
        <tr>
            <td align="justify">
                <hr class="signature">
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
            <td align="justify"><p>I.....................................................,(NRIC/Passport No:..........................................), hereby accept the terms and
                    conditions of employment with City University as set forth in
          Appendix A and confirm herewith I shall report to work on the date specified.</p></td>
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
      <?php $mpdf->PageNumSubstitutions[] = ['from' => 4, 'reset' => 1, 'type' => '1', 'suppress' => 'off']; ?>
    <div style='page-break-after:always'>&nbsp;</div>
      <htmlpageheader name="fourthpage" style="display:none">
    <table width="100%">
        <tr>
            <td><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?></td>
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
    <table width="100%" class="table spacebar">
        <tr>
            <td align="center" width="6%"><b>No</b></td>
            <td align="left" width="32%"><b>Item</b></td>
            <td align="left" width="62%"><b>Description</b></td>
        </tr>
        <tr>
            <td align="center" width="6%">1</td>
            <td align="left" width="32%" valign="top">Name</td>
            <td align="left" width="62%"><?php upper($result['name']);?></td>
        </tr>
        <tr>
            <td align="center" width="6%">2</td>
            <td align="left" width="32%" valign="top">Position</td>
            <td align="left" width="62%"><?php getPosition($result['position_id'],$db);?> ( Job Grade: <?php getPositionGrade($result['position_id'],$db);?> )</td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">3</td>
            <td align="left" width="32%" valign="top">Employment Status</td>
            <td align="left" width="62%">Contract</td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">4</td>
            <td align="left" width="32%" valign="top">Probation</td>
            <td align="left" width="62%">Your probationary is six (6) months.</td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">5</td>
            <td align="left" width="32%" valign="top">Commencement Date</td>
            <td align="justify" width="62%"><p><?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?> to <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end'])) ;?>. Kindly note this contract shall end by efflux of time unless extended by
                    mutual agreement.<br>
                    In view of the foregoing, the question of the Company giving you notice about the expiry of the
                    contract on <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end'])) ;?> may not arise.

                </p></td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">6</td>
            <td align="left" width="32%" valign="top">Reporting Line</td>
            <td align="justify" width="62%"><p>
                    You shall report to the <?php echo $result['report_to_id'];?> of <?php getFaculty($result['department_id'],$db);?> department or any other officer as appointed by the Company.
                </p></td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">7</td>
            <td align="left" width="32%" valign="top">Working Hours</td>
            <td align="justify" width="62%">
                Monday to Thursday – 8.30am to 5.30pm <br>(lunch break 1.00pm to 2.00pm)<br>
                Friday – 8.30am to 5.45pm <br>(Lunch break 12.30pm to 2.45pm)<br>
                You maybe required to work on your off and rest days with no additional payment. Please note that the
                working hours maybe subject to change due to operational requirements by the Company.
            </td>
        </tr>
         <tr>
            <td align="center" width="6%" valign="top">8</td>
            <td align="left" width="32%" valign="top">Duties & Responsibilities<br>
                i) Job Description<br>
                ii) Class cancelation
            </td>
            <td align="left" width="62%" valign="top">
            	<br>
                -Please refer to your Job Description (Attached)<br>
                -Unauthorized cancellation of scheduled classes is considered as a major misconduct which is subject to
                dismissal from service.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table spacebar">
       
        <tr>
            <td align="center" width="6%" valign="top">9</td>
            <td align="left" width="32%" valign="top">Annual leave</td>
            <td align="justify" width="62%">
                   Twelve (12) working days per completed year of service. Leave shall be applied 7 days in advance.<br>
                    Annual leave benefit is only applicable after six (6) months of employment.
                </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">10</td>
            <td align="left" width="32%" valign="top">Sick Leave and Hospitalization leave</td>
            <td align="justify" width="62%">You will be granted paid outpatient medical leave of up to (14) days per
                annum . Hospitalization medical leave will be granted up to a maximum of sixty (60) days per completed
                year of service.<br>
                The aforementioned outpatient and Hospitalization medical leave will be granted up to a maximum of sixty
                (60) days per completed year of service.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">11</td>
            <td align="left" width="32%" valign="top">Transfer/Secondment</td>
            <td align="justify" width="62%"><p>You may be transferred or seconded to another department/division or any
                    of the associate or subsidiary companies within the Group based on business needs and depending on
                    your experience, knowledge and skills.</p>
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">12</td>
            <td align="left" width="32%" valign="top">Termination of Employment</td>
            <td align="justify" width="62%">
                One (1) month notice from either party or one (1) month salary in lieu of such notice.<br><br>
                <u>Note : Resignation of Academic Staff</u><br><br>
                As City University is involved in providing education and in order not to disrupt completion of modules/ subjects being taught, academics will have to ensure that the last day of service is to coincide either with the last day of semester or the day immediately preceding the commencement of the semester, subject to the contractual notice period.<br>
                Kindly note with regard to this offer of employment you fully understand and agree that should you resign without giving the due notice or salary in lieu, 
            </td>
        </tr>
       
    </table>
      <div style='page-break-after:always'>&nbsp;</div>
      <br><br>
      <table width="100%" class="table spacebar">
       <tr>
            <td align="center" width="6%" valign="top">&nbsp;</td>
            <td align="left" width="32%" valign="top">&nbsp;</td>
            <td align="justify" width="62%">City University reserves the right to inform your new employer that you quit without giving due notice and legal action is being pursued by City University.
            </td>
        </tr>
       <tr>
            <td align="center" width="6%" valign="top">13</td>
            <td align="left" width="32%" valign="top">Medical Benefits</td>
            <td align="justify" width="62%">Upon registration with the Human Resources Department, you will be covered
                under the Company’s Healthcare Plan.<br>
                You shall be granted medical benefits as stated in the Employee Handbook. The Company shall not
                be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts, treatment of
                any sexually transmitted diseases (including AIDS) or injury suffered arising from participation in any
                dangerous sports such as hand gliding, mountain climbing and scuba diving.<br>

                Medical benefits shall cover medical consultation, hospitalization and emergency treatment in approved
                hospitals or clinics, which are all subject to the Company’s sole and absolute discretion.<br>

                The Company shall provide outpatient and other medical expenses for you and your immediate family (legal
                spouse and children) up to a combined limit of RM 800.00 (Ringgit Malaysia: Eight Hundred Only) per
                completed year of service.<br>

                Please refer to Employee Handbook on Medical/Sick Leave.
                <br>
            </td>
        </tr>
          <tr>
              <td align="center" width="6%" valign="top">14</td>
              <td align="left" width="32%" valign="top">Non-Disclosure and
                  Confidentiality
              </td>
              <td align="justify" width="62%">
                  You shall never at any time during and after your employment with the Company disclose or divulge to any
                  third party any information or matters relating to the Company or its business partners. This includes
                  but not limited to the Company’s business plans, strategies, program contents or trade secrets.<br>
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
                  You shall not, except with prior written consent of
                  the Chairman of the Board of Directors make direct or indirect statements public, whether to the press
                  or in books, magazines, periodicals or by advertisement, radio, televisions, film, internet or any other
                  medium with respect to any matter which might impair or injure the reputation of the Company or the
                relations of the Company’s companies, customers, or any other parties with whom the Company is working
                with or any Government or Regulatory Body. A breach of this clause, shall result in the Company
                instituting actions or remedies that it deems fit to safeguard its interest.<br>
                This may include the immediate termination of your employment and/or the instituting of legal action.
              </td>
          </tr>
        <tr>
            <td align="center" width="6%" valign="top">15</td>
            <td align="left" width="32%" valign="top">Proprietary Rights</td>
            <td align="justify" width="62%">The Company shall have the sole and exclusive right to all intellectual
                property rights that you have gained and/or acquired while performing your duties during your employment
                period. The intellectual properties shall include discoveries, innovations and inventions made and
                stored physically or electronically such as printed materials, computer software, presentation material,
                etc.<br>
                The Company has the sole and exclusive right to use these intellectual
                properties at its discretion in whatever form, manner or purpose. You shall not use these intellectual
                properties for any purpose other than for serving the Company, its subsidiaries or associated companies
                and shall not use them for your own gain or for any other employer without the prior authorization in
                writing from the Chairman of the Board of Directors.
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
         		a)&nbsp; Except with the written permission of the Company, you shall not
                publish or write or cause to be published or cause to be written any book, circulate in social media any
                information or other works which is based on information related and/or incidental to the Company, its
                subsidiaries and its associated companies.<br><br>
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
                days after being duly deposited at the post office.
            </td>
        </tr>
         <tr>
            <td align="center" width="6%" valign="top">18</td>
            <td align="left" width="32%" valign="top">Alteration</td>
            <td align="justify" width="62%">
                If, for any reasons whatsoever, the Company wishes to alter these terms and conditions in any way, it
                reserves the right to do so entirely at its discretion.<br><br>
            </td>
        </tr>
      </table>
      <div style='page-break-after:always'>&nbsp;</div>
      <br><br>
      <table width="100%" class="table spacebar">
        <tr>
            <td align="center" width="6%" valign="top">&nbsp;</td>
            <td align="left" width="32%" valign="top">&nbsp;</td>
            <td align="justify" width="62%">
                 Any alterations, amendments or additions to
                these terms and conditions of service shall be advised to you in writing.
            </td>
        </tr>
        <tr>
            <td align="center" width="6%" valign="top">19</td>
            <td align="left" width="32%" valign="top">Other Terms
                & Conditions
            </td>
            <td align="justify" width="62%">
                <b>I. CONDUCT </b><br>
                During your employment with the City University, we will naturally wish your conduct to be such as
                not to discredit you or the Company and you will be expected to perform the duties assigned to you in a
                loyal, efficient, trustworthy and honest fashion.<br><br>

                During the continuance of your employment with us, you will at all times faithfully and diligently
                perform and observe such duties as may from time to time be assigned to you by your superior and devote
                the whole of your time and attention to the discharge of the duties and functions devolved upon you.<br><br>

                Whilst under our employment, you are not allowed to be involved directly or indirectly in any business
                contrary to Company’s interest without formal approval of the Chairman of the Board of Directors.
                Breaching this would be a violation of your employment contract and could result in the termination of
                your employment. You shall not divulge any matters, which may come to your knowledge, relating to the
                affairs of the Company or its employees.<br><br>
                <b>II. COMPLIANCE WITH GOVERNMENT
                    REQUIREMENTS/REGULATIONS.</b><br><br>
                       As you are employed as a <?php getPosition($result['position_id'],$db);?>, you are required to take note that from time to time the government
                
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table spacebar">
        <tr>
            <td align="center" width="6%" valign="top">&nbsp;</td>
            <td align="left" width="32%" valign="top">&nbsp;</td>
            <td align="justify" width="62%">
            on its part may require our lecturers/concerned employees to update their skills in order to enhance the
                quality of education provided by the Company.
Should such requirement/s arise it is your sole responsibility to upgrade your skills/qualifications
                etc. in order to comply with the government requirements/regulations eg: the need for certain category
                of academic staff to have a teaching methodology certificate.<br><br>
            </td>
        </tr>
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

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}
?>
