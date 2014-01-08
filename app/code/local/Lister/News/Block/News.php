<?php
class Lister_News_Block_News extends Mage_Core_Block_Template{
     protected function _construct()   { 
        parent::_construct();
   }
   
   public function getnewslist(){
        $collection = Mage::getModel('news/news')->getCollection();
       var_dump($collection->getData());
        return $collection->getData();
   }
}
