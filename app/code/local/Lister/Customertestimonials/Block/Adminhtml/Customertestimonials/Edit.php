<?php

class Lister_Customertestimonials_Block_Adminhtml_Customertestimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   public function __construct()
   {
      parent::__construct();
      $this->_objectId = 'testimonial_id';
      $this->_blockGroup = 'customertestimonials';
      $this->_controller = 'adminhtml_customertestimonials';
    }
}
?>
