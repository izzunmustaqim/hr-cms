<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

	public $layout='';
	public $menu=array();
	public $breadcrumbs=array();
    public $sidemenu=0;

    public function menu() {

        $menu = array(
            'Access Control ( ACL )' => 'srbac@AuthitemManage',
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
                    $li .= '<a href="' . Yii::app()->baseUrl . '/' . strtolower($uri) . '">' . $name . '</a>';
                }
            } else {

            }

        endforeach;

        if ($li != '' AND $firstPage == false) {
            $ulStart = '<ul class="sub-menu" id="' . $id . '">';
            $ulEnd = '</ul>';
        } else if ($firstPage = true) {
            $ulStart = '<ul id="nav">';
            $current = (isset($this->module->id)) ? '' : 'current ';
            $ulStart .= '<a href="' . Yii::app()->baseUrl . '/"><i class="icon-dashboard"></i> Home</a><br>';
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
                }
            }
        }
        return false;
    }

    public function password_encryption($input, $rounds = 7) {
        $salt = "";
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
    }

    public function get_profile_name($name){

        $phrase = "$name";
        echo implode(' ', array_slice(str_word_count($phrase, 2), 0, 2));

    }

    public function padnumber($no){
        $num_padded = sprintf("%04d", $no);
        echo $num_padded;
    }

    public function getData($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die;
    }
}