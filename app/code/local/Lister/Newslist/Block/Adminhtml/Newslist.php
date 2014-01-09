<?php
class Lister_Newslist_Block_Adminhtml_Newslist extends Mage_Adminhtml_Block_Widget_Grid_Container
{
   public function __construct()
   {
      $this->_controller = 'adminhtml_newslist'; // Refers to the block
      $this->_blockGroup = 'newslist';
      $this->_headerText = Mage::helper('newslist')->__('News Items');
      //$this->_addButtonLabel = Mage::helper('seo')->__('Details');
      //$this->_removeButton('addButton');
      parent::__construct();
   }  
}
