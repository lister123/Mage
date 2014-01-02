<?php

class Lister_Feedback_Block_Adminhtml_Feedback_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'feedback_id';
        $this->_blockGroup = 'feedback';
        $this->_controller = 'adminhtml_feedback';
        $this->_updateButton('delete', 'label', Mage::helper('feedback')->__('Delete Feedback'));
        $this->_updateButton('save', 'label', Mage::helper('feedback')->__('Save Feedback'));
       
    }

    public function getHeaderText() {
        if (Mage::registry('feedback_data') && Mage::registry('feedback_data')->getId()) {
            return 'Edit Feedback ' . $this->htmlEscape(
                            Mage::registry('feedback_data')->getEmail()) . '<br />';
        }else
         {
             return 'Add Feedback';
         }
    }

}