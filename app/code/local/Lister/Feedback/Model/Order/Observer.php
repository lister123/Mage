<?php

class Lister_Feedback_Model_Order_Observer {

    public function __contruct() {
        
    }
    public function implementOrderStatus(Varien_Event_Observer $observer) {
        Mage::log('!!!!!!!!!!!!!!!!First line of the Observer!!!!!!!!!!!!!!!!');

        $order = $observer->getEvent()->getOrder();
        $date = Mage::getSingleton('core/date');
        $orderDate = $order->getCreatedAtDate();
        $order_details = array(
            //  'id'=>$order->getId(),
            'customer_id' => $order->getCustomerId(),
            'order_id' => $order->getIncrementId(),
            'payment_id' => $order->getPayment()->getId(),
            'blling_address_id' => $order->getBillingAddress()->getId(),
            'created_at' => date("Y-m-d", $date->timestamp($orderDate)),
        );

        try {
            Mage::getModel('feedback/orderDetail')->addorderdetails($order_details);
        } catch (Mage_Core_Exception $e) {
            Mage::logException($e);
        } catch (Exception $e) {
            Mage::logException($e);
        }
        Mage::getSingleton('core/session')
                ->addSuccess('Your order details has been created Successfully.');
        $path = $_SERVER['DOCUMENT_ROOT'] . '/Mage/';
        if (!is_dir($path)) {
            mkdir($path);
        }
        // format order.txt
        $filename = 'order.txt';
        $content =
                'OrderID:' . print_r($order->getIncrementId(), true) .
                'Customer ID:' . print_r($order->getCustomerId(), true) .
                ' RealOrderId:' . print_r($order->getRealOrderId(), true) .
                ' DeliveryMethod:' . print_r($order->getShippingMethod(), true) .
                ' Payment:' . print_r($order->getPayment()->getId(), true) .
                ' Billing ID:' . print_r($order->getBillingAddress()->getId(), true) .
                ' DeliveryAddress:' . print_r($order->getShippingAddress()->getData("street"), true) . ', ' . print_r($order->getShippingAddress()->getData("city"), true) .
                ' BillingAddress:' . print_r($order->getBillingAddress()->getData("street"), true) . ', ' . print_r($order->getShippingAddress()->getData("city"), true) .
                ' Subtotal:' . print_r($order->getSubtotal(), true) .
                ' DeliveryCharge:' . print_r($order->getShippingAmount(), true) .
                ' TotalPaid:' . print_r($order->getTotalPaid(), true) .
                ' TotalDue:' . print_r($order->getTotalDue(), true) .
                ' CustomerNote:' . print_r($order->getCustomerNote(), true) .
                ' PhoneNumber:' . print_r($order->getShippingAddress()->getTelephone(), true) .
                ' Email:' . print_r($order->getCustomerEmail(), true) .
                ' CustomerName:' . print_r($order->getCustomerName(), true) .
                ' Billing Information:' . print_r($this->getOrderBillingInfo($order), true) .
                ' Shipping Information:' . print_r($this->getOrderShippingInfo($order), true) .
                ' Order Line Items:' . print_r($this->getOrderLineDetails($order), true)


        ;


        // write file to server
        file_put_contents($path . $filename, $content);
        Mage::log("!!!!!!!!!!!!!!!!Just made a successful Observer!!!!!!!!!!!!!!!!");
    }

    function getOrderBillingInfo($order) {
        $billingAddress = !$order->getIsVirtual() ? $order->getBillingAddress() : null;
        $address_line1 = "";
        $district = "";

        if (strpos($billingAddress->getData("street"), "\n")) {
            $tmp = explode("\n", $billingAddress->getData("street"));
            $district = $tmp[1];
            $address_line1 = $tmp[0];
        }
        if ($address_line1 == "") {
            $address_line1 = $billingAddress->getData("street");
        }
        return array(
            "billing_name" => $billingAddress ? $billingAddress->getName() : '',
            "billing_company" => $billingAddress ? $billingAddress->getData("company") : '',
            "billing_street" => $billingAddress ? $address_line1 : '',
            "billing_district" => $billingAddress ? $district : '',
            "billing_zip" => $billingAddress ? $billingAddress->getData("postcode") : '',
            "billing_city" => $billingAddress ? $billingAddress->getData("city") : '',
            "billing_state" => $billingAddress ? $billingAddress->getRegionCode() : '',
            "billing_country" => $billingAddress ? $billingAddress->getCountry() : '',
            "billing_telephone" => $billingAddress ? $billingAddress->getData("telephone") : ''
        );
    }

    function getOrderLineDetails($order) {
        $lines = array();
        foreach ($order->getItemsCollection() as $prod) {
            $line = array();
            $_product = Mage::getModel('catalog/product')->load($prod->getProductId());
            $line['sku'] = $_product->getSku();
            $line['order_quantity'] = (int) $prod->getQtyOrdered();
            $lines[] = $line;
        }
        return $lines;
    }

    function getOrderShippingInfo($order) {
        $shippingAddress = !$order->getIsVirtual() ? $order->getShippingAddress() : null;
        $address_line1 = "";
        $district = "";

        if (strpos($shippingAddress->getData("street"), "\n")) {
            $tmp = explode("\n", $shippingAddress->getData("street"));
            $district = $tmp[1];
            $address_line1 = $tmp[0];
        }
        if ($address_line1 == "") {
            $address_line1 = $shippingAddress->getData("street");
        }

        return array(
            "shipping_name" => $shippingAddress ? $shippingAddress->getName() : '',
            "shipping_company" => $shippingAddress ? $shippingAddress->getData("company") : '',
            "shipping_street" => $shippingAddress ? $address_line1 : '',
            "shipping_district" => $shippingAddress ? $district : '',
            "shipping_zip" => $shippingAddress ? $shippingAddress->getData("postcode") : '',
            "shipping_city" => $shippingAddress ? $shippingAddress->getData("city") : '',
            "shipping_state" => $shippingAddress ? $shippingAddress->getRegionCode() : '',
            "shipping_country" => $shippingAddress ? $shippingAddress->getCountry() : '',
            "shipping_telephone" => $shippingAddress ? $shippingAddress->getData("telephone") : ''
        );
    }

}