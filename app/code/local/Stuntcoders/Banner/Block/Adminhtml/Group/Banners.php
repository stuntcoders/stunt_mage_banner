<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_Banners extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(
            Mage::getModel('stuntcoders_banner/banner')
                ->getCollection()
                ->addFieldToFilter('group_id', Mage::registry('current_banner_group')->getId())
        );

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->__('ID'),
            'align' =>'left',
            'width' => '50px',
            'index' => 'id',
        ));

        $this->addColumn('heading', array(
            'header' => $this->__('Title'),
            'align' => 'left',
            'index' => 'heading',
        ));

        $this->addColumn('code', array(
            'header' => $this->__('Code'),
            'align' => 'left',
            'index' => 'code',
        ));

        $this->addColumn('url', array(
            'header' => $this->__('URL'),
            'align' => 'left',
            'index' => 'url',
        ));

        $this->addColumn('text', array(
            'header' => $this->__('Text'),
            'align' => 'left',
            'index' => 'text',
        ));

        $this->addColumn('sort_order', array(
            'header' => $this->__('Sort order'),
            'align' => 'left',
            'index' => 'sort_order',
            'editable' => true,
        ));

        return parent::_prepareColumns();
    }
}
