<?php

class Stuntcoders_Banner_Block_Adminhtml_Banner_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'banner_form',
                'name' => 'banner_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        if (Mage::registry('banner_data')) {
            $data = Mage::registry('banner_data')->getData();
        } else {
            $data = array();
        }

        $fieldset = $form->addFieldset('banner_form', array(
            'legend' => Mage::helper('stuntcoders_banner')->__('Banner Information')
        ));

        $fieldset->addField('code', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Code'),
            'comment' => Mage::helper('stuntcoders_banner')->__('Code must be unique'),
            'required' => true,
            'name' => 'code',
        ));

        $fieldset->addField('group_id', 'select', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Banner Group'),
            'name' => 'group_id',
            'values' => Mage::getModel('stuntcoders_banner/banner_group')->getSelectOptionValues()
        ));

        $fieldset->addField('heading', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Title'),
            'name' => 'heading',
        ));

        $fieldset->addField('url', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Url'),
            'name' => 'url',
            'note' =>  Mage::helper('stuntcoders_banner')->__('On click url'),
        ));

        $fieldset->addField('text', 'textarea', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Text'),
            'name' => 'text',
        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Image'),
            'name' => 'image',
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Sort Order'),
            'name' => 'sort_order',
        ));

        $form->setValues($data);

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
