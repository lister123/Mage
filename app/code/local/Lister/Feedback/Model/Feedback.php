<?php

class Lister_Feedback_Model_Feedback extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init('feedback/feedback');
    }

    public function savefeedback($postdata) {
        $this->setData($postdata)->save();
        return true;
    }

}

