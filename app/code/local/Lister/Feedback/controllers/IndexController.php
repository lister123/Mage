<?php

class Lister_Feedback_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
//        $data = array('name' => 'bala','comments'=>"testing ");
//        $id = 1;
//        $model = Mage::getModel('feedback/feedback')->load($id)->addData($data);
//        try {
//            $model->setId($id)->save()->addSuccess("Data updated successfully.");
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
    }

    public function saveAction() {
        $feedback_values = $this->getRequest()->getParams();
        Mage::getModel('feedback/feedback')->savefeedback($feedback_values);
        Mage::getSingleton('core/session')
                ->addSuccess('Your feedback has been added Successfully.');
        $this->_redirect('feedback');
    }

}
