<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_Banners extends Mage_Adminhtml_Block_Widget_Grid
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
        $this->setCollection(
            Mage::getModel('stuntcoders_banner/banner')
                ->getCollection()
                ->addFieldToFilter('group_id', Mage::registry('stuntcoders_banner_group_data')->getId())
        );
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
            'header'    => Mage::helper('stuntcoders_banner')->__('Title'),
            'align'     =>'left',
            'index'     => 'heading',
        ));

        $this->addColumn('code', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Code'),
            'align'     =>'left',
            'index'     => 'code',
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

        $this->addColumn('sort_order', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Sort order'),
            'align'     =>'left',
            'index'     => 'sort_order',
            'editable'  => true,
        ));

        return parent::_prepareColumns();
    }
}
