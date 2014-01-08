<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lister_Customertestimonials_Model_Userdetails extends Mage_Core_Model_Abstract {
    protected function _construct()
    {
        $this->_init('customertestimonials/userdetails');
    }
    
    public function insertData($postdata)
    {
        $write = Mage::getModel('customertestimonials/userdetails')->setData($postdata);
        $write->save();
    }
  
    
}
