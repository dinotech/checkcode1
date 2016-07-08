<?php
/**
 * @category    Itr
 * @package     Itr_AddonProduct
 * @author      Prakash Parwani <parwani.prakash@gmail.com>
 * @license     http://itradicals.com
 */
 /*****************Code by ITR******************************/
class ItrCustomModule_PointofSales_Model_Observer
{   
	public function filterpaymentmethod(Varien_Event_Observer $observer) 
	{
		/* call get payment method */
    	$method = $observer->getEvent()->getMethodInstance();
     	/*   get  Quote  */
     	$quote = $observer->getEvent()->getQuote();
    	/* Disable Your payment method for   adminStore */
    	if (!Mage::app()->getStore()->isAdmin())
		{
        	if($method->getCode()=='pointofsales' || $method->getCode()=='voucher')
			{
        		$result = $observer->getEvent()->getResult();   
         		$result->isAvailable = false;
        	}
		}
	}
}?>