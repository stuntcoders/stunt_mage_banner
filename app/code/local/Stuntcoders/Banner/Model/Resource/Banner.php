<?php

class Stuntcoders_Banner_Model_Resource_Banner extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('stuntcoders_banner/banner', 'id');
    }

    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = $object->getData('stores');

        if (empty($newStores)) {
            $newStores = $object->getData('store_id');
        }

        $table  = $this->getTable('stuntcoders_banner/store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);

        if ($delete) {
            $where = array(
                'banner_id = ?' => $object->getId(),
                'store_id IN (?)' => $delete
            );

            $this->_getWriteAdapter()->delete($table, $where);
        }

        if ($insert) {
            $data = array();

            foreach ($insert as $storeId) {
                $data[] = array(
                    'banner_id' => $object->getId(),
                    'store_id' => $storeId
                );
            }

            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }

        Mage::app()->getCacheInstance()->invalidateType('layout');

        return parent::_afterSave($object);
    }

    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());

            $object->setData('store_id', $stores);
        }

        return parent::_afterLoad($object);
    }

    public function lookupStoreIds($bannerId)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getTable('stuntcoders_banner/store'), 'store_id')
            ->where('banner_id = ?', $bannerId);

        return $adapter->fetchCol($select);
    }
}
