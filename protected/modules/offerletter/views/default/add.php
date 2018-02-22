<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Offer Letter ( New )</h3>

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
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/add" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-calendar-o"></span>  New Offer Letter
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/list" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-database"></span>  Offer Letter List
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/honoradd" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-linode"></span>  New Honorific
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?php echo Yii::app()->baseURL; ?>/offerletter/default/honor" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="ks-icon fa fa-linode"></span>  Honorific List
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ks-nav-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="card">
                                <div class="card-block">
                                    <div>
                                        <?php $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('autocomplete' => 'off', 'enctype' => 'multipart/form-data'))); ?>

                                        <div class="form-group row">

                                            <label for="input-group-text" class="5form-control-label">Title</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'title', CHtml::listData(Tblhrhonorific::model()->findAll(array('order' => 'id')), 'title_code', 'title'), array('empty' => ' Please select Honorific ', 'class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'title'); ?>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Name Of Applicant</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">IC / Passport No</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'passport_no', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'passport_no'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Short Name</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'short_name', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'short_name'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Address 1</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'address1', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'address1'); ?>.
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Address 2</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'address2', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'address2'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">City</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'city', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'city'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">State</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'state', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'state'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Postcode</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'postcode', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'postcode'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Country</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'country_id', CHtml::listData(Tblcountry::model()->findAll(array('order' => 'CountryId')), 'CountryId', 'CountryName'), array('empty' => ' Please select country ', 'class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'country_id'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Status</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'status', array('1' => 'New', '0' => 'Cancel'), array('class' => 'form-control', 'prompt' => 'Please select status')); ?>
                                                <?php echo $form->error($model, 'status'); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><p>&nbsp;</p>
                        </div>

                        <div class="col-lg-5">
                            <div class="card">
                                <div class="card-block">
                                    <div>

                                        <div class="form-group">
                                            <label for="input-group-text" class="col-sm-3 form-control-label">Type</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'offer_type', CHtml::listData(Tblhrmaster::model()->getLetter(array('order' => 'code')), 'id', 'description'), array('empty' => ' Please select letter type ', 'class' => 'form-control')); ?>
                                            </div>
                                        </div>

                                        <div id="prog_level" class="form-group">
                                            <label for="email-2" class="control-label">Program Level</label>
                                            <?php echo $form->dropDownList($model, 'prog_lvlid', array('1' => 'Phd', '2' => 'DBA'), array('class' => 'form-control', 'prompt' => 'Please program level')); ?>
                                            <?php echo $form->error($model, 'prog_lvlid'); ?>
                                        </div>

                                        <div id="sup_contact" class="form-group">
                                            <label for="email-2" class="control-label">Supervisor Contact No</label>
                                            <?php echo $form->textField($model, 'sup_contact', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_contact'); ?>
                                        </div>

                                        <div id="sup_email" class="form-group">
                                            <label for="email-2" class="control-label">Supervisor Email Address</label>
                                            <?php echo $form->textField($model, 'sup_email', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_email'); ?>
                                        </div>

                                        <div id="student_name" class="form-group">
                                            <label for="email-2" class="control-label">Student Name</label>
                                            <?php echo $form->textField($model, 'student_name', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'student_name'); ?>
                                        </div>

                                        <div id="student_id" class="form-group">
                                            <label for="email-2" class="control-label">Student Id</label>
                                            <?php echo $form->textField($model, 'student_id', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'student_id'); ?>
                                        </div>

                                        <div id="letter_title" class="form-group">
                                            <label for="input-group-text" class="col-sm-3 form-control-label">Programmes</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'letter_title', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'letter_title'); ?>
                                            </div>
                                        </div> 

                                        <div id="position" class="form-group">
                                            <label for="input-group-text" class="col-sm-3 form-control-label">Position</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'position_id', CHtml::listData(Tblposition::model()->getPosition(array('order' => 'PositionId')), 'PositionId', 'PositionName'), array('empty' => ' Please select position ', 'class' => 'form-control')); ?>
                                            </div>
                                        </div>  
                                        <div id="unit" class="form-group">
                                            <label for="input-group-text" class="col-sm-3 form-control-label">Position Unit</label>
                                            <div class="input-group">
                                                <?php echo $form->dropDownList($model, 'unitid', CHtml::listData(Tblhrunit::model()->findAll(array('order' => 'unitid')), 'unitid', 'unitname'), array('empty' => ' Please select position unit', 'class' => 'form-control')); ?>
                                            </div>

                                        </div>

                                        <div id="faculty" class="form-group">
                                            <label for="email-2" class="control-label">Faculty / Department</label>
                                            <?php echo $form->dropDownList($model, 'department_id', CHtml::listData(Tbldepartment::model()->findAll(array('order' => 'DeptCatId,DepartmentDesc')), 'DepartmentId', 'DepartmentDesc'), array('empty' => ' Please select faculty / department ', 'class' => 'form-control')); ?>
                                        </div>
                                        <div id="reporting" class="form-group">
                                            <label for="email-2" class="control-label">Reporting To</label>
                                            <?php echo $form->textField($model, 'report_to_id', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'report_to_id'); ?>
                                        </div>

                                        <div id="passport" class="form-group">
                                            <label for="email-2" class="control-label">Passport No.</label>
                                            <?php // echo $form->textField($model, 'passport_no', array('class' => 'form-control')); ?>
                                            <?php // echo $form->error($model, 'passport_no'); ?>
                                        </div>

                                        <div id="salary" class="form-group">
                                            <label for="email-2" class="control-label">Salary</label>
                                            <?php echo $form->textField($model, 'salary', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'salary'); ?>
                                        </div>


                                        <div id="payment_stage" class="alert alert-danger" role="alert">
                                            Supervisor Payment Schedule
                                        </div>

                                        <div id="sup_stage1" class="form-group">
                                            <label for="email-2" class="control-label">Stage 1 : Research Proposal</label>
                                            <?php echo $form->textField($model, 'sup_stage1', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage1'); ?>
                                        </div>

                                        <div id="sup_stage2" class="form-group">
                                            <label for="email-2" class="control-label">Stage 2 : Literature Review</label>
                                            <?php echo $form->textField($model, 'sup_stage2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage2'); ?>
                                        </div>

                                        <div id="sup_stage3" class="form-group">
                                            <label for="email-2" class="control-label">Stage 3 : Research Methodology</label>
                                            <?php echo $form->textField($model, 'sup_stage3', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage3'); ?>
                                        </div>

                                        <div id="sup_stage4" class="form-group">
                                            <label for="email-2" class="control-label">Stage 4 : Data Analysis</label>
                                            <?php echo $form->textField($model, 'sup_stage4', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage4'); ?>
                                        </div>

                                        <div id="sup_stage5" class="form-group">
                                            <label for="email-2" class="control-label">Stage 5 : Conclusion</label>
                                            <?php echo $form->textField($model, 'sup_stage5', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage5'); ?>
                                        </div>

                                        <div id="sup_stage6" class="form-group">
                                            <label for="email-2" class="control-label">Stage 6 : Thesis Submission</label>
                                            <?php echo $form->textField($model, 'sup_stage6', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage6'); ?>
                                        </div>

                                        <div id="sup_stage7" class="form-group">
                                            <label for="email-2" class="control-label">Stage 7 : Satisfactory Completion</label>
                                            <?php echo $form->textField($model, 'sup_stage7', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'sup_stage7'); ?>
                                        </div>

                                        <div id="duration" class="form-group">
                                            <label for="email-2" class="control-label">Payment type</label>
                                            <?php echo $form->dropDownList($model, 'duration_id', array('0' => 'per month', '1' => 'per hour', '2' => 'per duration', '3' => 'per visit'), array('class' => 'form-control', 'prompt' => 'Please select fees type')); ?>
                                            <?php echo $form->error($model, 'duration_id'); ?>
                                        </div>
                                        <div id="duration_extra" class="form-group">
                                            <label for="email-2" class="control-label">Duration</label>
                                            <?php echo $form->textField($model, 'duration_extra', array('class' => 'form-control', 'placeholder' => 'Mondays to Thursdays (4 hours per day)')); ?>
                                            <?php echo $form->error($model, 'duration_extra'); ?>
                                        </div>

                                        <div id="duration_day" class="form-group">
                                            <label for="email-2" class="control-label">Working Days</label> <i>(per week)</i>
                                            <?php echo $form->textField($model, 'duration_day', array('class' => 'form-control', 'placeholder' => '4')); ?>
                                            <?php echo $form->error($model, 'duration_day'); ?>
                                        </div>

                                        <div id="duration_hours" class="form-group">
                                            <label for="email-2" class="control-label">Working Hours</label> <i>(per week)</i>
                                            <?php echo $form->textField($model, 'duration_hours', array('class' => 'form-control', 'placeholder' => '4')); ?>
                                            <?php echo $form->error($model, 'duration_hours'); ?>
                                        </div>

                                        <div id="contract" class="form-group">
                                            <label for="email-2" class="control-label">Notice of Termination</label>
                                            <?php echo $form->dropDownList($model, 'contract_id', array('0' => '2 weeks', '1' => '3 Month'), array('class' => 'form-control', 'prompt' => 'Please select contract term')); ?>
                                            <?php echo $form->error($model, 'contract_id'); ?>
                                        </div>

                                        <div id="dol" class="form-group">
                                            <label for="email-2" class="control-label">Date Of Letter</label>
                                            <?php echo $form->textField($model, 'date_offer', array('class' => 'form-control', 'data-provide' => 'datepicker')); ?>
                                            <?php echo $form->error($model, 'date_offer'); ?>
                                        </div>
                                        <div id="dole" class="form-group">
                                            <label for="email-2" class="control-label">Date Of Letter Expired</label>
                                            <?php echo $form->textField($model, 'date_offer_end', array('class' => 'form-control', 'data-provide' => 'datepicker')); ?>
                                            <?php echo $form->error($model, 'date_offer_end'); ?>
                                        </div>
                                        <div id="docs" class="form-group">
                                            <label for="email-2" class="control-label">Contract Start</label>
                                            <?php echo $form->textField($model, 'date_contract_start', array('class' => 'form-control', 'data-provide' => 'datepicker')); ?>
                                            <?php echo $form->error($model, 'date_contract_start'); ?>
                                        </div>
                                        <div id="doce" class="form-group">
                                            <label for="email-2" class="control-label">Contract End</label>
                                            <?php echo $form->textField($model, 'date_contract_end', array('class' => 'form-control', 'data-provide' => 'datepicker')); ?> 
                                            <?php echo $form->error($model, 'date_contract_end'); ?>
                                        </div>

                                        <div id="external_title" class="form-group">
                                            <label for="email-2" class="control-label">External Title (if any)</label>
                                            <?php echo $form->textField($model, 'external_title', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'external_title'); ?>
                                        </div>

                                        <div id="external_extra" class="form-group">
                                            <label for="email-2" class="control-label">External Extra (if any)</label>
                                            <?php echo $form->textArea($model, 'external_extra', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'external_extra'); ?>
                                        </div>

                                        <div id="advisory_1" class="form-group">
                                            <label for="email-2" class="control-label">Insight regarding</label>
                                            <?php echo $form->textField($model, 'advisory_1', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'advisory_1'); ?>
                                        </div>
                                        <div id="advisory_2" class="form-group">
                                            <label for="email-2" class="control-label">Regulatory examples</label>
                                            <?php echo $form->textField($model, 'advisory_2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'advisory_2'); ?>
                                        </div>
                                        <div id="advisory_3" class="form-group">
                                            <label for="email-2" class="control-label">Benefit example</label>
                                            <?php echo $form->textField($model, 'advisory_3', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'advisory_3'); ?>
                                        </div>

                                        <div id="teachsem" class="form-group">
                                            <label for="email-2" class="control-label">Teach for Semester</label>
                                            <?php echo $form->textField($model, 'tech_semester', array('class' => 'form-control', 'placeholder' => 'May 2017')); ?>
                                            <?php echo $form->error($model, 'tech_semester'); ?>
                                        </div>

                                        <div id="subject_tab" class="alert alert-danger" role="alert">
                                            Subject Details
                                        </div>

                                        <div id="subject_id1" class="form-group">
                                            <label for="email-2" class="control-label">Subject 1</label>
                                            <?php echo $form->textField($model, 'subject_id1', array('class' => 'form-control', 'placeholder' => 'BAPP1113 Ethics in Psychology (20 hours)')); ?>
                                            <?php echo $form->error($model, 'subject_id1'); ?>
                                        </div>

                                        <div id="subject_id2" class="form-group">
                                            <label for="email-2" class="control-label">Subject 2</label>
                                            <?php echo $form->textField($model, 'subject_id2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'subject_id2'); ?>
                                        </div>

                                        <div id="subject_id3" class="form-group">
                                            <label for="email-2" class="control-label">Subject 3</label>
                                            <?php echo $form->textField($model, 'subject_id3', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'subject_id3'); ?>
                                        </div>

                                        <div id="subject_id4" class="form-group">
                                            <label for="email-2" class="control-label">Subject 4</label>
                                            <?php echo $form->textField($model, 'subject_id4', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'subject_id4'); ?>
                                        </div>

                                        <div id="subject_id5" class="form-group">
                                            <label for="email-2" class="control-label">Subject 5</label>
                                            <?php echo $form->textField($model, 'subject_id5', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'subject_id5'); ?>
                                        </div>



                                        <div id="classcode_tab" class="alert alert-danger" role="alert">
                                            Class Code
                                        </div>

                                        <div id="classcode_1" class="form-group">
                                            <label for="email-2" class="control-label">Class Code 1</label>
                                            <?php echo $form->textField($model, 'classcode_1', array('class' => 'form-control', 'placeholder' => '201701F1614 Keyin according to subject you keyin earlier')); ?>
                                            <?php echo $form->error($model, 'classcode_1'); ?>
                                        </div>

                                        <div id="classcode_2" class="form-group">
                                            <label for="email-2" class="control-label">Class Code 2</label>
                                            <?php echo $form->textField($model, 'classcode_2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'classcode_2'); ?>
                                        </div>

                                        <div id="classcode_3" class="form-group">
                                            <label for="email-2" class="control-label">Class Code 3</label>
                                            <?php echo $form->textField($model, 'classcode_3', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'classcode_3'); ?>
                                        </div>

                                        <div id="classcode_4" class="form-group">
                                            <label for="email-2" class="control-label">Class Code 4</label>
                                            <?php echo $form->textField($model, 'classcode_4', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'classcode_4'); ?>
                                        </div>

                                        <div id="classcode_5" class="form-group">
                                            <label for="email-2" class="control-label">Class Code 5</label>
                                            <?php echo $form->textField($model, 'classcode_5', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'classcode_5'); ?>
                                        </div>

                                        <div id="course_tab" class="alert alert-danger" role="alert">
                                            Course Details
                                        </div>

                                        <div id="course_tab_drop" class="form-group">
                                            <label for="email-2" class="control-label">Program</label>
                                            <?php echo $form->dropDownList($model, 'program_id', CHtml::listData(Tblprogram::model()->getProgramList(array('order' => 'ProgramName')), 'ProgramId', 'ProgramName'), array('empty' => ' Please select program ', 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'program_id'); ?>
                                        </div>

                                        <div id="course_tab_drop2" class="form-group">
                                            <label for="email-2" class="control-label">Program</label>
                                            <?php echo $form->dropDownList($model, 'program_id2', CHtml::listData(Tblprogram::model()->getProgramList(array('order' => 'ProgramName')), 'ProgramId', 'ProgramName'), array('empty' => ' Please select program ', 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'program_id2'); ?>
                                        </div>

                                        <div id="course_tab_drop3" class="form-group">
                                            <label for="email-2" class="control-label">Program</label>
                                            <?php echo $form->dropDownList($model, 'program_id3', CHtml::listData(Tblprogram::model()->getProgramList(array('order' => 'ProgramName')), 'ProgramId', 'ProgramName'), array('empty' => ' Please select program ', 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'program_id3'); ?>
                                        </div>

                                        <div id="course_tab_drop4" class="form-group">
                                            <label for="email-2" class="control-label">Program</label>
                                            <?php echo $form->dropDownList($model, 'program_id4', CHtml::listData(Tblprogram::model()->getProgramList(array('order' => 'ProgramName')), 'ProgramId', 'ProgramName'), array('empty' => ' Please select program ', 'class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'program_id4'); ?>
                                        </div>
                                        <div id="service_tab" class="alert alert-danger" role="alert">
                                            Scope of Service
                                        </div>
                                        <div id="service1" class="form-group">
                                            <label for="email-2" class="control-label">Service 1</label>
                                            <?php echo $form->textField($model, 'service1', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'service1'); ?>
                                        </div>
                                        <div id="service2" class="form-group">
                                            <label for="email-2" class="control-label">Service 2</label>
                                            <?php echo $form->textField($model, 'service2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'service2'); ?>
                                        </div>
                                        <div id="service3" class="form-group">
                                            <label for="email-2" class="control-label">Service 3</label>
                                            <?php echo $form->textField($model, 'service3', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'service3'); ?>
                                        </div>
                                        <div id="service4" class="form-group">
                                            <label for="email-2" class="control-label">Service 4</label>
                                            <?php echo $form->textField($model, 'service4', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'service4'); ?>
                                        </div>
                                        <div id="service5" class="form-group">
                                            <label for="email-2" class="control-label">Service 5</label>
                                            <?php echo $form->textField($model, 'service5', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'service5'); ?>
                                        </div>

                                        <div id="cc_tab" class="alert alert-danger" role="alert">
                                            CC To
                                        </div>

                                        <div id="cc_name" class="form-group">
                                            <label for="email-2" class="control-label">Name</label>
                                            <?php echo $form->textField($model, 'cc_name', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_name'); ?>
                                        </div>

                                        <div id="cc_position" class="form-group">
                                            <label for="email-2" class="control-label">Position</label>
                                            <?php echo $form->textField($model, 'cc_position', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_position'); ?>
                                        </div>

                                        <div id="cc_address1" class="form-group">
                                            <label for="email-2" class="control-label">Address 1</label>
                                            <?php echo $form->textField($model, 'cc_address1', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_address1'); ?>
                                        </div>

                                        <div id="cc_address2" class="form-group">
                                            <label for="email-2" class="control-label">Address 2</label>
                                            <?php echo $form->textField($model, 'cc_address2', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_address2'); ?>
                                        </div>

                                        <div id="cc_postcode" class="form-group">
                                            <label for="email-2" class="control-label">Postcode</label>
                                            <?php echo $form->textField($model, 'cc_postcode', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_postcode'); ?>
                                        </div>


                                        <div id="cc_city" class="form-group">
                                            <label for="email-2" class="control-label">City</label>
                                            <?php echo $form->textField($model, 'cc_city', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_city'); ?>
                                        </div>

                                        <div id="cc_state" class="form-group">
                                            <label for="email-2" class="control-label">State</label>
                                            <?php echo $form->textField($model, 'cc_state', array('class' => 'form-control')); ?>
                                            <?php echo $form->error($model, 'cc_state'); ?>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary btn-block">Save Applications</button>

                                    </div>

                                </div>
                            </div>

                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
                <p>&nbsp;</p>

            </div>
        </div>
    </div>
</div>

</div>