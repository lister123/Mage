<?php

class Lister_Communitypoll_Block_Communitypoll extends Mage_Core_Block_Template {
  
  public function prod()
    { 
        $products = Mage::getModel('communitypoll/communitypoll')->productcatlist();
        return $products;
        
    }
    
        
}

?>
