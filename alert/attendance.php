<?php

require_once "Db.class.php";
$db = new Db();

function dump($app){
    echo "<pre>";
    print_r($app);
    echo "</pre>";
}

try{

    /*$staff = $db->query("SELECT tbluser.UserId,tbluser.FullName,tbluser.hod1 as hod1,tbluser.DateConfirm as DateConfirm,tbluser.DateJoin as DateJoin
    FROM
    tbluser
    LEFT OUTER JOIN  tblposition ON tblposition.PositionId = tbluser.PositionId
    LEFT OUTER JOIN  tblbranch ON tblbranch.BranchId = tbluser.BranchId
    LEFT OUTER JOIN  tblstatusai ON tblstatusai.StatusId = tbluser.StatusId
    LEFT OUTER JOIN  tblworkingstatus ON tbluser.WorkingStatusId = tblworkingstatus.WorkingStatusId
    LEFT OUTER JOIN  tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
    LEFT OUTER JOIN  tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId
    LEFT OUTER JOIN  tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
    LEFT OUTER JOIN tblnationality ON tblnationality.NationalityId = tbluser.NationalityId
    LEFT OUTER JOIN tblrace ON tblrace.RaceId = tbluser.RaceId
    WHERE
    tbluser.FullName not like '%OLD STAFF%'
    and tbluser.FullName not like '%-TBA%'
    and tbluser.UserId not in (226,198)
    and tbluser.StatusId=1
    and tblworkingstatus.WorkingStatusId in(1,3)
    and tbldepartment.StatusId = 1
    ORDER BY UserId");

    foreach($staff as $staff){*/


    function get_time_difference( $start, $end )
    {
        $uts['start']      =    strtotime( $start );
        $uts['end']        =    strtotime( $end );
        if( $uts['start']!==-1 && $uts['end']!==-1 )
        {
            if( $uts['end'] >= $uts['start'] )
            {
                $diff    =    $uts['end'] - $uts['start'];
                if( $days=intval((floor($diff/86400))) )
                    $diff = $diff % 86400;
                if( $hours=intval((floor($diff/3600))) )
                    $diff = $diff % 3600;
                if( $minutes=intval((floor($diff/60))) )
                    $diff = $diff % 60;
                $diff    =    intval( $diff );
                return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
            }
            else
            {
                trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
            }
        }
        else
        {
            trigger_error( "Invalid date/time data detected", E_USER_WARNING );
        }
        return( false );
    }


        $count_active = 0;
        $count_inactive = 0;
        $count_not_attend = 0;
        $array_staff_active = array();
        $array_staff_inactive = array();
        $array_not_attend = array();
        $dbh = new PDO( "sqlsrv:server=BB46\SQL2008;Database = soyaletegra", 'seserver', '11201se');

        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $sql = "SELECT * FROM dbo.profiles order by user_id asc ";
        $stmt = $dbh->prepare($sql);
        if($stmt->execute()){
            $results=$stmt->fetchAll();
            foreach($results as $row){

                $staff = $db->query("SELECT tbluser.UserNo,tbluser.FullName,tbluser.hod1 as hod1,tbluser.DateConfirm as DateConfirm,tbluser.DateJoin as DateJoin
                FROM
                tbluser
                WHERE
                tbluser.StatusId=1
                and tbluser.UserNo = '".$row['user_id']."'");
                if($staff){

                    foreach($staff as $staff) {
                        $count_active = $count_active + 1;
                        array_push($array_staff_active, array('UserId' => $staff['UserNo'],'FullName' => $staff['FullName'],'UserNo' => $row['id']));
                    }

                }else{

                    $count_inactive = $count_inactive + 1;
                }

            }

            //echo " Active : ".$count_active; echo "<br>";

        }

        /*echo "Total active ".$result = count($array_staff_active);echo "<br>";
        echo "Total inactive ".$count_inactive;echo "<br>";*/


        $date_today = date("Y-m-d");
        //$date_today = "2017-02-07";
        $work_time_in = "09:00:00";
        $work_time_out = "17:00:00";
        $in_max = "13:59:59";
        $out_min = "14:00:00";
        $condition = 0;

        $set_time_in = strtotime($work_time_in);
        $set_time_out = strtotime($work_time_out);
        $late_in = "";

        echo "<hr>";

        ?>
        <table border="1">
        <tr>
            <td></td>
            <td>Staff ID</td>
            <td>User Num</td>
            <td>Name</td>
            <td>Minimum</td>
            <td>Maximum</td>
            <td>Late In</td>
            <td>Early Out</td>
            <td>Working Time</td>
            <td>Short Work Hours</td>
            <td>Code</td>
            <td>Remarks</td>
        </tr>

        <?php
        $i = 1;
        foreach($array_staff_active as $array_staff_active) {

            $user_no = $array_staff_active['UserNo'];

            $sql = "SELECT dbo.events.user_num,
            Min(dbo.events.tran_time) AS minimum,
            Max(dbo.events.tran_time) AS maximum
            FROM dbo.events WHERE dbo.events.tran_date = '$date_today' AND dbo.events.user_num = $user_no group by user_num order by user_num asc";
            $stmt = $dbh->prepare($sql);
            if ($stmt->execute()) {
                //echo $stmt->debugDumpParams();echo "<br>";
                $results = $stmt->fetchAll();
                if($results){
                    foreach ($results as $row) {

                        $fullname = str_replace(array("'", ""), "", htmlspecialchars($array_staff_active['FullName']));
                        $time_in = $row['minimum'];
                        $time_out = $row['maximum'];
                        $late_in = strtotime($time_in)-$set_time_in;
                        $early_out = $set_time_out-strtotime($time_out);

                        // Late in checking
                        if($late_in>100){
                            $seconds = $late_in;
                            //$come_late_in = gmdate('H:i:s', $seconds);
                            $come_late_in = gmdate('H:i', $seconds);
                        }else{
                            $come_late_in = "00:00";
                        }

                        if( $diff=@get_time_difference($time_in, $time_out) ) {
                            //$working = sprintf( '%02d:%02d:%02d', $diff['hours'], $diff['minutes'], $diff['seconds'] );
                            $working = sprintf( '%02d:%02d', $diff['hours'], $diff['minutes']);
                        } else {
                            $working = "Hours: Error";
                        }

                        // Short working hours calculation
                        if($working<'08:00:01') {
                            $diff = strtotime("08:00:00")-strtotime("$working");
                            //$short = gmdate("H:i:s", $diff);
                            $short = gmdate("H:i", $diff);
                        } else {
                            $short = " Ok ";
                        }

                        // Early out checking
                        if($time_out<"$work_time_out") {
                            //$early = strtotime("$work_time_out")-strtotime("$time_out");
                            //$early = gmdate("H:i:s", $diff);
                            //$early = gmdate("H:i", $diff);
                            //$early = "check";.
                            $early = "00:00";
                        } else {
                            $early = "00:00";
                        }

                        // Absent Checking
                        if(($time_in=='00:00:00') || ($time_out=='00:00:00')) {
                            $code = "AB";
                        }else if($time_in>"$in_max") {
                            $code = "";
                        } else {
                            if($time_out<="$out_min"){
                                $code = "";
                            }else{
                                $code = "  ";
                            }
                        }

                        // No clock in / no clock out checking
                        if(($time_in=='00:00:00') || ($time_out=='00:00:00')) {
                            $remark = "No Clock In / No Clock Out";
                        }else if($time_in>"$in_max") {
                            $remark = "No Clock In";
                        } else {
                            if($time_out<="$out_min"){
                                $remark = "No Clock Out";
                            }else{
                                $remark = " Ok ";
                            }
                        }


                    ?>
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $array_staff_active['UserId']?></td>
                            <td><?php echo $row['user_num']?></td>
                            <td><?php echo $fullname?></td>
                            <td><?php echo $row['minimum'];?></td>
                            <td><?php echo $row['maximum'];?></td>
                            <td><?php echo $come_late_in; ?></td>
                            <td><?php echo $early;?></td>
                            <td><?php echo $working;?></td>
                            <td><?php echo $short;?></td>
                            <td><?php echo $code;?></td>
                            <td><?php echo $remark;?></td>
                        </tr>
                    <?php

                        /*$staff = $db->query("INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today." 00:00:00','".$array_staff_active['UserId']."','".$fullname."','WD','".$row['minimum']."',
                      '".$row['maximum']."','00:00','00:00','".$come_late_in."','".$early."','".$working."','".$code."','".$remark."')");

                        echo "INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today." 00:00:00','".$array_staff_active['UserId']."','".$fullname."','WD','".$row['minimum']."',
                      '".$row['maximum']."','00:00','00:00','".$come_late_in."','".$early."','".$working."','".$code."','".$remark."')";echo "<br>";*/

                        $i++;
                    }
                }else{
                    $count_not_attend = $count_not_attend + 1;
                    array_push($array_not_attend, array('UserId' => $array_staff_active['UserId'],'FullName' => $array_staff_active['FullName'],'UserNo' => $user_no));

                    /*$staff = $db->query("INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today." 00:00:00','".$array_staff_active['UserId']."','".$fullname."','WD','".$row['minimum']."',
                      '".$row['maximum']."','00:00','00:00','".$come_late_in."','".$early."','".$working."','".$code."','".$remark."')");*/
                }
            }
        }
        ?>
        </table>
        <hr>
        <table border="1">
            <tr>
                <td></td>
                <td>Staff ID</td>
                <td>User Num</td>
                <td>Name</td>
            </tr>

            <?php $x = 1;

                foreach ($array_not_attend as $array_not_attend){

                    /*echo "INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today."00:00:00','".$array_not_attend['UserId']."','".$array_not_attend['FullName']."','WD','00:00:00',
                      '00:00:00','00:00','00:00','00:00','00:00','00:00','AB','No Clock In / No Clock Out')";
                    echo "<br>";*/

                    /*$staff = $db->query("INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today." 00:00:00','".$array_not_attend['UserId']."','".$array_not_attend['FullName']."','WD','00:00:00',
                      '00:00:00','00:00','00:00','00:00','00:00','00:00','AB',NULL)");

                    echo "INSERT INTO tblattendancestaffthumb(Date,UserID,UserName,DayType,AttIN,AttOUT,Break1Out,Break1In,LateIn,EarlyOut,AttWork,LeavesCode,Remark)
                      values ('".$date_today." 00:00:00','".$array_not_attend['UserId']."','".$array_not_attend['FullName']."','WD','00:00:00',
                      '00:00:00','00:00','00:00','00:00','00:00','00:00','AB',NULL)";echo "<br>";*/
            ?>
            <tr>
                <td><?php echo $x?></td>
                <td><?php echo $array_not_attend['UserId']?></td>
                <td><?php echo $array_not_attend['UserNo']?></td>
                <td><?php echo $array_not_attend['FullName']?></td>
            </tr>
            <?php $x++;}?>
        </table>
<?php

    echo "Total not attend ".$count_not_attend;

} catch (PDOException $e) {
    echo 'Error!: '. $e->getMessage()."<br>";
    exit();
}
?>