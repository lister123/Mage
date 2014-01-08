<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lister_Communitypoll
 *
 * @author adithya
 */
class Lister_Communitypoll_Model_Communitypoll extends Mage_Core_Model_Abstract {

  public function productcatlist() {
    $id = Mage::registry('current_product')->getId();
    $category_id = Mage::registry('current_category')->getId();
    $category_coll = Mage::getModel('catalog/category');
    $category = $category_coll->load($category_id);

    $data = Mage::getModel('catalog/product');
    $product = $data->load($id);
    $price = $data->getPrice();
    $discount = Mage::getStoreConfig('price_config_section/price_config_group/price_config_field');
    $ulimit = $price + ($price * $discount/100);
    $llimit = $price - ($price * $discount/100);
    $products = Mage::getResourceModel('catalog/product_collection')
            ->addCategoryFilter($category)
            ->addAttributeToFilter('price', array('from' => $llimit, 'to' => $ulimit))
            ->addAttributeToFilter('visibility',4)
            ->addAttributeToFilter('entity_id',array('nin' => array($id)))
            ->addAttributeToSelect('visibility')->addAttributeToSelect('name')->addAttributeToSelect('price')->distinct(true);
    return $products;
  }

}

?>
