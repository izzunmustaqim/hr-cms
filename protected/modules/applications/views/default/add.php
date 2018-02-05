<div class="page-container">
    <div class="page-header clearfix">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mt-0 mb-5">Application</h4>
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
                        <h3 class="widget-title">Application form</h3>
                    </div>
                    <div class="widget-body">
                        <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="txtMovieTitle">Name</label>
                                    <?php echo $form->textField($model, 'name', array('class' => 'form-control','required' => 'required')); ?>
                                    <?php echo $form->error($model, 'name'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ddlGenge">Category</label>
                                    <?php echo $form->dropDownList($model, 'category_id',CHtml::listData(Category::model()->findAll(array('order' => 'category_id')), 'category_id', 'title'), array('empty'=>' Please select application type ','class'=>'form-control','required' => 'required')); ?>
                                    <?php echo $form->error($model, 'category_id'); ?>
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