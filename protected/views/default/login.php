<div class="ks-page">
    <!--<div class="ks-header">
        <a href="#" class="ks-logo">KOSMO</a>
    </div>-->
    <div class="ks-body">
        <!--<div class="ks-logo">KOSMO</div>-->

        <div class="card panel panel-default ks-light ks-panel">
            <div class="card-block">
                <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('class'=>'form-horizontal','autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                    <h4 class="ks-header">Login</h4>
                    <div class="form-group">
                        <div class="input-icon icon-left icon-lg icon-color-primary">
                            <?php echo $form->textField($model, 'username', array('class' => 'form-control','name'=>'username','required'=>'required','placeholder'=>'Email')); ?>
                            <?php echo $form->error($model, 'username'); ?>
                            <span class="icon-addon">
                                <span class="fa fa-at"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon icon-left icon-lg icon-color-primary">
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control','name'=>'password','type'=>'password','required'=>'required','placeholder'=>'Password')); ?>
                            <?php echo $form->error($model, 'password'); ?>
                            <span class="icon-addon">
                                <span class="fa fa-key"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
<!--                    <div class="ks-social">
                        <div>or Log In with social</div>
                        <div>
                            <a href="#" class="facebook fa fa-facebook"></a>
                            <a href="#" class="twitter fa fa-twitter"></a>
                            <a href="#" class="google fa fa-google"></a>
                        </div>
                    </div>-->
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <!--<div class="ks-footer">
        <span class="ks-copyright">&copy; 2016 Kosmo</span>
        <ul>
            <li>
                <a href="#">Privacy Policy</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>-->
</div>

<style>
    .errorMessage, .errorSummary {color: #E5343D !important;font-weight: 400 !important;}
    .error, .errorSummary { border-color: #E5343D !important; }
</style>