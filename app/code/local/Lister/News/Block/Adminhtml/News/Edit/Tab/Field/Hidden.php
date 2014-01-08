<?php
class Lister_News_Block_Adminhtml_News_Edit_Tab_Field_Hidden extends Varien_Data_Form_Element_Abstract{
	 public function __construct($attributes=array())
    {
        parent::__construct($attributes);
    }
    public function getElementHtml()
    {
        $value = $this->getHiddenvalue();
		$name=$this->getName();
        $html = '<input type="hidden" name="'.$name.'" value="'.$value.'" id="' . $this->getHtmlId() . '"'. $this->serialize($this->getHtmlAttributes())."/>";
        $html .= $this->getAfterElementHtml();
        return $html;
    }
}