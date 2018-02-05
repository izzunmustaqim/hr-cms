<?php

function padnumber($no){
    $num_padded = sprintf("%04d", $no);
    echo $num_padded;
}

function upper($string){
    echo ucwords(strtolower($string));
}

function uppercase($string){
    echo ucwords(strtoupper($string));
}

function money($amount){
    echo number_format($amount, 2, '.', ',');
}

function money_nodecimal($amount){
    echo number_format((float)$amount, 0, '.', '');
}

function expiredoffer($date){
    echo date('d F Y', strtotime($date. '+7 weekday'));
}

function expiredofferdate($date){
    echo date('l, j<\s\up>S</\s\up> F Y', strtotime($date));
}

function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
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

$ones = array(
    "",
    " one",
    " two",
    " three",
    " four",
    " five",
    " six",
    " seven",
    " eight",
    " nine",
    " ten",
    " eleven",
    " twelve",
    " thirteen",
    " fourteen",
    " fifteen",
    " sixteen",
    " seventeen",
    " eighteen",
    " nineteen"
);

$tens = array(
    "",
    "",
    " twenty",
    " thirty",
    " forty",
    " fifty",
    " sixty",
    " seventy",
    " eighty",
    " ninety"
);

$triplets = array(
    "",
    " thousand",
    " million",
    " billion",
    " trillion",
    " quadrillion",
    " quintillion",
    " sextillion",
    " septillion",
    " octillion",
    " nonillion"
);

// recursive fn, converts three digits per pass
function convertTri($num, $tri) {
    global $ones, $tens, $triplets;

    // chunk the number, ...rxyy
    $r = (int) ($num / 1000);
    $x = ($num / 100) % 10;
    $y = $num % 100;

    // init the output string
    $str = "";

    // do hundreds
    if ($x > 0)
        $str = $ones[$x] . " hundred";

    // do ones and tens
    if ($y < 20)
        $str .= $ones[$y];
    else
        $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];

    // add triplet modifier only if there
    // is some output to be modified...
    if ($str != "")
        $str .= $triplets[$tri];

    // continue recursing?
    if ($r > 0)
        return convertTri($r, $tri+1).$str;
    else
        return $str;
}

// returns the number as an anglicized string
function convertNum($num) {
    $num = (int) $num;    // make sure it's an integer

    if ($num < 0)
        return "negative".convertTri(-$num, 0);

    if ($num == 0)
        return "zero";

    return convertTri($num, 0);
}

// Returns an integer in -10^9 .. 10^9
// with log distribution
function makeLogRand() {
    $sign = mt_rand(0,1)*2 - 1;
    $val = randThousand() * 1000000
        + randThousand() * 1000
        + randThousand();
    $scale = mt_rand(-9,0);

    return $sign * (int) ($val * pow(10.0, $scale));
}

function get_first_letters($string)
{
    return preg_replace('/(\B.|\s+)/','',$string);
}


function getfilter($text)
{
    $filtered_words = array(
        'binti',
        'bin'
    );

    $zap = '';

    $filtered_text = str_replace($filtered_words, $zap, $text);

    return $filtered_text;

}

function getCountry($id,$db){
    $country = $db->query("SELECT * FROM tblcountry WHERE CountryId = :id", array("id"=>$id));
    echo $country[0]['CountryName'];
}

function getPosition($id,$db){
    $position = $db->query("SELECT * FROM tblposition WHERE PositionId = :id", array("id"=>$id));
    echo $position[0]['PositionName'];
}

function getUnit($id,$db){
    $unit = $db->query("SELECT * FROM tblhrunit WHERE unitid = :id", array("id"=>$id));
    echo $unit[0]['unitname'];
}

function getPositionGrade($id,$db){
    $grade = $db->query("SELECT * FROM tblposition INNER JOIN tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId WHERE tblposition.PositionId = :id", array("id"=>$id));
    echo $grade[0]['PositionGrade'];
}

function getPositionType($id,$db){
    $type = $db->query("SELECT * FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId
INNER JOIN tblpositiontype ON tblpositiongrade.PositionTypeId = tblpositiontype.PositionTypeId WHERE tblposition.PositionId = :id", array("id"=>$id));
    $type[0]['PositionTypeId'];
}

function getEntitlement($id,$db){
    $entitle = $db->query("SELECT Entitlement FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblleaveentitlement ON tblleaveentitlement.PositionGradeId = tblpositiongrade.PositionGradeId
    WHERE tblleaveentitlement.LeaveTypeId = 1 and tblposition.PositionId = :id", array("id"=>$id));
    echo $entitle[0]['Entitlement'];
}

function getEntitlementName($id,$db){ 
    $entitle = $db->query("SELECT Entitlement FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblleaveentitlement ON tblleaveentitlement.PositionGradeId = tblpositiongrade.PositionGradeId
    WHERE tblleaveentitlement.LeaveTypeId = 1 and tblposition.PositionId = :id", array("id"=>$id));
    echo upper(convertNum($entitle[0]['Entitlement']));
}

function getEntitlementNo($id,$db){
    $entitle = $db->query("SELECT Entitlement FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblleaveentitlement ON tblleaveentitlement.PositionGradeId = tblpositiongrade.PositionGradeId
    WHERE tblleaveentitlement.LeaveTypeId = 1 and tblposition.PositionId = :id", array("id"=>$id));
    $entitle[0]['Entitlement'];
}

/*function getEntitlementNo($id,$db){
    $entitle = $db->query("SELECT Entitlement FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblleaveentitlement ON tblleaveentitlement.PositionGradeId = tblpositiongrade.PositionGradeId
    WHERE tblleaveentitlement.LeaveTypeId = 1 and tblleaveentitlement.StartDateJoin = '2016-08-24' and tblposition.PositionId = :id", array("id"=>$id));
    $entitle[0]['Entitlement'];
}*/

function getFaculty($id,$db){
    $faculty = $db->query("SELECT * FROM tbldepartment WHERE DepartmentId = :id", array("id"=>$id));
    echo $faculty[0]['DepartmentDesc'];
}

function getFacultyUpper($id,$db){
    $faculty = $db->query("SELECT *,UCASE(tbldepartment.DepartmentDesc) AS DepartmentDesc FROM tbldepartment WHERE DepartmentId = :id", array("id"=>$id));
    echo $faculty[0]['DepartmentDesc'];
}

function getHod($id,$db){
    $hod = $db->query("SELECT * FROM tblhod WHERE HodId = :id", array("id"=>$id));
    upper($hod[0]['HodDesc']);
}

function getProgram($id,$db){
    $program = $db->query("SELECT * FROM tblprogram WHERE ProgramId = :id", array("id"=>$id));
    echo $program[0]['ProgramName'];
}

function getProgramfaculty($id,$db){
    $program = $db->query("SELECT * FROM tblprogram INNER JOIN tblfaculty ON tblfaculty.FacultyId = tblprogram.FacultyId WHERE ProgramId = :id", array("id"=>$id));
    echo $program[0]['FacultyName'];
}

function getProgramfacultyB($id,$db){
    $program = $db->query("SELECT * FROM tblprogram INNER JOIN tblfaculty ON tblfaculty.FacultyId = tblprogram.FacultyId WHERE ProgramId = :id", array("id"=>$id));
    echo uppercase($program[0]['FacultyName']);
}

function getProgramfacultyBold($id,$db){
    $program = $db->query("SELECT * FROM tblprogram INNER JOIN tblfaculty ON tblfaculty.FacultyId = tblprogram.FacultyId WHERE ProgramId = :id", array("id"=>$id));
    echo uppercase($program[0]['FacultyName']);
}

function getProbation($id,$db){
    $probation = $db->query("SELECT PositionProbation FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblpositiontype ON tblpositiontype.PositionTypeId = tblpositiongrade.PositionTypeId WHERE PositionId = :id", array("id"=>$id));
    echo $probation[0]['PositionProbation'];
}

function getConfirm($id,$db){
    $probation = $db->query("SELECT PositionConfirm FROM tblpositiongrade INNER JOIN tblposition ON tblpositiongrade.PositionGradeId = tblposition.PositionGradeId INNER JOIN tblpositiontype ON tblpositiontype.PositionTypeId = tblpositiongrade.PositionTypeId WHERE PositionId = :id", array("id"=>$id));
    echo $probation[0]['PositionConfirm'];
}

function getDuration($id){
    if($id==0){
        //echo "<u>per month</u> / per hour / per duration";
        echo "per month";
    }
    else if($id==1){
        //echo "per month / <u>per hour</u> / per duration";
        echo "per hour";
    }
    else if($id==2){
        //echo "per month / per hour / <u>per duration</u>";
        echo "per duration";
    }else{
        echo "";
    }
}

function getContract($id){
    if($id==0){
        echo "two (2) weeks";
    }
    if($id==1){
        echo "three (3) months ";
    }
}


?>