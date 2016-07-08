<?php
class ItrCustomModule_PointofSales_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'pointofsales';
	 
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = false;
	protected $_canUseForMultishipping  = false;
	
	protected $_infoBlockType = 'pointofsales/info';
}
	 