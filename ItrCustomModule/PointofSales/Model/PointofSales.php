<?php
class ItrCustomModule_PointofSales_Model_PointofSales extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('pointofsales/pointofsales');
    }
}