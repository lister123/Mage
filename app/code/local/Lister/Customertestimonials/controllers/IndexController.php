<?php
/*
 * Controller class has to be inherited from Mage_Core_Controller_action
 */
class Lister_Customertestimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    /*
     * this method privides default action.
     */
    public function indexAction()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            /* Get the customer data */
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            /* Get the customer's full name */
            $firstname = $customer->getFirstname();
            /* Get the customer's last name */
            $lastname = $customer->getLastname();
            /* Get the customer's email address */
            $email = $customer->getEmail();
        }
        //Get current layout state
        $this->loadLayout();
        $this->_initLayoutMessages('core/session');
        $this->renderLayout();
    }
    
    public function createAction()
    {
        $post = $this->getRequest()->getParams();
        if ( $post ) {
            try {
                $error = false;
                if ($error) {
                    throw new Exception();
                }
                $post['status'] = 1;
                $post['created_time'] = time();
                $testimonials = Mage::getModel('customertestimonials/userdetails')->insertData($post);
                $this->_redirect('lister');
                return;
            } catch (Exception $e) {
                $this->_redirect('lister');
                return;
            }
        } else {
            $this->_redirect('lister');
        }

    }
}