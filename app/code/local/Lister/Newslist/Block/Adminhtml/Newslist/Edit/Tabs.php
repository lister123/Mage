<?php

class Lister_Newslist_Block_Adminhtml_Newslist_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
   public function __construct()
   {
      parent::__construct();
     
      $this->setId('newslist_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('newslist')->__('News Item Information'));
   }

   protected function _beforeToHtml()
   {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('newslist')->__('News Item Data'),
          'title'     => Mage::helper('newslist')->__('News Item'),
          'content'   => $this->getLayout()->createBlock('newslist/adminhtml_newslist_edit_tab_form')->toHtml(),
          ));

      return parent::_beforeToHtml();
   }
}