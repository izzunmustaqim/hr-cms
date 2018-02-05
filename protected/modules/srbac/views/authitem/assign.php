<?php
/**
 * assign.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The Assign tabview view
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.0.0
 */
?>
<style>
select,textarea{border:1px solid #DADADA;}

</style>

<?php $this->breadcrumbs = array(
    'Srbac Assign'
)
?>
<?php if($this->module->getMessage() != ""){ ?>
<div id="srbacError">
  <?php echo $this->module->getMessage();?>
</div>
<?php } ?>
<?php if($this->module->getShowHeader()) {
  $this->renderPartial($this->module->header);
}
?>
<div>
  <?php

  $this->renderPartial("frontpage");

  $tabs = array(
      'tab1'=>array(
      'title'=>'ID Pengguna',
      'view'=>'tabViews/roleToUser',
      ),
      'tab2'=>array(
      'title'=>'Peranan Pengguna',
      'view'=>'tabViews/taskToRole',
      ),
      'tab3'=>array(
      'title'=>'Tugasan',
      'view'=>'tabViews/operationToTask',
      ),
  );
  ?>
  <div class="horTab" style="padding-top:60px;">
    <?php 
    Helper::publishCss($this->module->css);
    $this->widget('system.web.widgets.CTabView',
        array('tabs'=>$tabs,
        'viewData'=>array('model'=>$model,'userid'=>$userid,'message'=>$message,'data'=>$data),
        'cssFile'=>$this->module->getCssUrl(),
    ));
    ?>
  </div>
</div>
<?php if($this->module->getShowFooter()) {
  $this->renderPartial($this->module->footer);
}
?>
