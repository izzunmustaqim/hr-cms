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

	$mpdf=new mPDF('','', 0, '', 25, 20, 20, 5, 9, 9, 'P');
	ob_start();
	$mpdf->ignore_invalid_utf8 = true;

    $str = $user[0]['FullName'];
    $first_letters = strtolower(substr(get_first_letters($str),0));
	
    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC5</div>');
    $mpdf->SetHTMLFooter('

<table width="100%" style="vertical-align: bottom; font-family: tahoma; font-size: 10pt; color:#000;"><tr>

<td width="50%" align="left">{PAGENO}</td>

<td width="50%" style="text-align: right; ">'.$first_letters.'</td>

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
<table width="100%" align="center">
<tr>
<td align="center"><img src="citylogo1.png" width="350" height="154"></td>
</tr>
</table>
<br><br><br>
<table width="100%" align="center">
<tr>
<td align="center">******************************</td>
</tr>
<tr>
<td align="center"><b>EMPLOYMENT AGREEMENT</b></td>
</tr>
<tr>
<td align="center">******************************</td>
</tr>
<tr>
<td align="center"><b>(EXPATRIATE)</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center"><b>BETWEEN</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center"><b>U.C.I EDUCATION SDN.BHD. (UCI)</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center"><b>AND</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
</tr>
<tr>
<td align="center"><b><?php uppercase($result['name']);?></b></td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table class="spacebar">
<tr>
<td>AN AGREEMENT is made the <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_offer'])) ;?></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>BETWEEN</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><p>
U.C.I EDUCATION SDN. BHD.(Company No. 457626-U) a private limited company incorporated in Malaysia under the Companies Act 1965 having its registered address at B-05 & B06, Plaza Kelana Jaya, Jalan SS7/13B, Kelana Jaya, 47301 Petaling Jaya, Selangor Darul Ehsan and having its business  address at  Menara City U, No. 8, Jalan 51A/223, 46100 Petaling Jaya, Selangor Darul Ehsan (hereinafter referred to as UCI (the &quot;Employer&quot;) of the one part;
</p></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>AND</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<?php upper($result['title']);?>. <?php uppercase($result['name']);?> (Passport No <?php echo $result['passport_no']?>) having a residential addressed at
    <?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
        <?php echo $result['address1'];?>, <?php if($result['address2']!=NULL){ upper($result['address2']);echo ", "; }?><?php echo $result['postcode'];?><?php if($result['city']){ echo " ";upper($result['city']);} ;?>, <?php if($result['state']){ upper($result['state']);echo ", "; };?> <?php getCountry($result['country_id'],$db);?>
    <?php } else { ?>
    &nbsp;-present-
    <?php } ?>
    (here in after referred to as &quot;The Employee&quot;) of the other part.
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td><b>RECITALS</b></td>
</tr>
</table>
<table width="100%" class="spacebar">
<tr>
<td width="8%" valign="top" align="right">(a)</td>
<td width="92%" align="justify">
UCI is in the business of providing educational and learning services under the name and style of City University a private learning institution established with its objective to provide higher education, training, research and consultancy within Malaysia as well as to countries overseas.
</td>
</tr>
<tr>
<td width="8%">&nbsp;</td>
<td width="92%" align="justify">&nbsp;</td>
</tr>
<tr>
<td width="8%" valign="top" align="right">(b)</td>
<td width="92%" align="justify">
The parties hereto desire to enter into an agreement whereby the service of the Employee shall be made available to UCI subject to and upon the terms and conditions hereinafter set forth.
</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td align="left"><b>WHEREBY IT IS AGREED AS FOLLOWS:</b></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>The Employee shall be employed by UCI on the following terms and conditions herein contained:</td>
</tr>
</table>
<br>
<table width="100%" class="spacebar">
<tr>
<td align="center" valign="top">1.</td>
<td><b>POSITION</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td><p>The Employee shall be employed as a Lecturer or any other designation as deemed appropriate by UCI subject to approval and/or validation of work permit from Immigration Department of Malaysia.</p></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center">2.</td>
<td><b>SALARY</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td><p>The Employee shall be paid a monthly salary of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?>  only) less statutory only wherever applicable.</p></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center">3.</td>
<td><b>DURATION</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td><p>
<table>
<tr>
<td valign="top" align="right">(a)</td>
<td align="justify" class="spacebar">The period of employment of the Employee (here in after referred to as &quot;Employment Period&quot;) shall commence from <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_start'])) ;?>(here in after referred to as &quot;the Commencement Date&quot;) and ends on <?php echo date('j<\s\up>S</\s\up> F Y',strtotime($result['date_contract_end'])) ;?> (here in after referred to as &quot;the Expiry Date&quot;)</td>
</tr>
<tr>
<td valign="top" align="right">&nbsp;</td>
<td align="justify">&nbsp;</td>
</tr>
<tr>
<td valign="top" align="right">(b)</td>
<td align="justify" class="spacebar">Upon the expiration of the Employment Period, this Agreement may be extended subject to the mutual written agreement of both parties not later than Thirty (30) Days before the Expiry Date and if no such extension is granted, this Agreement will expire by efflux ion of time.</td>
</tr>
</table>
</p></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center">4.</td>
<td><b>CERTIFICATE OF FITNESS</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="justify" class="spacebar"><p>This offer of employment is subject to the Employee being certified physically and medically fit in all aspects for employment with UCI. The Employee shall undergo further medical examinations if required to do so by UCI to ascertain this fitness.</p></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td align="center"><b>5.</b></td>
<td><b>ACCOMMODATION (APPLICABLE IF PROVIDED)</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="justify"><p>The Employee shall be provided with hostel accommodation on single or sharing basis where deemed appropriate. The monthly utilities expense will be borne by UCI; however, the Employee is advised to be prudent in the usage. The Employee is required to observe and comply with the hostel rules and regulation which among others are:</p>
<br>
<table width="100%" class="spacebar">
<tr>
<td valign="top">5.1</td>
<td class="spacebar"><p>The Employee is required to stay in the hostel provided during his or her employment term and the Employee is prohibited to stay anywhere else ;( this shall not be applicable for and employee who is married and stays with the spouse)</p></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">5.2</td>
<td class="spacebar"><p>The Employee is responsible to take care of the facilities, furniture and fittings provided. Normal wear and tear acceptable</p></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">5.3</td>
<td class="spacebar"><p>The employee is required to behave morally and wear decent attire at all times</p></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">5.4</td>
<td class="spacebar"><p>The employee is prohibited from:-</p>
<table>
<tr>
<td valign="top">i.</td>
<td class="spacebar"><p>being involved in immoral behavior </p></td>
</tr>
<tr>
<td valign="top" class="spacebar">ii.</td>
<td><p>allowing any visitors, colleagues, relatives  either male or female in the premises.</p></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><b>6.</b></td>
<td><b>PLACE OF EMPLOYMENT</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td align="justify" class="spacebar"><p>The Employee’s place of employment shall be at any UCI’s office, its subsidiaries, its associated companies or any other place that is in existence or to be created in the future as may be determined by UCI from time to time.</p></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><b>7.</b></td>
<td><b>WORKING HOURS</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td><p>The Employee shall observe the working hours as per UCI’s prescribed working hours; which is as follows: </p>
</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td align="center">&nbsp;</td>
<td>
<p><i>Mondays to Thursdays:	9.90 am – 5.90 pm (Lunch hour: 1.00 pm – 2.00 pm)<br>
Fridays		    : 	9.00 am – 5.30 pm (Lunch hour: 12.30 pm – 2.45 pm)<br>
Saturdays : 9.00 am - 1.00 pm
</i></p><br>
<p>However, all academic staff may be subjected to the respective School working hours.</p><br>
<p>Notwithstanding the above, the employee may be required to work on Saturday or rest days on UCI business hours without any additional payment.</p><br>
<p>The working hours may be revised accordingly at the management’s discretion</p>
</td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><b>8.</b></td>
<td><b>DUTIES AND RESPONSIBILITIES </b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>
<table width="100%" class="spacebar">
<tr>
<td valign="top">8.1</td>
<td align="justify">
The Employee’s normal duties and responsibilities shall be given by UCI during the Employment Period and UCI shall reserve the right to vary and amend them at any time at UCI’s sole and absolute discretion. The Employee shall devote full commitment to the service of UCI and shall Endeavour to the utmost in his capacity to promote the interest and good name of UCI. The Employee’s employment shall be subject to the employment Rules and Regulations of UCI and the Laws of Malaysia that may be amended from time to time. 
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">8.2</td>
<td align="justify">
The duties of the Employee shall include the performance of work connected with the service activities of UCI of which shall be deemed to include public and professional services.
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">8.3</td>
<td class="spacebar"><p>
Further details of the Employees duties and responsibilities are as stated in the Second Schedule of this Agreement.
</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center"><b>9.</b></td>
<td><b>ANNUAL LEAVE</b></td>
</tr>
<tr>
<td align="center">&nbsp;</td>
<td>
<table class="spacebar">
<tr>
<td valign="top">9.1</td>
<td class="spacebar" align="justify">
The Employee shall be eligible for annual leave up to a maximum of 21 days per annum PROVIDED ALWAYS that the rest days and gazette public
</td>
</tr>
</table>
</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td align="center">&nbsp;</td>
<td>
<table class="spacebar">
<tr>
<td valign="top">&nbsp;</td>
<td align="justify">
holidays shall not be included when computing the leave entitlement of the Employee. All leave application has to be applied 7 days in advance.
</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">9.2</td>
<td><p>
Only half of the unutilized annual leave entitlement shall be carried forward to the subsequent contractual year with the prior written approval of the management.
</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">9.3</td>
<td><p>
UCI shall have the right to recall the Employee who is on leave, cancel any leave or not grant leave if due to the exigencies of  the Employee’s service so required.
</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">9.4</td>
<td><p>
Annual leave must be taken at times convenient to the Company and subject to approval from the Management.
</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td align="center" valign="top"><b>10.</b></td>
<td><b>SICK LEAVE</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="justify">The Employee shall be allowed paid sick leave up to a maximum of 14 days per annum and a maximum of 60 days of hospitalization per annum. All sick leave must be certified by UCI’s panel of doctors or appropriate Government Hospital authorities. In cases of emergency, where the Employee cannot be attended to by UCI’s panel of doctors or appropriate Government Hospital authorities, a medical certificate of recommendation by a registered medical practitioner who attended to him during such an emergency may be accepted which must be certified by UCI’s panel of doctors.<br><br>
Sick/Medical Certificate must reach the Human Resource Department within 48 hours of such leave or it will be considered as unpaid leave.
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>11.</b></td>
<td><b>GROUP PERSONAL ACCIDENT INSURANCE SCHEME</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td align="justify">UCI shall at its own cost and expense maintain with reputable insurers an insurance coverage for the Employee for personal injury, death or total disablement whatsoever caused by or arising out in the course of carrying out of UCI’s official duties under this Agreement.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table with="100%" class="spacebar">
<tr>
<td valign="top">&nbsp;</td>
<td>
<table class="spacebar">
<tr>
<td valign="top">11.1</td>
<td><p>The Employee will be covered with a Group Hospitalization and Term Life insurance (where applicable) by any insurers as notified by the Employer. Notwithstanding the above, the Employer reserves the right to review the Insurance Scheme from time to time</p></td>
</tr>
</table>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>12.</b></td>
<td><b>MEDICAL BENEFITS</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td>
<table class="spacebar">
<tr>
<td valign="top">12.1</td>
<td><p>The Employee shall be granted medical benefits as stated in Item 6 of the first Schedule PROVIDED ALWAYS that the Employer shall not be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts, treatment of any sexually transmitted diseases (including AIDS) or injury suffered arising from participation in any dangerous sports such as hang gliding, mountain climbing and scuba diving.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">12.2</td>
<td><p>Medical benefits shall cover medical consultation, hospitalization and emergency treatment in approved hospitals or clinics, which are all subject to the Company’s sole and absolute discretion.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">12.3</td>
<td><p>The Employer will bear the cost of the Employee’s medical treatment, medicines and hospitalization as per the Employee’s entitlement and as per benefits and limits in accordance with the Employer current insurance policies.  Current limit for the outpatient and other medical expenses for the Employee and his/her immediate family (legal spouse and children) is up to a combined limit of RM 800.00 (Ringgit Malaysia: Eight Hundred Only) per completed year of service.</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>13.</b></td>
<td><b>INCOME TAX</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>UCI shall not be liable to pay any Income Tax on salary and allowances paid to the Employee but reserve the right to deduct from the monthly salary of the Employee pursuant to Section 83 of the Income Tax Act, 1967.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td width="6%" align="center"><b>14.</b></td>
<td width="94%"><b>PUBLICATION</b></td>
</tr>
<tr>
<td width="6%" align="center">&nbsp;</td>
<td width="94%">
<table width="100%" class="spacebar">
<tr>
<td valign="top">14.1</td>
<td align="justify">Except with the written permission of UCI, the Employee shall not publish or write or cause to be published or cause to be written any book or other works which is based on information related and/or incidental to UCI, its subsidiaries and its associated companies.<td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">14.2</td>
<td><p>Where such permission is granted it shall be subject to an implied condition that no statement or comment contained in the publication is or may be calculated to cause embarrassment to UCI, its subsidiaries, its associated companies, the Malaysian Government or Malaysia.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">14.3</td>
<td align="justify">Except with the written permission of UCI, the Employee shall not either orally or in writing divulge to anyone or discuss publicly any measures taken by UCI on any official matters taken or carried out by the Employee.</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td width="6%" align="center"><b>15.</b></td>
<td width="94%"><b>SECRECY / CONFIDENTIALITY</b></td>
</tr>
<tr>
<td width="6%" align="center">&nbsp;</td>
<td width="94%" align="justify">The Employee shall maintain and observe complete secrecy/confidentiality in respect of any information about UCI or UCI’s activities, plans and strategies throughout his term of employment and thereafter, and shall be liable for any acts in breach of this provision.</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td width="6%" align="center"><b>16.</b></td>
<td width="94%"><b>DISCLOSURE OF INFORMATION</b></td>
</tr>
<tr>
<td width="6%" align="center">&nbsp;</td>
<td width="94%" align="justify">Except with the written permission of UCI, the Employee shall not divulge, disclose, make use of or impart to any third party any information or knowledge gained during employment with UCI. This information includes, but is not limited to, trade secrets, patented or secret processes, intellectual property right, proprietary equipment, machinery, business affairs, transactions or property of UCI. The Employee further agrees that he/she shall not, except with the prior written consent of UCI make directly or indirectly any statement public whether to the press or in books, magazines, periodicals or by</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td width="6%" align="center">&nbsp;</td>
<td width="94%">advertisement, radio,televisions, film, facsimile, internet or any other medium with respect to any Government representatives.</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>17.</b></td>
<td><b>CONFLICT OF INTEREST</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td><p>Unless expressly agreed to by UCI in advance, the Employee shall not seek out, embark upon or be engaged in any other business industry, enterprise or employment of any kind.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>18.</b></td>
<td><b>PROPRIETARY RIGHTS</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td><p>UCI shall have the sole and exclusive right to all intellectual property rights that the Employee gained and/or acquires while performing his duties during this Employment Period. The intellectual properties shall include discoveries, innovations and inventions made and stored physically or electronically such as printed materials, computer software, presentation material, etc. UCI shall have the right to use these intellectual properties at its discretion in whatever form, manner or purpose. The Employee shall not use these intellectual properties for any purpose other than for serving UCI, its subsidiaries or associated companies and shall not use them for his own gain or for any other employer without the prior authorization in writing from UCI.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>19.</b></td>
<td><b>TERMINATION OF EMPLOYMENT</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<table width="100%" class="spacebar">
<tr>
<td valign="top">19.1</td>
<td align="justify">The Employee may terminate this employment by giving two (2) months notice in writing to UCI or by paying in lieu of service a sum equivalent to the salary which would have been payable had the Employee served the period of notice (two months). The employee has to take note that should the employee which to terminate the contract, the last day of service should coincide with the end of current semester or the day immediately preceding the commencement of the semester, subject to the contractual notice period.
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">19.2 </td>
<td align="justify">UCI  shall reserve the right to terminate the employment of the Employee by giving  one (1) month notice in writing at any time or one (1) month
</td>
</tr>
</table>
</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td>&nbsp;</td>
<td>
<table width="100%" class="spacebar">
<tr>
<td valign="top">&nbsp;</td>
<td align="justify">salary in lieu of  notice to the Employee upon the happening of any of the following:-<br>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<table width="100%" class="spacebar">
<tr>
<td valign="top">a)</td>
<td align="justify">the Employee becomes incapacitated by injury, ill health or other causes which may prevent the Employee from performing his duties under his/her normal duties under this Agreement and for the purpose of this sub-clause, a certificate from a registered medical practitioner certifying that he will be unable to perform his duties shall be deemed to be an incapacity</td>
</tr>
<tr>
<td valign="top">b)</td>
<td align="justify">the Employee commits any breach of any of the terms of his/her employment or any of his/her duties or obligation under this Agreement.</td>
</tr>
</table> 
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top">19.3</td>
<td><p>The Employee’s employment with UCI may be terminated forthwith by UCI without prior notice if the Employee shall:</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
<table class="spacebar">
<tr>
<td valign="top">a)</td>
<td><p>fail to perform to the satisfaction of UCI and in particular fails to fulfill the requirements set out in Section 8 above; or</p></td>
</tr>
<tr>
<td valign="top">b)</td>
<td><p>persistently misses or reschedules classes without valid reason; or</p></td>
</tr>
<tr>
<td valign="top">c)</td>
<td><p>commits any breach of the terms of the Employee’s employment; or</p></td>
</tr>
<tr>
<td valign="top">d)</td>
<td><p>be guilty of any misconduct or negligence especially in the discharge of the Employee’s duties; or</p></td>
</tr>
<tr>
<td valign="top">e)</td>
<td><p>becomes bankrupt or makes any arrangement or composition with the Employee’s creditors; or</p></td>
</tr>
<tr>
<td valign="top">f)</td>
<td><p>be convicted on a charge in respect of;</p></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td>
<table>
<tr>
<td valign="top">i.</td>
<td><p>an offence involving fraud, dishonesty or moral turpitude; or</p></td>
</tr>
<tr>
<td valign="top">ii.</td>
<td><p>an offence under the Malaysian law relating to corruption; or</p></td>
</tr>
<tr>
<td valign="top">iii.</td>
<td><p>any other criminal offence punishable with fine, imprisonment or death penalty; or</p></td>
</tr>
<tr>
<td valign="top">iv.</td>
<td><p>involvement in any act of drug abuse; or</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td valign="top">g)</td>
<td><p>makes false declaration of job skill or work related record when applying for employment with UCI; or</p></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td>&nbsp;</td>
<td>
<table width="100%" class="spacebar">
<tr>
<td valign="top">h)</td>
<td><p>acts in a manner which is detrimental, or calculated to be detrimental to the interest or good name of Malaysia, UCI or to the public.</p></td>
</tr>
</table>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>20.</b></td>
<td><b>TRANSFERABILITY</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td><p>The Company may at its discretion transfer the employee to another location, section, department, division, region, branch, subsidiaries or associate company that is in existence or to be created in the future where the employee’s service is required.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>21.</b></td>
<td><b>WORK PERMIT</b></td>
</tr>
<tr>
<td valign="top">&nbsp;</td>
<td><p>The Company shall use its best efforts to obtain and maintain all necessary permits  but if the Company shall fail to obtain such permits and passes, the Agreement shall be terminated as from the date which the employee is  not permitted to enter or is no longer permitted to remain in Malaysia. Thereafter, either party shall have no claims against the other except for antecedent charges.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>22.</b></td>
<td><b>WORK PERMIT, PASSES AND LEVY DEDUCTION</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>The Company shall advance payment on behalf of the employee for obtaining work permit,  passes and levy charges and these costs shall be recovered from the Employee by means of off setting same from the employee’s salary over a period 12 months.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>23.</b></td>
<td><b>TRANSPORTATION TO AND FROM OFFICE</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>The Employee will be provided with pool transportation to and from place of accommodation provided to, and fro office where deemed appropriate.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>24.</b></td>
<td><b>CONFIDENTIAL INFORMATION</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="justify">The employee may have Company’s confidential knowledge that is not privy to share with others; in view of which the employee is prohibited from sharing</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td>&nbsp;</td>
<td align="justify">such information with others unless prior written approval has been granted by the company.</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>25.</b></td>
<td><b>CONDITION OF OFFER</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>This offer of employment is conditional upon the granting of work permit (employment pass) and other relevant approvals and consents by the relevant Government authorities. If the Employee is unable to obtain or renew the employment pass, this Agreement shall terminate on the date in which the application was rejected or revoked by the authorities. All remunerations and benefits provided by UCI shall cease on the date of termination of Employment except as may be specifically provided for or agreed upon.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>26</b></td>
<td><b>PERMANENT ADDRESS</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>The address of the person to be notified in the event of an accident or emergency is
<?php if(($result['address1']!="") || ($result['address2']!="") ||  ($result['postcode']!="") || ($result['city']!="")  || ($result['country_id']!="") ) {?>
    <?php echo $result['address1'];?>, <?php if($result['address2']!=NULL){ upper($result['address2']);echo ", "; }?><?php echo $result['postcode'];?><?php if($result['city']){ echo " ";upper($result['city']);} ;?>, <?php if($result['state']){ upper($result['state']);echo ", "; };?> <?php getCountry($result['country_id'],$db);?>
<?php } else { ?>
    &nbsp;-present-
<?php } ?>
and shall be considered as the Employee’s permanent address of the person in whose care UCI may communicate during an emergency. In the event of death while employed under this agreement. UCI shall attempt to communicate with the person at the given address. In the event that no directions are received from such person within reasonable time, or in the event the Employee has left no written instructions with UCI concerning the disposition of his remains or personal effects, the Employee hereby authorizes UCI to make disposition of the remains at UCI’s direction and to return all personal effects to the Executor or Administrator of the Employee’s estate or the person named at the permanent address.
</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>27.</b></td>
<td><b>NOTICES</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>All notices made here under shall be in writing and sent by A.R Registered post to the intended recipient thereof at his/her address set out in this contract. The notice shall be deemed to have been duly served seven (7) working days after posting. </p></td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td valign="top"><b>28.</b></td>
<td><b>RESTRICTIVE CONVENANT</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>On cessation of employment with UCI, the Employee shall not be engaged in any activity that would prejudice or pose a serious threat to UCI’s interest for a period of two (2) years from the date of cessation.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>29.</b></td>
<td><b>AMENDMENTS</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>Changes to this Agreement shall be valid only after they have been agreed upon mutually and confirmed in writing. The understandings set forth in this Agreement shall supersede all contrary oral undertakings or impressions the Employee may have obtained in conversations with UCI’s officer’s or representatives prior to the signing hereof.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>30.</b></td>
<td><b>GOVERNING LAW</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>The Employment Agreement and the attached interim First Schedule which form part of the Agreement shall be construed under, and governed by, and in all respects interpreted in accordance with the laws of Malaysia. Any dispute or claim arising out of this agreement shall, unless settled, be submitted to the appropriate Government agency in Malaysia according to the prevailing labor laws and regulations in force.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>31.</b></td>
<td><b>ENGLISH VERSION</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><p>This Agreement in the English Language is the authentic version of the Agreement between the parties and shall prevail over any other translation of it that may be made into any other language.</p></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td valign="top"><b>32.</b></td>
<td><b>ENTIRE AGREEMENT</b></td>
</tr>
<tr>
<td>&nbsp;</td>
<td align="justify"><p>This Agreement together with all Recitals, all Schedule hereto (together with any documents referred to herein) and the original Offer constitute the whole agreement between the parties hereto and it is expressly declared that no variations hereof shall be effective unless agreed in writing and signed by both parties. It is further agreed that the words importing the masculine gender shall be deemed to include the feminine and neuter genders and the singular to</p></td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td>&nbsp;</td>
<td align="justify">include the plural and vice versa. The headings are inserted for convenience only and shall not affect the construction of this Agreement </td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<div align="center"><b>[THE REST OF THIS PAGE IS INTENTIONALLY LEFT BLANK]</b></div>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%">
<tr>
<td colspan="2">IN WITNESS WHEREOF the parties have hereto set their hands the day and year first above written:</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="62%">SIGNED by the Employee</td>
<td align="left" width="38%">)</td>
</tr>
</table>
<table width="100%">
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)Name:</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)Passport No:</td>
</tr>
</table>
<table width="100%">
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="62%">In the presence of :-</td>
<td align="left" width="38%">)</td>
</tr>
</table>
<table width="100%">
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)Name:</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)I/C No:</td>
</tr>
</table>
<table width="100%">
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="55%">SIGNED for and on behalf of UCI</td>
<td align="left" width="45%">)</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)Name:&nbsp;<b>DATIN ROHAIDAH SHAARI</b></td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)I/C No:</td>
</tr>
</table>
<table width="100%">
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td width="62%">In the presence of :-</td>
<td align="left" width="38%">)</td>
</tr>
</table>
<table width="100%">
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)Name:</td>
</tr>
<tr>
<td width="55%">&nbsp;</td>
<td align="left" width="45%">)I/C No:</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%">
<tr>
<td align="center"><b>FIRST SCHEDULE</b></td>
</tr>
<tr>
<td align="center">(Which is to be taken, read and construed as an integral part of this Agreement)</td>
</tr>
</table>
<br>
<table width="100%" class="table">
<tr>
<td width="15%" align="center">SECTION NO</td>
<td width="36%">ITEM</td>
<td width="45%">PARTICULARS</td>
</tr>
<tr>
<td align="center">1</td>
<td>Overseas Travel</td>
<td>As per Company Standard Policies and Procedures</td>
</tr>
<tr>
<td align="center">2</td>
<td>Outstation travel, lodging, meal and transport</td>
<td>As per Company Standard Policies and Procedures</td>
</tr>
<tr>
<td align="center">3</td>
<td>Travel reimbursement claims</td>
<td>As per Company Standard Policies and Procedures</td>
</tr>
<tr>
<td align="center">4</td>
<td>Medical benefits</td>
<td>As per Company Standard Policies and Procedures</td>
</tr>
</table>
<br>
Note: Non Exclusion does not mean inclusion<br><br><br><br>
<p align="center"><b>[THE REST OF THIS PAGE IS INTENTIONALLY LEFT BLANK]</b></p>
</body>
    <?php

    $html = ob_get_contents();
    ob_end_clean();

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;

}
?>

