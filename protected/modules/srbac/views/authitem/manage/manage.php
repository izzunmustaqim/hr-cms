<?php
/**
 * manage.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The auth items main administration page
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.manage
 * @since 1.0.0
 */
 ?>
<?php $this->breadcrumbs = array(
    'Srbac Manage'
)
?>
<style>
	.i-con {font-size:30px;}
	a .i-con {margin:5px;}
</style>
<?php if($this->module->getMessage() != ""){ ?>
<div id="srbacError">
  <?php echo $this->module->getMessage();?>
</div>
<?php } ?>
<?php if(!$full){
    if($this->module->getShowHeader()) {
      $this->renderPartial($this->module->header);
    }
    $this->renderPartial("frontpage");
?>
<div id="wizardButton" style="text-align:left; padding-top:40px;" class="marginBottom">
  <?php echo SHtml::ajaxLink(
               '<i title="Senarai item" class="i-con icon-cog"></i>',
                array('manage','full'=>true),
                array(
                    'type'=>'POST',
                    'update'=>'#wizard',
                    'beforeSend' => 'function(){
                                      $("#wizard").addClass("srbacLoading");
                                  }',
                    'complete' => 'function(){
                                      $("#wizard").removeClass("srbacLoading");
                                  }',
                ),
                array(
                    'name'=>'buttonManage',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
<?php echo SHtml::ajaxLink(
                '<i title="Daftar item secara automatik" class="i-con icon-plus"></i>',
                array('auto'),
                array(
                    'type'=>'POST',
                    'update'=>'#wizard',
                    'beforeSend' => 'function(){
                                      $("#wizard").addClass("srbacLoading");
                                  }',
                    'complete' => 'function(){
                                      $("#wizard").removeClass("srbacLoading");
                                  }',
                ),
                array(
                    'name'=>'buttonAuto',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
  <?php echo SHtml::ajaxLink(
               '<i title="Halaman umum" class="i-con icon-thumbs-up-alt"></i>',
                array('editAllowed'),
                array(
                    'type'=>'POST',
                    'update'=>'#wizard',
                    'beforeSend' => 'function(){
                                      $("#wizard").addClass("srbacLoading");
                                  }',
                    'complete' => 'function(){
                                      $("#wizard").removeClass("srbacLoading");
                                  }',
                ),
                array(
                    'name'=>'buttonAllowed',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
  <?php echo SHtml::ajaxLink(
               '<i title="Hapus halaman tidak terpakai" class="i-con icon-trash"></i>',
                array('clearObsolete'),
                array(
                    'type'=>'POST',
                    'update'=>'#wizard',
                    'beforeSend' => 'function(){
                                      $("#wizard").addClass("srbacLoading");
                                  }',
                    'complete' => 'function(){
                                      $("#wizard").removeClass("srbacLoading");
                                  }',
                ),
                array(
                    'name'=>'buttonClear',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
</div>
<br />
<?php } ?>
<div id="wizard">
  <table class="srbacDataGrid" align="center">
    <tr>
      <th width="50%"><?php echo Helper::translate("srbac","Item");?></th>
      <th><?php echo Helper::translate('srbac','Tindakan')?></th>
    </tr>
    <tr>
      <td style="vertical-align: top;text-align: center">
        <div id="list">
            <?php echo $this->renderPartial('manage/list', array(
                    'models'=>$models,
                    'pages'=>$pages,
                    'sort'=>$sort,
                    )); ?>
        </div>
      </td>
      <td style="vertical-align: top;text-align: center">
        <div id="preview">

        </div>
      </td>
    </tr>
  </table>
</div>
<?php if(!$full) {
  if($this->module->getShowFooter()) {
    $this->renderPartial($this->module->footer);
  }
}?>
