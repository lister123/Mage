<?php

class Lister_Event_Model_Observer {

    public function __construct() {
        
    }

    public function onSave($observer) {
        $product = $observer->getEvent()->getProduct();
        $product_name = $product->getName();
        $url = $product->getUrlKey();
        $sku = $product->getSku();
        if (empty($sku)) {
            $url_key = $url . '-' . $product_name;
            $product->setData('url_key', $url_key);
        } else {
            $url_key = $url . '-' . $sku;
            $product->setData('url_key', $url_key);
        }
    }

}

