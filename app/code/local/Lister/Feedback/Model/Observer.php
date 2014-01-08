<?php

class Lister_Feedback_Model_Observer {


    public function addMenuAttributes(Varien_Event_Observer $observer) {
        $observer->getSelect()->columns(
               array('exclude_out_of_stock')
        );
} 