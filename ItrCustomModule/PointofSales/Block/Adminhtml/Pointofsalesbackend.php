<?php 
class ItrCustomModule_PointofSales_Block_Adminhtml_Pointofsalesbackend extends Mage_Adminhtml_Block_Template 
{
	public function __construct()
	{
		$this->default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");	
	}
	//Method for get Switchers according to roles
	public function setSomething()
	{
		//Get Current User Role
	   $admin_user_session = Mage::getSingleton('admin/session');
	   $adminuserId = $admin_user_session->getUser()->getUserId();
	   $role_data = Mage::getModel('admin/user')->load($adminuserId)->getRole()->getData();
	   $userrole=$role_data['role_name'];
	   
	   //Select all Users where Role is equal to Curent login user's role
	   $users = Mage::getModel('admin/user')->getCollection();
       $i=1;
	   foreach($users as $user):
	   $test=Mage::getModel('admin/user')->load($user->getId())->getRole()->getData();
	   if($userrole=='Administrators')
	   {
			/*if($adminuserId==$user->getId())
			{
				continue;	
			}*/	
			$name[$i]=$user->getUsername();
			$i++;
			continue;   
	   }
	   if($test['role_name']==$userrole)
	   {
			/*if($adminuserId==$user->getId())
			{
				continue;	
			}*/
			$name[$i]=$user->getUsername();
			$i++;
	   }
       endforeach;
	   return $name;	
	}
	//Method for get products
	public function getfavproduct()
	{
		//Check attribute
		$entity = 'catalog_product';
		$code = 'favourite_product';
		$attr = Mage::getResourceModel('catalog/eav_attribute')->loadByCode($entity,$code);
		$fav_grid_status=Mage::getSingleton('core/session')->getfav_grid_status();	
		//get session values for grid views
		if($attr->getId()) 
		{
			$default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");
			$fav_view=Mage::getSingleton('core/session')->getfav_view();
			if(!empty($fav_view))
			{
				$fav_view_value=$fav_view;	
			}
			else
			{
				$fav_view_value=$default_pagging_value;	
			}
			$page=1;
			$pagesize=$fav_view_value;
			//Count total no of records
			if($attr->getId()) 
			{
				$product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToFilter('favourite_product', array('eq' => 1));
				if($fav_grid_status)
				$product->addAttributeToFilter('status', array('eq' => $fav_grid_status));
			}
			$total_records=$product->getSize();
			
			//to overwrite limit but you need first to increase your memory limit
			if($attr->getId()) 
			{
				$favproduct = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*') // select all attributes
				->addAttributeToFilter('favourite_product', array('eq' => 1));
				if($fav_grid_status)
				$favproduct->addAttributeToFilter('status', array('eq' => $fav_grid_status));
			}
			$favproduct->setCurPage($page) // set the offset (useful for pagination)
			->setPageSize($pagesize); // limit number of results returned
			$display_records=$favproduct->count();
			$total_pages=ceil($total_records/$display_records);
			$favproduct->total_records=$total_records;
			$favproduct->total_pages=$total_pages;
			$favproduct->page=$page;
			$favproduct->pagesize=$pagesize;
			return $favproduct;
		}
		else
		{
			return 0;
		}
	}
	public function getproduct()
	{
		$entity = 'catalog_product';
		$code = 'favourite_product';
		$fav_product_status=Mage::getStoreConfig("pos/notifications/fav_product_status");
		$attr = Mage::getResourceModel('catalog/eav_attribute')->loadByCode($entity,$code);
		//get session values for grid views
		$default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");
		$normal_view=Mage::getSingleton('core/session')->getnormal_view();
		$normal_grid_status=Mage::getSingleton('core/session')->getnormal_grid_status();
		if(!empty($normal_view))
		{
			$normal_view_value=$normal_view;	
		}
		else
		{
			$normal_view_value=$default_pagging_value;	
		}
		$page=1;
		$pagesize=$normal_view_value;
		//Count total no of records
		if($attr->getId()) 
		{
			if($fav_product_status==1)
			{
				$fav_product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToFilter('favourite_product', array('eq' => 1));
				foreach($fav_product as $data)
				{
					$fav_ids[]=$data['entity_id'];
				}
				//echo'<pre>';print_r($fav_ids);die;
				$product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToFilter('entity_id', array('nin' => $fav_ids));
			}
			else
			{
				$product = Mage::getModel('catalog/product')->getCollection();
			}
		}
		else
		{
			$product = Mage::getModel('catalog/product')->getCollection();
		}
		if($normal_grid_status)
		$product->addAttributeToFilter('status', array('eq' => $normal_grid_status));
		$total_records=$product->getSize();
		
		//to overwrite limit but you need first to increase your memory limit
		if($attr->getId()) 
		{
			if($fav_product_status==1)
			{
				$fav_product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToFilter('favourite_product', array('eq' => 1));
				foreach($fav_product as $data)
				{
					$fav_ids1[]=$data['entity_id'];
				}
				$product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*')
				->addAttributeToFilter('entity_id', array('nin' => $fav_ids1));
			}
			else
			{
				$product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*');
			}
		}
		else
		{
			$product = Mage::getModel('catalog/product')->getCollection()
			->addAttributeToSelect('*');
		} 
		if($normal_grid_status)
		$product->addAttributeToFilter('status', array('eq' => $normal_grid_status));
		$product->setCurPage($page) // set the offset (useful for pagination)	
		->setPageSize($pagesize); // limit number of results returned
		$display_records=$product->count();
		$total_pages=ceil($total_records/$display_records);
		$product->total_records=$total_records;
		$product->total_pages=$total_pages;
		$product->page=$page;
		$product->pagesize=$pagesize;
		return $product;
	}
	//Method for get all customers
	public function getcustomer()
	{
		//get session values for grid views
		$default_pagging_value=Mage::getStoreConfig("pos/notifications/default_pagging_value");
		$customer_view=Mage::getSingleton('core/session')->getcustomer_view();
		if(!empty($customer_view))
		{
			$customer_view_value=$customer_view;	
		}
		else
		{
			$customer_view_value=$default_pagging_value;	
		}
		$page=1;
		$pagesize=$customer_view_value;
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
	//Method for get data from temporary history table
	public function get_temporary_data()
	{
		$resource = Mage::getSingleton('core/resource');
		$temporary_history = $resource->getTableName('temporary_history');
		$admin_user_session = Mage::getSingleton('admin/session');
		$current_user_name = $admin_user_session->getUser()->getUsername();
		
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$data = $connection->select()->from($temporary_history, array('*'));//->where('pos_username=?',$current_user_name);// where id =1
		$rowsArray = $connection->fetchAll($data);				
		//$temporary_history_data =$connection->fetchRows($data);   //return row
		return $rowsArray;
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