<?php
class ItrCustomModule_PointofSales_Block_Adminhtml_Pointofsalescreditmemo extends Mage_Adminhtml_Block_Template 
{
	//Method for get all Pos Users
	public function getposusernames()
	{
		$resource = Mage::getSingleton('core/resource');
		$pos_sales_report = $resource->getTableName('pos_sales_report');
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$select = $connection->select()->distinct()->from($pos_sales_report, array('pos_user_id','pos_user_name'));//->where('pos_user_name=?',$temp_id);
		$rowArray =$connection->fetchAll($select);   //return row
		return $rowArray;
		//echo'<pre>','test';print_r($rowArray);die;
	}
	//Method for get Sales data from sales report
	public function getsalesdata()
	{
		//get session values for grid views
		$default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");
		$salesreport_view=Mage::getSingleton('core/session')->getsalesreport_view();
		if(!empty($salesreport_view))
		{
			$salesreport_view_value=$salesreport_view;	
		}
		else
		{
			$salesreport_view_value=$default_pagging_value;	
		}
		$page=1;
		$pagesize=$salesreport_view_value;
		//Count total no of records
		$sales_record = Mage::getModel('sales/order')->getCollection();
		$total_records=$sales_record->getSize();
		$order=Mage::getModel('sales/order')->getCollection()
		->setCurPage($page) // set the offset (useful for pagination)	
		->setPageSize($pagesize); // limit number of results returned
		$display_records=$order->count();
		$total_pages=ceil($total_records/$display_records);
		$order->total_records=$total_records;
		$order->total_pages=$total_pages;
		$order->page=$page;
		$order->pagesize=$pagesize;
		//echo'<pre>';print_r($order);die;
		return $order;
	}
	
	//Method for get all customers
	public function getcustomer()
	{
		//get session values for grid views
		$default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");
		$page=1;
		$pagesize=$default_pagging_value;
		//Count total no of records
		$customer = Mage::getModel('customer/customer')->getCollection();
		$total_records=$customer->getSize();
		//to overwrite limit but you need first to increase your memory limit
		 $getcustomer = Mage::getModel('customer/customer')->getCollection()
		->addAttributeToSelect('*') // select all attributes
		->setCurPage($page) // set the offset (useful for pagination)	
		->setPageSize($pagesize); // limit number of results returned
		$display_records=$getcustomer->count();
		$total_pages=ceil($total_records/$display_records);
		$getcustomer->total_records=$total_records;
		$getcustomer->total_pages=$total_pages;
		$getcustomer->page=$page;
		$getcustomer->pagesize=$pagesize;
		return $getcustomer;
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