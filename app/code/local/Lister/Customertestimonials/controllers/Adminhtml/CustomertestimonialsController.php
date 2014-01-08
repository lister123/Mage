<?php
/*
 * Controller class has to be inherited from Mage_Core_Controller_action
 */
class Lister_Customertestimonials_Adminhtml_CustomertestimonialsController extends Mage_Adminhtml_Controller_Action
{
    /*
     * this method privides default action.
     */
  public function indexAction() {
      
    $this->_title($this->__('Customer Testimonials'))->_title($this->__('Manage'));
    $this->loadLayout();
    $this->_setActiveMenu('customertestimonials/index');
    $this->_addBreadcrumb('Customertestimonials', 'manage');
    $this->_addContent($this->getLayout()->createBlock('customertestimonials/adminhtml_customertestimonials'));
    $this->renderLayout();
  }

  public function gridAction() {
    $this->loadLayout();
    $this->getResponse()->setBody(
        $this->getLayout()->createBlock('customertestimonials/adminhtml_customertestimonials')->toHtml()
    );
  }
  public function newAction() {
        $this->_redirect('*/*/edit');
  }
  public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('customertestimonials/userdetails');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customertestimonials')->__('Invalid Testimonial'));
                $this->_redirect('*/*/');
            }
        }
        
        Mage::register('customertestimonials_data', $model);
     
        $this->loadLayout();
        $this->_setActiveMenu('customertestimonials/edit');
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock("customertestimonials/adminhtml_customertestimonials_edit"))->_addLeft($this->getLayout()->createBlock("customertestimonials/adminhtml_customertestimonials_edit_tabs"));
        $this->renderLayout();

    }
    
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost())
        {
            $model = Mage::getModel('customertestimonials/userdetails');
            $id = $this->getRequest()->getParam('testimonial_id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);
 
            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $model->setId($id);
                }
                $model->save();
 
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('customertestimonials')->__('Error saving example'));
                }
 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customertestimonials')->__('Testimonial was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
 
                // The following line decides if it is a "save" or "save and continue"
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
             } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }
             return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('customertestimonials')->__('No data found to save'));
        $this->_redirect('*/*/');
    }
    public function deleteAction()
   {
     $id = $this->getRequest()->getParam('id');
     Mage::getModel('customertestimonials/userdetails')->load($id)->delete();
     $message = 'The testimonial has been deleted.';
     Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('customertestimonials')->__($message));
     $this->_redirect("*/*/index");
     return;
   }
    public function exportCsvAction() {
        $fileName = 'customertestimonials.csv';
        $grid = $this->getLayout()->createBlock('customertestimonials/adminhtml_customertestimonials_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction() {
        $fileName = 'customertestimonials.xml';
        $grid = $this->getLayout()->createBlock('customertestimonials/adminhtml_customertestimonials_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }
    
}