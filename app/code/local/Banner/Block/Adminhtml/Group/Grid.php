<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerGroupGrid');
        $this->setDefaultSort('group_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('stuntcoders_banner/banner_group')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('group_id', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Group Id'),
            'align'     =>'left',
            'width'     => '50px',
            'index'     => 'group_id',
        ));

        $this->addColumn('code', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Code'),
            'align'     => 'left',
            'index'     => 'code',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('stuntcoders_banner')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('group_id');
        $this->getMassactionBlock()->setFormFieldName('groups');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('stuntcoders_banner')->__('Delete'),
            'url'      => $this->getUrl('*/banner_group/massDelete'),
            'confirm'  => Mage::helper('stuntcoders_banner')->__('Are you sure?')
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/add', array('id' => $row->getId()));
    }
}
