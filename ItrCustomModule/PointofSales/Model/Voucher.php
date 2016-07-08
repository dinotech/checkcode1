<?php
class ItrCustomModule_PointofSales_Model_Voucher extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'voucher';
	 
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = false;
	protected $_canUseForMultishipping  = false;
	
	//protected $_infoBlockType = 'payment/info_pay';
}
	 