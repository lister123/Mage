<?php
class Lister_News_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{
   public function __construct()
   {
      $this->_controller = 'adminhtml_news'; // Refers to the block
      $this->_blockGroup = 'news';
      $this->_headerText = Mage::helper('news')->__('News Items');
      //$this->_addButtonLabel = Mage::helper('seo')->__('Details');
      $this->_removeButton('addButton');
      parent::__construct();
   }  
}
