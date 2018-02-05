<div class="page-container">
<div class="page-header clearfix">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mt-0 mb-5">Category</h4>
            <ol class="breadcrumb mb-0">
                <li><a href="#">Setting</a></li>
                <li><a href="#">Category</a></li>
                <li class="active">Add</li>
            </ol>
        </div>
    </div>
</div>
<div class="page-content container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-heading">
                <h3 class="widget-title">Category form</h3>
            </div>
            <div class="widget-body">
                <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="txtMovieTitle">Name</label>
                                <?php echo $form->textField($model, 'title', array('class' => 'form-control','required' => 'required')); ?>
                                <?php echo $form->error($model, 'title'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ddlGenge">Category Setting</label>
                                <?php echo $form->dropDownList($model, 'category_alert', array('0' => 'Active','1' => 'Custom'), array('class'=>'form-control','prompt'=>'Please select alert category') ); ?>
                                <?php echo $form->error($model, 'category_alert'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ddlGenge">Concurrent Date (Day)</label>
                                <?php echo $form->textField($model, 'category_day', array('class' => 'form-control','required' => 'required')); ?>
                                <?php echo $form->error($model, 'category_day'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ddlGenge">Status</label>
                                <?php echo $form->dropDownList($model, 'status', array('1' => 'Active','0' => 'InActive'), array('class'=>'form-control','prompt'=>'Please select status') ); ?>
                                <?php echo $form->error($model, 'status'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6"><button type="submit" name="submit" class="btn btn-outline btn-success">Submit</button></div>
                    </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>