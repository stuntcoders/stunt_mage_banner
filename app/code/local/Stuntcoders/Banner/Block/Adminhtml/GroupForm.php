<?php

class Stuntcoders_Banner_Block_Adminhtml_GroupForm extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_headerText = Mage::helper('stuntcoders_banner')->__('Banner Group Manager');;
        parent::__construct();
        $this->setTemplate('banner/group/add.phtml');
    }

    protected function _prepareLayout()
    {
        $this->setChild('save_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData(array(
                    'label'     =>  Mage::helper('stuntcoders_banner')->__('Save Banner Group'),
                    'onclick'   => "banner_group_form.submit()",
                    'class'   => 'add'
                ))
        );

        $this->setChild('form', $this->getLayout()->createBlock('stuntcoders_banner/adminhtml_group_form'));
    }

    public function getAddNewButtonHtml()
    {
        return $this->getChildHtml('save_button');
    }

    public function getFormHtml()
    {
        return $this->getChildHtml('form');
    }
}
