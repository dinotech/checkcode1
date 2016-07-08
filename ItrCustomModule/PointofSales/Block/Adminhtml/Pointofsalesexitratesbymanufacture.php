<?php 
class ItrCustomModule_PointofSales_Block_Adminhtml_Pointofsalesexitratesbymanufacture extends Mage_Adminhtml_Block_Template 
{
	public function __construct()
	{
		$this->default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");	
	}
	//Method for ajax loader
	public function ajax_loader()
	{
		$ajax_loader='<div id="loading-mask" style="left: -2px; top: 0px; width: 1049px; height: 2007px; display: none;">
						<p class="loader" id="loading_mask_loader">
							<img src="'.str_replace("index.php/","",$this->getSkinUrl()).'images/ajax-loader-tr.gif">
							<br>Please wait...
                        </p>
						</div>';	
		return $ajax_loader;
    }
}