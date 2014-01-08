<?php

class Lister_Feedback_Adminhtml_FeedbackController extends Mage_Adminhtml_Controller_Action {

    public function indexAction() {
        $this->_title($this->__('Feedback'))->_title($this->__('Catalog'));
        $this->loadLayout();
        $this->_setActiveMenu('catalog/catalog');
        $this->_addBreadcrumb('Feedback', 'Feedback');
        $this->_addContent($this->getLayout()->createBlock('feedback/adminhtml_feedback'));
        $this->renderLayout();
    }

    public function newAction() {
        $this->_redirect('*/*/edit');
    }

    public function saveAction() {

        if ($data = $this->getRequest()->getPost()) {
            //init model and set data
            $model = Mage::getModel('feedback/feedback');
            if ($id = $this->getRequest()->getParam('feedback_id')) {//the parameter name may be different
                $model->load($id);
            }
            $model->addData($data);
            try {
                //try to save it
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess('Your Feedback is successfully Updated');
                //redirect to grid.
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                //if there is an error return to edit
                Mage::getSingleton('adminhtml/session')->addError('Not Saved. Error:' . $e->getMessage());
                Mage::getSingleton('adminhtml/session')->setExampleFormData($data);
                $this->_redirect('*/*/edit', array('feedback_id' => $mode->getId(), '_current' => true));
            }
        }
    }

    public function editAction() {
        $feedbackId = $this->getRequest()->getParam('feedback_id');
        $feedbackModel = Mage::getModel('feedback/feedback')->load($feedbackId);
        if ($feedbackModel->getId() || $feedbackId == 0) {
            Mage::register('feedback_data', $feedbackModel);
            $this->loadLayout();
            $this->_setActiveMenu('catalog/catalog');
            $this->_addBreadcrumb('feedback Manager', 'feedback Manager');
            $this->_addBreadcrumb('Test Description', 'Test Description');
            $this->getLayout()->getBlock('head')
                    ->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()
                            ->createBlock('feedback/adminhtml_feedback_edit'))
                    ->_addLeft($this->getLayout()
                            ->createBlock('feedback/adminhtml_feedback_edit_tabs')
            );
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')
                    ->addError('Feedback does not exist');
            $this->_redirect('*/*/');
        }
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam('feedback_id') > 0) {
            try {
                $feedbackModel = Mage::getModel('feedback/feedback');
                $feedbackModel->setId($this->getRequest()
                                ->getParam('feedback_id'))
                        ->delete();
                Mage::getSingleton('adminhtml/session')
                        ->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')
                        ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('feedback_id' => $this->getRequest()->getParam('feedback_id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function exportCsvAction() {
        $fileName = 'feedback.csv';
        $grid = $this->getLayout()->createBlock('feedback/adminhtml_feedback_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction() {
        $fileName = 'feedback.xml';
        $grid = $this->getLayout()->createBlock('feedback/adminhtml_feedback_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

}
