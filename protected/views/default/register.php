<div class="container page-container">
    <div class="page-content">
        <div class="v2">
            <center><div class="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/images/logo/logo.png" class="img-responsive"></div></center>
            <?php if($status==1){?>
                <div class="alert alert-success" role="alert">
                    <strong>Well done!</strong> You have successfully register in the student portal.
                    <p>We send the code authentication to your email. Click <a href="<?php echo Yii::app()->request->baseUrl; ?>/default/login" class="alert-link">here</a> to login</p>
                </div>
            <?php }else if($status==2){?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Either you email / student no is not match.
                    <p>try submitting again <button type="button" class="btn btn-danger btn-xs" onclick="history.go(-1);">here</button></p>
                </div>
            <?php }else {?>
                <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal','autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                <div class="form-group <?php echo $model->hasErrors('email') ? 'has-error' : ''; ?>">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control','required' => 'required','placeholder'=>'Email.')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
                <div class="form-group <?php echo $model->hasErrors('idno') ? 'has-error' : ''; ?>">
                    <div class="col-xs-12">
                        <?php echo $form->textField($model, 'idno', array('class' => 'form-control','required' => 'required','placeholder'=>'Student No.')); ?>
                        <?php echo $form->error($model, 'idno'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <?php $this->endWidget(); ?>
            <?php } ?>
            <p>&nbsp;</p>
            <div class="clearfix">
                <p class="text-muted mb-0 pull-left">Already have an account?</p><a href="<?php echo Yii::app()->request->baseUrl; ?>/default/login" class="inline-block pull-right">Sign In</a>
            </div>
        </div>
    </div>
</div>