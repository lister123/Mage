<?php

class Lister_Newslist_Block_Adminhtml_Newslist_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
   protected function _prepareForm()
   {
      $form = new Varien_Data_Form();
      $this->setForm($form);
     
      $fieldset = $form->addFieldset('newslist_form', array('legend'=>Mage::helper('newslist')->__('News Item Information')));
	  $fieldset->addType('hidden_field', 'Lister_Newslist_Block_Adminhtml_Newslist_Edit_Tab_Field_Hidden');


      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('newslist')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
          ));      
	  $fieldset->addField('category', 'text', array(
          'label'     => Mage::helper('newslist')->__('Category'),
          'class'     => 'required-entry',         
          'required'  => true,
          'name'      => 'category',
          ));
	  $fieldset->addField('content', 'textarea', array(
          'label'     => Mage::helper('newslist')->__('Content'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'content',
          ));      
	 
      if (Mage::getSingleton('adminhtml/session')->getEmarketingData()) {
         $form->setValues(Mage::getSingleton('adminhtml/session')->getEmarketingData());
         Mage::getSingleton('adminhtml/session')->setEmarketingData(null);
      } 
      elseif (Mage::registry('newslist_data')) {
         $form->setValues(Mage::registry('newslist_data')->getData());
      }
      return parent::_prepareForm();
   }
}