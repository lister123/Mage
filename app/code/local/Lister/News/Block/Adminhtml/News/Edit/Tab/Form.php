<?php

class Lister_News_Block_Adminhtml_News_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
      $form = new Varien_Data_Form();
      $this->setForm($form);
     
      $fieldset = $form->addFieldset('news_form', array('legend'=>Mage::helper('news')->__('News Item Information')));
	  $fieldset->addType('hidden_field', 'Lister_News_Block_Adminhtml_News_Edit_Tab_Field_Hidden');

	  $fieldset->addField('news_id', 'hidden_field', array(
          'name'      => 'news_id',
      	  'hiddenvalue' => $this->getRequest()->getParam('id'),
	  ));
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('news')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          ));      
	  $fieldset->addField('category', 'text', array(
          'label'     => Mage::helper('news')->__('Category'),
          'class'     => 'required-entry',         
          'required'  => true,
          'name'      => 'category',
          ));
	  $fieldset->addField('content', 'textarea', array(
          'label'     => Mage::helper('news')->__('Content'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'content',
          ));      
	 
      if (Mage::getSingleton('adminhtml/session')->getEmarketingData()) {
         $form->setValues(Mage::getSingleton('adminhtml/session')->getEmarketingData());
         Mage::getSingleton('adminhtml/session')->setEmarketingData(null);
      } 
      elseif (Mage::registry('news_data')) {
         $form->setValues(Mage::registry('news_data')->getData());
      }
      return parent::_prepareForm();
   }
}