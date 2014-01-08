<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lister_Customertestimonials_Block_Customertestimonials extends Mage_Core_Block_Template {
  
  public function getUserdetails()
    { 
    if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            /* Get the customer data */
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            /* Get the customer's full name */
            $user['firstname'] = $customer->getFirstname();
            /* Get the customer's last name */
            $user['lastname'] = $customer->getLastname();
            /* Get the customer's email address */
            $user['email'] = $customer->getEmail();
            $customerAddressId = $customer->getDefaultBilling();
            if ($customerAddressId){
                $address = Mage::getModel('customer/address')->load($customerAddressId);
                $user['telephone'] = isset($address->_data['telephone']) ? $address->_data['telephone'] : '' ;
            } 
        }
        return !empty($user)? $user: false;
    }
    
}