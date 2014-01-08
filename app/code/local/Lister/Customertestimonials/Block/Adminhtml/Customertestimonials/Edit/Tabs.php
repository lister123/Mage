<?php

class Lister_Customertestimonials_Block_Adminhtml_Customertestimonials_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
   public function __construct()
   {
      parent::__construct();
      $this->setId('customertestimonials_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('customertestimonials')->__('Manage Testimonials'));
   }

   protected function _beforeToHtml()
   {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('customertestimonials')->__('Testimonial Details'),
          'title'     => Mage::helper('customertestimonials')->__('Testimonials'),
          'content'   => $this->getLayout()->createBlock('customertestimonials/adminhtml_customertestimonials_edit_tab_form')->toHtml(),
          ));
      return parent::_beforeToHtml();
   }
}