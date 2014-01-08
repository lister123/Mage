<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lister_Footerupdate_Block_Footerupdate extends Mage_Core_Block_Template {

  public function addCustomlinks()
    { 
         $cart = Mage::getModel('checkout/cart')->getQuote();
         $output = '<ul>';
          foreach ($cart->getAllItems() as $item) {
                $product = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
                $footer = $product->getFooter();
                if($footer) 
                    $output .= '<li><a href="'.$product->getProductUrl().'">'.$item->getName() . "</a></li>";
          }
          $output .= '</ul>';
          return $output;
    }
   
}