<?php

class Stuntcoders_Banner_Block_Adminhtml_Index_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('bannerGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('stuntcoders_banner/banner')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header' => $this->__('ID'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'id'
        ));

        $this->addColumn('image', array(
            'header' => $this->__('Image'),
            'align' => 'center',
            'index' => 'image',
            'renderer' => 'stuntcoders_banner/adminhtml_index_grid_image_renderer',
        ));

        $this->addColumn('code', array(
            'header' => $this->__('Code'),
            'align' => 'left',
            'index' => 'code',
        ));

        $this->addColumn('heading', array(
            'header' => $this->__('Title'),
            'align' => 'left',
            'index' => 'heading',
        ));

        $this->addColumn('group_id', array(
            'header' => $this->__('Group'),
            'align' => 'left',
            'index' => 'group_id',
            'type' => 'options',
            'options' => Mage::getModel('stuntcoders_banner/banner_group')->getGroupOptionValues()
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
            'renderer' => 'stuntcoders_banner/adminhtml_index_grid_description_renderer',
        ));

        return parent::_prepareColumns();
    }

    /**
     * @return Stuntcoders_Banner_Block_Adminhtml_Index_Grid
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('banners');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => $this->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('group', array(
            'label'=> Mage::helper('catalog')->__('Assign to group'),
            'url'  => $this->getUrl('*/*/massAssign'),
            'additional' => array(
                'visibility' => array(
                    'name' => 'group',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => $this->__('Assign to group'),
                    'values' => Mage::getModel('stuntcoders_banner/banner_group')->getSelectOptionValues()
                )
            )
        ));

        return $this;
    }

    /**
     * @param Varien_Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/add', array('id' => $row->getId()));
    }
}
