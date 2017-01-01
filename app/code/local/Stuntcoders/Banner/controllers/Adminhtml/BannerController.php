<?php

class Stuntcoders_Banner_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
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
                $banner = Mage::getModel('stuntcoders_banner/banner');

                if ($id = $this->getRequest()->getParam('id')) {
                    $banner->load($id);
                }

                $banner->addData($postData)
                    ->setOpenInNewTab(!empty($postData['open_in_new_tab']));

                if ($imageName = $this->_uploadImage()) {
                    $banner->setImage($imageName);
                }

                if (!empty($postData['image']['delete'])) {
                    $banner->setImage(null);
                }

                $banner->save();

                $this->_getSession()->addSuccess($this->__('Item was successfully saved'));
                $this->_redirect('*/*/new', array('id' => $banner->getId()));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirectReferer('*/*/');
            }
        }
    }

    public function massDeleteAction()
    {
        $idList = $this->getRequest()->getParam('banners');
        if (!is_array($idList)) {
            $this->_getSession()->addError($this->__('Please select banners(s)'));
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner')->setIsMassDelete(true)->load($itemId)->delete();
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

    public function massAssignAction()
    {
        $idList = $this->getRequest()->getParam('banners');
        $groupId = $this->getRequest()->getParam('group');

        if (!is_array($idList) || !$groupId) {
            $this->_getSession()->addError($this->__('Please select banner(s) and banner group'));
        } else {
            try {
                foreach ($idList as $itemId) {
                    Mage::getModel('stuntcoders_banner/banner')
                        ->load($itemId)
                        ->setGroupId($groupId)
                        ->save();
                }
                $this->_getSession()->addSuccess($this->__(
                    'Total of %d record(s) were successfully updated',
                    count($idList)
                ));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

    /**
     * @return bool|string
     */
    protected function _uploadImage()
    {
        try {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowCreateFolders(true);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $uploader->save(Mage::helper('stuntcoders_banner')->getBaseMediaPath());

            return $uploader->getUploadedFileName();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @return Stuntcoders_Banner_Adminhtml_BannerController
     */
    protected function _initAction()
    {
        $this->loadLayout();
        $this->_title($this->__('Banner Manager'));
        if ($id = $this->getRequest()->getParam('id')) {
            $banner = Mage::getModel('stuntcoders_banner/banner')->load($id);
            Mage::register('current_banner', $banner);
        }

        return $this;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/banner');
    }
}
