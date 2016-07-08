<?php

class ItrCustomModule_PointOFSales_Adminhtml_PointofsalesreportController extends Mage_Adminhtml_Controller_Action

{

	public function indexAction()

    {
	   $this->loadLayout();

	   $this->_title($this->__("Point Of Sales"));

	   $this->renderLayout(); 

	}

	//*********************************Method for create pdf in magento*********************************//

	  public function printAction()

	  {

		  $order_id=$this->getRequest()->getParam('order_id');

		  //$this->getResponse()->clearHeaders()->setHeader('Content-Type', 'application/pdf');

		  $helper = Mage::helper('pointofsales');

		  $filename=$helper->createpdf($order_id);

		  //$helper->createpdf();

		  echo $filename;

	  }

	//*********************************Method for Pagging*********************************//

	public function paggingAction()

	{
		$resource = Mage::getSingleton('core/resource');
		$pos_sales_report_table = $resource->getTableName('pos_sales_report');
		
		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);

		$currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();

		$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();

		//Get values from ajax

		$grid=$this->getRequest()->getParam('grid');

		$page=$this->getRequest()->getParam('page');

		$pagesize=$this->getRequest()->getParam('pagesize');

		if($grid=="salesreport")

		{

			Mage::getSingleton('core/session')->setsalesreport_view($pagesize);

			

			//Get order ids from pos_sales_report table

			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

			$select = $connection->select()->from($pos_sales_report_table, array('order_id'));//->where('pos_user_name=?',$temp_id);

			$rowArray =$connection->fetchAll($select);   //return row

			//echo'<pre>';print_r($rowArray);die;

		

			//Count total no of records

			$sales_record = Mage::getModel('sales/order')->getCollection();

			foreach($rowArray as $data)

			{

				$sales_data[] = array('eq' => $data['order_id']);		

			}

			$sales_record->addFieldToFilter('entity_id',$sales_data);

			$total_records=$sales_record->count();

			

			//to overwrite limit but you need first to increase your memory limit

			 $order = Mage::getModel('sales/order')->getCollection()

			 ->addFieldToFilter('entity_id',$sales_data)

			 ->setOrder('entity_id', 'DESC')

			 ->setCurPage($page) // set the offset (useful for pagination)	

			 ->setPageSize($pagesize); // limit number of results returned

			$content.="<input type='hidden' name='pagging_total_sales_record' value='".$total_records."' id='pagging_total_sales_record'";

		}

		//*******************Pagging Code for pos sales report*******************************

		$counter=0;

		foreach($order as $data)

		{

			$customer_id=$data['customer_id'];

			$order_id=$data['entity_id'];

			//Get data from pos_sales_report

			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

			$select = $connection->select()->from($pos_sales_report_table, array('*'))->where('order_id=?',$order_id);// where id =1

			$rowArray =$connection->fetchRow($select);   //return row

			//print_r($rowArray);

			$pos_user_name=$rowArray['pos_user_name'];

			

			$increment_id=$data['increment_id'];

			$fname=$data['customer_firstname'];

			$lname=$data['customer_lastname'];

			$created_at=$data['created_at'];

			$grand_total=round($data['grand_total'],2);

			$Allitems=$data->getAllItems();

			$product_data="";

			foreach($Allitems as $items)

			{

				$qty=round($items["qty_invoiced"]);

				$name=$items["name"];

				$product_data.=$qty." &Chi; ".$name."<br/>";

			}

			$imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");

			$payment_method = $data->getPayment()->getMethodInstance()->getTitle();

			if($counter % 2==0)

			{

			  $tr_class="even";

			}

			else

			{

			  $tr_class="";

			}

			if($customer_id=="")

			{

				$fname=Mage::getStoreConfig("pos/notifications/guest_fname");

				$lname=Mage::getStoreConfig("pos/notifications/guest_lname");

			}

			$counter++;

			//echo'<pre>';print_r($Allitems);die;

			//********************************write content into table body*********************************

			$content.='

			<tr></tr>

			<tr title="#" class="pointer '.$tr_class.'">

				<td class=" ">'.$pos_user_name.'</td>

				<td class=" ">'.$increment_id.'</td>

				<td class=" ">'.$created_at.'</td>

				<td class=" ">'.$fname.' '.$lname.'</td>

				<td class=" ">'.$product_data.'</td>

				<td>'.$payment_method.'</td>

				<td class="a-right">'.$grand_total.$currency_symbol.'</td>

				<td class="a-center">

					<img src="'.$imageUrl.'" height="35" width="25"/>

				</td>

			</tr>';

			$counter++; 

		}

		echo $content;	

	}

	

	//*********************************Method for searching***********************************************//

	public function searchingAction() 

	{
		$resource = Mage::getSingleton('core/resource');
		$pos_sales_report_table = $resource->getTableName('pos_sales_report');
		//Get values from ajax

		$grid=$this->getRequest()->getParam('grid');

		$currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();

		$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();

		$pos_user_id=$this->getRequest()->getParam('user_id');

		$increment_id=$this->getRequest()->getParam('increment_id');

		$date_from=$this->getRequest()->getParam('date_from');

		$date_to=$this->getRequest()->getParam('date_to');	

		$customer_name=$this->getRequest()->getParam('customer_name');	

		$product_name=$this->getRequest()->getParam('product_name');

		$resetfilter=$this->getRequest()->getParam('resetfilter');

		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);

		$page=$this->getRequest()->getParam('page');

		$pagesize=$this->getRequest()->getParam('pagesize');

		if($resetfilter==1)

		{

			//Get order ids from pos_sales_report table

			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

			$select = $connection->select()->from($pos_sales_report_table, array('order_id'));//->where('pos_user_name=?',$temp_id);

			$rowArray =$connection->fetchAll($select);   //return row

			//echo'<pre>';print_r($rowArray);die;

			foreach($rowArray as $data)

			{

				$sales_data[] = array('eq' => $data['order_id']);		

			}

			

			//Count total no of records

			$sales_record = Mage::getModel('sales/order')->getCollection()

			->addFieldToFilter('entity_id',$sales_data);

			$total_records=$sales_record->count();

			$content.="<input type='hidden' name='searching_total_sales_record' value='".$total_records."' id='searching_total_sales_record'/>";

			

			//select product with pagesize

			$order = Mage::getModel('sales/order')->getCollection()

			->addFieldToFilter('entity_id',$sales_data)

			->setOrder('entity_id', 'DESC')

			->setCurPage($page) // set the offset (useful for pagination)	

			->setPageSize($pagesize); // limit number of results returned

		}

		else

		{

			//*******************Code executes when searching in sales report***********************//

			//Get order ids from pos_sales_report table

			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

			$select = $connection->select()->from($pos_sales_report_table, array('order_id'));//->where('pos_user_name=?',$temp_id);

			$rowArray =$connection->fetchAll($select);   //return row

			//echo'<pre>';print_r($rowArray);die;

			foreach($rowArray as $data)

			{

				$sales_data[] = array('eq' => $data['order_id']);		

			}

			//Count total no of records

			$sales_order = Mage::getModel('sales/order')->getCollection()

			->addFieldToFilter('entity_id',$sales_data);

			//Filter by increment id

			if($increment_id!="")

			$sales_order->addAttributeToFilter('increment_id', array('like' => '%'.$increment_id.'%'));

			//Filter by date 

			if(!empty($date_from) or !empty($date_to))

			{

				if(empty($date_to))

				{

					$date_to = date('Y-m-d');

				}

				else

				{

					$date_to=date('Y-m-d', strtotime($date_to. ' + 1 days'));	

				}

				/* Format our dates */

				$date_from = date('Y-m-d H:i:s', strtotime($date_from));

				$date_to = date('Y-m-d H:i:s', strtotime($date_to));

				$sales_order->addAttributeToFilter('created_at', array('from' => $date_from,'to'=>$date_to));

			}

			//Filter by Customer name

			if($customer_name!="")

			{

				$sales_order->addFieldToFilter(

					array('customer_firstname','customer_lastname'),

					array(

						array('like' => $customer_name),

    					array('like' => $customer_name),

					)

				);

			}

			

			//Filter by product name

			if($product_name!="")

			{

				$sales_order1= Mage::getModel('sales/order')->getCollection();

				foreach($sales_order1 as $alldata)

				{

					$Allitems=$alldata->getAllItems();

					foreach($Allitems as $items)

					{

						$name=$items['name'];

						if($name==$product_name)

						{

							$filter_order_id[] = array('eq' => $items['order_id']);		

						}

					}	

				}

				$sales_order->addAttributeToFilter('entity_id', $filter_order_id);

			}

			//Get pos_sales_record data

			if($pos_user_id!="")

			{

				$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

				$select = $connection->select()->from($pos_sales_report_table, array('*'))->where('pos_user_id=?',$pos_user_id);

				$rowArray =$connection->fetchAll($select);   //return row

				foreach($rowArray as $pos_user_records)

				{

					$filter[] = array('eq' => $pos_user_records['order_id']);

				}	

				$sales_order->addAttributeToFilter('entity_id', $filter);

			}

			$total_records=$sales_order->count();

			$content.="<input type='hidden' name='searching_total_sales_record' value='".$total_records."' id='searching_total_sales_record'/>";

			

			

			//***************************select product with pagesize******************************//

			$order = Mage::getModel('sales/order')->getCollection()

			->addFieldToFilter('entity_id',$sales_data);

			//Filter by increment id

			if($increment_id!="")

			$order->addAttributeToFilter('increment_id', array('like' => '%'.$increment_id.'%'));

			//Filter  by date

			if(!empty($date_from) or !empty($date_to))

			{

				$order->addAttributeToFilter('created_at', array('from' => $date_from,'to'=>$date_to));

			}

			//Filter by customer name

			if($customer_name!="")

			{

				$order->addFieldToFilter(

					array('customer_firstname','customer_lastname'),

					array(

						array('like' => $customer_name),

    					array('like' => $customer_name),

					)

				);

			}

			//Filter by product name

			if($product_name!="")

			{

				$order1= Mage::getModel('sales/order')->getCollection();

				foreach($order1 as $alldata)

				{

					$Allitems=$alldata->getAllItems();

					foreach($Allitems as $items)

					{

						$name=$items['name'];

						if($name==$product_name)

						{

							$filter_order_id[] = array('eq' => $items['order_id']);		

						}

					}	

				}

				$order->addAttributeToFilter('entity_id', $filter_order_id);

			}

			//Filter by pos user name

			//Get pos_sales_record data

			if($pos_user_id!="")

			{

				$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

				$select = $connection->select()->from($pos_sales_report_table, array('*'))->where('pos_user_id=?',$pos_user_id);

				$rowArray =$connection->fetchAll($select);   //return row

				foreach($rowArray as $pos_user_records)

				{

					$filter[] = array('eq' => $pos_user_records['order_id']);

				}	

				$order->addAttributeToFilter('entity_id', $filter);

			}

			$order->addAttributeToSelect('*') 

			->setOrder('entity_id', 'DESC')

			->setCurPage($page) // set the offset (useful for pagination)	

			->setPageSize($pagesize); // limit number of results returned

		}

		//*******************Pagging Code for pos sales report*******************************

		$counter=0;

		foreach($order as $data)

		{

			$customer_id=$data['customer_id'];

			$order_id=$data['entity_id'];

			//Get data from pos_sales_report

			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

			$select = $connection->select()->from($pos_sales_report_table, array('*'))->where('order_id=?',$order_id);// where id =1

			$rowArray =$connection->fetchRow($select);   //return row

			//print_r($rowArray);

			$pos_user_name=$rowArray['pos_user_name'];

			

			$increment_id=$data['increment_id'];

			$fname=$data['customer_firstname'];

			$lname=$data['customer_lastname'];

			$created_at=$data['created_at'];

			$grand_total=round($data['grand_total'],2);

			$Allitems=$data->getAllItems();

			$product_data="";

			foreach($Allitems as $items)

			{

				$qty=round($items["qty_invoiced"]);

				$name=$items["name"];

				$product_data.=$qty." &Chi; ".$name."<br/>";

			}

			$imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");

			$payment_method = $data->getPayment()->getMethodInstance()->getTitle();

			if($counter % 2==0)

			{

			  $tr_class="even";

			}

			else

			{

			  $tr_class="";

			}

			if($customer_id=="")

			{

				$fname=Mage::getStoreConfig("pos/notifications/guest_fname");

				$lname=Mage::getStoreConfig("pos/notifications/guest_lname");

			}

			$counter++;

			//echo'<pre>';print_r($Allitems);die;

			//********************************write content into table body*********************************

			$content.='

			<tr></tr>

			<tr title="#" class="pointer '.$tr_class.'">

				<td class=" ">'.$pos_user_name.'</td>

				<td class=" ">'.$increment_id.'</td>

				<td class=" ">'.$created_at.'</td>

				<td class=" ">'.$fname.' '.$lname.'</td>

				<td class=" ">'.$product_data.'</td>

				<td>'.$payment_method.'</td>

				<td class="a-right">'.$grand_total.$currency_symbol.'</td>

				<td class="a-center">

					<img src="'.$imageUrl.'" height="35" width="25"/>

				</td>

			</tr>';

			$counter++; 

		}

		echo $content;		

	}

	//***************************Method for print pos sales report pdf**********************************//

	public function pos_sales_report_printAction() 

	{

		$pos_uname=$this->getRequest()->getParam('pos_user_id');

		$date_from=$this->getRequest()->getParam('date_from');

		$date_to=$this->getRequest()->getParam('date_to');

		$helper = Mage::helper('pointofsales');

		$html=$helper->pos_sales_report_pdf($pos_uname,$date_from,$date_to);		

		echo $html;

	}

}

