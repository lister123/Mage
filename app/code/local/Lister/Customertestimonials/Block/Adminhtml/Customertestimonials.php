<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lister_Customertestimonials_Block_Adminhtml_Customertestimonials extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
      $this->_blockGroup = 'customertestimonials';
      $this->_controller = 'adminhtml_customertestimonials';
      $this->_headerText = Mage::helper('customertestimonials')->__('Customertestimonials');
      parent::__construct();
      $this->_removeButton('add');
    }
    
   /*protected function _prepareLayout(){
       $this->setChild( 'grid',
       $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
       $this->_controller . '.grid')->setSaveParametersInSession(true) );
       return parent::_prepareLayout();
   }*/

}