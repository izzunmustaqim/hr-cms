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
	
	$mpdf->SetHTMLHeader('<div style="text-align: left; font-weight: bold; color:#000; font-size: 22pt; font-family: tahoma;">C3</div>');

    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">' . $first_letters . '</td>

</tr></table>

');

    ?>
    <style>
        body {
            font-family: tahoma, arial, verdana, sans-serif;
            font-size: 12pt;
            margin-top: 0px;

        }

        .adress td {
            line-height: 100%;
            vertical-align: top;
        }

        td {
            text-align: justify;
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
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-C3</td>
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
                <td><?php upper($result['address1']);?>,<?php if($result['address2']!=NULL){ echo "<br>"; upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?> <?php upper($result['city']);?>,<br><?php getCountry($result['country_id'],$db);?></td>
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
            <td border="0010"><b>LETTER OF APPOINTMENT</b></td>
        </tr>
        <tr>
            <td>
                <hr class="hr">
            </td>
        </tr>
    </table>
    </br>
    <!-- Page 1 -->

    <table width="100%">
        <tr>
            <td align="justify" height=""><p>We are pleased to confirm our offer of employment to you as <?php getPosition($result['position_id'],$db);?> with City University College of Science and Technology (“The Company”). You will report to
                    the <?php echo $result['report_to_id'];?> or any other officer as appointed by the Company. This position is
                    based at the Petaling Jaya Main Campus at Menara City University College.
                </p></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>You shall be paid a salary of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> Only) per month less statutory deductions.</p></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>The terms and conditions applicable to this appointment is attached
                    herewith (Appendix A).</p></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify" height=""><p>This letter is given to you in duplicate. Your signature on the duplicate
                    of this letter shall confirm your understanding and acceptance of terms and conditions of your
                    employment.</p></td>
        </tr>
    </table>
    <!-- Page 1 ------------------------------------------------------------------------------------------------------------->
    <div style='page-break-after:always'>&nbsp;</div>
    <!-- Page 2 ------------------------------------------------------------------------------------------------------------->

    <table width="100%">
        <tr>
            <td align="justify" height=""><p>Kindly return the duplicate of this letter; fuly signed to the Human
                    Resource Department by <?php expiredofferdate($result['date_offer_end']); ?> failing which, this offer shall lapse.You are also to
                    note that once acceptance of this employment offer is confirmed by you and if you do not report to
                    work on the specified date in Appendix A, you may subject yourself to legal action by CITY
                    University College of Science & Technology.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td align="justify">Yours faithfully,</td>
        </tr>
        <tr>
            <td align="justify"><b>CITY UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY</b></td>
        </tr>
    </table>

    <!-- Page 2 ------------------------------------------------------------------------------------------------------------->

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
    <br><br><br>
    <table width="100%" border="0">
        <tr>
            <td colspan="2" height="">
                <hr>
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
                    ..........................................................),
                    <br>hereby accept the terms and conditions of employment with City University College of Science and
                    Technology as set forth in Appendix A and confirm herewith I shall report to work on the date
                    specified.</p></td>
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
    <!-- Page 3 ------------------------------------------------------------------------------------------------------------->

    <div style='page-break-after:always'>&nbsp;</div>

    <!-- Page 4 ------------------------------------------------------------------------------------------------------------->
    <htmlpageheader name="fourthpage" style="display:none">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left"><?php upper($result['title']);?>. <?php upper($result['short_name']);?></td>
                <td align="right">Our Ref : CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-C3</td>
            </tr>
        </table>
        <table width="100%" class="table">
            <tr>
                <td width="50%"><b>TERMS & CONDITIONS OF SERVICE</b></td>
                <td width="50%"><b>Appendix A</b></td>
            </tr>
        </table>
    </htmlpageheader>
    <sethtmlpageheader name="fourthpage" value="on" show-this-page="1"/>
    <br><br>
    <table width="100%" border="0" cellpadding="10" cellspacing="0" class="table">
        <tr>
            <td width="10%" align="center"><strong>No.</strong></td>
            <td width="30%" align="center"><strong>Item</strong></td>
            <td width="60%" align="center"><strong>Description</strong></td>
        </tr>
        <tr>
            <td align="center" valign="top">1</td>
            <td>Name</td>
            <td><?php upper($result['name']);?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>Position</td>
            <td><?php getPosition($result['position_id'],$db);?> ( Job Grade: <?php getPositionGrade($result['position_id'],$db);?> )</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>Employment Status</td>
            <td>Permanent</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>Commencement Date</td>
            <td><?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start']));?></td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>Probation</td>
            <td align="justify">Your probationary period is six (6) months.</td>
        </tr>
        <tr>
            <td align="center" valign="top">6</td>
            <td valign="top">Reporting Line</td>
            <td align="justify">You shall report to the Vice President - Marketing or any other officer as appointed by the
                Company.
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">7</td>
            <td valign="top">Target to be Met<br>(Kindly Note)</td>
            <td align="justify">A minimum of five (5) students per month for the first six (6) months.  This will be
                reviewed at the end of the first three (3) months to monitor progress which if not encouraging may
                result in cessation of employment..
            </td>
        </tr>

        <tr>
            <td align="center" valign="top">8</td>
            <td valign="top">Working Hours</td>
            <td align="justify">Monday to Thursday – 8.30am to 5.30pm (lunch break 1.00pm to 2pm)<br>Friday – 8.30 am to
                5.45pm (Lunch break 12.30pm to 2.45pm)<br>
                You are to note that as you are employed to work in our Marketing Department, you required to work on
                Saturdays from 9.00am to 1.00pm when applicable..
            </td>
        </tr>

        <tr>
            <td align="center" valign="top">9</td>
            <td valign="top" align="left">Duties & Responsibilities</td>
            <td align="justify" style="border-left: thin solid; border-bottom: thin solid; border-right: thin solid;">
                Please refer to your Job Description (Attached)
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" valign="top">10</td>
            <td valign="top">Annual leave</td>
            <td align="justify" style="border-left: thin solid; border-bottom: thin solid; border-right: thin solid;">
                <p>Fifteen (15) working days.  Leave shall be applied 7 days in advance.</p>&nbsp;
                <p>Half of your unutilized leave accrued for the year may be carried forward to the subsequent calendar
                    year.</p>&nbsp;
                <p>Annual Leave benefit is only applicable after you have been confirmed in your employment.</p></td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">11</td>
            <td width="30%" align="left" valign="top">Sick Leave and Hospitalization leave during your contract period
            </td>
            <td align="justify" width="60%"><p>You will be granted paid outpatient medical leave of up to fourteen (14)
                    days.  Hospitalization medical leave will be granted up to a maximum of sixty (60) days.  </p><br>
                The aforementioned outpatient and Hospitalization medical leave will be granted up to a maximum of sixty
                (60) days.
            </td>
        </tr>

        <tr>
            <td align="center" valign="top">12</td>
            <td valign="top">Transfer/Secondment</td>
            <td align="justify">You may be transferred or seconded to another department/division or any of the
                associate or subsidiary companies within the Group based on business needs and depending on your
                experience, knowledge and skills.
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">13</td>
            <td valign="top" align="left">Termination of Employment</td>
            <td align="justify"><p><u>During Probation</u><br>
                    One (1) months&rsquo; notice from either party or one (1) months&rsquo; salary in lieu of such
                    notice. <br><br>
                    <u>Upon confirmation</u><br>
                    Two (2) months&rsquo; notice from either party or two (2) months&rsquo; salary in lieu of such
                    notice. <br>
                    </p><br>
          </td>
          </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
    
        <tr>
            <td align="center" valign="top">&nbsp;</td>
            <td valign="top" align="left">&nbsp;</td>
            <td align="justify">
            The Company reserves the right to either reduce or waive the notice period if the Management deems
                    that it would be in the Company&rsquo;s interest to do so.<br>
                Kindly note with regard to this offer of employment you fully understand and agree that should you
                resign without giving the due notice or salary in lieu, City UC reserves the right to inform your new
                employer that you quit without giving due notice and legal action is being pursued by City UC.
            </td>
        </tr>
         <tr>
            <td align="center" width="10%" valign="top">14</td>
            <td width="30%" valign="top">Medical Benefits</td>
            <td width="60%" align="justify"><p>Upon registration with the Human Resource Department, you will be covered
                    under the Company&rsquo;s Healthcare Plan.<br><br>
                    The Employee shall be granted medical benefits as stated in the employee handbook. The Company shall
                    not be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts,
                    treatment of any sexually transmitted diseases (including AIDS) or injury suffered arising from
                    participation in any dangerous sports such as hang gliding, mountain climbing and scuba diving.</p>
                <br>
                 <p>Medical benefits shall cover medical consultation, hospitalization and emergency treatment in
                    approved hospitals or clinics, which are all subject to the Company&rsquo;s sole and absolute
                    discretion.</p><br>
           </td>
           </tr>
        </table>
            <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">&nbsp;</td>
            <td width="30%" valign="top">&nbsp;</td>
            <td width="60%" align="justify">
                <p>The Company shall provide outpatient and other medical expenses for you and your immediate family
                    (legal spouse and children) up to a combined limit of RM800.00 (Ringgit Malaysia: Eight Hundred
                    Only).</p>
                Please refer to Employee Handbook on Medical/Sick Leave.
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">15</td>
            <td valign="top" align="left">Non-Disclosure and Confidentiality</td>
            <td align="justify"><p>You shall never at any time during and after your employment with the Company
                    disclose or divulge to any third party any information or matters relating to the Company or its
                    business partners. This includes but not limited to the Company&rsquo;s business plans, strategies,
                    program contents or trade secrets.  </p><br>
                    <p>You shall not, except with prior written consent of the Chairman of the
                    Board of Directors make direct or indirect statements public, whether to the press or in books,
                    magazines, periodicals or by advertisement, radio, televisions, film, internet or any other medium
                    with respect to any matter which might impair or injure the reputation of the Company or the
                    relations of the Company&rsquo;s companies, customers, or any other parties with whom the Company is
                    working with or any Government or Regulatory Body. <br>
                    A breach of this clause, shall result in the Company instituting actions or remedies that it deems
                    fit to safeguard its interest.  </p>
                This may include the immediate termination of your employment and/or the instituting of legal action.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">16</td>
            <td valign="top" width="30%">Propriety Rights</td>
            <td align="justify" width="60%"><p>The Company shall have the sole and exclusive right to all intellectual property
                    rights that you have gained and/or acquired while performing your duties during your employment
                    period. The intellectual properties shall include discoveries, innovations and inventions made and
                    stored physically or electronically such as printed materials, computer software, presentation
                    material, etc.  </p><br>
                The Company has the sole and exclusive right to use these intellectual properties at its discretion in
                whatever form, manner or purpose. You shall not use these intellectual properties for any purpose other
                than for serving the Company, its subsidiaries or associated companies and shall not use them for your
                own gain or for any other employer without the prior authorization in writing from the Chairman of the
                Board of Directors.</td>
        </tr>
        <tr>
            <td align="center" valign="top" width="10%">17</td>
            <td valign="top" width="30%">Publication / Social Media</td>
            <td align="justify" width="60%"><p>a)    Except with the written permission of the Company, you shall not
                    publish or write or cause to be published or cause to be written any book,<strong> </strong>circulate
                    in social media any information or other works which is based on information related and/or
                    incidental to the Company, its subsidiaries and its associated companies.</p><br>

           </td>
           </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" valign="top" width="10%">&nbsp;</td>
            <td valign="top" width="30%">&nbsp;</td>
            <td align="justify" width="60%">
            
                <p>b)    With regard to (a) of above, where such permission is granted it shall be subject to an implied
                    condition that no statement or comment contained in the publication or social media is or maybe
                    calculated to cause embarrassment to Company, its subsidiaries, its associated companies, the
                    Malaysian Government or Malaysia.</p><br>
                c)       Except with the written permission of the Company, you shall not either orally or in writing
                divulge to anyone or discuss publicly any measures taken by the Company on any official matters taken or
                carried out by you, the management or an employee of the Company.</td>
        </tr>
        <tr>
            <td align="center" valign="top">18</td>
            <td valign="top">Notices</td>
            <td align="justify" style="border-left: thin solid; border-bottom: thin solid; border-right: thin solid;">
                <p>All notices hereunder shall be made in writing and sent to the other party either in person, via an
                    authorized representative or by A.R. Registered post.   Unless otherwise specified herein, the
                    notice shall be deemed to have been received seven (7) working days after being duly deposited at
                    the post office.</p>
           </td>
        </tr>
            <tr>
            <td align="center" valign="top" width="10%">19</td>
            <td valign="top" width="30%">Alteration</td>
            <td align="justify" width="60%"><p>If, for any reasons whatsoever, the Company wishes to alter these terms
                    and conditions in any way, it reserves the right to do so entirely at its discretion. </p><br>
                Any alterations, amendments or additions to these terms and conditions of service shall be advised to
                you in writing.
         
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" valign="top" width="10%">20</td>
            <td valign="top" width="30%">Other Terms & Conditions</td>
            <td align="justify" width="60%"><p>During your employment with City University College, we will naturally wish your
                    conduct to be such as not to discredit you or the Company and you will be expected to perform the
                    duties assigned to you in a loyal, efficient, trustworthy and honest fashion.</p><br>

                <p>During the continuance of your employment with us, you will at all times faithfully and diligently
                    perform and observe such duties as may from time to time be assigned to you by your superior and
                    devote the whole of your time and attention to the discharge of the duties and functions devolved
                    upon you.</p><br>

                <p>Whilst under our employment, you are not allowed to be involved directly or indirectly in any
                    business contrary to Company&rsquo;s interest without formal approval of the Chairman of the Board
                    of Directors.  Breaching this would be a violation of your employment contract and could result in
                    the termination of your employment.  You shall not divulge any matters, which may come to your
                    knowledge, relating to the affairs of the Company or its employees.</p><br><br> <br> <br><br>
                <br><br> <br></td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <br><br>
    <table width="100%" class="table">
        <tr>
            <td align="center" valign="top" width="10%">21</td>
            <td valign="top" width="30%">Severance</td>
            <td align="justify" width="60%">If any clause contained in this letter is illegal or unenforceable, it may
                be rendered void, without affecting the enforceability of the other clauses in this letter.
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td colspan="3"><b>CITY UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY</b></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>

    <table border="0" width="100%">
        <tr>
            <td width="35%"></td>
            <td width="37%"></td>
            <td width="28%">Accepted by,</td>
        </tr>
        <tr>
            <td height="100">&nbsp;</td>
        </tr>

        <tr>
            <td style="vertical-align:bottom;">
                <hr></hr>
            </td>
            <td></td>
            <td>
                <hr>
            </td>
        </tr>
        <tr>
            <td><b>DATIN ROHAIDAH SHAARI</b></td>
            <td></td>
            <td>Name:</td>
        </tr>
        <tr>
            <td>Executive Director</td>
            <td></td>
            <td>I/C No.:</td>
        </tr>
    </table>
    <!-- Page 4 ------------------------------------------------------------------------------------------------------------->

    </body>
<?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
}
?>
