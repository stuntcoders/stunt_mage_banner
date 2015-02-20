<?php

class Stuntcoders_Banner_Banner_GroupController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout();
        $this->_title($this->__('Banner Manager'));
        if ($this->getRequest()->getParam('id')) {
            $banner = Mage::getModel('stuntcoders_banner/banner_group')->load($this->getRequest()->getParam('id'));
            Mage::register('stuntcoders_banner_group_data', $banner);
        }

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('stuntcoders_banner/adminhtml_group'));

        $this->renderLayout();
    }

    public function addAction()
    {
        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('stuntcoders_banner/adminhtml_groupForm'));

        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            try {
                $bannerGroupModel = Mage::getModel('stuntcoders_banner/banner_group');

                if ($this->getRequest()->getParam('id')) {
                    $bannerGroupModel->setId($this->getRequest()->getParam('id'));
                }

                $bannerGroupModel->setCode($postData['code'])->setName($postData['name'])->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('stuntcoders_banner')->__('Group successfully saved')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                $this->_redirectReferer('*/*/');
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
    }

    public function massDeleteAction()
    {
        $idList = $this->getRequest()->getParam('categories');
        if (!is_array($idList)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('adminhtml')->__('Please select banner groups(s)')
            );
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner_group')
                        ->setIsMassDelete(true)
                        ->load($itemId)
                        ->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($idList)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
