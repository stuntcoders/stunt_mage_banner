<?php

class Stuntcoders_Banner_Adminhtml_Banner_GroupController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout();
        $this->_title($this->__('Banner Manager'));
        if ($id = $this->getRequest()->getParam('id')) {
            $group = Mage::getModel('stuntcoders_banner/banner_group')->load($id);
            Mage::register('current_banner_group', $group);
        }

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function newAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            try {
                $bannerGroupModel = Mage::getModel('stuntcoders_banner/banner_group');

                if ($id = $this->getRequest()->getParam('id')) {
                    $bannerGroupModel->setId($id);
                }

                $bannerGroupModel->setCode($postData['code'])->setName($postData['name'])->save();

                if (!empty($postData['banner_positions'])) {
                    $bannerPositions = json_decode($postData['banner_positions'], true);
                    foreach ($bannerPositions as $bannerId => $bannerPosition) {
                        Mage::getModel('stuntcoders_banner/banner')
                            ->load($bannerId)
                            ->setSortOrder((int) $bannerPosition)
                            ->save();
                    }
                }

                $this->_getSession()->addSuccess($this->_getHelper()->__('Group successfully saved'));
                $this->_redirect('*/*/new', array('id' => $bannerGroupModel->getId()));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirectReferer('*/*');
            }
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('stuntcoders_banner/banner_group')->setId($id)->delete();

                $this->_getSession()->addSuccess($this->__('Banner group was successfully deleted'));
                $this->_redirect('*/*');
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirectReferer();
            }
        }
    }

    public function massDeleteAction()
    {
        $idList = $this->getRequest()->getParam('groups');
        if (!is_array($idList)) {
            $this->_getSession()->addError($this->__('Please select banner groups(s)'));
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner_group')
                        ->setIsMassDelete(true)
                        ->load($itemId)
                        ->delete();
                }

                $this->_getSession()->addSuccess($this->__(
                    'Total of %d record(s) were successfully deleted',
                    count($idList)
                ));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/banner');
    }
}
