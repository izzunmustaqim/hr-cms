<?php

require_once "Db.class.php";
$db = new Db();

function dump($app){
    echo "<pre>";
    print_r($app);
    echo "</pre>";
}

try{

    $count_active = 0;
    $count_inactive = 0;
    $array_staff_active = array();
    $array_staff_inactive = array();

    $staff = $db->query("SELECT * from azam_temp");

    ?>

    <table border="1">
        <tr>
            <td>ID</td>
            <td>STAFF NO</td>
            <td>NAME</td>
            <td>Status</td>
            <td>NAME HR</td>
        </tr>

        <?php $i=1;foreach($staff as $staff){
        $staff_id_hr = $staff['staff_id']; ?>

        <?php

        $staff_cms = $db->query("Select tbluser.UserNo,tbluser.UserId,tbluser.FullName,WorkingStatusDesc
        FROM
        tbluser
        left outer join azam_temp at on tbluser.UserNo=at.staff_id
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
        and tbldepartment.DepartmentId NOT IN (28,39)
        and tbluser.UserNo='$staff_id_hr'");

        $staff_cms_no = $staff_cms[0]['UserNo'];

        if ($staff_id_hr == "$staff_cms_no"){
        ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $staff['staff_id'] ?></td>
            <td><?php echo $staff['name'] ?></td>
            <td><?php echo $staff_cms[0]['FullName'] ?></td>
            <td></td>
        </tr>
        <?php $i++;
        } else { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $staff['staff_id'] ?></td>
                <td><?php echo $staff['name'] ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php
        }
        }?>

    </table>

    <?php

    echo $count_active;echo "<br>";
    echo $count_inactive;echo "<br>";

    //dump($array_staff_inactive);



} catch (PDOException $e) {
    echo 'Error!: '. $e->getMessage()."<br>";
    exit();
}
?>