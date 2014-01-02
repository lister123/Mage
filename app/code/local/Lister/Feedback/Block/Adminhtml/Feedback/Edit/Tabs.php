<?php

class Lister_Feedback_Block_Adminhtml_Feedback_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('feedback_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('feedback')->__('Feedback Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('feedback')->__('Feedback Information'),
            'title' => Mage::helper('feedback')->__('Feedback Information'),
            'content' => $this->getLayout()->createBlock('feedback/adminhtml_feedback_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}