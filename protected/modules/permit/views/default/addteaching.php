<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Teaching Permit</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="index.html">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Teaching Permit</span>
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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/addworking" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Working Permit
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/working" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Working Permit List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/addteaching" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Teaching Permit
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/permit/default/teaching" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Teaching Permit List
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
                                    <h5 class="card-title">Teaching Permit Details</h5>
                                    <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Name</label>
                                        <div class="col-sm-11">
                                            <?php echo $form->textField($model, 'FullName', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'FullName'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">ID/IC No. </label>
                                        <div class="col-sm-11">
                                            <?php echo $form->textField($model, 'ICPassportNo', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'ICPassportNo'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Department</label>
                                        <div class="col-sm-11">
                                            <?php echo $form->dropDownList($model, 'DepartmentId',CHtml::listData(Tbldepartment::model()->findAll(array('order' => 'DeptCatId')), 'DeptCatId', 'DepartmentDesc'), array('empty'=>' Please select department ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'DepartmentId'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Status</label>
                                        <div class="col-sm-11">
                                            <?php echo $form->dropDownList($model, 'WorkingStatusId',CHtml::listData(Tblworkingstatus::model()->findAll(array('order' => 'WorkingStatusId')), 'WorkingStatusId', 'WorkingStatusDesc'), array('empty'=>' Please select working status ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'WorkingStatusId'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Remarks</label>
                                        <div class="col-sm-11">
                                            <?php echo $form->textArea($model, 'Remarks', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'Remarks'); ?>
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