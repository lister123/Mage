<?php

class Lister_Feedback_Block_Adminhtml_Feedback_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('feedbackGrid');
        $this->setDefaultSort('feedback_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        // $this->setUseAjax(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('feedback/feedback')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('feedback_id', array(
            'header' => 'ID',
            'align' => 'right',
            'width' => '50px',
            'index' => 'feedback_id',
        ));
        $this->addColumn('name', array(
            'header' => 'Name',
            'align' => 'left',
            'index' => 'name',
        ));
        $this->addColumn('email', array(
            'header' => 'Email',
            'align' => 'left',
            'index' => 'email',
        ));
        $this->addColumn('comments', array(
            'header' => 'Comments',
            'align' => 'left',
            'index' => 'comments',
        ));
        $this->addColumn('action', array(
            'header' => Mage::helper('feedback')->__('Action - Edit'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
                array(
                    'caption' => Mage::helper('feedback')->__('Edit'),
                    'url' => array('base' => '*/*/edit'),
                    'field' => 'feedback_id'
                ),
               
            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'feedback_id',
            'is_system' => true,
        ));
        $this->addColumn('actions', array(
            'header' => Mage::helper('feedback')->__('Action - Delete'),
            'width' => '100',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(
               
                array(
                        'caption' => Mage::helper('feedback')->__('Delete'),
                        'url'     => $this->getUrl("*/*/delete"),
                        'field'   => 'feedback_id'
                        )

            ),
            'filter' => false,
            'sortable' => false,
            'index' => 'feedback_id',
            'is_system' => true,
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('feedback_id' => $row->getId()));
    }

}