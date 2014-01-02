<?php

class Lister_Feedback_Block_Adminhtml_Feedback extends Mage_Adminhtml_Block_Widget_Grid_Container {

  public function __construct() {
    $this->_blockGroup = 'feedback';
    $this->_controller = 'adminhtml_feedback';
    $this->_headerText = Mage::helper('feedback')->__('Feedback');
    parent::__construct();
    //$this->_removeButton('add');
  }

}
