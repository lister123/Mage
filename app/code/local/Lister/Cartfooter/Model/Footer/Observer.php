<?php

class Lister_Cartfooter_Model_Footer_Observer {

  /*  public function __construct() {
        
    }*/

    public function Productaddafter($observer) {                     
         $update = $observer->getEvent()->getLayout()->getUpdate();         
         $request=$update->getHandles();
        if (in_array('checkout_cart_index',$request)) {            
            $update->addHandle('custom_block');
        }       
        return $this;
    }

}