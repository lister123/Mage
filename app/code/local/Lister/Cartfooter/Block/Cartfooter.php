<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lister_Cartfooter_Block_Cartfooter extends Mage_Core_Block_Template {
   
    public function AddFoooterData() {     
        $cart = Mage::getModel('checkout/cart')->getQuote();        
        $baseurl = Mage::getBaseUrl();        
        $data='';
        foreach ($cart->getAllItems() as $item) {

            $_prod = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            $footer= $_prod->getFooter_link();
           
            if ($footer == '1') {
                $productname = $_prod->getName();
                $producturl = $_prod->getUrl_path();
                $data.= "<a href='" . $baseurl . "" . $producturl . "'>" . $productname . " has been added to your cart</a></br>";
            }
        }

        return $data;
    }
    
}