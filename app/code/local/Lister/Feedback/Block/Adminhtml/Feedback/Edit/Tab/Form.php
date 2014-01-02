<?php

class Lister_Feedback_Block_Adminhtml_Feedback_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('feedback_form', array('legend' => Mage::helper('feedback')->__('Feedback information')));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('feedback')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('email', 'text', array(
            'label' => Mage::helper('feedback')->__('Email'),
            'required' => true,
            'class' => 'required-entry validate-email',
            'name' => 'email',
        ));

        $fieldset->addField('comments', 'text', array(
            'label' => Mage::helper('feedback')->__('Comments'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'comments',
        ));

        if (Mage::registry('feedback_data')) {
            $form->setValues(Mage::registry('feedback_data')->getData());
        }
        return parent::_prepareForm();
    }

}