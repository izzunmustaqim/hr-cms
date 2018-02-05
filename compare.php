<table border="1">
    <tr>
        <td>ID</td>
        <td>Name</td>
    </tr>
    <?php
    $con = mysqli_connect('localhost','root','','citysys');

    $array_count = array();
    $array_accept = array();
    $array_reject = array();

    $check="SELECT
        tbluser.UserNo as userno
        FROM
        tbluser
        INNER JOIN tblposition ON tblposition.PositionId = tbluser.PositionId
        INNER JOIN tblbranch ON tblbranch.BranchId = tbluser.BranchId
        INNER JOIN tblstatusai ON tblstatusai.StatusId = tbluser.StatusId
        INNER JOIN tblworkingstatus ON tbluser.WorkingStatusId = tblworkingstatus.WorkingStatusId
        INNER JOIN tbldepartment ON tbldepartment.DepartmentId = tbluser.DepartmentId
        INNER JOIN tblpositiongrade ON tblposition.PositionGradeId = tblpositiongrade.PositionGradeId
        LEFT JOIN tblteachingpermit ON tbluser.UserId = tblteachingpermit.StaffId
        INNER JOIN tbldepartmentcategory ON tbldepartment.DeptCatId = tbldepartmentcategory.DeptCatId
        LEFT OUTER JOIN tblusereducation ON tblusereducation.UserId = tbluser.UserId
        INNER JOIN tblnationality ON tblnationality.NationalityId = tbluser.NationalityId
        INNER JOIN tblrace ON tblrace.RaceId = tbluser.RaceId
        WHERE
        tbluser.FullName not like '%OLD STAFF%'
        and tbluser.FullName not like '%-TBA%'
        and tbluser.UserId not in (226,198)
        and tbluser.StatusId=1
        and tblworkingstatus.WorkingStatusId=1
        GROUP BY ICPassportNo
        ORDER BY UserNo";
    $query_check = mysqli_query($con,$check);
    $query_row = mysqli_num_rows($query_check);
    while($z=mysqli_fetch_array($query_check)){
        array_push($array_count, $z['userno']);
    }

    $i = 0;
    $import="select * from tblhrpayroll order by staff_id";
    $query = mysqli_query($con,$import);
    while($o=mysqli_fetch_array($query)){
        echo "<tr>";
        echo "<td>";echo $o['staff_id'];echo "</td>";
        echo "<td>";echo $o['name'];echo "</td>";
        echo "</tr>";
        if (in_array($o['staff_id'], $array_count)) {
            $i = $i + 1;
            array_push($array_accept, array('id' => $o['staff_id'], 'name' => $o['name']));

        }else{
            array_push($array_reject, array('id' => $o['staff_id'], 'name' => $o['name']));
        }
    }




    echo " amount of user as below";echo "<br>";
    echo count($array_count);echo "<br>";
    echo " amount of user in array as below";echo "<br>";
    echo count($array_accept);echo "<br>";
    echo " amount of user not in array as below";echo "<br>";
    echo count($array_reject);echo "<br>";
    echo "<pre>";
    //print_r($array_reject);
    echo "</pre>";
    ?>
</table>
