<?php

class Stuntcoders_Banner_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_headerText = Mage::helper('stuntcoders_banner')->__('Banner Group Manager');
        parent::__construct();
        $this->setTemplate('banner/group/groups.phtml');
    }

    protected function _prepareLayout()
    {
        $this->setChild('add_new_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     => Mage::helper('stuntcoders_banner')->__('Add Banner Group'),
                    'onclick'   => "setLocation('" . $this->getUrl('*/banner_group/add') . "')",
                    'class'     => 'add'
                ))
        );

        $this->setChild('grid', $this->getLayout()->createBlock('stuntcoders_banner/adminhtml_group_grid'));
    }

    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('add_new_button');
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
