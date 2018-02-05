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

    $mpdf->SetHTMLHeader('<div style="text-align: left; font-family: tahoma; font-weight: bold; color:#000; font-size: 20pt;  ">AC11</div>');
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
     <table width="100%" class="spacebar">
     <tr>
     <td align="justify">We are pleased to engage you on a contract for service basis on the following terms and conditions:-</td>
     </tr>
     </table>
   <table width="100%" class="spacebar">
        <tr>
            <td align="left" width="24%">1.0 Position</td>
            <td align="center" width="10%">:</td>
            <td align="left" width="66%"><?php getPosition($result['position_id'],$db);?></td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">2.0 Reporting line</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>You shall report to <?php echo $result['report_to_id'];?> or 
 any other person designated by the Company.

                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">3.0 Duration</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p><?php echo date('d F Y',strtotime($result['date_contract_start']));?> to – <?php echo date('d F Y',strtotime($result['date_contract_end']));?></p>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
         <tr>
            <td align="left" width="24%" valign="top">4.0 Work Days</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p><?php upper($result['duration_day']);?> days per week</p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">5.0 Location</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>Menara City University, Petaling Jaya (PJ)</p></td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" width="24%" valign="top">6.0 Total Fees</td>
            <td align="center" width="10%" valign="top">:</td>
            <td align="justify" width="66%"><p>RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?> only) per month.</td>
        </tr>
    </table>
<div style='page-break-after:always'>&nbsp;</div>
<htmlpageheader name="fourthpage" style="display:none"> </htmlpageheader>
<sethtmlpageheader name="fourthpage" value="on" show-this-page="1"/>
<table width="100%" class="spacebar">
<tr>
<td width="5%" align="left" valign="top">7.0</td>
<td width="95%" align="justify" valign="top"><b>Termination of Contract</b><br>&nbsp;</td>
</tr>
<tr>
<td width="5%" align="justify" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">During the Contract Period this contract for Service can be terminated by either party giving to the other three (3) months’ notice or three (3) months’ fees in lieu of notice. You are however to note that should you wish to terminate the contract, it will only be considered and accepted at the end of current academic calendar.<br><br>
7.1 Your contract with City University may be terminated without prior notice if you:-<br><br>

	<table width="100%" class="spacebar">
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" align="center">a)</td>
            <td width="89%">commit any breach of the terms of the Contract for Service; or</td>
        </tr>
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">b)</td>
            <td width="89%" align="justify">be guilty of any misconduct or negligence especially in the discharge of
                your services; or
            </td>
        </tr>
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">c)</td>
            <td width="89%" align="justify">become bankrupt or make any arrangement or composition with your creditors;
                or
            </td>
        </tr>
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">d)</td>
            <td width="89%" align="justify">be convicted on a charge in respect of;</td>
        </tr>
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">&nbsp;</td>
            <td width="89%" align="justify">
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
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">e)</td>
            <td width="89%" align="justify">suffer debilitating ill health or become of unsound mind or is otherwise
                incapable of discharging your services; or
            </td>
        </tr>
        <tr>
            <td width="6%">&nbsp;</td>
            <td width="5%" valign="top" align="center">f)</td>
            <td width="89%" align="justify">act in a manner which is detrimental, or calculated to be detrimental to the
                interest or good name of Malaysia, UCI or to the public.
            </td>
        </tr>
    </table> 
    <br>  
</td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">
<table width="100%" class="spacebar">
<tr>
<td valign="top">7.2</td>
<td align="justify">Upon termination of your contract for service pursuant to Section 7.1 and under any one (1) of the clauses, you shall not be entitled to any payment by way of compensation and you will be required to pay City University a penalty equivalent to the sum of three (3) months of the service fee, except for 7.1(e).</td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="5%" align="left" valign="top">8.0</td>
<td width="95%" align="justify" valign="top"><b>Relocation</b></td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">The Company may at its discretion relocate you to another location, section, department, division, region, branch, subsidiaries or associate company that is in existence or to be created in the future where your service is required.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td width="5%" align="left" valign="top">9.0</td>
<td width="95%" align="justify" valign="top"><b>Duties and responsibility</b></td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">You shall devote full commitment to the service of City University and shall endeavour to the utmost in your capacity to promote the interest and good name of City University. The service you provide shall be subject to the provisions of the Constitution, Statutes, Acts and Rules and Regulations of City University that may be   amended from time to time and to the Laws of Malaysia.<br>&nbsp;</td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">
<table width="100%" class="spacebar">
<tr>
<td valign="top">9.1</td>
<td align="justify">Your service shall include work connected with the service activity of City University of which shall be deemed to include public and professional services.</td>
</tr>
</table>
</td>
</tr>
<tr>
<td width="5%" align="left" valign="top">10.0</td>
<td width="95%" align="justify" valign="top"><b>Secrecy/Confidentiality</b></td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">You shall maintain and observe complete secrecy/confidentiality in respect of any information about City University or City University’s activities, plans and strategies throughout your service, and shall be liable for any acts in breach of this provision.<br>&nbsp;</td>
</tr>
<tr>
<td width="5%" align="left" valign="top">11.0</td>
<td width="95%" align="justify" valign="top"><b>Disclosure of Information</b></td>
</tr>
<tr>
<td width="5%" align="left" valign="top">&nbsp;</td>
<td width="95%" align="justify" valign="top">Except with the written permission of the University, the you shall not divulge, disclose, make use of or impart to any third party any information or knowledge gained during  your services to the University. This information includes, but is not limited to, trade secrets, patented or secret processes, intellectual property rights, proprietary equipment, machinery, business affairs, transactions or property of the University. Your further agree that you will not, except with the prior written consent of the University to make directly or indirectly any statement public whether to the press or in books, magazines, periodicals or by advertisement, radio, televisions, film, facsimile, internet or any other medium with respect to any matter which might impair or injure the reputation of the University or the relations of the University, the University’s companies, customers or subcontractors or any other employers with whom The University is working with or with any Government representatives.</td>
</tr>
</table>
<div style='page-break-after:always'>&nbsp;</div>
<table width="100%" class="spacebar">
<tr>
<td align="justify">We look forward to your contribution towards the progress and development of City University.</td>
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
            <td align="justify"><p>I....................................................., (NRIC/Passport No:..........................................),<br>
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