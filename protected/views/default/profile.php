<div class="page-container">
<div class="page-header clearfix">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mt-0 mb-5">Profile</h4>
            <p class="text-muted mb-0">student profile</p>
        </div>
        <div class="col-sm-6">
        </div>
    </div>
</div>
<div class="page-content container-fluid">
<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-body">
                <?php
                foreach($data as $data){

                    $image = Tblstudentimages::model()->find("StudentId ='" .Yii::app()->user->getState('UserID')."'");
                ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" style="text-align: center">
                                <?php if($image['ImageData']!=NULL){ echo '<img src="data:image/jpeg;base64,'.base64_encode( $image['ImageData'] ).'" width="200"/>';} else {?><img src = "http://localhost/student/mysql_blob/imagesupload.jpg" class = "img-thumbnail"><?php } ?>
                                <p>&nbsp;</p><p><span class="label label-success"> Active </span></p>

                            </div>

                            <?php if($image['ApprovalStatusId']==0){?>
                            <hr>
                            <?php $form = $this->beginWidget('CActiveForm',array('htmlOptions'=>array('id'=>'uploadForm','class'=>'form-horizontal','autocomplete'=>'off','enctype'=>'multipart/form-data'))); ?>
                            <label>Upload Profile Image:</label><br/>
                                <?php echo CHtml::fileField('Tblstudentimages[sl_path]', '', array('id'=>'sl_path','class' => 'form-control')); ?><br>
                                <input type="submit" value=" Upload " class="btnSubmit" />
                                <input type="hidden" name="img" value="1">
                            <?php $this->endWidget(); ?>
                            <?php } ?>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget">
                                        <div class="widget-heading">
                                            <h3 class="widget-title">Personal Details</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="txtMovieTitle">Name</label>
                                <input id="txtMovieTitle" type="text" class="form-control" value="<?php echo $data['StudName']?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtDirector">NRIC/PassportNo</label>
                                        <input id="txtDirector" type="text" class="form-control" value="<?php echo $data['StudNRICPassportNo']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtWriter">Student No</label>
                                        <input id="txtWriter" type="text" class="form-control" value="<?php echo $data['StudentNo']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="txtProducer">Birthdate</label>
                                        <input id="txtProducer" type="text" class="form-control" value="<?php echo $data['StudDateOfBirth']?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtProducer">Email</label>
                                        <input id="txtProducer" type="text" class="form-control" value="<?php echo $data['StudEmail']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtYoutubeTrailer">Mobile No.</label>
                                        <input id="txtYoutubeTrailer" type="text" class="form-control" value="<?php echo $data['StudMobileNo']?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtProducer">Program Code</label>
                                        <input id="txtProducer" type="text" class="form-control" value="<?php echo $data['ProgramCode']?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtYoutubeTrailer">Program Name</label>
                                        <input id="txtYoutubeTrailer" type="text" class="form-control" value="<?php echo $data['ProgramName']?>" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget">
                                        <div class="widget-heading">
                                            <h3 class="widget-title">Change Password</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtYoutubeTrailer">New Password</label>
                                        <input id="newpassword" name="newpassword" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtWebsite">Confirm Password</label>
                                        <input id="confirmpassword" name="confirmpassword" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="text-align: right">
                                    <button id="changepassword" type="button" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">

    $('#changepassword').click( function() {

        var newpassword = $('#newpassword').val();
        var confirmpassword = $('#confirmpassword').val();

        if(confirmpassword!="" && newpassword!=""){
            var user_id = <?php echo Yii::app()->user->getState('UserID'); ?>;
            if (confirm("Are you sure want to change password?")) {
                $.ajax({
                    url: "<?php echo $this->createUrl("changepassword"); ?>/confirm/"+confirmpassword+"/new/"+newpassword,
                    type: "POST",
                    data: { user_id: user_id}
                }).done(function(data) {
                    if(data==1){
                        alert("You have successfully change your password");
                    }
                    if(data==2){
                        alert("your new password not match. Please check again");
                    }
                });
            }
        }else{
            alert("Please fill in old and new password to change password");
        }
    });

</script>
