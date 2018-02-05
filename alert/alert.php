<?php

require_once "Db.class.php";
$db = new Db();

function dump($app){
    echo "<pre>";
    print_r($app);
    echo "</pre>";
}

$datenow = date("Y-m-d");
$year = date("Y");
$month = date("m");
$day = date("d");
$app = $db->query("SELECT * FROM applications ap left outer join category c on ap.category_id=c.category_id where category_alert=0");
foreach($app as $app) {

    // alert fixed date
    if($app['category_alert']==0) {
        for ($i = $year; $i < $year+1; $i++) {
            echo "<br>";echo "Item : ".$app['name']; echo " ( ";echo $i;echo " )<br>" ;
            for($y=1;$y<13;$y++){

                $category = $db->query("SELECT * FROM category");
                foreach($category as $category){
                    if($app['category_id']==$category['category_id']){

                        if($month<date(sprintf("%02d",$y))){

                            //echo "takyah carik";echo "<br>";

                        }else{

                            if($day<=$category['category_day']) {

                                $app_id = $app['applications_id'];
                                $category_id = $app['category_id'];

                                $checkpaid = $db->query("SELECT * FROM itemlist_paid where applications_id='" . $app_id . "' and category_id='" . $category_id . "' and month(payment_date)=$y  and year(payment_date)=$year");
                                if ($checkpaid != NULL) {
                                    echo " data exist";
                                    echo "<br>";
                                } else {

                                    // check if email already being send in same day
                                    $checkemail = $db->query("SELECT * FROM email_log where application_id='" . $app_id . "' and category_id='" . $category_id . "' and month='" . $y . "' and year='" . $year . "' ");
                                    if(!$checkemail){

                                        // save log
                                        $savelog = $db->query("INSERT into email_log(date,application_id,category_id,month,year,status) values(NOW(),$app_id,$category_id,$y,$year,1)");
                                        if($savelog){
                                            echo "send email";
                                            echo "<br>";
                                        }

                                    }else{
                                        // ignore, send next day
                                        echo "email sent already";echo "<br>";
                                    }
                                }
                            }else{
                                    echo "dah lepas tarikh tak perlu alert";echo "<br>";
                            }
                        }
                    }
                }
            }
        }
    }

}

echo "<hr>";

$app_m = $db->query("SELECT * FROM applications ap left outer join category c on ap.category_id=c.category_id where category_alert=1");
foreach($app_m as $app_m) {

    // alert annually / monthly / quaterly
    if($app_m['category_alert']==1){
        for ($i = $year; $i < $year+1; $i++) {
            echo "<br>";echo "Item : ".$app_m['name']; echo " ( ";echo $i;echo " )<br>" ;
            for($y=1;$y<13;$y++){

                $type = $db->query("SELECT * FROM type where type_alert is not null");
                foreach($type as $type) {

                    if($type['type_alert']==0) {

                        $item_check = $db->query("SELECT * FROM itemlist where applications_id=" . $app_m['applications_id'] . " and type_id=" . $type['type_id']);
                        if ($item_check != NULL) {

                            foreach ($item_check as $item_check) {

                                if ($month < date(sprintf("%02d", $y))) {
                                    //echo "takyah carik";echo "<br>";
                                } else {

                                    if ($day <= $item_check['day']) {

                                        $app_id = $app_m['applications_id'];
                                        $type_id = $item_check['type_id'];

                                        $checkpaid = $db->query("SELECT * FROM itemlist_paid where applications_id='" . $app_id . "' and type_id='" . $type_id . "' and month(payment_date)=$y  and year(payment_date)=$year");
                                        if ($checkpaid != NULL) {
                                            echo " data exist";
                                            echo "<br>";
                                        } else {

                                            // check if email already being send in same day
                                            $checkemail = $db->query("SELECT * FROM email_log where application_id='" . $app_id . "' and type_id='" . $type_id . "' and month='" . $y . "' and year='" . $year . "' ");
                                            if (!$checkemail) {

                                                // save log
                                                $savelog = $db->query("INSERT into email_log(date,application_id,type_id,month,year,status) values(NOW(),$app_id,$type_id,$y,$year,1)");
                                                if ($savelog) {
                                                    echo "send email";
                                                    echo "<br>";
                                                } else {
                                                    echo "not send email";
                                                    echo "<br>";
                                                }

                                            } else {
                                                // ignore, send next day
                                                echo "email sent already";
                                                echo "<br>";
                                            }
                                        }
                                    } else {
                                        echo "dah lepas tarikh tak perlu alert";
                                        echo "<br>";
                                    }
                                }
                            }

                        } else {
                            // echo " tak perlu check";echo "<br>";
                        }
                    }

                    if($type['type_alert']==1) {
                        //echo "Will be alert later";echo "<br>";
                    }
                }
            }
        }

    }

}

?>
