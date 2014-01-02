<?php
/*
 * Controller class has to be inherited from Mage_Core_Controller_action
 */
class Lister_Cartfooter_IndexController extends Mage_Core_Controller_Front_Action
{
    /*
     * this method privides default action.
     */
    public function indexAction()
    {  
        //var_dump(Mage::getConfig()->getBlockClassName('assignment/assignment'));
        //Get current layout state
        $this->loadLayout();       
        $this->renderLayout();
    }
    
   
}