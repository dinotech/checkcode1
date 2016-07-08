<?php
class ItrCustomModule_PointOFSales_Adminhtml_PointofsalescreditmemoController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
	   $this->loadLayout();
	   $this->_title($this->__("Point Of Sales"));
	   $this->renderLayout(); 
	}
	public function create_credit_memoAction()
	{
		//Code for create credit memo
		$order_id=$_POST['credit_memo_submit_order_id'];
		$credit_memo_data=$_POST["creditmemo"];
		//echo'<pre>';print_r($credit_memo_data['items']);
		$customer_mode=$_POST['customer_mode'];
		$refund_type=$_POST['refund_type'];
		$customer_status=$_POST['customer_status'];
		$payment_method=$_POST['payment_method'];
		if($refund_type=='refund_money' && $payment_method=='Multiple Payment')
		{
			$bank=$_POST['show_bank_amount'];
			$check=$_POST['show_check_amount'];
			$cash=$_POST['show_cash_amount'];
		}
		else
		{
			$bank=0;
			$check=0;
			$cash=0;
		}
		//echo'<pre>';print_r($credit_memo_data);die;
		$comment=$credit_memo_data['comment_text'];
		$order = Mage::getModel('sales/order')->load($order_id);
		$customer_id=$order['customer_id'];	
		$items = $order->getAllItems();
		$getquantity=array();
		$hasqty;
		$itemids=array();
		$i=0;
		foreach($items as $oneitem)
		{
			//$productids[$i]=$oneitem['product_id'];
			$itemids[$i]=$oneitem['item_id'];
			//get quantities from cretid memo page
			$item_id=$oneitem['item_id']; 
			$getquantity[$i]=$credit_memo_data['items'][$item_id]['qty'];
			$i++;
		}
		//code for check credit memo amount
		foreach($items as $oneitem)
		{
			//$productids[$i]=$oneitem['product_id'];
			//get quantities from cretid memo page
			$item_id=$oneitem['item_id']; 
			$getquantity[$i]=$credit_memo_data['items'][$item_id]['qty'];
			if($credit_memo_data['items'][$item_id]['qty']>0)
			{
				$hasqty=1;
				break;
			}
			else
			{
				$hasqty=0;
			}
			$i++;
		}
		$orderItem = $order->getItemsCollection();
		$data = array();
		$i=0;
		foreach($orderItem as $oneitem)
		{
			$entity_id=$oneitem['item_id'];
			$set_quantity[$entity_id]=$getquantity[$i];
			$i++;
		}
		$data = array('qtys' => $set_quantity);
        $service = Mage::getModel('sales/service_order', $order);	
		$email_error=0;
		if($hasqty>0)
		{
			//Check customer email is exist or not
			if($customer_mode=="new")
			{
				$email = $_POST['customer_email'];
				$customers=Mage::getModel("customer/customer")->getCollection();
				foreach($customers as $cdata)
				{
					if($cdata['email']==$email)
					{	
						echo'Email already exits';
						$email_error=1;
						//exit();	
					}
				}	
			}
			if($email_error==0)
			{
				try
				{
					$creditmemo = $service->prepareCreditmemo($data);
					$creditmemo->setPaymentRefundDisallowed(true)->register();
					// add comment to creditmemo
					if(!empty($comment)) 
					{
						$creditmemo->addComment($comment, $notifyCustomer);
					}
					try 
					{
						Mage::getModel('core/resource_transaction')->addObject($creditmemo)->addObject($order)->save();  
						// send email notification
						$creditmemo->sendEmail($notifyCustomer, ($includeComment ? $comment : ''));
						//**************update product stock***************//
						$admin_user_session = Mage::getSingleton('admin/session');
						$current_user_name = $admin_user_session->getUser()->getUsername();
						foreach($itemids as $oneproduct)
						{
							//Code for get product id
							$order_details= Mage::getModel('sales/order')->load($order_id);
							$total_products=$order_details->getAllItems();
							$Incrementid = $order->getIncrementId();
							foreach($total_products as $data)
							{
								if($data['item_id']==$oneproduct)
								{
									$product_id=$data['product_id'];
									break;	
								}
							}
							//	$product_id.'****'.$oneproduct;
							if($credit_memo_data['items'][$oneproduct]['back_to_stock']>=1)
							{
								$stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product_id);
								$resource = Mage::getSingleton('core/resource');
								$stock_movement = $resource->getTableName('stock_movement');
								$pos_credit_memo_table = $resource->getTableName('pos_credit_memo');
								
								if ($stockItem->getId() > 0 and $stockItem->getManageStock()) 
								{
									$old_qty=$stockItem->getQty();
									$refund_qty=$credit_memo_data['items'][$oneproduct]['qty'];
									if(!empty($refund_qty))
									{
										$qty =$old_qty-$refund_qty;
										$stockItem->setQty($qty);
										$stockItem->setIsInStock((int)($qty > 0));
										$stockItem->save();
										
										//Code for save return stock data info into pos_stock_movement table//
										
										$date = new DateTime();
										$created_date=$date->format("Y-m-d");
										/*$default_zone=Mage::getStoreConfig("general/locale/timezone");
										date_default_timezone_set($default_zone);
										$timestamp = time();
										$current_date_time = date("Y-m-d h:i:s", $timestamp);*/
										$created_at=$creditmemo->getCreatedAt();
										$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
										$connection->beginTransaction(); 
										$__fields = array();
										$__fields['sm_product_id'] = $product_id;
										$__fields['sm_qty'] = $refund_qty;
										$__fields['sm_coef'] = 0;
										$__fields['sm_description'] = 'Creditmemo for order #'.$Incrementid;
										$__fields['sm_type'] = 'Creditmemo';
										$__fields['sm_date'] = $created_at;
										$__fields['sm_ui'] = NULL;
										$__fields['sm_target_stock'] = 1;
										//$__fields['sm_user'] = $current_user_name;
										//echo'<pre>';print_r($__fields);
										$connection->insert($stock_movement, $__fields);
										$connection->commit();
									}
								}
							}
						}
						$creditmemo_id=$creditmemo->getIncrementId();
						//get credit memo amount
						$creditMemos = Mage::getResourceModel('sales/order_creditmemo_collection');
						$creditMemos->addFieldToFilter('order_id', $order_id);
						$creditMemos->load();
						foreach($creditMemos as $data)
						{
						  if($creditmemo_id==$data['increment_id'])
						  {
							  $refund_amount=$data['grand_total'];
						  }
						}
						$creditmemo->setBaseGrandTotal($refund_amount)->save();
						
						$exp_week=Mage::getStoreConfig("pos/credit_memo/exp_date_week");
						$exp_month=Mage::getStoreConfig("pos/credit_memo/exp_date_month");
						if(empty($exp_week))
						{
							$exp_week=1;
						}
						if(empty($exp_month))
						{
							$exp_month=1;
						}
						$date = new DateTime("+".$exp_week." weeks,+".$exp_month." months");
						$exp_date=$date->format("Y-m-d");
						if($refund_type=='refund_money')
						{
							$exp_date=0000-0-0;
						}
					//************Code for create or select customer if customer type is guest in order*********//
						if($customer_mode!="")
						{
							if($customer_mode=='existing')
							{
								$customer_id=$_POST['customer_id'];
								if($order->getCustomerId() == NULL)
								{
    								$firstname=$_POST['fname'];
									$lastname=$_POST['lname'];
									$customer = Mage::getModel('customer/customer')->load($customer_id);
									$email=$customer['email'];
									$address1=$_POST['address1'];
									$address2=$_POST['address2'];
									$city=$_POST['city'];
									$country=$_POST['country'];
									$region_id=$_POST['region'];
									$zip=$_POST['zip'];
									$phone=$_POST['phone'];
									$fax=$_POST['fax'];
									$order->setCustomerId($customer_id);
									$order->setCustomerFirstname($firstname);
									$order->setCustomerLastname($lastname);
									$order->setCustomerEmail($email);
									$order->save();
									$shippingAddress = Mage::getModel('sales/order_address')->load($order->getShippingAddress()->getId());
									$shippingAddress->setFirstname($firstname)->setMiddlename($lastname)->setLastname($lastname)->setSuffix("")->setCompany("")->setStreet($address1,$address2)->setCity($city)->setCountry_id($country)->setRegion_id($region_id)->setPostcode($zip)->setTelephone($phone)->setFax($fax)->save();
									
									$billingAddress = Mage::getModel('sales/order_address')->load($order->getBillingAddress()->getId());
									$billingAddress->setFirstname($firstname)->setMiddlename($lastname)->setLastname($lastname)->setSuffix("")->setCompany("")->setStreet($address1,$address2)->setCity($city)->setCountry_id($country)->setRegion_id($region_id)->setPostcode($zip)->setTelephone($phone)->setFax($fax)->save();
								}	
							}
							if($customer_mode=='new')
							{
								//get values for new customer
								$REGION = Mage::getStoreConfig("pos/notifications/guest_region");
								if($REGION=="")
								$REGION=12;
								$ADDRESS1 = Mage::getStoreConfig("pos/notifications/guest_address1");
								if($ADDRESS1=="")
								$ADDRESS1="anonymous";
								$ADDRESS2 = Mage::getStoreConfig("pos/notifications/guest_address2");
								if($ADDRESS2=="")
								$ADDRESS2="anonymous";
								$CITY = Mage::getStoreConfig("pos/notifications/guest_city");
								if($CITY=="")
								$CITY="anonymous";
								$ZIP = Mage::getStoreConfig("pos/notifications/guest_zip");
								if($ZIP=="")
								$ZIP="anonymous";
								$PHONE = Mage::getStoreConfig("pos/notifications/guest_phone");
								if($PHONE=="")
								$PHONE="anonymous";
								$FAX = Mage::getStoreConfig("pos/notifications/guest_fax");
								if($FAX=="")
								$FAX="anonymous";
								//get values for new customer
								$firstname = $_POST['customer_firstname'];
								$lastname = $_POST['customer_lastname'];
								$email = $_POST['customer_email'];
								$subscriber_email=$email;
								$address1 = $_POST['address1'];
								if($address1=="")
								$address1 = $ADDRESS1;
								$address2 = $_POST['address2'];
								if($address2=="")
								$address2 = $ADDRESS2;
								$city = $_POST['city'];
								if($city=="")
								$city = $CITY;
								$zip = $_POST['zip'];
								if($zip=="")
								$zip = $ZIP;
								$country = $_POST['country'];
								$region_id = $_POST['region'];
								if($region_id=="")
								$region_id = $REGION;
								$phone = $_POST['phone'];
								if($phone=="")
								$phone = $PHONE;
								$fax = $_POST['fax'];
								if($fax=="")
								$fax = $FAX;
								//Code for auto generate password for new customer
								$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
								$count = mb_strlen($chars);
								for ($i = 0, $result = ''; $i < $count; $i++) 
								{
									$index = rand(0, $count - 1);
									$password .= mb_substr($chars, $index, 1);
								}
								//Set values for new customer
								$customer = Mage::getModel('customer/customer');
								$customer->setEmail($email);
								$customer->setFirstname($firstname);
								$customer->setLastname($lastname);
								$customer->setPassword($password);
								$customer->setConfirmation(null);
								$customer->save();
								$customer->setWebsiteId(1)->load($email);
								//create address variable for new customer
								$_custom_address = array (
								  'firstname' => $firstname,
								  'lastname' => $lastname,
								  'street' => array($address1,$address2),
								  'city' =>$city,
								  'region_id' => $region_id,
								  'postcode' => $zip,
								  'country_id' => $country, /* Croatia */
								  'telephone' => $phone,
								  'fax' => $fax,
								);
								//set address for new customer
								$customAddress = Mage::getModel('customer/address');
								$customAddress->setData($_custom_address)
								->setCustomerId($customer->getId())
								->setIsDefaultBilling('1')
								->setIsDefaultShipping('1')
								->setSaveInAddressBook('1');
								$customAddress->save();
								$customer_id=$customer->getId();
								//Update the value into sales table
								if($order->getCustomerId() == NULL)
								{
    								$order->setCustomerId($customer_id);
									$order->setCustomerFirstname($firstname);
									$order->setCustomerLastname($lastname);
									$order->setCustomerEmail($email);
									$order->save();
									$shippingAddress = Mage::getModel('sales/order_address')->load($order->getShippingAddress()->getId());
									$shippingAddress->setFirstname($firstname)->setMiddlename($lastname)->setLastname($lastname)->setSuffix("")->setCompany("")->setStreet($address1,$address2)->setCity($city)->setCountry_id($country)->setRegion_id($region_id)->setPostcode($zip)->setTelephone($phone)->setFax($fax)->save();
									
									$billingAddress = Mage::getModel('sales/order_address')->load($order->getBillingAddress()->getId());
									$billingAddress->setFirstname($firstname)->setMiddlename($lastname)->setLastname($lastname)->setSuffix("")->setCompany("")->setStreet($address1,$address2)->setCity($city)->setCountry_id($country)->setRegion_id($region_id)->setPostcode($zip)->setTelephone($phone)->setFax($fax)->save();
								}		
							}
						}
					//*********Code for save credit memo info into table***********//
						$admin_user_session = Mage::getSingleton('admin/session');
						$current_user_name = $admin_user_session->getUser()->getUsername();
						$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
						$connection->beginTransaction(); 
						$__fields = array();
						$__fields['credit_memo_id'] = $creditmemo_id;
						$__fields['order_id'] = $order_id;
						$__fields['pos_user'] = $current_user_name;
						$__fields['customer_id'] = $customer_id;
						$__fields['credit_memo_amount'] = $refund_amount;
						$__fields['exp_date'] = $exp_date;
						$__fields['refund_type'] = $refund_type;
						$__fields['bank_amount'] = $bank;
						$__fields['check_amount'] = $check;
						$__fields['cash_amount'] = $cash;
						//echo'<pre>';print_r($__fields);
						$connection->insert($pos_credit_memo_table, $__fields);
						$connection->commit();
					}
					catch (Mage_Core_Exception $e) 
					{
						//$this->_fault('data_invalid', $e->getMessage());
					}
				}
				catch (Mage_Core_Exception $e) 
				{
					//$this->_fault('data_invalid', $e->getMessage());
				}
				echo $order_id.','.$creditmemo_id;
			}
		}
		else
		{
			echo 'not able';	
		}
	}
	public function print_credit_memo_ticketAction()
	{
		$order_id=$this->getRequest()->getParam('order_id');
		$creditmemo_id=$this->getRequest()->getParam('creditmemo_id');
		$helper = Mage::helper('pointofsales');
		$html=$helper->credit_memo_ticket($order_id,$creditmemo_id);
		//$helper->createpdf();
		echo $html;	
	}
	
	//*********************************Method for Pagging*********************************//
	public function paggingAction()
	{
		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$countryCode = Mage::getStoreConfig('general/country/default');
		$catalog_prices=Mage::getStoreConfig("tax/calculation/price_includes_tax");
		//Get values from ajax
		$grid=$this->getRequest()->getParam('grid');
		$page=$this->getRequest()->getParam('page');
		$pagesize=$this->getRequest()->getParam('pagesize');
		if($grid=="customer")
		{
			Mage::getSingleton('core/session')->setcustomer_view($pagesize);
			//Count total no of records
			$customer = Mage::getModel('customer/customer')->getCollection();
			$total_records=$customer->getSize();
			$content.="<input type='hidden' name='search_customer_total_records' value='".$total_records."' id='search_customer_total_records'";
			//get products with pagesize
			 $getcustomer = Mage::getModel('customer/customer')->getCollection()
			->addAttributeToSelect('*') // select all attributes
			->setCurPage($page) // set the offset (useful for pagination)	
			->setPageSize($pagesize); // limit number of results returned
			$counter=0;
			//Code for create customer records grid for pagging
			foreach($getcustomer as $cdata)
			{
			  $customer_id=$cdata['entity_id'];
			  $customer_email=$cdata['email'];
			  $customer_group=$cdata['group_id'];
			  switch($customer_group)
			  {	
				  case 1:
				  $group="General";
				  break;
				  case 2:
				  $group="Wholesale";
				  break;
				  case 3:
				  $group="Retailer";
				  break;
			  }
			  $customer_created_at=$cdata['created_at'];
			  $customer_fname=$cdata['firstname'];
			  $customer_lname=$cdata['lastname'];
			  $customer_name = $cdata['firstname'].' '.$cdata['lastname'];
			  //echo '<pre>';print_r($cdata);die;
			  //Get Customer address 
			  $customer = Mage::getModel('customer/customer')->load($customer_id);
			  $customerAddress = array();
			  foreach ($customer->getAddresses() as $address)
			  {
				 $customerAddress = $address->toArray();
			  }
			  //echo'<pre>';var_dump($customerAddress);
			  $street_array = explode("\n", $customerAddress['street']);
			  $customer_address1=$street_array[0];
			  $customer_address2=$street_array[1];
			  $customer_city=$customerAddress['city'];
			  $customer_tel=$customerAddress['telephone'];
			  $customer_zip=$customerAddress['postcode'];
			  $country_id=$customerAddress['country_id'];
			  $customer_region_id=$customerAddress['region_id'];
			  $customer_country = Mage::getModel('directory/country')->load($country_id)->getName();
			  $customer_state=$customerAddress['region'];
			  $customer_fax=$customerAddress['fax'];
			  //provide class to a tr and increment into counter variable
			  if($counter % 2==0)
			  {
				$tr_class="even";  
			  }
			  else
			  {
				$tr_class="";
			  }
			  $counter++;
			//write content into table body
			  $content.='
			  <tr title="#" class="pointer '.$tr_class.'">
				<td class=" a-right ">'.$customer_id.'</td>
				<td class=" ">'.$customer_name.'</td>
				<td class=" ">'.$customer_email.'</td>
				<td class=" ">'.$group.'</td>
				<td class=" ">'.$customer_tel.'</td>
				<td class=" ">'.$customer_zip.'</td>
				<td class=" ">'.$customer_country.'</td>
				<td class=" ">'.$customer_state.'</td>
				<td class="a-center ">'.$customer_created_at.'</td>
				<td class=" last">
					<a onclick="selectCustomer('."'".$customer_id."'".','."'".$customer_fname."'".','."'".$customer_lname."'".','."'".$customer_address1."'".','."'".$customer_address2."'".','."'".$customer_city."'".','."'".$customer_zip."'".','."'".$customer_region_id."'".','."'".$customer_tel."'".','."'".$customer_fax."'".',1);" style="cursor:pointer;">Select</a>                    		
				</td>
			</tr>';
			}
				echo $content;
				return false;
		}
	}
	//*********************************Method for searching***********************************************//
	public function searchingAction() 
	{
		//Get values from ajax
		$countryCode = Mage::getStoreConfig('general/country/default');
		$catalog_prices=Mage::getStoreConfig("tax/calculation/price_includes_tax");
		$grid=$this->getRequest()->getParam('grid');
		if($grid=="customer")
		{
			$id_from=$this->getRequest()->getParam('id_from');
			$id_to=$this->getRequest()->getParam('id_to');	
			$name=$this->getRequest()->getParam('name');
			$email=$this->getRequest()->getParam('email');
			$group=$this->getRequest()->getParam('group');
			$telephone=$this->getRequest()->getParam('telephone');
			$zip=$this->getRequest()->getParam('zip');
			$country=$this->getRequest()->getParam('country');
			$state=$this->getRequest()->getParam('state');
			$customer_since_from=$this->getRequest()->getParam('customer_since_from');
			$customer_since_to=$this->getRequest()->getParam('customer_since_to');
		}
		$resetfilter=$this->getRequest()->getParam('resetfilter');
		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$page=$this->getRequest()->getParam('page');
		$pagesize=$this->getRequest()->getParam('pagesize');
		//*************************Searching code for customer table**************************
		if($grid=="customer")
		{
			//Code executes when searching action is peform
			if($resetfilter==1)
			{
				//Count total no of records
				$customer = Mage::getModel('customer/customer')->getCollection();
				$total_records=$customer->getSize();
				$content.="<input type='hidden' name='search_customer_total_records' value='".$total_records."' id='search_customer_total_records'/>";
				//select product with pagesize
				$getcustomer = Mage::getModel('customer/customer')->getCollection()
				->addAttributeToSelect('*') // select all attributes
				->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
			}
			else
			{
				//*************************Count total no of records*************************//
				$customer = Mage::getModel('customer/customer')->getCollection();
				//Filter by customer id's
				if($id_from!="" and $id_to=="")
				$customer->addFieldToFilter('entity_id',array('gteq'=>$id_from));
				if($id_from=="" and $id_to!="")
				$customer->addFieldToFilter('entity_id',array('lteq'=>$id_to));
				if($id_from!="" and $id_to!="")
				$customer->addFieldToFilter('entity_id',array(array('from'=>$id_from,'to'=>$id_to))); 
				//Filter by customer name
				if($name!="")
				{
          			$customer1 = Mage::getModel('customer/customer')->getCollection();
					$customer1->addAttributeToFilter('firstname', array('like' => '%'.$name.'%'));
					$customer1_count=$customer1->count();
				}
				if($customer1_count==0)
				{
					$customer->addAttributeToFilter('lastname', array('like' => '%'.$name.'%'));
				}
				else
				{
					$customer->addAttributeToFilter('firstname', array('like' => '%'.$name.'%'));
				}
				//Filter by customer email
				if($email!="")
          		$customer->addFieldToFilter('email', array('like' => '%'.$email.'%'));
				//Filter by customer group
				if($group!="")
				$customer->addAttributeToFilter('group_id', array('eq' => $group));
				//Filter by customer telephone
				if($telephone!="")
				{
					$customer2 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('telephone', array('like' => '%'.$telephone.'%'));
					foreach($customer2 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$customer->addFieldToFilter('entity_id',$telephone_data);
				}
				//Filter by customer zip
				if($zip!="")
				{
					$customer3 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('postcode', array('like' => '%'.$zip.'%'));
					foreach($customer3 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$customer->addFieldToFilter('entity_id',$telephone_data);
				}
				//Filter by customer country
				if($country!="")
				{
					$customer4 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('country_id', array('eq' => $country));
					foreach($customer4 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$customer->addFieldToFilter('entity_id',$telephone_data);
				}
				//Filter by customer state
				if($state!="")
				{
					$customer5 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('region', array('like' => '%'.$state.'%'));
					//echo'<pre>';print_r($customer5->count());die;
					foreach($customer5 as $telephonedata)
					{
						$state_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$customer->addFieldToFilter('entity_id',$state_data);
				}
				//Filter by customer id's
				if($customer_since_from!="" and $customer_since_to=="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$customer->addFieldToFilter('created_at',array('gteq'=>$customer_since_from));
				}
				if($customer_since_from=="" and $customer_since_to!="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$customer->addFieldToFilter('created_at',array('lteq'=>$customer_since_to));
				}
				if($customer_since_from!="" and $customer_since_to!="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$date=array($customer_since_from,$customer_since_to);
					//print_r($date);die;
					$customer->addAttributeToFilter('created_at',array('in'=>$date)); 
				}
				$total_records=$customer->count();
				$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_customer_total_records'/>";
						
				
				//****************************Get customers with pagesize*****************************//
				$getcustomer = Mage::getModel('customer/customer')->getCollection();
				//Filter by customer id's
				if($id_from!="" and $id_to=="")
				$getcustomer->addAttributeToFilter('entity_id',array('gteq'=>$id_from));
				if($id_from=="" and $id_to!="")
				$getcustomer->addAttributeToFilter('entity_id',array('lteq'=>$id_to));
				if($id_from!="" and $id_to!="")
				$getcustomer->addAttributeToFilter('entity_id',array(array('from'=>$id_from,'to'=>$id_to)));
				//Filter by customer name
				if($name!="")
				{
          			$getcustomer1 = Mage::getModel('customer/customer')->getCollection();
					$getcustomer1->addAttributeToFilter('firstname', array('like' => '%'.$name.'%'));
					$getcustomer1_count=$getcustomer1->count();
				}
				if($getcustomer1_count==0)
				{
					$getcustomer->addAttributeToFilter('lastname', array('like' => '%'.$name.'%'));
				}
				else
				{
					$getcustomer->addAttributeToFilter('firstname', array('like' => '%'.$name.'%'));
				}
				//Filter by customer email
				if($email!="")
          		$getcustomer->addFieldToFilter('email', array('like' => '%'.$email.'%'));
				//Filter by customer group
				if($group!="")
				$getcustomer->addAttributeToFilter('group_id', array('eq' => $group));
				//Filter by customer telephone
				if($telephone!="")
				{
					$getcustomer2 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('telephone', array('like' => '%'.$telephone.'%'));
					foreach($getcustomer2 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$getcustomer->addFieldToFilter('entity_id',$telephone_data);
				} 
				//Filter by customer zip
				if($zip!="")
				{
					$getcustomer3 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('postcode', array('like' => '%'.$zip.'%'));
					foreach($getcustomer3 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$getcustomer->addFieldToFilter('entity_id',$telephone_data);
				}
				//Filter by customer country
				if($country!="")
				{
					$getcustomer4 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('country_id', array('eq' => $country));
					foreach($getcustomer4 as $telephonedata)
					{
						$telephone_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$getcustomer->addFieldToFilter('entity_id',$telephone_data);
				}
				//Filter by customer state
				if($state!="")
				{
					$getcustomer5 = Mage::getResourceModel('customer/address_collection')
					->addAttributeToFilter('region', array('like' => '%'.$state.'%'));
					//echo'<pre>';print_r($customer5->count());die;
					foreach($getcustomer5 as $statedata)
					{
						$state_data[] = array('eq' => $statedata['parent_id']);		
					}
					$getcustomer->addFieldToFilter('entity_id',$state_data);
				}
				//Filter by customer id's
				if($customer_since_from!="" and $customer_since_to=="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$getcustomer->addFieldToFilter('created_at',array('gteq'=>$customer_since_from));
				}
				if($customer_since_from=="" and $customer_since_to!="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$getcustomer->addFieldToFilter('created_at',array('lteq'=>$customer_since_to));
				}
				if($customer_since_from!="" and $customer_since_to!="")
				{
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					$getcustomer->addFieldToFilter('created_at',array('from'=>$date_from,'to'=>$date_to)); 
				}
				$getcustomer->addAttributeToSelect('*')
				->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
				//echo'<pre>';print_r($getcustomer);die;
			}
			//Code for create customer records grid for searching
			foreach($getcustomer as $cdata)
			{
			  $customer_id=$cdata['entity_id'];
			  $customer_email=$cdata['email'];
			  $customer_group=$cdata['group_id'];
			  switch($customer_group)
			  {	
				  case 1:
				  $group="General";
				  break;
				  case 2:
				  $group="Wholesale";
				  break;
				  case 3:
				  $group="Retailer";
				  break;
			  }
			  $customer_created_at=$cdata['created_at'];
			  $getcustomer_details = Mage::getModel('customer/customer')->load($customer_id);
			  //echo'<pre>';print_r($getcustomer_details);die;
			  $customer_fname=$getcustomer_details['firstname'];
			  $customer_lname=$getcustomer_details['lastname'];
			  $customer_name = $customer_fname.' '.$customer_lname;
			  //echo '<pre>';print_r($cdata);die;
			  //Get Customer address 
			  $customer = Mage::getModel('customer/customer')->load($customer_id);
			  $customerAddress = array();
			  foreach ($customer->getAddresses() as $address)
			  {
				 $customerAddress = $address->toArray();
			  }
			  //echo'<pre>';var_dump($customerAddress);
			  $street_array = explode("\n", $customerAddress['street']);
			  $customer_address1=$street_array[0];
			  $customer_address2=$street_array[1];
			  $customer_city=$customerAddress['city'];
			  $customer_tel=$customerAddress['telephone'];
			  $customer_zip=$customerAddress['postcode'];
			  $country_id=$customerAddress['country_id'];
			  $customer_region_id=$customerAddress['region_id'];
			  $customer_country = Mage::getModel('directory/country')->load($country_id)->getName();
			  $customer_state=$customerAddress['region'];
			  $customer_fax=$customerAddress['fax'];
			  //provide class to a tr and increment into counter variable
			  if($counter % 2==0)
			  {
				$tr_class="even";  
			  }
			  else
			  {
				$tr_class="";
			  }
			  $counter++;
			//write content into table body
			  $content.='
              <tr title="#" class="pointer '.$tr_class.'">
				<td class=" a-right ">'.$customer_id.'</td>
				<td class=" ">'.$customer_name.'</td>
				<td class=" ">'.$customer_email.'</td>
				<td class=" ">'.$group.'</td>
				<td class=" ">'.$customer_tel.'</td>
				<td class=" ">'.$customer_zip.'</td>
				<td class=" ">'.$customer_country.'</td>
				<td class=" ">'.$customer_state.'</td>
				<td class="a-center ">'.$customer_created_at.'</td>
				<td class=" last">
					<a onclick="selectCustomer('."'".$customer_id."'".','."'".$customer_fname."'".','."'".$customer_lname."'".','."'".$customer_address1."'".','."'".$customer_address2."'".','."'".$customer_city."'".','."'".$customer_zip."'".','."'".$customer_region_id."'".','."'".$customer_tel."'".','."'".$customer_fax."'".',1);" style="cursor:pointer;">Select</a>                    		
				</td>
			</tr>';
			}
			echo $content;
			return false;
		}	
	}
}
