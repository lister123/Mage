<?php

class Lister_Feedback_Model_Resource_OrderDetail extends Mage_Core_Model_Resource_Db_Abstract {
    protected function _construct() {
        $this->_init('feedback/order_details', 'id');
        //modulename/tablename
    }
}
