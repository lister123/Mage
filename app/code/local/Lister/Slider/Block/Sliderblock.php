<?php

class Lister_Slider_Block_Sliderblock extends Mage_Core_Block_Template {
    
   protected function _construct()   { 
        parent::_construct();
   }
   
   public function displayslider(){

       $this->loadLayout();
       $this->renderLayout(); 
   }
}


