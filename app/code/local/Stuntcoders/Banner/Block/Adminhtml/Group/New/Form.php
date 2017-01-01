<?php

class Stuntcoders_Banner_Block_Adminhtml_Group_New_Form extends Mage_Adminhtml_Block_Widget_Form
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
            )
        );

        if (Mage::registry('current_banner_group')) {
            $data = Mage::registry('current_banner_group')->getData();
        } else {
            $data = array();
        }

        $fieldset = $form->addFieldset('banner_group_form', array(
            'legend' => Mage::helper('stuntcoders_banner')->__('Group Information')
        ));

        $fieldset->addField('code', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Code'),
            'comment' => Mage::helper('stuntcoders_banner')->__('Code must be unique'),
            'required' => true,
            'name' => 'code',
        ));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('stuntcoders_banner')->__('Name'),
            'comment' => Mage::helper('stuntcoders_banner')->__('Name must be unique'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('banner_positions', 'hidden', array(
            'name' => 'banner_positions',
        ));

        $form->setValues($data);

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
