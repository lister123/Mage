<?php

class Lister_Feedback_Model_Resource_Feedback extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {

        $this->_init('feedback/feedback', 'feedback_id');
    }

}
