<?php
/**
 * clearObsolete.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * A view for deleting authItems of controllers that no longer exist
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem.manage
 * @since 1.1.1
 */
?>
<?php if ($items) { ?>

<div style="margin:10px" id="obsoleteList">
  <table class="srbacDataGrid" style="width:50%">
    <tr><th>
          <?php echo Helper::translate("srbac","Item tanpa Controller"); ?>
      </th>
    <tr>
    <tr><td>
        <div class="srbacForm">
            <?php echo SHtml::beginForm()?>
          <div>
              <?php echo SHtml::checkBoxList("items", "", $items, array("checkAll"=>Helper::translate('srbac','Pilih semua')));?>
          </div>
          <div class="action">
              <?php echo SHtml::ajaxButton(Helper::translate('srbac', 'Hapus'),
              array("deleteObsolete"),
              array(
              'type'=>'POST',
              'update'=>'#obsoleteList',
              'beforeSend' => 'function(){
         $("#wiobsoleteListzard").addClass("srbacLoading");
        }',
              'complete' => 'function(){
        $("#obsoleteList").removeClass("srbacLoading");
       }',
              ),
              array(
              'name'=>'buttonSave','class'=>'btn btn-primary',
              ));?>
          </div>
            <?php echo SHtml::endForm()?>
        </div>
      </td>
    </tr>

  </table>
</div>

  <?php } else { ?>
<table class="srbacDataGrid" style="width:50%">
  <tr>
    <th>
        <?php echo Helper::translate("srbac", "Tiada item ditemui");?>
    </th>
  </tr>
</table>
  <?php }?>
