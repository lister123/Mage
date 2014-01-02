<?php

class Lister_Feedback_Model_OrderDetail extends Mage_Core_Model_Abstract {

    protected function _construct() {
         $this->_init('feedback/orderDetail');
         //modulename/filename
    }
    
    public function addorderdetails($orderdetails) {
        $this->setData($orderdetails)->save();
    }
}
