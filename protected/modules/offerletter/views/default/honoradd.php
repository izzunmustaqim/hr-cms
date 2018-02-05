<div class="ks-container">

    <div class="ks-column ks-page">
        <div class="ks-header">
            <section class="ks-title">
                <h3>Honorific ( New )</h3>

                <div class="ks-controls">
                    <nav class="breadcrumb ks-default">
                        <a class="breadcrumb-item ks-breadcrumb-icon" href="index.html">
                            <span class="fa fa-home ks-icon"></span>
                        </a>
                        <a href="#" class="breadcrumb-item">Dashboard</a>
                        <span class="breadcrumb-item active" href="#">Honorific</span>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <div>
                                        <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>

                                        <div class="form-group row">

                                            <label for="input-group-text" class="5form-control-label">Honorific Name</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'title'); ?>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="input-group-text" class="5form-control-label">Honorific Code</label>
                                            <div class="input-group">
                                                <?php echo $form->textField($model, 'title_code', array('class' => 'form-control')); ?>
                                                <?php echo $form->error($model, 'title_code'); ?>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>

                            </div><p>&nbsp;</p>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
                <p>&nbsp;</p>

            </div>
        </div>
    </div>
</div>

</div>