<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author subhasri
 */
class Lister_Staticblock_IndexController extends Mage_Core_Controller_Front_Action {
  
  public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}
