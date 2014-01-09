<?php

class Lister_Newslist_Adminhtml_NewslistController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu('sachin/child1');
        /**name of parent menu / name of child menu*/
        return $this;
    }

    public function indexAction() {

        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('newslist/adminhtml_newslist'))
                ->renderLayout();
        
    }

    public function newAction() {
        $this->_redirect("*/*/edit");
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');

        $model = Mage::getModel('newslist/newslist')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('newslist_data', $model);

            $this->loadLayout();

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('newslist/adminhtml_newslist_edit'))
                    ->_addLeft($this->getLayout()->createBlock('newslist/adminhtml_newslist_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('newslist')->__('News item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction() {
        $id = $this->getRequest()->getParam('news_id');
        $data = Mage::getModel('newslist/newslist')->load($id);
        $data->setTitle($this->getRequest()->getParam('title'));
        $data->setCategory($this->getRequest()->getParam('category'));
        $data->setContent($this->getRequest()->getParam('content'));
        $data->save();

        if (isset($id) && is_numeric($id)){
            $message = 'The news item has been updated.';
        }else{
            $message = 'The news item has been added.';
        }
        
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('newslist')->__($message));
        $this->_redirect("*/*/index");
        return;
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        Mage::getModel('newslist/newslist')->load($id)->delete();
        $message = 'The news item has been deleted.';
        Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('newslist')->__($message));
        $this->_redirect("*/*/index");
        return;
    }

  public function exportCsvAction() {
    $fileName = 'newslist.csv';
    $grid = $this->getLayout()->createBlock('newslist/adminhtml_newslist_grid');
    $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
  }

  public function exportExcelAction() {
    $fileName = 'newslist.xml';
    $grid = $this->getLayout()->createBlock('newslist/adminhtml_newslist_grid');
    $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
  }
    
}