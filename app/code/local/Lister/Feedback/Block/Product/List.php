<?php

class Lister_Feedback_Block_Product_List extends Mage_Catalog_Block_Product_List {

    protected function _getProductCollection() {
echo "gggg";exit;
        if (is_null($this->_productCollection)) {
            $layer = $this->getLayer();
            $productCollection = $layer->getProductCollection();
            $this->_productCollection = $productCollection;
        }
        
        if ($this->getRequest()->getParam('exclude_out_of_stock',0)) {

        $oCollection = Mage::getModel('cataloginventory/stock_item')
            ->getCollection()
            ->addFieldToFilter('is_in_stock',0);

        $oProducts = array();
        foreach($oCollection as $_collection) {
            $oProducts[] = $_collection->getProductId();
        }

        if(!empty($oProducts))
            $this->_productCollection->addIdFilter($oProducts,true);

}
        return $this->_productCollection;
    }
    

}