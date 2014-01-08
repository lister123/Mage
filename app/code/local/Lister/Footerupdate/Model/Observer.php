<?php
class Lister_Footerupdate_Model_Observer {

    public function Updatelinks(Varien_Event_Observer $observer)
    {
    $output = "";
      //if ($block = $observer->getLayout()->getBlock('footer')) {
    $layout = $observer->getLayout();

    //$layout->getUpdate()->addUpdate('<remove name="footer_links"/>');
   /* $layout->getUpdate()->addUpdate('<reference name="footer_links">
            <action method="addLink"><label>Contact Us</label><url>contacts</url><title>Contact Us</title><prepare>true</prepare></action>
       </reference>');*/
    $request=$observer->getEvent()->getLayout()->getUpdate()->getHandles();
    if (in_array('checkout_cart_index',$request)) {            
            $layout->getUpdate()->addHandle('footerupdate');
    }
    }
}