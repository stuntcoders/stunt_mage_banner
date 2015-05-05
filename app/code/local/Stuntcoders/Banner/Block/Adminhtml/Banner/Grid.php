<?php

class Stuntcoders_Banner_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('stuntcoders_banner/banner')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('banner_id', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('ID'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'banner_id',
        ));

        $this->addColumn('heading', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Code'),
            'align'     =>'left',
            'index'     => 'code',
        ));

        $this->addColumn('heading', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Title'),
            'align'     =>'left',
            'index'     => 'heading',
        ));

        $this->addColumn('url', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('URL'),
            'align'     =>'left',
            'index'     => 'url',
        ));

        $this->addColumn('text', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Text'),
            'align'     =>'left',
            'index'     => 'text',
        ));

        $this->addColumn('image', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Image'),
            'align'     =>'left',
            'index'     => 'image',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('banners');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('stuntcoders_banner')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('stuntcoders_banner')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('group', array(
            'label'=> Mage::helper('catalog')->__('Assign to group'),
            'url'  => $this->getUrl('*/*/massAssign'),
            'additional' => array(
                'visibility' => array(
                    'name' => 'group',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Assign to group'),
                    'values' => Mage::getModel('stuntcoders_banner/banner_group')->getSelectOptionValues()
                )
            )
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/add', array('id' => $row->getId()));
    }

}
