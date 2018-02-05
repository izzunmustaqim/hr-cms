<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Recruitment</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="index.html">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Recruitment</span>
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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/add" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Candidate
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Recruitment List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/integration" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Recruitment Integration
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
                                    <h5 class="card-title">Candidate Details</h5>
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
                                        <div class="col-sm-5">
                                            <?php echo $form->textField($model, 'ICPassportNo', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'ICPassportNo'); ?>
                                        </div>
                                        <label for="disabled-input" class="col-sm-1 form-control-label">D.O.B</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->textField($model, 'UserDOB', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'UserDOB'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Email </label>
                                        <div class="col-sm-5">
                                            <?php echo $form->textField($model, 'EmailAddress', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'EmailAddress'); ?>
                                        </div>
                                        <label for="disabled-input" class="col-sm-1 form-control-label">Mobile</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->textField($model, 'HandSetNo', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'HandSetNo'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-1 form-control-label">Nationality</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->dropDownList($model, 'NationalityId',CHtml::listData(Tblnationality::model()->findAll(array('order' => 'NationalityId')), 'NationalityId', 'NationalityName'), array('empty'=>' Please select nationality ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'NationalityId'); ?>
                                        </div>
                                        <label for="default-input" class="col-sm-1 form-control-label">Religion</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->dropDownList($model, 'ReligionId',CHtml::listData(Tblreligion::model()->findAll(array('order' => 'ReligionId')), 'ReligionId', 'ReligionName'), array('empty'=>' Please select religion ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'ReligionId'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-1 form-control-label">Race</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->dropDownList($model, 'RaceId',CHtml::listData(Tblrace::model()->findAll(array('order' => 'RaceId')), 'RaceId', 'RaceName'), array('empty'=>' Please select race ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'RaceId'); ?>
                                        </div>
                                        <label for="default-input" class="col-sm-1 form-control-label">Gender</label>
                                        <div class="col-sm-5">
                                            <?php echo $form->dropDownList($model, 'Gender',CHtml::listData(Tblgender::model()->findAll(array('order' => 'GenderId')), 'GenderId', 'GenderName'), array('empty'=>' Please select gender ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'Gender'); ?>
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