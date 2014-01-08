<?php
class Lister_News_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction() {
      $this->loadLayout()
              ->_setActiveMenu('news/news');
      return $this;
   }   
 
   public function indexAction() {
      
      $this->_initAction()
	  	   ->_addContent($this->getLayout()->createBlock('news/adminhtml_news'))
           ->renderLayout();
   }
   public function newAction()
   {
       $this->_redirect("*/*/edit");
   }
   public function editAction() {
      $id     = $this->getRequest()->getParam('id');
      
      $model  = Mage::getModel('news/news')->load($id);
            
      if ($model->getId() || $id == 0) {
         $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
         
         if (!empty($data)) {
            $model->setData($data);
         }
       //  Mage::helper('staticblock/data')->showme($model);
         Mage::register('news_data', $model);
	
         $this->loadLayout();
     
         $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
	
         $this->_addContent($this->getLayout()->createBlock('news/adminhtml_news_edit'))
                 ->_addLeft($this->getLayout()->createBlock('news/adminhtml_news_edit_tabs'));
			
         $this->renderLayout();
      } 
      else {
         Mage::getSingleton('adminhtml/session')->addError(Mage::helper('news')->__('News item does not exist'));
         $this->_redirect('*/*/');
      }
   }
   public function saveAction()
   {
       $id = $this->getRequest()->getParam('news_id');
       $data = Mage::getModel('news/news')->load($id);
       $data->setTitle($this->getRequest()->getParam('title'));
       $data->setCategory($this->getRequest()->getParam('category'));
       $data->setContent($this->getRequest()->getParam('content'));
       $data->save();
       
       if(is_numeric($id))
        $message = 'The news item has been updated.';
      else 
        $message = 'The news item has been added.';
      
       Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('news')->__($message));
       $this->_redirect("*/*/index");
       return;
   }
   
   public function deleteAction()
   {
     $id = $this->getRequest()->getParam('id');
     Mage::getModel('news/news')->load($id)->delete();
     $message = 'The news item has been deleted.';
     Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('news')->__($message));
     $this->_redirect("*/*/index");
     return;
   }
}