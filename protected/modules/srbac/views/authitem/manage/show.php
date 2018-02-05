<?php
/**
 * show.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The auth items information view. Also this view is used for deleting
 * confirmation.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.manage
 * @since 1.0.0
 */
 ?>
<?php if($updateList) :?>
<script language="javascript">
  <?php echo SHtml::ajax(array(
  'type'=>'POST',
  'url'=>array('manage'),
  'update'=>'#list',
  )); ?>
</script>
<?php else : ?>
<h2><?php echo AuthItem::$TYPES[$model->type].' | '.$model->name; ?></h2>


<div class="simple">
    <?php if($delete) :?>
    <?php echo Helper::translate('srbac','Anda pasti untuk menghapus item ini?')?>
      <?php echo SHtml::ajaxButton(Helper::translate('srbac','Ya'),
      array('delete','id'=>$model->name),
      array(
      'type'=>'POST',
      'update'=>'#preview'
      ), array('id'=>'deleteButton','class'=>'btn btn-danger')) ?>
    <?php endif ?>
</div>
<?php endif ?>