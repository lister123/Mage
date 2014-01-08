<?php

class Lister_Slider_Model_Observer {

  public function addBlockSlide(Varien_Event_Observer $observer) {
    $layout = $observer->getEvent()->getLayout()->getUpdate();
    $layout->addHandle('sliderblock');
    return $this;
  }

}
