<?php

class ItrCustomModule_PointofSales_Model_Mysql4_PointofSales_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('pointofsales/pointofsales');
    }
}