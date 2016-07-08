<?php

class ItrCustomModule_PointofSales_Model_Mysql4_PointofSales extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the pointofsales_id refers to the key field in your database table.
        $this->_init('pointofsales/pointofsales', 'pointofsales_id');
    }
}