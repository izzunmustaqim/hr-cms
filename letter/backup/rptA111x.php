<?php

require_once "Db.class.php";
include ("../mpdf/mpdf.php");

$db = new Db();
$id = $_GET['id'];$user_id = $_GET['user_id'];
define("MAJOR", 'Ringgit Malaysia');
define("MINOR", 'RM');

// LOG
$log = $db->query("INSERT INTO tblhrprintlog(date_log,offer_id,user_id) VALUES (NOW(),'$id','$user_id')");

function padnumber($no){
    $num_padded = sprintf("%04d", $no);
    echo $num_padded;
}

function upper($string){
    echo ucwords(strtolower($string));
}

function money($amount){
    echo number_format((float)$amount, 2, '.', '');
}

function money_nodecimal($amount){
    echo number_format((float)$amount, 0, '.', '');
}

function expiredoffer($date){
    echo date('d F Y', strtotime($date. '+7 weekday'));
}

function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}



class convert_money  {
    var $pounds;
    var $pence;
    var $major;
    var $minor;
    var $words = '';
    var $number;
    var $magind;
    var $units = array('','one','two','three','four','five','six','seven','eight','nine');
    var $teens = array('ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
    var $tens = array('','ten','twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety');
    var $mag = array('','thousand','million','billion','trillion');
    function convert_money($amount, $major=MAJOR, $minor=MINOR) {
        $this->major = $major;
        $this->minor = $minor;
        $this->number = number_format($amount,2);
        list($this->pounds,$this->pence) = explode('.',$this->number);
        //$this->words = " $this->major $this->pence$this->minor";
        $this->words = "";
        if ($this->pounds==0)
            $this->words = "Zero $this->words";
        else {
            $groups = explode(',',$this->pounds);
            $groups = array_reverse($groups);
            for ($this->magind=0; $this->magind<count($groups); $this->magind++) {
                if (($this->magind==1)&&(strpos($this->words,'hundred') === false)&&($groups[0]!='000'))
                    $this->words = ' and ' . $this->words;
                $this->words = $this->_build($groups[$this->magind]).$this->words;
            }
        }
    }
    function _build($n) {
        $res = '';
        $na = str_pad("$n",3,"0",STR_PAD_LEFT);
        if ($na == '000') return '';
        if ($na{0} != 0)
            $res = ' '.$this->units[$na{0}] . ' hundred';
        if (($na{1}=='0')&&($na{2}=='0'))
            return $res . ' ' . $this->mag[$this->magind];
        $res .= $res==''? '' : ' and';
        $t = (int)$na{1}; $u = (int)$na{2};
        switch ($t) {
            case 0: $res .= ' ' . $this->units[$u]; break;
            case 1: $res .= ' ' . $this->teens[$u]; break;
            default:$res .= ' ' . $this->tens[$t] . ' ' . $this->units[$u] ; break;
        }
        $res .= ' ' . $this->mag[$this->magind];
        return $res;
    }
}

function getCountry($id,$db){
    $country = $db->query("SELECT * FROM tblcountry WHERE CountryId = :id", array("id"=>$id));
    echo $country[0]['CountryName'];
}

function getPosition($id,$db){
    $position = $db->query("SELECT * FROM tblposition WHERE PositionId = :id", array("id"=>$id));
    echo $position[0]['PositionName'];
}

function getPositionGrade($id,$db){
    $grade = $db->query("SELECT * FROM tblposition INNER JOIN tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId WHERE tblposition.PositionId = :id", array("id"=>$id));
    echo $grade[0]['PositionGrade'];
}

function getEntitlement($id,$db){
    $entitle = $db->query("SELECT Entitlement FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblleaveentitlement ON tblleaveentitlement.PositionGradeId = tblpositiongrade.PositionGradeId
    WHERE tblleaveentitlement.LeaveTypeId = 1 and tblposition.PositionId = :id", array("id"=>$id));
    echo $entitle[0]['Entitlement'];
}

function getFaculty($id,$db){
    $faculty = $db->query("SELECT * FROM tblfaculty WHERE FacultyId = :id", array("id"=>$id));
    echo $faculty[0]['FacultyName'];
}
function getHod($id,$db){
    $hod = $db->query("SELECT * FROM tblhod WHERE HodId = :id", array("id"=>$id));
    upper($hod[0]['HodDesc']);
}


$result = $db->query("SELECT * FROM tblhroffer WHERE id = :id", array("id"=>$id));
foreach($result as $result) {

    $obj = new convert_money($result['salary']);

    $mpdf = new mPDF('', '', 0, '', 25, 20, 20, 5, 9, 9, 'P');
    ob_start();
    $mpdf->ignore_invalid_utf8 = true;

    ?>
    <style>
        body {
            font-family: tahoma;
            font-size: 12pt;
            margin-top: 0px;

        }

        td{
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

        .tabheader{
            margin-right:10em;
        }


        .hr {
            border: 0;
            margin-top:auto;
            border-top: 4px double #8c8c8c;
            text-align: center;
        }


        .signature {
            margin-bottom:auto;
            width:5px;
        }

        .table {
            font-family:Tahoma, Geneva, sans-serif;
            font-size:14px;
            color:#333333;
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
            <td>&nbsp;:&nbsp;CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>&nbsp;:&nbsp;<?php echo date('d F Y',strtotime($result['date_offer']));?></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php upper($result['name']);?></td>
        </tr>
        <tr>
            <td><?php upper($result['address1']);?>,<br><?php if($result['address2']!=NULL){ upper($result['address2']);echo ","; }?><br><?php echo $result['postcode'];?> <?php upper($result['city']);?>,<br><?php getCountry($result['country_id'],$db);?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Dear Mr/Mrs,</td>
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
    <table width="100%">
        <tr>
            <td align="justify" height=""><p>We are pleased to confirm our offer of employment to you as <?php getPosition($result['position_id'],$db);?> under
                    <?php getFaculty($result['faculty_id'],$db);?> with City University College of Science and Technology (&quot;The
                    Company&quot;). You will report to Dean, <?php upper(getHod($result['report_to_id'],$db));?> or any other officer as appointed by the
                    Company. This position is based at the Petaling Jaya Main Campus at Menara City University
                    College.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>Your appointment with the Company is subject to you obtaining a satisfactory medical
                    report including a chest X-ray from the Company's appointed clinic and you being certified medically
                    fit for employment.</p></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify"><p>Apart from the foregoing, as an educational institution we have to strictly comply
                    with government regulation with regard to matters concerning teaching permit etc. You are herewith
                    requested to note that, if for any reason your teaching permit application is rejected by the
                    ministry concerned or if there is any objection from government authorities concerning your
                    employment, your continued employment by us shall cease with immediate effect and the question of
                    any payment of compensation shall not arise.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">You shall be paid a salary of RM <?php money($result['salary']);?> (Ringgit Malaysia: <?php upper($obj->words) ?>) per month less
                statutory deductions.
            </td>
        </tr>
    </table>
    <table width="100%">
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
            <td align="justify">Kindly return the duplicate of this letter, duly signed to the Human Resource Department
                by Day, <?php expiredoffer($result['date_offer']); ?> failing which, this offer shall lapse.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="justify">You are also to note that once acceptance of this employment offer is confirmed by you
                and if you do not report to work on the specified date in Appendix A, you may subject yourself to legal
                action by CITY University College of Science & Technology.
            </td>
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
            <td align="left">Mr/Mrs</td>
            <td align="right">Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
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
            <td align="justify"><p>I ......................., (I/C No: ...................), hereby accept the terms and
                    conditions of employment with City University College of Science and Technology as set forth in
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
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%">No</td>
            <td align="center" width="40%">Item</td>
            <td align="center" width="50%">Description</td>
        </tr>
        <tr>
            <td align="center" width="10%">1</td>
            <td align="left" width="40%" valign="top">Name</td>
            <td align="left" width="50%"><?php upper($result['name']);?></td>
        </tr>
        <tr>
            <td align="center" width="10%">2</td>
            <td align="left" width="40%" valign="top">Position</td>
            <td align="left" width="50%"><?php getPosition($result['position_id'],$db);?> ( Job Grade:  <?php getPositionGrade($result['position_id'],$db);?>  )</td>
        </tr>
        <tr>
            <td align="center" width="10%">3</td>
            <td align="left" width="40%" valign="top">Employment Status</td>
            <td align="left" width="50%">Permanent</td>
        </tr>
        <tr>
            <td align="center" width="10%">4</td>
            <td align="left" width="40%" valign="top">Commencement Date</td>
            <td align="left" width="50%"><?php echo date('d F Y',strtotime($result['date_offer']));?></td>
        </tr>
        <tr>
            <td align="center" width="10%">5</td>
            <td align="left" width="40%" valign="top">Probation</td>
            <td align="left" width="50%">Your probationary period is six (6) months</td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">6</td>
            <td align="left" width="40%" valign="top">Reporting Line</td>
            <td align="left" width="50%">You shall report to the Dean / Director <?php upper(getHod($result['report_to_id'],$db));?> or any other officer as appointed by the Company.</td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">7</td>
            <td align="left" width="40%" valign="top">Working Hours</td>
            <td align="justify" width="50%"><p>Monday to Thursday - 8.30am to 5.30pm (lunch break 1.00pm to 2pm)<br><br>
                    Friday - 8.30am to 5.45pm (Lunch break 12.30pm to 2.45pm)<br><br>
                    You maybe required to work on your off and rest days with no additional payment. Please note that the working hours maybe subject to change due to operational requirements by the Company.
                </p></td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">8</td>
            <td align="left" width="40%" valign="top">Duties & Responsibilities</td>
            <td align="left" width="50%">Please refer to your Job Description (Attached)</td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">9</td>
            <td align="left" width="40%" valign="top">Annual leave</td>
            <td align="justify" width="50%"> ( <?php getEntitlement($result['position_id'],$db);?> ) working days per completed year of service.  Leave shall be applied 7 days in advance.  <br><br>
                Annual Leave benefit is only applicable after you have been confirmed in your employment.
            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">10</td>
            <td align="left" width="40%" valign="top">Sick Leave and Hospitalization leave</td>
            <td align="justify" width="50%">You will be granted paid outpatient medical leave of up to 14 days per annum.  Hospitalization medical leave will be granted up to a maximum of sixty (60) days per completed year of service.<br>
                The aforementioned outpatient and Hospitalization medical leave will be granted up to a maximum of sixty (60) days per completed year of service.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">11</td>
            <td align="left" width="40%" valign="top">Transfer/Secondment</td>
            <td align="justify" width="50%">You may be transferred or seconded to another department/division or any of the associate or subsidiary companies within the Group based on business needs and depending on your experience, knowledge and skills.
            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">12</td>
            <td align="left" width="40%" valign="top">Termination of Employment</td>
            <td align="justify" width="50%"><u>During Probation</u>
                Two (2) month notice from either party or two (2) month salary in lieu of such notice.<br><br>
                <u>Upon confirmation</u>
                Three (3) months notice or three (3) months salary in lieu of such notice. However, your resignation will only be considered and accepted at the end of current academic calendar.<br><br>

                Note : Resignation of Academic Staff<br><br>

                As City U is involved in providing education and in order not to disrupt completion of modules/ subjects being taught, academics will have to ensure that the last day of service is to coincide either with the last day of semester or the day immediately preceding the commencement of the semester, subject to the contractual notice period.<br><br>

                Kindly note with regard to this offer of employment you fully understand and agree that should you resign without giving the due notice or salary in lieu, City UC reserves the right to inform your new employer that you quit without giving due notice and legal action is being pursued by City UC.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">13</td>
            <td align="left" width="40%" valign="top">Medical Benefits</td>
            <td align="justify" width="50%">Upon registration with the Human Resource Department, you will be covered under the Company�s Healthcare Plan.<br>
                The Employee shall be granted medical benefits as stated in the employee handbook. The Company shall not be responsible for medical expenses incurred for self-inflicted injuries, suicide attempts, treatment of any sexually transmitted diseases (including AIDS) or injury suffered arising from participation in any dangerous sports such as hand gliding, mountain climbing and scuba diving.<br><br>

                Medical benefits shall cover medical consultation, hospitalization and emergency treatment in approved hospitals or clinics, which are all subject to the Company�s sole and absolute discretion.<br><br>

                The Company shall provide outpatient and other medical expenses for you and your immediate family (legal spouse and children) up to a combined limit of RM 800.00 (Ringgit Malaysia: Eight Hundred Only) per completed year of service.<br><br>

                Please refer to Employee Handbook on Medical/Sick Leave.
            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">14</td>
            <td align="left" width="40%" valign="top">Non-Disclosure and
                Confidentiality
            </td>
            <td align="justify" width="50%">
                You shall never at any time during and after your employment with the Company disclose or divulge to any third party any information or matters relating to the Company or its business partners. This includes but not limited to the Company�s business plans, strategies, program contents or trade secrets.<br>

                You shall not, except with prior written consent of
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>
        <table width="100%">
            <tr>
                <td>xxxNamexxxxxx </td>
                <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
            </tr>
        </table>
        <table width="100%" class="table">
            <tr>
                <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
                <td align="center"  width="50%">Appendix A</td>
            </tr>
        </table>
        <br>
        <table width="100%" class="table">
            <tr>
                <td align="center" width="10%" valign="top">&nbsp;</td>
                <td align="left" width="40%" valign="top">&nbsp;</td>
                <td align="justify" width="50%">the Chairman of the Board of Directors make direct or indirect statements public, whether to the press or in books, magazines, periodicals or by advertisement, radio, televisions, film, internet or any other medium with respect to any matter which might impair or injure the reputation of the Company or the relations of the Company�s companies, customers, or any other parties with whom the Company is working with or any Government or Regulatory Body. A breach of this clause, shall result in the Company instituting actions or remedies that it deems fit to safeguard its interest.<br>
                    This may include the immediate termination of your employment and/or the instituting of legal action.
                </td>
            </tr>
            <tr>
                <td align="center" width="10%" valign="top">15</td>
                <td align="left" width="40%" valign="top">Proprietary Rights</td>
                <td align="justify" width="50%">The Company shall have the sole and exclusive right to all intellectual property rights that you have gained and/or acquired while performing your duties during your employment period. The intellectual properties shall include discoveries, innovations and inventions made and stored physically or electronically such as printed materials, computer software, presentation material, etc.<br>

                    The Company has the sole and exclusive right to use these intellectual properties at its discretion in whatever form, manner or purpose. You shall not use these intellectual properties for any purpose other than for serving the Company, its subsidiaries or associated companies and shall not use them for your own gain or for any other employer without the prior authorization in writing from the Chairman of the Board of Directors.
                </td>
            </tr>
        </table>
    </div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">16</td>
            <td align="left" width="40%" valign="top">Publication / Social Media</td>
            <td align="justify" width="50%">
                a)&nbsp; Except with the written permission of the Company, you shall not publish or write or cause to be published or cause to be written any book, circulate in social media any information or other works which is based on information related and/or incidental to the Company, its subsidiaries and its associated companies.<br><br>

                b)&nbsp; With regard to (a) of above, where such permission is granted it shall be subject to an implied condition that no statement or comment contained in the publication or social media is or maybe calculated to cause embarrassment to Company, its subsidiaries, its associated companies, the Malaysian Government or Malaysia.<br><br>

                c)&nbsp; Except with the written permission of the Company, you shall not either orally or in writing divulge to anyone or discuss publicly any measures taken by the Company on any official matters taken or carried out by you, the management or an employee of the Company.
            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">17</td>
            <td align="left" width="40%" valign="top">Notices</td>
            <td align="justify" width="50%">
                All notices hereunder shall be made in writing and sent to the other party either in person, via an authorized representative or by A.R. Registered post.
                Unless otherwise specified herein, the notice shall be deemed to have been received seven (7) working days after being duly deposited at the post office.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">18</td>
            <td align="left" width="40%" valign="top">Alteration</td>
            <td align="justify" width="50%">
                If, for any reasons whatsoever, the Company wishes to alter these terms and conditions in any way, it reserves the right to do so entirely at its discretion. Any alterations, amendments or additions to these terms and conditions of service shall be advised to you in writing.
            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">19</td>
            <td align="left" width="40%" valign="top">Other Terms
                & Conditions
            </td>
            <td align="justify" width="50%">
                <b>I.	CONDUCT </b><br><br>
                During your employment with City University College, we will naturally wish your conduct to be such as not to discredit you or the Company and you will be expected to perform the duties assigned to you in a loyal, efficient, trustworthy and honest fashion.<br><br>

                During the continuance of your employment with us, you will at all times faithfully and diligently perform and observe such duties as may from time to time be assigned to you by your superior and devote the whole of your time and attention to the discharge of the duties and functions devolved upon you.<br><br>

                Whilst under our employment, you are not allowed to be involved directly or indirectly in any business contrary to Company�s interest without formal approval of the Chairman of the Board of Directors.  Breaching this would be a violation of your employment contract and could result in the termination of your employment.  You shall not divulge any matters, which may come to your knowledge, relating to the affairs of the Company or its employees.
            </td>
        </tr>
    </table>
    <div style='page-break-after:always'>&nbsp;</div>
    <table width="100%">
        <tr>
            <td>xxxNamexxxxxx </td>
            <td align="right">Our Ref: CITYU/HRA/EXT/<?php echo date("Y")?>-<?php padnumber($result['offer_id'])?>-A1</td>
        </tr>
    </table>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="50%">TERMS & CONDITIONS OF SERVICE</td>
            <td align="center"  width="50%">Appendix A</td>
        </tr>
    </table>
    <br>
    <table width="100%" class="table">
        <tr>
            <td align="center" width="10%" valign="top">&nbsp;</td>
            <td align="left" width="40%" valign="top">&nbsp;</td>
            <td align="justify" width="50%">
                <b>II.	COMPLIANCE WITH GOVERNMENT
                    REQUIREMENTS/REGULATIONS.</b><br><br>

                As you are employed as a Lecturer, you are required to take note that from time to time the government on its part may require our lecturers/concerned employees to update their skills in order to enhance the quality of education provided by us.<br><br>

                Should such requirement/s arise it is your sole responsibility to upgrade your skills/qualifications etc. in order to comply with the government requirements/regulations eg: the need for certain category of academic staff to have a teaching methodology certificate.<br><br>

            </td>
        </tr>
        <tr>
            <td align="center" width="10%" valign="top">12</td>
            <td align="left" width="40%" valign="top">Severance</td>
            <td align="justify" width="50%">
                If any clause contained in this letter is illegal or unenforceable, it may be rendered void, without affecting the enforceability of the other clauses in this letter.
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td><b>CITY UNIVERSITY COLLEGE OF SCIENCE AND TECHNOLOGY</b></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td align="right">Accepted by,</td>
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
            <td width="35%" align="left"><hr class="signature"></td>
            <td width="30%" align="right">&nbsp;</td>
            <td width="35%" align="right"><hr class="signature"></td>
        </tr>
        <tr>
            <td align="left"><b>DATIN ROHAIDAH SHAARI</b></td>
            <td align="right">&nbsp;</td>
            <td align="left">Name:</td>
        </tr>
        <tr>
            <td align="left">Executive Director </td>
            <td align="right">&nbsp;</td>
            <td align="left">I/C No.:</td>
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
