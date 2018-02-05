<?php  $id = Yii::app()->getRequest()->getParam('id');$type = Yii::app()->getRequest()->getParam('type'); ?>
<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Applications Details</h4>
                <p class="text-muted mb-0">registered applications details</p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Application Details</h3>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txtMovieTitle">Name</label>
                                    <input class="form-control" type="text" maxlength="100" value="<?php echo $data['name'];?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ddlGenge">Category</label>
                                    <input class="form-control" type="text" maxlength="100" value="<?php echo $category[0]['title'];?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Year & Monthly Summary List for <?php echo $type_desc[0]['title'];?> </h3>
                    </div>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background-color: #1d539d; color: #fff;">
                                    <th style="width:5%">#</th>
                                    <th style="text-align: center">Year</th>
                                    <th style="text-align: center">Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $x=1;for($i=2016;$i<2018;$i++){?>
                                <tr>
                                    <th scope="row"><?php echo $x;?></th>
                                    <td style="text-align: center"><?php echo $i?></td>
                                    <td align="center">

                                        <table class="table table-bordered">
                                            <thead>
                                            <tr style="background-color: #1d539d; color: #fff;">
                                                <th style="text-align: center">No.</th>
                                                <th style="text-align: center">Month</th>
                                                <!--<th style="text-align: center">Amount Due</th>-->
                                                <th style="text-align: center">Amount Paid</th>
                                                <!--<th style="text-align: center">Balance</th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php for($q=1;$q<13;$q++){?>

                                                <?php
                                                if($category[0]['category_id']==1){
                                                    $itemdue = ItemlistDue::model()->getItemlistdueyear($id,$type,$q,$i);
                                                    $itempaid = ItemlistPaid::model()->getItemlistdueyear($id,$type,$q,$i);
                                                }else{
                                                    $itemdue = ItemlistDue::model()->getItemlistdueyearextra($id,$q,$i);
                                                    $itempaid = ItemlistPaid::model()->getItemlistdueyearextra($id,$q,$i);
                                                }

                                                $monthNum = $q;
                                                $monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

                                                $balance = $itemdue[0]['amount'] - $itempaid[0]['amount'];

                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $q?></td>
                                                    <td align="center"><?php echo $monthName ?></td>
                                                    <!--<td align="center"><?php /*if($itemdue[0]['amount']) { echo $itemdue[0]['amount']; } else { echo "0.00";} */?></td>-->
                                                    <td align="center"><?php if($itempaid[0]['amount']) { echo $itempaid[0]['amount']; } else { echo "0.00";} ?></td>
                                                    <!--<td align="center"><?php /*if($balance) { echo $balance; } else { echo "0.00";} */?></td>-->
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php $x++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
