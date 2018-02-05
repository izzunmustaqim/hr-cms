<?php  $id = Yii::app()->getRequest()->getParam('id');$type = Yii::app()->getRequest()->getParam('type');$category = Yii::app()->getRequest()->getParam('category'); ?>

<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Add Payment</h4>
                <ol class="breadcrumb mb-0">
                    <li><a href="#">Application</a></li>
                    <li class="active">Payment</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-heading">
                        <h3 class="widget-title">Payment form</h3>
                    </div>
                    <div class="widget-body">
                        <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <!--<div class="form-group">
                                    <label for="ddlGenge">Type</label>
                                    <?php /*echo $form->dropDownList($model, 'type_id',CHtml::listData(Type::model()->getTypeFilter(array('order' => 'type_id')), 'type_id', 'title'), array('empty'=>' Please select item type ','class'=>'form-control','required' => 'required')); */?>
                                    <?php /*echo $form->error($model, 'type_id'); */?>
                                </div>-->
                                <div class="form-group">
                                    <label for="ddlGenge">Payment Date.</label>
                                    <?php echo $form->textField($model, 'payment_date', array('class' => 'form-control','required' => 'required')); ?>
                                    <?php echo $form->error($model, 'payment_date'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="ddlGenge">Amount</label>
                                    <?php echo $form->textField($model, 'amount', array('class' => 'form-control','required' => 'required')); ?>
                                    <?php echo $form->error($model, 'amount'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="ddlGenge">Reference No.</label>
                                    <?php echo $form->textField($model, 'reference_no', array('class' => 'form-control','required' => 'required')); ?>
                                    <?php echo $form->error($model, 'reference_no'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input name="ItemlistPaid[category_id]" type="hidden" value="<?php echo $category?>">
                                <input name="ItemlistPaid[type_id]" type="hidden" value="<?php echo $type?>">
                                <input name="ItemlistPaid[applications_id]" type="hidden" value="<?php echo $id?>">
                            </div>
                            <div class="col-md-6"><button type="submit" name="submit" class="btn btn-outline btn-success">Submit</button></div>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('input[name="ItemlistPaid[payment_date]"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                cancelLabel: 'Clear',
                format: 'YYYY-MM-DD'
            }
        });
    });
</script>