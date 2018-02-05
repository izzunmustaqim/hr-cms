<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Applications Category <button type="button" class="btn btn-info btn-xs" onclick="window.location='/cms-property/applications/default/add'"> Add New </button> </h4>
                <p class="text-muted mb-0">registered billing applications</p>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-body">

                        <?php foreach($category as $category) { ?>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr style="background-color: #1d539d; color: #fff">
                                        <th style="text-align: center" colspan="8"><?php echo $category['title'];?></th>
                                    </tr>
                                    <thead>
                                    <tr style="background-color: #14b3bb; color: #fff;">
                                        <th>Applications</th>
                                        <th style="text-align: center;width:20%">Category</th>
                                        <!--<th style="text-align: center;width:10%">Item</th>-->
                                        <th style="text-align: center;width:10%">Status</th>
                                        <th style="text-align: center;width:36%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $data = Applications::model()->getApplicationlist($category['category_id']);
                                    if($data){
                                        foreach($data as $data)
                                        {
                                            $category_text = "";
                                            $category = Category::model()->findByPk($data['category_id']);
                                            $category_text = $category['title'];
                                            $checkitem = Itemlist::model()->findAllByAttributes(array('applications_id'=>$data['id']));
                                            $count_item = count ($checkitem);

                                            ?>
                                            <tr>
                                                <td><?php echo $data['name']?></td>
                                                <td align="center"><?php echo $category_text?></td>
                                                <!--<td align="center"><?php /*echo $count_item*/?></td>-->
                                                <td align="center"><?php ($data['status'] == 1) ? $status = "Active" : $status = "InActive"; echo $status; ?></td>
                                                <td align="center">
                                                    <button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/add/id/<?php echo $data['applications_id']?>/category/<?php echo $data['category_id']?>'">  Edit  </button>
                                                    <?php if($category['category_alert']==1){?>
                                                        <button type="button" class="btn btn-info btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/itemlist/id/<?php echo $data['applications_id']?>/category/<?php echo $data['category_id']?>'">  List  </button>
                                                    <?php } else {?>
                                                        <button type="button" class="btn btn-warning btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/addpayment/id/<?php echo $data['applications_id']?>/category/<?php echo $data['category_id']?>/type/<?php echo $item['type_id'];?>'">  Payment  </button>
                                                        <button type="button" class="btn btn-info btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/summary/id/<?php echo $data['applications_id']?>/category/<?php echo $data['category_id']?>'">  Summary  </button>
                                                        <button type="button" class="btn btn-success btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/log/id/<?php echo $data['applications_id']?>/category/<?php echo $data['category_id']?>'">  Reminder Log  </button>
                                                    <?php } ?>
                                                    <button type="button" class="btn btn-danger btn-xs" onClick="window.location='<?php echo Yii::app()->request->baseUrl; ?>/applications/default/add/id/<?php echo $data['applications_id']?>'">  Delete  </button>
                                                </td>
                                            </tr>
                                            <?php  } } else {?>
                                        <tr>
                                            <td scope="row" colspan="8" align="center">Not available</td>
                                        </tr>

                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
