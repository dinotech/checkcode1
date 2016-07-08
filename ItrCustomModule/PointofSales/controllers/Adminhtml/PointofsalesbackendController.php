<?php
class ItrCustomModule_PointOFSales_Adminhtml_PointofsalesbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
	   $this->loadLayout();
	   $this->_title($this->__("Point Of Sales"));
	   $this->renderLayout(); 
	}
	//*********************************Method for change user*********************************//
	public function changeuserAction()
	{
		$username=$this->getRequest()->getParam('id');
		//Login Another User
		if(!empty($username))
		{
			umask(0);
			Mage::app('default');
			
			Mage::getSingleton('core/session', array('name' => 'adminhtml'));	
			
			$user = Mage::getModel('admin/user')->loadByUsername($username); // Here admin is the Username
			if (Mage::getSingleton('adminhtml/url')->useSecretKey()) 
			{
			  Mage::getSingleton('adminhtml/url')->renewSecretUrls();
			}
				
			$session = Mage::getSingleton('admin/session');
			$session->setIsFirstVisit(true);
			$session->setUser($user);
			$session->setAcl(Mage::getResourceModel('admin/acl')->loadAcl());
			
			Mage::dispatchEvent('admin_session_user_login_success',array('user'=>$user));
			if ($session->isLoggedIn()) 
			{
				$redirectUrl = Mage::getSingleton('adminhtml/url')->getUrl(Mage::getModel('admin/user')->getStartupPageUrl(), array('_current' => false));
				header('Location: ' . $redirectUrl);
				exit;

			}
		}
	}
	
	//***************Method for enable and disable the product**************************//
	public function changeproductstateAction()
	{
		$pid=$this->getRequest()->getParam('pid');
		$productdata=Mage::getModel('catalog/product');
		$productdata->load($pid);
		$status=$productdata->getStatus();
		if($status==1)
		{
			$productdata->setStatus(2);
			echo '2';
		}
		if($status==2)
		{
			$productdata->setStatus(1);
			echo '1';
		}
		$productdata->save();
	}
	//*********************************Method for create pdf in magento*********************************//
	  public function printAction()
	  {
		  $order_id=$this->getRequest()->getParam('order_id');
		  $helper = Mage::helper('pointofsales');
		  $html=$helper->createpdf($order_id);
		  //$helper->createpdf();
		  echo $html;
	  }
	  
	//***********************Method for check apllied shopping cart price rules***********************//  
	public function validate_shopping_cart_ruleAction()
	{
		$coupon_code=$this->getRequest()->getParam('coupon_code');
		$rules = Mage::getResourceModel('salesrule/rule_collection')->load();
		//echo $rules->getSize();
		foreach ($rules as $rule) 
		{
			//if ($rule->getIsActive()) 
			//{
				$rule = Mage::getModel('salesrule/rule')->load($rule->getId()); 
				if($coupon_code==$rule->getCouponCode())
				{
					//echo $rule['is_active'];
					if($rule['is_active']==0)
					{
						$data='one';
						break;	
					}
					//echo '<pre>';print_r($rule);
					$simple_action=$rule['simple_action'];
					$discount_amount=round($rule['discount_amount'],2);
					$from_date=$rule['from_date'];
					$to_date=$rule['to_date'];
					$data=$simple_action.','.$discount_amount.','.$from_date.','.$to_date;
					break;
				}
				else
				{
					$data='one';
					break;		
				}
				/*$conditions = $rule->getConditions()->asArray();
				foreach( $conditions['conditions'] as $_conditions ):
					foreach( $_conditions['conditions'] as $_condition ):
						$string = explode(',', $_condition['value']);
						for ($i=0; $i<count($string); $i++) 
						{
							$sku = trim($string[$i]);
							if ($sku==$current_sku) 
							{
								echo $rule->getCouponCode(); // Return coupon code that matches the sku condition
							}
						}
					endforeach;
				endforeach;*/
			//}
		}
		echo $data;
	}
	  
	//***********************Method for get custom option name and values***********************//
	public function get_custom_option_namevalueAction()
	{	
		$pid=$this->getRequest()->getParam('pid');
		$option_ids=rtrim($this->getRequest()->getParam('ids'),',');
		$value_ids=rtrim($this->getRequest()->getParam('value_ids'),',');
		$ids=explode(',',$option_ids);
		$value_ids=explode(',',$value_ids);
		$product= Mage::getModel("catalog/product")->load($pid);
		$theoptions = $product->getOptions();
		for($i=0;$i<sizeof($ids);$i++)
		{
			foreach ($theoptions as $option) 
			{
				$option_id=$option['option_id'];		
				if($option_id==$ids[$i])
				{
					$optionType = $option->getType();
					$values = $option->getValues();
					foreach ($values as $k => $v) 
					{
						$option_type_id=$v['option_type_id'];
						if($option_type_id==$value_ids[$i])
						{
							$value_title=$v['title'];
							break;
						}
					}
					break;
				}
			}
			$data.='
				<li>
					<b>
						<i>'.$option["title"].':</i>
					</b>
					'.$value_title.'
				</li>';
		}
		echo $data;
	}
	
	//***********************Method for get custom option name and values***********************//
	public function get_credit_memo_amountAction()
	{
		$resource = Mage::getSingleton('core/resource');
		$pos_credit_memo_table = $resource->getTableName('pos_credit_memo');
		$multiplepayment_table = $resource->getTableName('multiplepayment');
		
		$customer_id=$this->getRequest()->getParam('customer_id');
		//Select records from temporary history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$select = $connection->select()
		->from($pos_credit_memo_table)
		->where('customer_id = ?',$customer_id)
		->where('refund_type = ?','create_voucher');
		$rowsArray = $connection->fetchAll($select); // return all rows
		//$rowArray =$connection->fetchRow($select);   //return row
		foreach($rowsArray as $data)
		{
			$total_amount=$total_amount+$data['credit_memo_amount'];
			$order_ids[]=$data['order_id'];
		}
		$sales_record = Mage::getModel('sales/order')->getCollection()
		->addFieldToFilter('customer_id',$customer_id);
		foreach($sales_record as $data1)
		{
			$select = $connection->select()->from($multiplepayment_table)->where('order_id=?',$data1['entity_id']);
			$rowArray =$connection->fetchrow($select); 
			$return_credit_memo=$return_credit_memo+$rowArray['credit_memo'];
		}
		$final_amount=$total_amount-$return_credit_memo;
		echo $final_amount;
	}
	
	//*********************************Method for get custom options*********************************//
	public function productcustomoptionAction()
	{
		$countryCode = Mage::getStoreConfig('general/country/default');
		$catalog_prices=Mage::getStoreConfig("tax/calculation/price_includes_tax");
		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();
		$pid=$this->getRequest()->getParam('pid');
		$total_custom_options=0;
		$total_checkbox_types=0;
		$total_dropdowns=0;
		$product= Mage::getModel("catalog/product")->load($pid);
		$name=$product->getName(); //get name
		$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);//Get Quantity
		$quantity=(float)$stock->getQty();
		$price=round($product->getPrice(),2);
		//Calculate tax
		$tax= Mage::getModel('tax/calculation');
		$request = $tax->getRateRequest();																  																  		$product_tax_country_id=$request['country_id']; 
		if($product_tax_country_id==$countryCode)
		{
		  $taxClassId = $product->getData("tax_class_id");
		  $taxClasses = Mage::helper("core")->jsonDecode(Mage::helper("tax")->getAllRatesByProductClass());
		  $taxRate = $taxClasses["value_".$taxClassId];
		}
		if($taxRate=="")
		{
			$taxRate=0;	
		}
		$tax=$price*$taxRate/100;
		if($catalog_prices==1)
		{
		  $price_incl_tax=$price;  
		  $price=($price_incl_tax*100)/($taxRate+100);
		}
		else
		{
		  $price_incl_tax=round($price+$tax,2);
		}
		//$price_incl_tax=round(($price+$tax),2);
		$delete_image='adminhtml/default/default/images/pos/delete_image.gif';
		//Code for get custom options 
		$theoptions = $product->getOptions();
		$content.='<ul id="custom_options_ul_product_'.$pid.'">
						<h3>Custom Options</h3>
						<p class="required">* Required Fields</p>
						<div class="clear"></div>';
		$i=1;
		foreach ($theoptions as $option) 
		{	
		   $optionType = $option->getType();
		   $total_custom_options++;
//*************************Code for checkbox custom type**********************************//
			if($optionType=="checkbox")
			{
				$values = $option->getValues();
				$option_id=$option['option_id'];
				$option_title=$option['title'];
				$require=$option['is_require'];
				if(empty($require))
				{
					$required_star="";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="0" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				else
				{
					$required_star="*";
					$validate="Please select one of the options.";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="1" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				$content.='<li id="custom_option_'.$pid.'_'.$i.'">
							<div class="title">
								<label>'.$option_title.'</label><em>'.$required_star.'</em>
							</div>
							<div class="content">
							<input type="hidden" name="custom_option_id_'.$pid.'_'.$i.'" id="custom_option_id_'.$pid.'_'.$i.'" value="'.$option_id.'"/>';
				$j=1;
				foreach ($values as $k => $v) 
				{
					$ckeckbox_option_type_id=$v['option_type_id'];
					$checkbox_option_name=$v['title'];
					$price_type=$v['store_price_type'];
					if($catalog_prices==1)
					{
						$checkbox_option_value=number_format($v['price'],2);
						$checkbox_option_value_without_tax=($v['price']*100)/($taxRate+100);
						$checkbox_option_value_without_tax=number_format($checkbox_option_value_without_tax,2);
						if($price_type=="percent")
						{
							$checkbox_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$checkbox_option_value_without_tax=number_format($price*$v['price']/100,2);
						}
					}
					else
					{
						$tax=$v['price']*$taxRate/100;
						$checkbox_option_value=number_format($tax+$v['price'],2);
						$checkbox_option_value_without_tax=number_format($v['price'],2);
						if($price_type=="percent")
						{
							$checkbox_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$checkbox_option_value_without_tax=number_format($price*$v['price']/100,2);
						}
					}
					$content.= '<div class="check-box">
									<input type="checkbox" name="custom_option_checkbox_'.$pid.'_'.$i.'_'.$j.'" id="custom_option_checkbox_'.$pid.'_'.$i.'_'.$j.'" value="'.$ckeckbox_option_type_id.'" class="custom_option_checkbox" onclick="checkbox_onclick_price('.$pid.','.$i.','.$j.','.$price_incl_tax.','.$price.')" data-price="'.$checkbox_option_value.'"/>
									<label>'.$checkbox_option_name.'</label>
										<span class="price-notice">
											+'.$currency_symbol.'
											<span class="price" id="custom_option_checkbox_price_excl_tax_'.$pid.'_'.$i.'_'.$j.'">'.$checkbox_option_value_without_tax.'</span>
											<input type="hidden" value="0" id="custom_option_checkbox_selected_value_excl_tax_'.$pid.'_'.$i.'_'.$j.'"/>
										</span><br/>
										<span class="price-notice">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+'.$currency_symbol.'
											<span class="price" id="custom_option_checkbox_price_'.$pid.'_'.$i.'_'.$j.'">'.$checkbox_option_value.'</span>&nbsp;Incl tax)
											<input type="hidden" value="0" id="custom_option_checkbox_selected_value_'.$pid.'_'.$i.'_'.$j.'"/>
										</span>
								</div>';
				$j++;
				}
				$content.='<span class="required validate_error">'.$validate.'</span>
						   '.$required_status.'
						   </div></li>';
			$total_checkbox_types++;
			}
//******************************Code for Radio Custom Option*************************//
			if($optionType=="radio")
			{
				$values = $option->getValues();
				$option_id=$option['option_id'];
				$option_title=$option['title'];
				$require=$option['is_require'];
				if(empty($require))
				{
					$required_star="";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="0" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				else
				{
					$required_star="*";
					$validate="Please select one of the options.";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="1" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				$content.='<li id="custom_option_'.$pid.'_'.$i.'">
							<div class="title">
								<label>'.$option_title.'</label><em>'.$required_star.'</em>
							</div>
							<div class="content">
								<input type="hidden" name="custom_option_id_'.$pid.'_'.$i.'" id="custom_option_id_'.$pid.'_'.$i.'" value="'.$option_id.'"/>';
				$j=1;
				foreach ($values as $k => $v) 
				{
					$radio_option_type_id=$v['option_type_id'];
					$radio_option_name=$v['title'];
					$price_type=$v['store_price_type'];
					if($catalog_prices==1)
					{
						$radio_option_value=number_format($v['price'],2);
						$radio_option_value_excl_tax=($v['price']*100)/($taxRate+100);
						$radio_option_value_excl_tax=number_format($radio_option_value_excl_tax,2);
						if($price_type=="percent")
						{
							$radio_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$radio_option_value_excl_tax=number_format($price*$v['price']/100,2);
						}
					}
					else
					{
						$tax=$v['price']*$taxRate/100;
						$radio_option_value=number_format($tax+$v['price'],2);
						$radio_option_value_excl_tax=number_format($v['price'],2);
						if($price_type=="percent")
						{
							$radio_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$radio_option_value_excl_tax=number_format($price*$v['price']/100,2);
						}
					}
					$content.= '<div class="radio-button">
									<input type="radio" name="custom_option_radio_'.$pid.'_'.$i.'" id="custom_option_radio_'.$pid.'_'.$i.'_'.$j.'" value="'.$radio_option_type_id.'" class="custom_option_radio" onclick="radio_onclick_price('.$pid.','.$i.','.$price_incl_tax.','.$price.')" data-price="'.$radio_option_value.'"/>
									<label>'.$radio_option_name.'</label>
										<span class="price-notice">
											+'.$currency_symbol.'
											<span class="price" id="custom_option_radio_price_excl_tax_'.$pid.'_'.$i.'_'.$j.'">'.$radio_option_value_excl_tax.'</span>
										</span><br/>
										<span class="price-notice">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(+'.$currency_symbol.'
											<span class="price" id="custom_option_radio_price_'.$pid.'_'.$i.'_'.$j.'">'.$radio_option_value.'</span>&nbsp;Incl tax)
										</span>
								</div>';
				$j++;
				}
				$content.='<input type="hidden" value="0" id="custom_option_selected_value_'.$pid.'_'.$i.'"/>
						   <input type="hidden" value="0" id="custom_option_selected_value_excl_tax_'.$pid.'_'.$i.'"/>
							<span class="required validate_error">'.$validate.'</span>
						   '.$required_status.'
						   </div></li>';
			}
			//Code for field custom type
			if($optionType=="field")
			{
				$count_field++;
				$require=$option['is_require'];
				if(empty($require))
				{
					$required_star="";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="0" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				else
				{
					$required_star="*";
					$validate="This is a required field.";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="1" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				$title=$option['title'];
				$price=round($option['price'],2);
				$content.='<li id="custom_option_'.$pid.'_'.$i.'">
							<div class="title">
								<label>'.$title.'</label><em>'.$required_star.'</em>
								<span class="price-notice">
									+'.$currency_symbol.'
									<span class="price" id="custom_option_field_price_'.$pid.'_'.$i.'">'.$price.'</span>
								</span>
							</div>
							<div class="content">
								<div class="input-box">
									<input type="text" name="" value="" id="custom_option_field_'.$pid.'_'.$i.'"/>   
								</div>
							</div>
							<span class="required validate_error">'.$validate.'</span>
							'.$required_status.'
						</li>';
			}
			//Code for drop down
			if($optionType=="drop_down")
			{
				$values = $option->getValues();
				$option_id=$option['option_id'];
				$option_title=$option['title'];
				$require=$option['is_require'];
				if(empty($require))
				{
					$required_star="";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="0" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				else
				{
					$required_star="*";
					$validate="This is a required field.";
					$required_status='<input type="hidden" name="custom_option_required_'.$pid.'_'.$i.'" value="1" id="custom_option_required_'.$pid.'_'.$i.'"';
				}
				$content.='<li id="custom_option_'.$pid.'_'.$i.'">
							<div class="title">
								<label>'.$option_title.'</label><em>'.$required_star.'</em>
							</div>
							<div class="content">
								<input type="hidden" name="custom_option_id_'.$pid.'_'.$i.'" id="custom_option_id_'.$pid.'_'.$i.'" value="'.$option_id.'"/>
								<div class="input-box">
									<select name="" id="custom_option_dropdown_'.$pid.'_'.$i.'" onchange="select_onchange_price('.$pid.','.$i.','.$price_incl_tax.','.$price.')">
										<option value="">--Please Select--</option>';
				foreach ($values as $k => $v) 
				{
					$option_type_id=$v['option_type_id'];
					$dropdown_option_name=$v['title'];
					$price_type=$v['store_price_type'];
					if($catalog_prices==1)
					{
						$dropdown_option_value=number_format($v['price'],2);
						$dropdown_option_value_excl_tax=($v['price']*100)/($taxRate+100);
						$dropdown_option_value_excl_tax=number_format($dropdown_option_value_excl_tax,2);
						if($price_type=="percent")
						{
							$dropdown_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$dropdown_option_value_excl_tax=number_format($price*$v['price']/100,2);
						}
					}
					else
					{
						$tax=$v['price']*$taxRate/100;
						$dropdown_option_value=number_format($tax+$v['price'],2);
						$dropdown_option_value_excl_tax=number_format($v['price'],2);
						if($price_type=="percent")
						{
							$dropdown_option_value=number_format($price_incl_tax*$v['price']/100,2);
							$dropdown_option_value_excl_tax=number_format($price*$v['price']/100,2);
						}
					}
					$content.= '<option value="'.$option_type_id.'" data-price="'.$dropdown_option_value.'" data-price_excl_tax="'.$dropdown_option_value_excl_tax.'">'.$dropdown_option_name.' +'.$currency_symbol.$dropdown_option_value_excl_tax.'&nbsp;&nbsp;(+'.$currency_symbol.$dropdown_option_value.'&nbsp;&nbsp;Incl Tax)</option>';
				}
				$content.='</select></div>
						   <input type="hidden" value="0" id="custom_option_selected_value_'.$pid.'_'.$i.'"/>
						   <input type="hidden" value="0" id="custom_option_selected_value_excl_tax_'.$pid.'_'.$i.'"/>
						   <span class="required validate_error">'.$validate.'</span>
						   '.$required_status.'
						   <div></li>';
			}
		$i++;
		}
		$product_custom_option_validate=array($pid,addslashes($name),$quantity,$taxRate,$price,$delete_image,$total_custom_options);
		$product_custom_option_validate=implode(',',$product_custom_option_validate);
		$content.='
					<input type="hidden" name="total_custom_options" id="total_custom_options" value='.$total_custom_options.'>
					<div id="add_to_cart_button_ajax">
						<button type="button" title="close" onclick="product_custom_option_validate('."'".$product_custom_option_validate."'".')" class="dialogButton  addcart_button">
			  				<span>ADD TO CART</span>
		  				</button>
					</div>
					</ul>';
		echo $content;
	}

	
	//*********************************Method for Pagging*********************************//
	public function paggingAction()
	{
		$erp_status=0;
		$erp_status=Mage::getConfig()->getModuleConfig('MDN_AdvancedStock')->is('active', 'true');
		$resource = Mage::getSingleton('core/resource');
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$product_availability = $resource->getTableName('product_availability');
		$cataloginventory_stock_item = $resource->getTableName('cataloginventory_stock_item');
		$cataloginventory_stock = $resource->getTableName('cataloginventory_stock');
		
		//Check attribute
		$entity = 'catalog_product';
		$code = 'favourite_product';
		$fav_product_status=Mage::getStoreConfig("pos/notifications/fav_product_status");
		$attr = Mage::getResourceModel('catalog/eav_attribute')->loadByCode($entity,$code);
		
		$skinurl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN);
		$countryCode = Mage::getStoreConfig('general/country/default');
		$catalog_prices=Mage::getStoreConfig("tax/calculation/price_includes_tax");
		//Get values from ajax
		$grid=$this->getRequest()->getParam('grid');
		$page=$this->getRequest()->getParam('page');
		$pagesize=$this->getRequest()->getParam('pagesize');
		if($grid=="normalproduct")
		{
			Mage::getSingleton('core/session')->setnormal_view($pagesize);
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
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*')
					->addAttributeToFilter('entity_id', array('nin' => $fav_ids1));
				}
				else
				{
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*');
				}
			}
			else
			{
				$getproduct = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*');
			} 
			//->addAttributeToFilter('status', array('eq' => 1))
			$getproduct->setCurPage($page) // set the offset (useful for pagination)	
			->setPageSize($pagesize); // limit number of results returned
			$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_normal_total_records'";
		}
		if($grid=="favproduct")
		{
			Mage::getSingleton('core/session')->setfav_view($pagesize);
			//Count total no of records
			if($attr->getId()) 
			{
				$product = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToFilter('favourite_product', array('eq' => 1));
			}
			//->addAttributeToFilter('status', array('eq' => 1));
			$total_records=$product->getSize();
			$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_normal_total_records'";
			
			//get products with pagesize
			if($attr->getId()) 
			{
				$getproduct = Mage::getModel('catalog/product')->getCollection()
				->addAttributeToSelect('*') // select all attributes
				->addAttributeToFilter('favourite_product', array('eq' => 1));
			}
			//->addAttributeToFilter('status', array('eq' => 1))
			$getproduct->setCurPage($page) // set the offset (useful for pagination)	
			->setPageSize($pagesize); // limit number of results returned
		}
		
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
		//***************Pagging Code for normal products and favourite products*************************
		foreach($getproduct as $product)
		{
			$pid=$product->getId();//get product id
			$custom_option_status=$product['has_options'];
			if($custom_option_status==1)
			{
			  $custom_option_status=1; 
			}
			else
			{
			  $custom_option_status=0;  
			}
			$name=$product->getName(); //get name
			$name=str_replace("'","",$name);
			$imageUrl=$product->getImage();
			$sku=$product->getSku();//get sku
			$price=$product->getPrice(); //get price as cast to float
			//Calculate tax
			$tax= Mage::getModel('tax/calculation');
			$request = $tax->getRateRequest();																  																  			$product_tax_country_id=$request['country_id'];														
			if($product_tax_country_id==$countryCode)
			{
			  $taxClassId = $product->getData("tax_class_id");
			  $taxClasses = Mage::helper("core")->jsonDecode(Mage::helper("tax")->getAllRatesByProductClass());
			  $taxRate = $taxClasses["value_".$taxClassId];
			}
			if($taxRate=="")
			{
				$taxRate=0;	
			}
			$tax=$price*$taxRate/100;
			if($catalog_prices==1)
			{
			  $price_incl_tax=$price;  
			}
			else
			{
			  $price_incl_tax=round($price+$tax,2);
			}
			$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);//Get Quantity
			$quantity=(float)$stock->getQty();
			
			//Check if erp module exist
			if($erp_status==1)
			{

				$select = $connection->select()->from($product_availability)->where('pa_product_id=?',$pid);
				$rowArray =$connection->fetchRow($select);
				
				$select1 = $connection->select()->from($cataloginventory_stock_item)->where('product_id='.$pid.' and stock_id=1');
				$select2 = $connection->select()->from($cataloginventory_stock_item)->where('product_id=?',$pid);
	
				$rowArray1 =$connection->fetchRow($select1);																  
				$rowArray2 =$connection->fetchAll($select2);
				$pa_available_qty=$rowArray['pa_available_qty'];			  
				$quantity=$pa_available_qty;
				if($rowArray1['is_in_stock']==0)
				$quantity=0;
				//Code for get Stock summary
				$stock_summary="";
				$stock_summary='<ul>';
				foreach($rowArray2 as $summary)
				{
				  $stock_id=$summary['stock_id'];
				  $qty=round($summary['qty'],2);
				  $stock_ordered_qty=round($summary['stock_ordered_qty'],2);
				  $available_qty=$qty-$stock_ordered_qty;
				  $select3 = $connection->select()->from($cataloginventory_stock)->where('stock_id=?',$stock_id);
				  $rowArray3 =$connection->fetchRow($select3);															
				  $stock_name=$rowArray3['stock_name'];
				  if($qty>0)
				  {
					  $stock_summary.='
				  <li style="color:green">'.$stock_name.': '.$available_qty.' / '.$qty.'</li>';
				  }
				  else
				  {
					  $stock_summary.='
				  <li style="color:red">'.$stock_name.':  '.$available_qty.' / '.$qty.'</li>';
				  }
				}
				$stock_summary.='</ul>';
			}
			else
			{
				$stock_summary=$quantity;
			}
			
			$projectstatus=$product->getStatus(); //get product status
			//Change Product Status
			if($projectstatus==1)
			{
				$status='<i class="fa fa-unlock"></i>';	
			}
			else
			{
				$status='<i class="fa fa-lock"></i>';	
			}
			//Check imageurl
			if($imageUrl=="no_selection" || $imageUrl=="")
			{
				$imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");
				$popupimage=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");
			}
			else
			{
				/*$imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
				
				if(!getimagesize($imageUrl))
				{
					  $imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");							
				}
				else
				{	
				  $imageUrl=$this->helper('catalog/image')->init($product, 'image')->resize(35,35);
				}*/
				$popupimage = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
				try
				{
				  $imageUrl = Mage::helper('catalog/image')->init($product, 'image')->resize(35,35);
				 }	
				  catch(Exception $e) 
				  {
					  $imageUrl = Mage::getDesign()->getSkinUrl('images/catalog/product/placeholder/image.jpg',array('_area'=>'frontend'));
					  $popupimage=$imageUrl;
				  }
																		
																  }
			//provide class to a tr and increment into counter variable
			if($counter % 2==0)
			{
			  $tr_class="even";  
			}
			else
			{
			  $tr_class="";
			}
			//Create array for product custom options
			$custom_option=array($custom_option_status,$pid,$name,$quantity,$price_incl_tax,50,$popupimage);
			$custom_option=implode(',',$custom_option);
			//write content into table body
			$content.='
			<tr></tr>
			<tr title="#" class="pointer '.$tr_class.'">
				<td class="a-center ">
					<img src="'.$imageUrl.'" onclick="showpopup(1,'.$pid.','."'".$name."'".','.$quantity.','.$price_incl_tax.',50,'."'".$popupimage."'".');" height="35" width="35">                    										
                </td>
				<td>'.$name.'</td>
				<td>'.$size.'</td>
				<td>'.$sku.'</td>
				<td class="a-right ">$'.number_format($price_incl_tax,2).'</td>
				<td class="a-center ">'.$stock_summary.'</td>
				<td class="a-center ">
					<input type="hidden" name="product_state_'.$pid.'" value="'.$projectstatus.'" id="product_status_value_'.$pid.'"/>
						<a onclick="change_product_state('.$pid.')" id="product_status_'.$pid.'">'.$status.'</a>
				</td>
				<td class="a-center">
					<a onclick="selectProduct('."'".$pid."'".','."'".$name."'".','."'".$quantity."'".','."'".$taxRate."'".','."'".$price_incl_tax."'".','."'".$skinurl.'adminhtml/default/default/images/pos/delete_image.gif'."'".','."'".$custom_option."'".')">
						<img src="'.$skinurl.'adminhtml/default/default/images/pos/action_add.png"/>
					</a>                    
				</td>
			</tr>';
			$counter++; 
		}
		echo $content;	
	}
	
	//*********************************Method for searching***********************************************//
	public function searchingAction() 
	{
		$erp_status=0;
		$erp_status=Mage::getConfig()->getModuleConfig('MDN_AdvancedStock')->is('active', 'true');
		$resource = Mage::getSingleton('core/resource');
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$product_availability = $resource->getTableName('product_availability');
		$cataloginventory_stock_item = $resource->getTableName('cataloginventory_stock_item');
		$cataloginventory_stock = $resource->getTableName('cataloginventory_stock');
		
		//Check attribute
		$entity = 'catalog_product';
		$code = 'favourite_product';
		$attr = Mage::getResourceModel('catalog/eav_attribute')->loadByCode($entity,$code);
		$fav_product_status=Mage::getStoreConfig("pos/notifications/fav_product_status");
		//Get values from ajax
		$countryCode = Mage::getStoreConfig('general/country/default');
		$catalog_prices=Mage::getStoreConfig("tax/calculation/price_includes_tax");
		$grid=$this->getRequest()->getParam('grid');
		if($grid=='normalproduct' || $grid=='favproduct')
		{
			$name=$this->getRequest()->getParam('name');
			$sku=$this->getRequest()->getParam('sku');	
			$price=$this->getRequest()->getParam('price');
			$status=$this->getRequest()->getParam('status');
			if($status=="")
			{
				//$status=1;
			}
			//Set session values for product status
			if($grid=='normalproduct')
			{
				Mage::getSingleton('core/session')->setnormal_grid_status($status);	
			}
			if($grid=='favproduct')
			{
				Mage::getSingleton('core/session')->setfav_grid_status($status);	
			}	
		}
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
		if($grid=="normalproduct")
		{
			if($resetfilter==1)
			{
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
				//->addAttributeToFilter('status', array('eq' => 1));
				$total_records=$product->getSize();
				$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_normal_total_records'/>";
				
				//select product with pagesize
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
						$getproduct = Mage::getModel('catalog/product')->getCollection()
						->addAttributeToSelect('*')
						->addAttributeToFilter('entity_id', array('nin' => $fav_ids1));
					}
					else
					{
						$getproduct = Mage::getModel('catalog/product')->getCollection()
						->addAttributeToSelect('*');
					}
				}
				else
				{
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*');
				}
				//$getproduct->addAttributeToFilter('status', array('eq' => 1))
				$getproduct->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
			}
			else
			{
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
				if($name!="")
				$product->addAttributeToFilter('name', array('like' => '%'.$name.'%'));
				if($sku!="")
          		$product->addAttributeToFilter('sku', array('like' => '%'.$sku.'%'));
				if($price!="")
				$product->addAttributeToFilter('price', array('eq' => $price));
				if($status!="")
				$product->addAttributeToFilter('status', array('eq' => $status));
				$total_records=$product->getSize();
				$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_normal_total_records'/>";
				
				//select product with pagesize
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
						$getproduct = Mage::getModel('catalog/product')->getCollection()
						->addAttributeToSelect('*')
						->addAttributeToFilter('entity_id', array('nin' => $fav_ids1));
					}
					else
					{
						$getproduct = Mage::getModel('catalog/product')->getCollection()
						->addAttributeToSelect('*');
					}	
				}
				else
				{
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*');
				}
				if($name!="")
				$getproduct->addAttributeToFilter('name', array('like' => '%'.$name.'%'));
				if($sku!="")
          		$getproduct->addAttributeToFilter('sku', array('like' => '%'.$sku.'%'));
				if($price!="")
				$getproduct->addAttributeToFilter('price', array('eq' => $price));
				if($status!="")
				$getproduct->addAttributeToFilter('status', array('eq' => $status));
				$getproduct->addAttributeToSelect('*') 
				->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
			}
		}
		if($grid=="favproduct")
		{
			//Code executes when searching action is peform
			if($resetfilter==1)
			{
				//Count total no of records
				if($attr->getId()) 
				{
					$product = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToFilter('favourite_product', array('eq' => 1));
				}
				//->addAttributeToFilter('status', array('eq' => 1));
				$total_records=$product->getSize();
				$content.="<input type='hidden' name='search_fav_total_records' value='".$total_records."' id='search_fav_total_records'/>";
				
				//select product with pagesize
				if($attr->getId()) 
				{
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*') // select all attributes
					->addAttributeToFilter('favourite_product', array('eq' => 1));
				}
				//->addAttributeToFilter('status', array('eq' => 1))
				$getproduct->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
			}
			else
			{
				//Count total no of records
				if($attr->getId()) 
				{
					$product = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToFilter('favourite_product', array('eq' => 1));
				}
				if($name!="")
				$product->addAttributeToFilter('name', array('like' => '%'.$name.'%'));
				if($sku!="")
          		$product->addAttributeToFilter('sku', array('like' => '%'.$sku.'%'));
				if($price!="")
				$product->addAttributeToFilter('price', array('eq' => $price));
				if($status!="")
				$product->addAttributeToFilter('status', array('eq' => $status));
				$total_records=$product->getSize();
				$content.="<input type='hidden' name='search_normal_total_records' value='".$total_records."' id='search_fav_total_records'/>";
				
				//Get products with pagesize
				if($attr->getId()) 
				{
					$getproduct = Mage::getModel('catalog/product')->getCollection()
					->addAttributeToSelect('*') // select all attributes
					->addAttributeToFilter('favourite_product', array('eq' => 1));
				}
				if($name!="")
				$getproduct->addAttributeToFilter('name', array('like' => '%'.$name.'%'));
				if($sku!="")
          		$getproduct->addAttributeToFilter('sku', array('like' => '%'.$sku.'%'));
				if($price!="")
				$getproduct->addAttributeToFilter('price', array('eq' => $price));
				if($status!="")
				$getproduct->addAttributeToFilter('status', array('eq' => $status));
				$getproduct->addAttributeToSelect('*')
				->setCurPage($page) // set the offset (useful for pagination)	
				->setPageSize($pagesize); // limit number of results returned
			}
		}
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
				->setOrder('entity_id', 'DESC')
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
					$customer1_count=$customer1->getSize();
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
					//echo'<pre>';print_r($customer5->getSize());die;
					foreach($customer5 as $telephonedata)
					{
						$state_data[] = array('eq' => $telephonedata['parent_id']);		
					}
					$customer->addFieldToFilter('entity_id',$state_data);
				}
				//Filter by customer created date
				/*if($customer_since_from!="" and $customer_since_to=="")
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
				}*/
				if(!empty($customer_since_from) or !empty($customer_since_to))
				{
					if(empty($customer_since_to))
					{
						$customer_since_to = date('Y-m-d');
					}
					else
					{
						$customer_since_to=date('Y-m-d', strtotime($customer_since_to. ' + 1 days'));	
					}
					$date_from = date('Y-m-d H:i:s', strtotime($customer_since_from));
					$date_to = date('Y-m-d H:i:s', strtotime($customer_since_to));
					//$customer->addFieldToFilter('created_at',array('lteq'=>$customer_since_to));
					$customer->addFieldToFilter('created_at', array('from' => $date_from,'to'=>$date_to));
				}
				$total_records=$customer->getSize();
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
					$getcustomer1_count=$getcustomer1->getSize();
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
					//echo'<pre>';print_r($customer5->getSize());die;
					foreach($getcustomer5 as $statedata)
					{
						$state_data[] = array('eq' => $statedata['parent_id']);		
					}
					$getcustomer->addFieldToFilter('entity_id',$state_data);
				}
				//Filter by customer id's
				/*if($customer_since_from!="" and $customer_since_to=="")
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
				}*/
				if(!empty($customer_since_from) or !empty($customer_since_to))
				{
					$customer->addFieldToFilter('created_at', array('from' => $date_from,'to'=>$date_to));
				}
				$getcustomer->addAttributeToSelect('*')
				->setOrder('entity_id', 'DESC')
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
		$counter=0;
		foreach($getproduct as $product)
		{
			$pid=$product->getId();//get product id
			$custom_option_status=$product['has_options'];
			if($custom_option_status==1)
			{
			  $custom_option_status=1; 
			}
			else
			{
			  $custom_option_status=0;  
			}
			$name=$product->getName(); //get name
			$name=str_replace("'","",$name);
			$imageUrl=$product->getImage();
			$sku=$product->getSku();//get sku
			$price=round($product->getPrice(),2); //get price as cast to float
			//Calculate tax
			$tax= Mage::getModel('tax/calculation');
			$request = $tax->getRateRequest();																  																  			$product_tax_country_id=$request['country_id'];														
			if($product_tax_country_id==$countryCode)
			{
			  $taxClassId = $product->getData("tax_class_id");
			  $taxClasses = Mage::helper("core")->jsonDecode(Mage::helper("tax")->getAllRatesByProductClass());
			  $taxRate = $taxClasses["value_".$taxClassId];
			}
			if($taxRate=="")
			{
				$taxRate=0;	
			}
			$tax=$price*$taxRate/100;
			if($catalog_prices==1)
			{
			  $price_incl_tax=$price;  
			}
			else
			{
			  $price_incl_tax=round($price+$tax,2);
			}
			$stock = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);//Get Quantity
			$quantity=(float)$stock->getQty();
			
			//Check if erp module exist

			if($erp_status==1)

			{

				$select = $connection->select()->from($product_availability)->where('pa_product_id=?',$pid);
				$rowArray =$connection->fetchRow($select);
				
				$select1 = $connection->select()->from($cataloginventory_stock_item)->where('product_id='.$pid.' and stock_id=1');
				$select2 = $connection->select()->from($cataloginventory_stock_item)->where('product_id=?',$pid);
	
				$rowArray1 =$connection->fetchRow($select1);																  
				$rowArray2 =$connection->fetchAll($select2);
				$pa_available_qty=$rowArray['pa_available_qty'];			  
				$quantity=$pa_available_qty;
				if($rowArray1['is_in_stock']==0)
				$quantity=0;
				//Code for get Stock summary
				$stock_summary="";
				$stock_summary='<ul>';
				foreach($rowArray2 as $summary)
				{
				  $stock_id=$summary['stock_id'];
				  $qty=round($summary['qty'],2);
				  $stock_ordered_qty=round($summary['stock_ordered_qty'],2);
				  $available_qty=$qty-$stock_ordered_qty;
				  $select3 = $connection->select()->from($cataloginventory_stock)->where('stock_id=?',$stock_id);
				  $rowArray3 =$connection->fetchRow($select3);															
				  $stock_name=$rowArray3['stock_name'];
				  if($qty>0)
				  {
					  $stock_summary.='
				  <li style="color:green">'.$stock_name.': '.$available_qty.' / '.$qty.'</li>';
				  }
				  else
				  {
					  $stock_summary.='
				  <li style="color:red">'.$stock_name.':  '.$available_qty.' / '.$qty.'</li>';
				  }
				}
				$stock_summary.='</ul>';
			}
			else
			{
				$stock_summary=$quantity;
			}
			
			$projectstatus=$product->getStatus(); //get product status
			//Change Product Status
			if($projectstatus==1)
			{
				$status='<i class="fa fa-unlock"></i>';	
			}
			else
			{
				$status='<i class="fa fa-lock"></i>';	
			}
			//Check imageurl
			if($imageUrl=="no_selection" || $imageUrl=="")
			{
				$imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");
				$popupimage=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");
			}
			else
			{
				/*$imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
				
				if(!getimagesize($imageUrl))
				{
					  $imageUrl=Mage::getSingleton('catalog/product_media_config')->getBaseMediaUrl(). '/placeholder/' .Mage::getStoreConfig("catalog/placeholder/thumbnail_placeholder");							
				}
				else
				{	
				  $imageUrl=$this->helper('catalog/image')->init($product, 'image')->resize(35,35);
				}*/
				$popupimage = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $product->getImage();
				try
				{
				  $imageUrl = Mage::helper('catalog/image')->init($product, 'image')->resize(35,35);
				 }	
				  catch(Exception $e) 
				  {
					  $imageUrl = Mage::getDesign()->getSkinUrl('images/catalog/product/placeholder/image.jpg',array('_area'=>'frontend'));
					  $popupimage=$imageUrl;
				  }
																		
																  }
			//provide class to a tr and increment into counter variable
			if($counter % 2==0)
			{
			  $tr_class="even";  
			}
			else
			{
			  $tr_class="";
			}
			//Create array for product custom options
			$custom_option=array($custom_option_status,$pid,$name,$quantity,$price_incl_tax,50,$popupimage);
			$custom_option=implode(',',$custom_option);
			$counter++;
			//write content into table body
			$content.='
			<tr></tr>
			<tr title="#" class="pointer '.$tr_class.'">
				<td class="a-center ">
					<img src="'.$imageUrl.'" onclick="showpopup(1,'.$pid.','."'".$name."'".','.$quantity.','.$price_incl_tax.',50,'."'".$popupimage."'".');" height="35" width="35">                    										
                </td>
				<td>'.$name.'</td>
				<td>'.$size.'</td>
				<td>'.$sku.'</td>
				<td class="a-right ">$'.number_format($price_incl_tax,2).'</td>
				<td class="a-center ">'.$stock_summary.'</td>
				<td class="a-center ">
					<input type="hidden" name="product_state_'.$pid.'" value="'.$projectstatus.'" id="product_status_value_'.$pid.'"/>
					<a onclick="change_product_state('.$pid.')" id="product_status_'.$pid.'">'.$status.'
					</a>
				</td>
				<td class="a-center">
	<a onclick="selectProduct('.$pid.','."'".$name."'".','."'".$quantity."'".','."'".$taxRate."'".','."'". $price_incl_tax."'".','."'".$skinurl.'adminhtml/default/default/images/pos/delete_image.gif'."'".','."'".$custom_option."'".')">
						<img src="'.$skinurl.'adminhtml/default/default/images/pos/action_add.png"/>
					</a>                    
				</td>
			</tr>'; 
			$counter++;
		}
		echo $content;	
	}
	
	//*********************************Method for create temp history*********************************//
	public function temp_historyAction()
	{
		$resource = Mage::getSingleton('core/resource');
		$temporary_history_table = $resource->getTableName('temporary_history');
		$temporary_product_history_table = $resource->getTableName('temporary_product_history');
		
		$qty=$_REQUEST['qty'];
		$total_amount=$_REQUEST['total_amount'];
		$data=$_REQUEST['data'];
		//Get customer info
		$customer_data=explode(',',$_REQUEST['cdata']);
		$customer_mode=$customer_data[0];
		if($customer_mode=='guest')
		{
			$order_comments=$customer_data[1];
			$invoice_comments=$customer_data[2];
		}
		if($customer_mode!='guest')
		{
			$customer_email=$customer_data[1];
			if($customer_mode=='existing')
			{	
				$customer_id=$customer_data[1];
			}
			$customer_fname=$customer_data[2];
			$customer_lname=$customer_data[3];
			$customer_company=$customer_data[4];
			$customer_address1=$customer_data[5];
			$customer_address2=$customer_data[6];
			$customer_city=$customer_data[7];
			$customer_zip=$customer_data[8];
			$customer_region=$customer_data[9];
			$customer_mobile=$customer_data[10];
			$customer_fax=$customer_data[11];
			$order_comments=$customer_data[12];
			$invoice_comments=$customer_data[13];
		}
		//echo'<pre>';print_r($customer_data);
		
		//Current login user name
		$admin_user_session = Mage::getSingleton('admin/session');
		$current_user_name = $admin_user_session->getUser()->getUsername();
		
		$customer_name=$_REQUEST['customer_firstname'].' '.$_REQUEST['customer_lastname'];
		if($customer_name==" ")
		$customer_name='anonymous';
		//set time
		$time_offset ="525"; // Change this to your time zone
		$time_a = ($time_offset * 120);
		$time = date("h:i:s",time() + $time_a);
		//Select records from temporary history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$select = $connection->select()->from($temporary_history_table, array('*'));// where id =1
		$rowsArray = $connection->fetchAll($select); // return all rows
		$rowArray =$connection->fetchRow($select);   //return row
		$array_size=sizeof($rowsArray);
		if($array_size==0)
		{	
			$array_size=1;
		}
		for($i=$array_size-1;$i<=$array_size-1;$i++)
		{
			$last_temp_id=$rowsArray[$i]['temporary_history_id'];
		}
		$last_temp_id=$last_temp_id+1;
		//Code for insert data into temporary history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$connection->beginTransaction(); 
		$__fields = array();
		$__fields['temporary_history_id'] = $last_temp_id;
		$__fields['pos_username'] = $current_user_name;
		$__fields['amount'] = $total_amount;
		$__fields['qty'] = $qty;
		$__fields['time'] = $time;
		$connection->insert($temporary_history_table, $__fields);
		$connection->commit();
		
		//Code for insert data into temporary product history table 
		$temp_product_data = array();
		$temp_product_data['temp_id'] = $last_temp_id;
		$temp_product_data['temp_product_data'] = $data;
		$temp_product_data['customer_mode'] = $customer_mode;
		if($customer_mode=='new')
		{
			$temp_product_data['customer_email'] = $customer_email;
		}
		if($customer_mode=='existing')
		{
			$temp_product_data['customer_id'] = $customer_id;
		}
		if($customer_mode!='guest')
		{
			$temp_product_data['customer_fname'] = $customer_fname;
			$temp_product_data['customer_lname'] = $customer_lname;
			$temp_product_data['customer_company'] = $customer_company;
			$temp_product_data['customer_address1'] = $customer_address1;
			$temp_product_data['customer_address2'] = $customer_address2;
			$temp_product_data['customer_city'] = $customer_city;
			$temp_product_data['customer_zip'] = $customer_zip;
			$temp_product_data['customer_region'] = $customer_region;
			$temp_product_data['customer_mobile'] = $customer_mobile;
			$temp_product_data['customer_fax'] = $customer_fax;
		}
		$temp_product_data['order_comments'] = $order_comments;
		$temp_product_data['invoice_comments'] = $invoice_comments;
		//print_r($temp_product_data);die;
		$connection->insert($temporary_product_history_table, $temp_product_data);
		$connection->commit();
		echo 'Record saved';
	}
	
	//*********************************Method for get temporary products*********************************//
	public function get_temp_productsAction()
	{
		$resource = Mage::getSingleton('core/resource');
		$temporary_history_table = $resource->getTableName('temporary_history');
		$temporary_product_history_table = $resource->getTableName('temporary_product_history');
		
		$temp_id=$this->getRequest()->getParam('id');
		//Select records from temporary_product_history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
		$select = $connection->select()->from($temporary_product_history_table, array('*'))->where('temp_id=?',$temp_id);// where id =1
		$rowArray =$connection->fetchRow($select);   //return row
		$data.=$rowArray['temp_product_data'];
		$customer_data=array();
		$customer_data[]=$rowArray['customer_mode'];
		$customer_data[]=$rowArray['customer_email'];
		$customer_data[]=$rowArray['customer_fname'];
		$customer_data[]=$rowArray['customer_lname'];
		$customer_data[]=$rowArray['customer_company'];
		$customer_data[]=$rowArray['customer_address1'];
		$customer_data[]=$rowArray['customer_address2'];
		$customer_data[]=$rowArray['customer_city'];
		$customer_data[]=$rowArray['customer_zip'];
		$customer_data[]=$rowArray['customer_region'];
		$customer_data[]=$rowArray['customer_mobile'];
		$customer_data[]=$rowArray['customer_fax'];
		$customer_data[]=$rowArray['customer_id'];
		$customer_data[]=$rowArray['order_comments'];
		$customer_data[]=$rowArray['invoice_comments'];
		//print_r($customer_data);die;
		$cdata=rtrim(implode(',',$customer_data),',');
		//echo $cdata;die;
		$data.='<input type="hidden" name="customer_info" id="customer_information" value="'.$cdata.'"/>';
		
		//Delete records from temporary_history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$__condition = array($connection->quoteInto('temporary_history_id=?', $temp_id));
		$connection->delete($temporary_history_table, $__condition);
		
		//Delete records from temporary_product_history table
		$__condition = array($connection->quoteInto('temp_id=?', $temp_id));
		$connection->delete($temporary_product_history_table, $__condition);
		echo $data;
	}
	
	//*********************************Method for delete temporary record*********************************//
	public function delete_temp_dataAction()
	{
		$resource = Mage::getSingleton('core/resource');
		$temporary_history_table = $resource->getTableName('temporary_history');
		$temporary_product_history_table = $resource->getTableName('temporary_product_history');
		
		$temp_id=$this->getRequest()->getParam('id');
		//Delete records from temporary_history table
		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$__condition = array($connection->quoteInto('temporary_history_id=?', $temp_id));
		$connection->delete($temporary_history_table, $__condition);
		
		//Delete records from temporary_product_history table
		$__condition = array($connection->quoteInto('temp_id=?', $temp_id));
		$connection->delete($temporary_product_history_table, $__condition);
	}
	
	//*********************************Method for create order*********************************//
	public function createorderAction()
	{
		$resource = Mage::getSingleton('core/resource');
		$multiplepayment_table = $resource->getTableName('multiplepayment');
		$pos_sales_report_table = $resource->getTableName('pos_sales_report');
		
		//$quote = Mage::getModel('sales/quote')->setStoreId(Mage::app()->getStore()->getId());
		$store = Mage::app()->getStore();
		
		//$quote = Mage::getModel('sales/quote')->setStoreId($store->getId());
		$config_store_id= Mage::getStoreConfig("pos/notifications/pos_order_store");
		if(empty($config_store_id))
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
			$config_store_id=$return_array[0]['value'];	
		}
		
		$quote = Mage::getModel('sales/quote')->setStoreId($config_store_id);
		$customer_mode = $_REQUEST['customer_mode'];
		$product_ids = $_REQUEST['product_ids'];
		$order_comments=$_REQUEST['comments'];
		$paymentmethod=$_REQUEST['paymentmethod'];
		$shippingmethod=$_REQUEST['shippingmethod'];
		//$shippingmethod='flatrate_flatrate';
		$product_ids=explode(',',$product_ids);
		//Get region from config for all users
		$REGION = Mage::getStoreConfig("pos/notifications/guest_region");
		if($REGION=="")
		$REGION=12;
		$EMAIL = Mage::getStoreConfig("pos/notifications/guest_email");
		if($EMAIL=="")
		$EMAIL="customer@gmail.com";
		$FIRSTNAME =Mage::getStoreConfig("pos/notifications/guest_fname");
		if($FIRSTNAME=="")
		$FIRSTNAME="anonymous";
		$LASTNAME =Mage::getStoreConfig("pos/notifications/guest_lname");
		if($LASTNAME=="")
		$LASTNAME="anonymous";
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
		switch($customer_mode)
		{
			case 'guest':
			$checkout_method="guest";
			$countryCode = Mage::getStoreConfig('general/country/default');
			$quote->setCustomerEmail($EMAIL);
			$subscriber_email=$EMAIL;
			//create address variable for new customer
			$_custom_address = array (
			  'firstname' => $FIRSTNAME,
			  'lastname' => $LASTNAME,
			  'street' => array($ADDRESS1,$ADDRESS2),
			  'city' =>$CITY,
			  'postcode' => $ZIP,
			  'telephone' => $PHONE,
			  'country_id' => $countryCode, /* Croatia */
			  'region_id' => $REGION,
			  'fax' => $FAX,
		  	);
			//print_r($_custom_address);die;
			break;
			
			case 'new':
			$checkout_method="register";
			//get values for new customer
			$firstname = $_REQUEST['customer_firstname'];
			$lastname = $_REQUEST['customer_lastname'];
			$email = $_REQUEST['customer_email'];
			$subscriber_email=$email;
			$customers=Mage::getModel("customer/customer")->getCollection();
			foreach($customers as $cdata)
			{
				if($cdata['email']==$email)
				{	
					echo'Email already exits';
					$email_error=1;
					exit();	
				}
			}
			if($email_error==1)
			{
				return false;	
			}
			$address1 = $_REQUEST['address1'];
			if($address1=="")
			$address1 = $ADDRESS1;
			$address2 = $_REQUEST['address2'];
			if($address2=="")
			$address2 = $ADDRESS2;
			$city = $_REQUEST['city'];
			if($city=="")
			$city = $CITY;
			$zip = $_REQUEST['zip'];
			if($zip=="")
			$zip = $ZIP;
			$country = $_REQUEST['country'];
			$region_id = $_REQUEST['region'];
			if($region_id=="")
			$region_id = $REGION;
			$phone = $_REQUEST['phone'];

			if($phone=="")
			$phone = $PHONE;
			$fax = $_REQUEST['fax'];
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
        	$quote->assignCustomer($customer);
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
			break;
			
			case 'existing':
			$checkout_method="register";
			//Code for get address of customer
			$fname = $_REQUEST['fname'];
			$lname = $_REQUEST['lname'];
			$address1 = $_REQUEST['address1'];
			if($address1=="")
			$address1 = $ADDRESS1;
			$address2 = $_REQUEST['address2'];
			if($address2=="")
			$address2 = $ADDRESS2;
			$city = $_REQUEST['city'];
			if($city=="")
			$city = $CITY;
			$zip = $_REQUEST['zip'];
			if($zip=="")
			$zip = $ZIP;
			$country = $_REQUEST['country'];
			$region_id = $_REQUEST['region'];
			if($region_id=="")
			$region_id = $REGION;
			$phone = $_REQUEST['phone'];
			if($phone=="")
			$phone = $PHONE;
			$fax = $_REQUEST['fax'];
			if($fax=="")
			$fax = $FAX;
			$_custom_address = array (
				  'firstname' => $fname,
				  'lastname' => $lname,
				  'street' => array($address1,$address2),
				  'city' =>$city,
				  'region_id' => $region_id,
				  'postcode' => $zip,
				  'country_id' => $country, /* Croatia */
				  'telephone' => $phone,
				  'fax' => $fax,
				);
			$customer_id = $_REQUEST['customer_id'];
			$customer = Mage::getModel('customer/customer')->load($customer_id);
			$subscriber_email=$customer['email'];
			$quote->assignCustomer($customer);
			//print_r($customer);die;
			//echo $default_shipping=$customer->default_shipping;die;
			if(empty($default_shipping))
			{
				//print_r($_custom_address);die;
				//set address for new customer
				$customAddress = Mage::getModel('customer/address');
				$customAddress->setData($_custom_address)
				->setCustomerId($customer_id)
				->setIsDefaultBilling('1')
				->setIsDefaultShipping('1')
				->setSaveInAddressBook('1');
				$customAddress->save();		
			}
			else
			{
				$customAddress = Mage::getModel('customer/address');
				$customAddress->setData($_custom_address)
				->setCustomerId($customer_id)
				->setIsDefaultBilling('0')
				->setIsDefaultShipping('1');
				//->setSaveInAddressBook('1');
				$customAddress->save();
			}
			break;
		}
		$billingAddress = $quote->getBillingAddress()->addData($_custom_address);
		$shippingAddress = $quote->getShippingAddress()->addData($_custom_address);
		$newdiscount = array();
		$subtotal = $amount = 0;
		foreach ($product_ids as $product_id) 
		{
			$custom_option_product=$product_id;
			$ind_pid="";	
			for($i=0;$i<=strlen($product_id);$i++)
			{
				if($product_id[$i]=='_')
				break;
				$ind_pid.=$product_id[$i];
			}
			$product_id=$ind_pid;
			$product = Mage::getModel('catalog/product')->load($product_id);
			$custom_option_status=$product['has_options'];
			if($custom_option_status==1)
			$product_id=$custom_option_product;
			$qty=$_REQUEST['product_selected_col_2_'.$product_id];
			if(!empty($_REQUEST['product_selected_col_5_'.$product_id]))
			{
				$discount=$_REQUEST['product_selected_col_5_value_'.$product_id];
			}
			if(!empty($_REQUEST['product_selected_col_6_'.$product_id]))
			{
				$discount=$_REQUEST['product_selected_col_6_'.$product_id];
			}
			$newdiscount[] = $discount;
			$qty=$_REQUEST['product_selected_col_2_'.$product_id];
			if($custom_option_status==0)
			{
				$buyInfo = array
				(
					'qty' => $qty,
				);
			}
			if($custom_option_status==1)
			{
				$option_ids=explode(',',$_REQUEST['product_'.$product_id.'_option_ids']);
				$option_values=explode(',',$_REQUEST['product_'.$product_id.'_option_values']);
				$product_custom_option_data=array();
				for($i=0;$i<count($option_ids);$i++)
				{
					if(isset($product_custom_option_data[$option_ids[$i]]))
					{
						$product_custom_option_data[$option_ids[$i]]= $product_custom_option_data[$option_ids[$i]].",".$option_values[$i];
					}
					else
					{
						$product_custom_option_data[$option_ids[$i]]="$option_values[$i]";
					}
				}
				$buyInfo = array
				(
					'qty' => $qty,
					'options' => $product_custom_option_data
				);
			}
			$quote->addProduct($product, new Varien_Object($buyInfo));
			$discount=0;
		}
		$couponCode='ABCD';
		// Collect Rates and Set Shipping & Payment Method
		$shippingAddress->setCollectShippingRates(true)
						->collectShippingRates()
						->setShippingMethod($shippingmethod)
						->setPaymentMethod($paymentmethod);
		// Set Sales Order Payment
		$quote->getPayment()->importData(array('method' => $paymentmethod ));		
		$q = 0;
		//Code for provide discount on every product
		foreach($quote->getAllItems() as $qitem)
		{
			 $qitem->setDiscountAmount($newdiscount[$q]);
			 $q++;
		}
		$service = Mage::getModel('sales/service_quote', $quote);
		try 
		{
    		$service->submitAll();
		}
		catch (Exception $ex) 
		{
    		echo $error=$ex->getMessage();die;
		}   
		$order = $service->getOrder();
		$grand_total=$order->getGrandTotal();
		//total discount values
		foreach($newdiscount as $discount)
		{
			$grand_total=$grand_total-$discount;	
		}
		$order->setGrandTotal($grand_total);
		$order->setBaseGrandTotal($grand_total);
		if($_REQUEST['is_paid']==1)
		{
			$invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
			$invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
			$invoice->register();
			$transaction = Mage::getModel('core/resource_transaction')->addObject($invoice)->addObject($invoice->getOrder());
			$transaction->save();
			$order->setData('state',"complete");
			$order->setStatus("complete");
			$history = $order->addStatusHistoryComment($order_comments, false);
			$history->setIsCustomerNotified(false);
			$order->save();
			$order_id=$order->getId();
			$id=$invoice->getId();
			//Now I let’s make shipment:
			$_order = Mage::getModel('sales/order')->load($order_id);
			if($_order->canShip())
			{           
				$shipmentId = Mage::getModel('sales/order_shipment_api')->create($_order->getIncrementId(), $itemsarray ,'your_comment' ,false,1);
				$shipmentId;   // Outputs Shipment Increment Number
			}
		}
		else
		{
			$order_id=$order->getId();		
		}
		if($paymentmethod=='pointofsales')
		{
			$bank_amount=$_REQUEST['multiple_bank_value'];
			$check_amount=$_REQUEST['multiple_check_value'];
			$cash_amount=$_REQUEST['multiple_cash_value'];
			$credit_memo=$_REQUEST['return_credit_memo_amount'];
			$voucher=$_REQUEST['multiple_voucher_value'];
			if($bank_amount=="")
			$bank_amount=0;
			if($check_amount=="")
			$check_amount=0;
			if($cash_amount=="")
			$cash_amount=0;
			if($credit_memo=="")
			$credit_memo=0;
			if($voucher=="")
			$voucher=0;
			
			//Code for insert data into multiplepayment table
			$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
			$connection->beginTransaction(); 
			$__fields = array();
			$__fields['order_id'] = $order_id;
			$__fields['bank_amount'] = $bank_amount;
			$__fields['check_amount'] = $check_amount;
			$__fields['cash_amount'] = $cash_amount;
			$__fields['credit_memo'] = $credit_memo;
			$__fields['voucher'] = $voucher;
			//print_r($__fields);
			$connection->insert($multiplepayment_table, $__fields);
			$connection->commit();
		}
		if(isset($_REQUEST['newsletter']))
		{
			Mage::getModel('newsletter/subscriber')->subscribe($subscriber_email);
		}
		//Current login user name
		$admin_user_session = Mage::getSingleton('admin/session');
		$pos_user_id = $admin_user_session->getUser()->getUserId();
		$pos_user_name = $admin_user_session->getUser()->getUsername();
		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$connection->beginTransaction();
		$__fields = array();
		$__fields['order_id'] = $order_id;
		$__fields['pos_user_id'] = $pos_user_id;
		$__fields['pos_user_name'] = $pos_user_name;
		//print_r($__fields);
		$connection->insert($pos_sales_report_table, $__fields);
		$connection->commit();
		echo "success,".$order_id."";    	
		//printf("Created order %s\n", $order->getIncrementId());
	}
}
