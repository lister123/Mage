<?php

class Lister_Customertestimonials_Block_Adminhtml_Customertestimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('Customertestimonials');
        $this->setDefaultSort('testimonial_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    protected function _prepareCollection() {
        $collection = Mage::getModel('customertestimonials/userdetails')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns() {
    $this->addColumn('testimonial_id', array(
      'header' => 'Testimonial ID',
      'align' => 'right',
      'width' => '50px',
      'index' => 'testimonial_id',
    ));
    $this->addColumn('customer_first_name', array(
      'header' => 'Name',
      'align' => 'left',
      'index' => 'customer_first_name',
    ));
    $this->addColumn('customer_first_name', array(
      'header' => 'Name',
      'align' => 'left',
      'index' => 'customer_last_name',
    ));
    $this->addColumn('email', array(
      'header' => 'Customer Email',
      'align' => 'left',
      'index' => 'customer_email',
    ));
    $this->addColumn('customer_phone_number', array(
      'header' => 'Customer Phone',
      'align' => 'left',
      'index' => 'customer_phone_number',
    ));
    $this->addColumn('testimonial', array(
      'header' => 'Testimonial',
      'align' => 'left',
      'index' => 'content',
    ));
    $this->addColumn('status', array(
      'header' => 'Published',
      'align' => 'left',
      'index' => 'status',
    ));
    $this->addExportType('*/*/exportCsv', Mage::helper('customertestimonials')->__('CSV'));
      $this->addExportType('*/*/exportExcel', Mage::helper('customertestimonials')->__('Excel XML'));
    return parent::_prepareColumns();
  }
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}