<?php

/**
 * SBaseController class file.
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */
/**
 * SBaseController must be extended by all of the applications controllers
 * if the auto srbac should be used.
 * You can import it in your main config file as<br />
 * 'import'=>array(<br />
 * 'application.modules.srbac.controllers.SBaseController',<br />
 * ),
 *
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.controllers
 * @since 1.0.2
 */
Yii::import("srbac.components.Helper");

class SBaseController extends CController {

  /**
   * Checks if srbac access is granted for the current user
   * @param String $action . The current action
   * @return boolean true if access is granted else false
   */
  protected function beforeAction($action) {
    $del = Helper::findModule('srbac')->delimeter;
    
    //srbac access
    $mod = $this->module !== null ? $this->module->id . $del : "";
    
    $contrArr = explode("/", $this->id);
    $contrArr[sizeof($contrArr) - 1] = ucfirst($contrArr[sizeof($contrArr) - 1]);
    $controller = implode(".", $contrArr);

    $controller = str_replace("/", ".", $this->id);
    // Static pages
    if(sizeof($contrArr)==1){
      $controller = ucfirst($controller);
    }
    if($controller==0){
    	$controller2 = 'default';
    }
   
    /*
    echo $mod;
    echo '-';
    echo $controller;
    echo '-';
    echo  ucfirst($this->action->id);
    echo '-';
    die();
    */
    $access  = $mod . $controller . ucfirst($this->action->id);
    $access2 = $mod . $controller2 . ucfirst($this->action->id);

 //   if (Yii::getVersion() >= "1.1.7") {
//      if (count($this->actionParams) > 0) {
//        $keys = array_keys($this->actionParams);
//        foreach ($keys as $key) {
//          $query = $query . ',' . '$' . $key;
//        }
//
//        $query = substr_replace($query, '', 0, 1);
//        $access = $access . $query;
//      }
//    }
    //Always allow access if $access is in the allowedAccess array

    if (in_array($access, $this->allowedAccess())) {
      return true;
    }
    
    
    //Allow access if srbac is not installed yet
    if (!Yii::app()->getModule('srbac')->isInstalled()) {
      return true;
    }
   
    //Allow access when srbac is in debug mode
    if (Yii::app()->getModule('srbac')->debug) {
      return true;
    }

     // Check for srbac access
        
    if (!Yii::app()->user->checkAccess($access2) || Yii::app()->user->isGuest) {

      $this->onUnauthorizedAccess();
    } else {
      return true;
    }
  }

  /**
   * The auth items that access is always  allowed. Configured in srbac module's
   * configuration
   * @return The always allowed auth items
   */
  protected function allowedAccess() {
    Yii::import("srbac.components.Helper");
  
    return Helper::findModule('srbac')->getAlwaysAllowed();
  }

  protected function onUnauthorizedAccess() {
 
    /**
     *  Check if the unautorizedacces is a result of the user no longer being logged in.
     *  If so, redirect the user to the login page and after login return the user to the page they tried to open.
     *  If not, show the unautorizedacces message.
     */
    if (Yii::app()->user->isGuest) {
      Yii::app()->user->loginRequired();
    } else {
      $mod = $this->module !== null ? $this->module->id : "";
      $access = $mod . ucfirst($this->id) . ucfirst($this->action->id);
      $error["code"] = "403";
      $error["title"] = Helper::translate('srbac', 'You are not authorized for this action');
      $error["message"] = Helper::translate('srbac', 'Error while trying to access') . ' ' . $mod . "/" . $this->id . "/" . $this->action->id . ".";
     
      //You may change the view for unauthorized access
      if (Yii::app()->request->isAjaxRequest) {
        $this->renderPartial(Yii::app()->getModule('srbac')->notAuthorizedView, array("error" => $error));
      } else {
        $this->render(Yii::app()->getModule('srbac')->notAuthorizedView, array("error" => $error));
      }
      return false;
    }
  }
  
  
  
     public function menu() {

        $menu = array(
            'PENGGUNA|group|Pengurusan pengguna|users' => array('Senarai Pengguna' => 'users@DefaultIndex','Daftar Pengguna Baru' => 'users@DefaultAdd','Kawalan Akses' => 'srbac@AuthitemManage'),
            'PERMOHONAN|tags|Application|applications' =>array('Daftar Permohonan' => 'applications@DefaultForm','Senarai Permohonan' => 'applications@DefaultIndex',),
            'PANGKALAN DATA|download-alt|Pengurusan Pangkalan Data|databases' => array('Backup Pangkalan Data' => 'databases@DefaultIndex',),
            'PENJEJAKAN|screenshot|Tracking|tracking' => array('Senarai Penjejakan' => 'tracking@DefaultList',),
            'CARIAN RANTAIAN|search' => array('Senarai Carian Produk' => 'search@DefaultCarianproduk',),
            //'LAPORAN|file|' => array('Permohonan' => 'report@DefaultIndex',),
            'LAPORAN|file|Laporan|report' => array(/*'Produk' => 'report@DefaultProduktouchcode',*/ 'Penjejakan' => 'report@DefaultPenjejakan','Permohonan' => 'report@DefaultStatistik',), //array ('Statistik' => 'report@DefaultStatistik','Jumlah Produk & Touchcode' => 'report@DefaultProduktouchcode', 'Statistik Syarikat' => 'report@DefaultStatistiksyarikat',),),
            'PRODUK|food|Produk|products' => array('Senarai Produk' => 'products@DefaultListserverside',), //products@DefaultList
            'SYARIKAT|building|Syarikat|company' => array('Senarai Syarikat' => 'company@DefaultList',),
            'TRANSAKSI|terminal|Transaksi|audit' => array('Senarai Transaksi' => 'audit@DefaultList',),
        );

        return $this->generateMenu($menu, 0, '');
    }

    public function generateMenu($array, $counter, $id = '') {
        $module = '';


        $user_id = 0;
        $user = Users::model()->find("user_login = '" . Yii::app()->user->id . "'");
        if ($user)
            $user_id = $user->user_id;


        $menuString = '';
        //First level ul  
        if ($counter == 0) {
            $firstPage = true;
        } else {
            $firstPage = false;
        }


        //initiate li
        $li = '';
        //populate the array of link
        foreach ($array as $menu => $link) :

            $counter++;
            //if link is simple, not an array

            $linkString = explode('|', $menu);
            if (is_array($linkString)) {
                $module = isset($linkString[3]) ? $linkString[3] : '';
                $title = isset($linkString[2]) ? $linkString[2] : '';
                $icon = isset($linkString[1]) ? $linkString[1] : '';
                $name = isset($linkString[0]) ? $linkString[0] : '';
            } else {
                $name = $linkString;
                $icon = '';
            }

            if (!is_array($link)) {
                //access@UsersIndex
                //if access granter
                if ($this->checkAccess($link, $user_id)) {
                    $uri = str_replace('@', '', $link);
                    $uri = preg_replace('/([A-Z])/', '/$1', $uri);
                    $li .= '<li>
                          <a class="auto" href="' . Yii::app()->homeUrl . '/' . strtolower($uri) . '">                                                        
                            <i class="i i-dot"></i>

                            <span>' . $name . '</span>
                          </a>
                        </li>';
                }
            } else {
                $liSearch = '';
                $ulId = 'ul_item_' . $counter;
                $liSearch = $this->generateMenu($link, $counter, $ulId);
                if ($liSearch != '') {
                    $active = (isset($this->module->id)) ? (($this->module->id == $module) ? 'current open' : '') : '';
                    $li .= '<li class="' . $active . '"><a title="' . $title . '" href="#" class="auto"> <i class="icon-' . $icon . '"></i>' . $name . '</a>';
                    $li .= $liSearch;
                }
            }

        endforeach;

        if ($li != '' AND $firstPage == false) {
            $ulStart = '<ul class="sub-menu" id="' . $id . '">';
            $ulEnd = '</ul>';
        } else if ($firstPage = true) {
            $ulStart = '<ul id="nav">';
            $current = (isset($this->module->id)) ? '' : 'current ';
            $ulStart .= '<li class="' . $current . '">
        <a href="' . Yii::app()->homeUrl . '">
          <i class="icon-dashboard"></i> Dashboard
        </a>
      </li>';
            $ulEnd = '</ul>';
        } else {
            $ulStart = '';
            $ulEnd = '';
        }
        $menuString = $li;
        if ($li != '')
            return $ulStart . $menuString . $ulEnd;
    }

    public function checkAccess($itemName, $userId) {


        $sql = "SELECT name, type, description, t1.bizrule, t1.data, t2.bizrule AS bizrule2, t2.data AS data2 FROM items t1, assignments t2 WHERE name=itemname AND userid=:userid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindValue(':userid', $userId);

        // check directly assigned items
        $names = array();

        //var_Dump($command->queryAll());


        foreach ($command->queryAll() as $row) {
            $names[] = $row['name'];
        }

        foreach ($names as $name) {
            if ($this->getItemChild($name, $itemName)) {
                return true;
            }
        }

        return false;
    }

    public function getItemChild($name, $link) {
        $connection = Yii::app()->db;
        $sql = "SELECT * FROM itemchildren WHERE parent=:name";
        $command = $connection->createCommand($sql);
        $command->bindValue(':name', $name);

        $tasks = $command->queryAll();

        if ($tasks) {
            foreach ($tasks as $task) {
                $sql2 = "SELECT * FROM itemchildren WHERE parent=:child AND child=:link";
                $command2 = $connection->createCommand($sql2);
                $command2->bindValue(':child', $task['child']);
                $command2->bindValue(':link', $link);
                $action = $command2->queryAll();
                if ($action) {
                    return true;
                    //	var_dump($action);
                    //	echo '<br />';
                    //	echo '<br />';
                }
            }
        }
        return false;
    }
    
    

}

