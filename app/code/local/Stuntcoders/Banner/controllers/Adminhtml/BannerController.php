<?php

class Stuntcoders_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout();
        $this->_title($this->__('Banner Manager'));
        if ($this->getRequest()->getParam('id')) {
            $banner = Mage::getModel('stuntcoders_banner/banner')->load($this->getRequest()->getParam('id'));
            Mage::register('banner_data', $banner);
        }

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function addAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            try {
                $bannerModel = Mage::getModel('stuntcoders_banner/banner');
                $bannerModel->setData($postData);

                if ($imageName = $this->_uploadImage()) {
                    $bannerModel->setImage($imageName);
                }

                if (!empty($postData['image']['delete'])) {
                    $bannerModel->setImage(null);
                }

                if ($this->getRequest()->getParam('id')) {
                    $bannerModel->setId($this->getRequest()->getParam('id'));
                }

                $bannerModel->setOpenInNewTab(!empty($postData['open_in_new_tab']))->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('stuntcoders_banner')->__('Item was successfully saved')
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
        $idList = $this->getRequest()->getParam('banners');
        if (!is_array($idList)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('adminhtml')->__('Please select banners(s)')
            );
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner')->setIsMassDelete(true)->load($itemId)->delete();
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

    public function massAssignAction()
    {
        $idList = $this->getRequest()->getParam('banners');
        $groupId =  $this->getRequest()->getParam('group');
        if (!is_array($idList) || !$groupId) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('adminhtml')->__('Please select banner(s) and banner group')
            );
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner')
                        ->load($itemId)
                        ->setGroupId($groupId)
                        ->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully updated', count($idList)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    private function _uploadImage()
    {
        if (!isset($_FILES['image']['name']) || !file_exists($_FILES['image']['tmp_name'])) {
            return false;
        }

        try {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));

            $path = Mage::getBaseDir('media') . DS . 'banner' . DS;

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $imageName = strtolower(str_replace(' ', '-', $_FILES['image']['name']));

            $uploader->save($path, $imageName);

            return 'banner/' . $imageName;

        } catch(Exception $e) {
            return false;
        }
    }
}
