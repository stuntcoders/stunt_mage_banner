<?php

class Stuntcoders_Banner_BannerController extends Mage_Adminhtml_Controller_action
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
        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('stuntcoders_banner/adminhtml_banner'));

        $this->renderLayout();
    }

    public function addAction()
    {
        $this->_initAction();

        $this->_addContent($this->getLayout()->createBlock('stuntcoders_banner/adminhtml_bannerForm'));

        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            try {
                $bannerModel = Mage::getModel('stuntcoders_banner/banner');
                $bannerModel->setUrl($postData['url'])
                    ->setCode($postData['code']);

                if (!empty($postData['heading'])) {
                    $bannerModel->setHeading($postData['heading']);
                }

                if (!empty($postData['text'])) {
                    $bannerModel->setText($postData['text']);
                }

                if (!empty($postData['group_id'])) {
                    $bannerModel->setGroupId($postData['group_id']);
                }

                if (!empty($postData['image']['delete'])) {
                    $bannerModel->setImage('');
                }

                if ($imageName = $this->_uploadImage()) {
                    $bannerModel->setImage($imageName);
                }

                if ($this->getRequest()->getParam('id')) {
                    $bannerModel->setId($this->getRequest()->getParam('id'));
                }

                $bannerModel->save();

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
        if (isset($_FILES['image']['name']) and (file_exists($_FILES['image']['tmp_name']))) {

            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                $uploader->setAllowRenameFiles(false);
                $uploader->setFilesDispersion(false);

                $path = Mage::getBaseDir('media') . DS . 'banner' . DS;

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $imageName = strtolower(str_replace(' ', '-', $_FILES['image']['name']));

                $uploader->save($path, $imageName);

                return Mage::getBaseUrl('media') . 'banner/' . $imageName;

            } catch(Exception $e) {
                return null;
            }
        } else {
            return null;
        }
    }
}
