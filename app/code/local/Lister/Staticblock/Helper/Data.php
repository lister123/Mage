<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data
 *
 * @author subhasri
 */

class Lister_Staticblock_Helper_Data extends Mage_Core_Helper_Abstract
{
  public function showme($data)
  {
    echo "<pre>";
    print_r($data);
    echo "</pre>"; exit;
  }
  
  public function addInformation() {
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
}