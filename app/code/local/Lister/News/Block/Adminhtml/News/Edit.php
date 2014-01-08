<?php

class Lister_News_Block_Adminhtml_News_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
   	// WYSIWYG editor - Start	
   	protected function _prepareLayout() {
	    parent::_prepareLayout();
	    if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
	        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
	   	}
	}
	// End of WYSIWYG editor
   public function __construct()
   {
      parent::__construct();
       
      $this->_objectId = 'news_id';
      $this->_blockGroup = 'news';
      $this->_controller = 'adminhtml_news';
       
    }
    
    public function getHeaderText()
    {
       if( Mage::registry('news_data') && Mage::registry('news_data')->getId() ) {
          return Mage::helper('news')->__("Edit News Item '%s'", $this->htmlEscape(Mage::registry('news_data')->getName()));
      } 
      else {
         return Mage::helper('news')->__('Add News Item');
      }
   }
}
?>
