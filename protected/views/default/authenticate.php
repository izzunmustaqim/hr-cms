<div class="container page-container">
    <div class="page-content">
        <div class="v2">
            <div class="logo"><img src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/build/images/logo/logo.png" alt=""></div>
            <?php if($status==1){?>
                <div class="alert alert-success" role="alert">
                    <strong>Well done!</strong> You have successfully update your password.
                    <p>You can login now. Click <a href="<?php echo Yii::app()->request->baseUrl; ?>/default/login" class="alert-link">here</a> to login</p>
                </div>
            <?php }else if($status==2){?>
                <div class="alert alert-danger" role="alert">
                    <strong>Oh snap!</strong> Either you email / student no is not match.
                    <p>try submitting again <button type="button" class="btn btn-danger btn-xs" onclick="history.go(-1);">here</button></p>
                </div>
            <?php }else {?>
                <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal','autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                <div class="form-group <?php echo $model->hasErrors('password') ? 'has-error' : ''; ?>">
                    <?php echo $form->textField($model, 'password', array('class' => 'form-control','required' => 'required','placeholder'=>'Password.')); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
                <div class="form-group <?php echo $model->hasErrors('password_confirm') ? 'has-error' : ''; ?>">
                    <div class="col-xs-12">
                        <?php echo $form->textField($model, 'password_confirm', array('class' => 'form-control','required' => 'required','placeholder'=>'Confirm Password.')); ?>
                        <?php echo $form->error($model, 'password_confirm'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                <?php $this->endWidget(); ?>
            <?php } ?>
            <p>&nbsp;</p>
            <div class="clearfix">
                <p class="text-muted mb-0 pull-left">Already have an account?</p><a href="<?php echo Yii::app()->request->baseUrl; ?>/default/login" class="inline-block pull-right">Sign In</a>
            </div>
        </div>
    </div>
</div>

<style>
    .errorMessage, .errorSummary {color: #E5343D !important;font-weight: 400 !important;}
    .error, .errorSummary { border-color: #E5343D !important; }
</style>