<?php

class Lister_Newslist_Block_Adminhtml_Newslist_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
      $collection = Mage::getModel('newslist/newslist')->getCollection();
      $this->setCollection($collection);
      
      return parent::_prepareCollection();
   }
   

   protected function _prepareColumns()
   {
       $this->addColumn('news_id', array(
          'header'    => Mage::helper('newslist')->__('News ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'news_id',
      ));
	   $this->addColumn('title', array(
          'header'    => Mage::helper('newslist')->__('Title'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'title',
      )); 
          $this->addColumn('category', array(
            'header'    =>  Mage::helper('newslist')->__('Category'),
            'width'     =>  '100',
            'align'     =>'right',
            'index'     =>  'category',
        ));
	
      $this->addColumn('content', array(
            'header'    =>  Mage::helper('newslist')->__('Content'),
            'width'     =>  '100',
            'align'     =>'right',
            'index'     =>  'content',
        ));    
		
     
      $this->addExportType('*/*/exportCsv', Mage::helper('newslist')->__('CSV'));
      $this->addExportType('*/*/exportExcel', Mage::helper('newslist')->__('Excel XML'));
	  
      return parent::_prepareColumns();
   }
   
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id'=>$row->getId())
        );
    }
    
}
