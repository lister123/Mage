<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Frontnews
 *
 * @author rahul
 */
class Lister_Newslist_FrontnewsController  extends Mage_Core_Controller_Front_Action{
  
    public function displayFrontNewsAction(){
       $this->loadLayout();
       $this->renderLayout(); 
    }
    
    
}


