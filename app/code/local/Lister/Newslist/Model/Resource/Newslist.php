<?php

class Lister_Newslist_Model_Resource_Newslist extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {

        $this->_init('newslist/news', 'news_id');
        /** _init(modulename/tablename)*/
    }

}
