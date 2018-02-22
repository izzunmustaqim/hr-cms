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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/joblist" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Job List
                            </a>
                        </li>
<!--                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/job" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Candidate List
                            </a>
                        </li>-->
<!--                      <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/add" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  New Candidate
                            </a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/recruitment/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-plane"></span>  Candidate List
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
                                    <h5 class="card-title">Job Details</h5>
                                    <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>

                                    <div class="form-group row">
                                        <label for="default-input" class="col-sm-2 form-control-label">Department</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->dropDownList($model, 'DepartmentId',CHtml::listData(Tbldepartment::model()->getDepartment(array('order' => 'DeptCatId')), 'DepartmentId', 'DepartmentDesc'), array('empty'=>' Please select department ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'DepartmentId'); ?>
                                        </div>
                                        
                                    </div>   
                                    <div class="form-group row">
										 <label for="default-input" class="col-sm-2 form-control-label">Position</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->dropDownList($model, 'PositionId',CHtml::listData(Tblposition::model()->findAll(array('order' => 'PositionName')), 'PositionId', 'PositionName'), array('empty'=>' Please select position ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'PositionId'); ?>
                                        </div>                                 
  									</div>   
                                   
                                    <div class="form-group row">

                                       <label for="default-input" class="col-sm-2 form-control-label">Employment Type</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->dropDownList($model, 'WorkingStatusId',CHtml::listData(Tblworkingstatus::model()->getEmploymentType(array('order' => 'WorkingStatusId')), 'WorkingStatusId', 'WorkingStatusDesc'), array('empty'=>' Please select working status ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'WorkingStatusId'); ?>
                                        </div>
                                     
                                    </div>
                                    
									<div class="form-group row">
                                   <label for="default-input" class="col-sm-2 form-control-label">Gender</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->dropDownList($model, 'GenderId',CHtml::listData(Tblgender::model()->findAll(array('order' => 'GenderId')), 'GenderId', 'GenderName'), array('empty'=>' Please select gender ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'GenderId'); ?>
                                        </div>
                                     </div>
                                        
                                   <div class="form-group row">
                                       
                                       <label for="disabled-input" class="col-sm-2 form-control-label">Person In Charge</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->dropDownList($model, 'UserId',CHtml::listData(Tbluser::model()->getHrStaff(array('order' => 'FullName')), 'UserId', 'FullName'), array('empty'=>' Please select staff ','class'=>'form-control')); ?>
                                            <?php echo $form->error($model, 'UserId'); ?>
                                        </div>
                                        
                                        <label for="disabled-input" class="col-sm-2 form-control-label">Closing Date</label>
                                        <div class="col-sm-2">
                                           <?php echo $form->textField($model, 'CloseDate', array('class' => 'form-control','data-provide'=>'datepicker')); ?>
                                           <?php echo $form->error($model, 'CloseDate'); ?>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-group row">                                       
                                        
                                        <label for="disabled-input" class="col-sm-2 form-control-label">Job Responsibility</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->textArea($model, 'JobResponsibility', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'JobResponsibility'); ?>
                                        </div>
                                                                                
                                    </div>
                                    
                                    <div class="form-group row">                                       
                                        
                                        <label for="disabled-input" class="col-sm-2 form-control-label">Job Requirements</label>
                                        <div class="col-sm-4">
                                            <?php echo $form->textArea($model, 'JobRequirements', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'JobRequirements'); ?>
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