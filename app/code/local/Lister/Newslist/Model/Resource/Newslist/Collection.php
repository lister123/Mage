<?php

class Lister_Newslist_Model_Resource_Newslist_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct() {
        $this->_init('newslist/newslist');
    }

}
