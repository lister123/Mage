<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of frontendblock
 *
 * @author rahul
 */
class Lister_Newslist_Block_Frontendblock extends Mage_Core_Block_Template {
    
   protected function _construct()   { 
        parent::_construct();
   }
   
   public function getnewslist(){
        $collection = Mage::getModel('newslist/newslist')->getCollection();
 //var_dump($collection->getData());exit;
        return $collection->getData();
   }
}


