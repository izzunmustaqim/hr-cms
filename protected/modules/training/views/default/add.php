<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Training</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="index.html">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Training</span>
                    </nav>

                    <button class="btn btn-primary-outline ks-light ks-content-nav-toggle" data-block-toggle=".ks-content-nav > .ks-nav">Menu</button>
                </div>
            </section>
        </div>

        <div class="ks-content">
            <div class="ks-body ks-content-nav">
                <div class="ks-nav">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/training" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/training/default/add" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Training
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/training/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Training List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/training/default/report" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Training Report
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                            <div class="card">
                                <div class="card-block">
                                    <h5 class="card-title">Training</h5>
                                    <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                                        <div class="form-group row">
                                            <label for="disabled-input" class="col-sm-2 form-control-label">Name</label>
                                            <div class="col-sm-10">
                                                <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'title'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="disabled-input" class="col-sm-2 form-control-label">Venue</label>
                                            <div class="col-sm-10">
                                                <?php echo $form->textField($model, 'venue', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'venue'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="disabled-input" class="col-sm-2 form-control-label">Date</label>
                                            <div class="col-sm-10">
                                                <?php echo $form->textField($model, 'date', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'date'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="default-input" class="col-sm-2 form-control-label">Category</label>
                                            <div class="col-sm-10">
                                                <?php echo $form->dropDownList($model, 'type',CHtml::listData(Tblhrtrainingtype::model()->findAll(array('order' => 'id')), 'id', 'title'), array('empty'=>' Please select type ','class'=>'form-control')); ?>
                                                <?php echo $form->error($model, 'type'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" name="submit" class="btn btn-primary btn-block">Save Applications</button>
                                        </div>
                                    <?php $this->endWidget(); ?>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                            <?php $this->endWidget(); ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

</div>