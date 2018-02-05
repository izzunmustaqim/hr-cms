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

    $staff = $db->query("Select tbluser.UserNo,tbluser.UserId,tbluser.FullName,WorkingStatusDesc
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
    and tbldepartment.DepartmentId NOT IN (28,39)");

?>

<table border="1">
    <tr>
        <td>ID</td>
        <td>STAFF NO</td>
        <td>NAME</td>
        <td>Status</td>
        <td>NAME HR</td>
        <!--<td>STAFF No. Check</td>-->
    </tr>

    <?php $i=1;foreach($staff as $staff){ ?>

        <?php
        $staff_no = $staff['UserNo'];
        $FullName = $staff['FullName'];
        $staff_id = $staff['UserId'];
        $status = $staff['WorkingStatusDesc'];

                $staff_check = $db->query("SELECT * from azam_temp where staff_id='$staff_no'");
        //$checkno = $staff_no - $staff_check[0]['staff_id'];

        if($staff_check){
            $count_active = $count_active + 1;
            array_push($array_staff_active, array('UserId' => $staff_id,'FullName' => $FullName,'UserNo' => $staff_no));
        ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $staff_no?></td>
        <td><?php echo $FullName?></td>
        <td><?php echo $status;?></td>
        <td><?php echo $staff_check[0]['name']?></td>
        <!--<td><?php /*if($checkno==0){ echo "Ok";} else { echo $checkno;}*/?></td>-->
        <?php
        $i++;
        }else{
            $count_inactive = $count_inactive + 1;
            array_push($array_staff_inactive, array('UserId' => $staff_id,'FullName' => $FullName,'UserNo' => $staff_no));
        ?>
        <td></td>
        <td><?php echo $staff_no?></td>
        <td><?php echo $FullName?></td>
        <td><?php echo $status;?></td>
        <td></td>
        <!--<td><?php /*if($checkno==0){ echo "Ok";} else { echo $staff_check[0]['staff_id'];}*/?></td>-->

        <?php } ?>
    <tr>
        <!--//$count_active = $count_active + 1;
        //dump($staff);-->
    <?php  } ?>

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