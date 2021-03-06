<?php

class Stuntcoders_Banner_Block_Adminhtml_New_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'name' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        if (Mage::registry('current_banner')) {
            $data = Mage::registry('current_banner')->getData();
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

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('stuntcoders_banner')->__('Store View'),
                'title' => Mage::helper('stuntcoders_banner')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
        }

        $fieldset->addField('group_id', 'select', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Banner Group'),
            'name' => 'group_id',
            'values' => Mage::getModel('stuntcoders_banner/banner_group')->getSelectOptionValues()
        ));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Title'),
            'name' => 'title',
        ));

        $fieldset->addField('content', 'textarea', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Text'),
            'name' => 'content',
        ));

        $fieldset->addField('url', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Url'),
            'name' => 'url',
            'note' =>  Mage::helper('stuntcoders_banner')->__('On click url'),
        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Image'),
            'name' => 'image',
        ));

        $fieldset->addField('open_in_new_tab', 'checkbox', array(
            'label'    => Mage::helper('stuntcoders_banner')->__('Open in new tab'),
            'name'     => 'open_in_new_tab',
            'onclick'   => 'this.value = this.checked ? 1 : 0;',
        ))->setIsChecked(!empty($data['open_in_new_tab']));

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
