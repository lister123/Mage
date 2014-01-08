<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Staticblock
 *
 * @author subhasri
 */
class Lister_Staticblock_Block_Staticblock extends Mage_Core_Block_Template {
  
  public function addInformation1()
  {
    $id = Mage::registry('current_product')->getId();
    $currentProduct = Mage::getModel('catalog/product')->load($id);
//    $category = Mage::getSingleton('catalog/layer')
//               ->getCurrentCategory()->getName();
//    $category = $currentProduct->getCategoryIds();
//    $actual_cat = Mage::getModel('catalog/category')->load(17);
    
    $weight = $currentProduct->getWeight();
    $manufacturer = $currentProduct->getAttributeText('manufacturer');
    $sku = $currentProduct->getSku();
  
    
    $values = array(
      'weight' => $weight,
      'manufacturer' => $manufacturer,
      'sku' => $sku
    );
   // $this->helper('staticblock/data')->showme($values);
    return $values;
  }
  
//  public function _prepareLayout()
//  {
//    $this->getLayout()->createBlock('catalog/product_view_attributes')
//    ->append($this->getLayout()->createBlock('staticblock/staticblock'))
//    ->toHtml();
//    return parent::_prepareLayout();
//  }
}

