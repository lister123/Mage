<?php

class Lister_News_Block_Adminhtml_News_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
   {
      parent::__construct();
      
      $this->setId('newsGrid');
      $this->setDefaultSort('news_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
   }
  
   protected function _prepareCollection()
   {
       
      $collection = Mage::getModel('news/news')->getCollection();
      $this->setCollection($collection);
      
      return parent::_prepareCollection();
   }
   

   protected function _prepareColumns()
   {
       $this->addColumn('news_id', array(
          'header'    => Mage::helper('news')->__('News ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'news_id',
      ));
	   $this->addColumn('title', array(
          'header'    => Mage::helper('news')->__('Title'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'title',
      )); 
          $this->addColumn('category', array(
            'header'    =>  Mage::helper('news')->__('Category'),
            'width'     =>  '100',
            'align'     =>'right',
            'index'     =>  'category',
        ));
	
      $this->addColumn('content', array(
            'header'    =>  Mage::helper('news')->__('Content'),
            'width'     =>  '100',
            'align'     =>'right',
            'index'     =>  'content',
        ));    
		
     
      $this->addExportType('*/*/exportCsv', Mage::helper('news')->__('CSV'));
	  
      return parent::_prepareColumns();
   }
   
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'store'=>$this->getRequest()->getParam('store'),
            'id'=>$row->getId())
        );
    }
}
