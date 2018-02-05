<?php
/**
 * allowed.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The view for the editing of the alwaysAllowed list
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.1.0
 */
?>
<style>
.vertTab .yiiTab ul.tabs {width: 200px; border;1px solid #4F81BD; background-color:#4F81BD;}
</style>
<?php

//CVarDumper::dump($controllers, 3, true);
foreach ($controllers as $n=>$controller) {
  $title = $controller["title"];
  $data = array();
  foreach ($controller["actions"] as $key=>$val) {
    $data[$val] = $val;
  }
  if(sizeof($data) > 0) {
    $select = $controller["allowed"];
    // It seems that this tabview conflicts with assign tabview so I raise the tab number by 3
    //$cont[$n+3]["title"] = str_replace("Controller", "", $title);
    //$cont[$n+3]["content"] = SHtml::checkBoxList($title, $select, $data);


    $cont["tab_".$n] = array(
      "title"=>str_replace("Controller", "", $title),
      "content"=>SHtml::checkBoxList($title, $select, $data));
  }
}
?>
<?php echo SHtml::form();?>
<div class="vertTab">
  <?php
  Helper::publishCss($this->module->css);
  $this->widget('system.web.widgets.CTabView',
    array(
    'tabs'=>$cont,
    'cssFile'=>$this->module->getCssUrl(),
  ));
  ?>
</div>
<div class="action" style="margin:10px;">
  <?php echo SHtml::ajaxSubmitButton(Helper::translate("srbac", "Simpan"),
  array('saveAllowed'),
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
  'name'=>'buttonSave','class'=>'btn btn-primary',
  )
  )
  ?>
</div>
<?php echo SHtml::endForm();?>
<!--Adjust tabview height--->
<script type="text/javascript">
  var tabsHeight = $(".tabs").height();
  if(tabsHeight > 260){
    $(".view").height(tabsHeight-16);
  } else {
    $(".view").height(260);
    $(".tabs").attr("style","border-bottom:none");
    
  }
</script>
