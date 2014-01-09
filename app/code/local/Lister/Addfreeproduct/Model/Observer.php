<?php

class Lister_Addfreeproduct_Model_Observer {

    CONST SKUTOADD = 'Polo-T- Shirts';

    public function processfreeproduct($observer) {       
        $quote = Mage::getSingleton('checkout/cart')->getQuote();
        $store = Mage::app()->getStore($quote->getStoreId());

       
       // $applied_rules = $quote->getAppliedRuleIds();
        /*  $rules = Mage::getModel('salesrule/rule')
          ->getCollection()
          ->setValidationFilter($store->getWebsiteId(), $quote->getCustomerGroupId(), $quote->getCouponCode())
          ->addFieldToFilter('rule_id', array('in' => array($applied_rules)))
          ->load(); */
        $rules = Mage::getModel('salesrule/rule')
                ->getCollection()
                ->setValidationFilter($store->getWebsiteId(), $quote->getCustomerGroupId(), $quote->getCouponCode())
                ->addFieldToFilter('name', array('like' => array('%free product%')))
                ->load();
        
        foreach ($rules as $rule) {
            $rule->load($rule->getId());
        }
        /* $conditions = unserialize($rule->getConditionsSerialized());
         */
      //  $conditions = $rule->getConditions();
        $conditions = $rule->getConditions()->asArray();

        foreach ($conditions['conditions'] as $_conditions):
            foreach ($_conditions['conditions'] as $_condition):
                $sku = $_condition['value'];
            endforeach;
        endforeach;

        foreach ($quote->getAllItems() as $item) {
            $_prod = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            $cartsku[] = $_prod->getSku();
        }

        $lastaddedproductid = Mage::getSingleton('checkout/session')->getLastAddedProductId();
        $lastaddedproduct = Mage::getModel('catalog/product')->load($lastaddedproductid);

        if ((in_array($sku, $cartsku)) && (!in_array(self::SKUTOADD, $cartsku))) {
            $product_model = Mage::getModel('catalog/product');
            $productid = $product_model->getIdBySku(self::SKUTOADD);
            $my_product = $product_model->load($productid);
            //  $my_product->setPrice(0);
            $qty_value = 1;
            $cart1 = Mage::getModel('checkout/cart');
            $cart1->addProduct($my_product, array('qty' => $qty_value));
            $cart1->save();
        } else if ((!in_array($sku, $cartsku)) && ($lastaddedproduct->getSku() != self::SKUTOADD)) {
            foreach ($quote->getAllItems() as $item) {
                $_prod = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
                if ($_prod->getSku() == self::SKUTOADD)
                    $quote->removeItem($item->getId())->save();
            }
        }
    }

    public function setdiscountamountbefore($observer) {
        $quote = $observer->getEvent()->getQuote();

        $store = Mage::app()->getStore($quote->getStoreId());
        $quoteid = $quote->getId();
        $rules = Mage::getModel('salesrule/rule')
                ->getCollection()
                ->setValidationFilter($store->getWebsiteId(), $quote->getCustomerGroupId(), $quote->getCouponCode())
                ->addFieldToFilter('name', array('like' => array('%free product%')))
                ->load();
        foreach ($rules as $rule) {
            $rule->load($rule->getId());
        }
        /* $conditions = unserialize($rule->getConditionsSerialized());
         */
        $conditions = $rule->getConditions();
        $conditions = $rule->getConditions()->asArray();

        foreach ($conditions['conditions'] as $_conditions):
            foreach ($_conditions['conditions'] as $_condition):
                $sku = $_condition['value'];
            endforeach;
        endforeach;


        foreach ($quote->getAllItems() as $item) {
            $_prod = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
            $cartsku[] = $_prod->getSku();
        }


        if ((in_array($sku, $cartsku)) && (in_array(self::SKUTOADD, $cartsku))) {
            foreach ($quote->getAllItems() as $item) {
                $sku = $item->getSku();
                if ($sku == self::SKUTOADD) {
                    $item->setCustomPrice(0);
                    $item->setOriginalCustomPrice(0);
                    //$item->getProduct()->setIsSuperMode(true);
                }
            }
        }
    }

    /*
      public function removefreeproduct($observer) {
      Mage::log('in remove');
      $delete_product = $observer->getQuoteItem()->getProduct();

      // Get all related products
      $related_products = $delete_product->getRelatedProductCollection();

      // get all related product id and save in array
      $related_product_ids = array();
      foreach ($related_products as $product) {
      echo "<pre>";
      print_r($product->getProduct());

      $related_product_ids[] = $product->getId(); // double check to make sure this product_id
      }

      Mage::log(print_r($related_product_ids, true));
      exit;
      } */

    /*
      public function setdiscountamount($observer) {

      $quote = $observer->getEvent()->getQuote();
      $quoteid = $quote->getId();
      $sku = 'oc_sm';
      foreach ($quote->getAllItems() as $item) {
      //$_prod = Mage::getModel('catalog/product')->load($item->getProduct()->getId());
      $sku = $item->getSku();
      if ($sku == 'oc_sm') {
      //     $price = $item->getPrice();
      //  $discountAmount = $price * $item->getQty();
      //$item->setCustomPrice(0);
      // $item->setOriginalCustomPrice(0);
      // $item->getProduct()->setIsSuperMode(true);
      }
      }

      if ($quoteid) {
      if ($discountAmount > 0) {
      $total = $quote->getBaseSubtotal();
      $quote->setSubtotal(0);
      $quote->setBaseSubtotal(0);

      $quote->setSubtotalWithDiscount(0);
      $quote->setBaseSubtotalWithDiscount(0);

      $quote->setGrandTotal(0);
      $quote->setBaseGrandTotal(0);



      $canAddItems = $quote->isVirtual() ? ('billing') : ('shipping');
      foreach ($quote->getAllAddresses() as $address) {

      $address->setSubtotal(0);
      $address->setBaseSubtotal(0);

      $address->setGrandTotal(0);
      $address->setBaseGrandTotal(0);

      $address->collectTotals();

      $quote->setSubtotal((float) $quote->getSubtotal() + $address->getSubtotal());
      $quote->setBaseSubtotal((float) $quote->getBaseSubtotal() + $address->getBaseSubtotal());

      $quote->setSubtotalWithDiscount(
      (float) $quote->getSubtotalWithDiscount() + $address->getSubtotalWithDiscount()
      );
      $quote->setBaseSubtotalWithDiscount(
      (float) $quote->getBaseSubtotalWithDiscount() + $address->getBaseSubtotalWithDiscount()
      );

      $quote->setGrandTotal((float) $quote->getGrandTotal() + $address->getGrandTotal());
      $quote->setBaseGrandTotal((float) $quote->getBaseGrandTotal() + $address->getBaseGrandTotal());

      $quote->save();



      if ($address->getAddressType() == $canAddItems) {
      //echo $address->setDiscountAmount; exit;
      $address->setSubtotalWithDiscount((float) $address->getSubtotalWithDiscount() - $discountAmount);
      $address->setGrandTotal((float) $address->getGrandTotal() - $discountAmount);
      $address->setBaseSubtotalWithDiscount((float) $address->getBaseSubtotalWithDiscount() - $discountAmount);
      $address->setBaseGrandTotal((float) $address->getBaseGrandTotal() - $discountAmount);
      if ($address->getDiscountDescription()) {
      $address->setDiscountAmount(-($address->getDiscountAmount() - $discountAmount));
      $address->setDiscountDescription($address->getDiscountDescription() . ', Custom Discount');
      $address->setBaseDiscountAmount(-($address->getBaseDiscountAmount() - $discountAmount));
      } else {
      $address->setDiscountAmount(-($discountAmount));
      $address->setDiscountDescription('Custom Discount');
      $address->setBaseDiscountAmount(-($discountAmount));
      }
      $address->save();
      }
      }
      }
      }
      } */
}