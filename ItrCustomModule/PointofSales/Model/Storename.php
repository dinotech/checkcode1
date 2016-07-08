<?php
class ItrCustomModule_PointofSales_Model_Storename{
    public function toOptionArray()
    {
		foreach (Mage::app()->getWebsites() as $website) 
		{
    		foreach ($website->getGroups() as $group) 
			{
        		$stores = $group->getStores();
        		foreach ($stores as $store) 
				{
            		$store_name=$store->getName();
					$store_id=$store->getId();
					$return_array[]=array('value'=>$store_id, 'label'=>Mage::helper('pointofsales')->__($store_name));
        		}
    		}
		}
		return $return_array;
    }
}
?>