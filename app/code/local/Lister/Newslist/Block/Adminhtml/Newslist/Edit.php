<?php

class Lister_Newslist_Block_Adminhtml_Newslist_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
      $this->_blockGroup = 'newslist';
      $this->_controller = 'adminhtml_newslist';
       
    }
    
    public function getHeaderText()
    {
       if( Mage::registry('newslist_data') && Mage::registry('newslist_data')->getId() ) {
          return Mage::helper('newslist')->__('Edit News'.'%s', $this->htmlEscape(Mage::registry('newslist_data')->getName()));
      } 
      else {
         return Mage::helper('newslist')->__('Add News');
      }
   }
}
?>
