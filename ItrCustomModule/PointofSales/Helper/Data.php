<?php
class ItrCustomModule_PointofSales_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function createpdf($order_id)
	{
			$resource = Mage::getSingleton('core/resource');
			$pos_sales_report_table = $resource->getTableName('pos_sales_report');
			$pos_credit_memo_table = $resource->getTableName('pos_credit_memo');
			$multiplepayment_table = $resource->getTableName('multiplepayment');
			
			$store_name=Mage::getStoreConfig("pos/pointofsales/store_name");
			$header=Mage::getStoreConfig("pos/pointofsales/receipt_header");
			$footer=Mage::getStoreConfig("pos/pointofsales/receipt_footer");
			$width=Mage::getStoreConfig("pos/pointofsales/receipt_width");
			$currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
			$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();
			//$unit=Mage::getStoreConfig("pos/pointofsales/receipt_unit");
			$unit='mm';
			$margin_left=Mage::getStoreConfig("pos/pointofsales/receipt_margin_left");
			define(PDF_UNIT,'in');
			define(PDF_PAGE_FORMAT,'A1');
			
			//$tcpdf = new TCPDF_TCPDF();
			$custom_layout = array($width,8);
			$pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,$custom_layout, true, 'UTF-8', false);
			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->setPageUnit($unit);
			
			// set margins
			$pdf->SetMargins($margin_left,5,5,true);
			
			$pdf->setPageOrientation('',false,0);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}

			$pdf->SetAutoPageBreak(TRUE, 15);
			// set font
			$pdf->SetFont('times', '', 9);
			
			// add a page
			$pdf->AddPage();

			// create some HTML content for header content
			$html = '<table align="center">
				<tr style="margin-bottom:10px;">
					<td style="font-size:13px;">
						<b>'.$store_name.'</b>
					</td>
				</tr>
				<tr>
					<td>'.$header.'</td>
				</tr>
			</table>';
			$html1 = '
			<table align="center" style="width:250px;margin:0px auto 10px auto;text-align:center;">
				<tr style="margin-bottom:10px;">
					<td style="font-size:13px;">
						<b>'.$store_name.'</b>
					</td>
				</tr>
				<tr>
					<td>
						'.$header.'
					</td>
				</tr>
			</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html1;
			//Get Order Details
			$order=Mage::getModel('sales/order')->load($order_id); //use an entity id here
			//echo'<pre>';print_r($order);
			$payment_method = $order->getPayment()->getMethodInstance()->getTitle();
			$created_at=strtotime($order->getCreatedAt());
			$increment_id=$order['increment_id'];
			$date=date('d/m/Y',$created_at);
			$time=date('H:m:s',$created_at);
			//Get current system time
			$default_zone=Mage::getStoreConfig("general/locale/timezone");
			date_default_timezone_set($default_zone);
			$timestamp = time();
			$current_time = date("h:i:s", $timestamp);
			
			//Get Login User details
			$admin_user_session = Mage::getSingleton('admin/session');
	   		$current_user_name = $admin_user_session->getUser()->getUsername();
			// create some HTML content for date and vendor section
			$html = '
			<table style="width:100%">
				<tr>
					<td align="left">
						<label>'.$this->__("Date").' :</label>
						<span>'.$date.'</span>
					</td>
					<td align="right">
						<label>'.$this->__("Sale").' :</label>
						<span>'.$increment_id.'</span>
					</td>
				</tr>
				<tr>
					<td align="left">
						<label>'.$this->__("Hour").' :</label>
						<span>'.$current_time.'</span>
					</td>
					<td align="right">
						<label>'.$this->__("Seller").' :</label>
						<span>'.$current_user_name.'</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<label>'.$this->__("Shop").' :</label>
						<span>'.$store_name.'</span>
					</td>
				</tr>
			</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$html1 = '
			<table style="width:50%;margin:0px auto;">
				<tr>
					<td align="left">
						<label>'.$this->__("Date").' :</label>
						<span>'.$date.'</span>
					</td>
					<td align="right">
						<label>'.$this->__("Sale").' :</label>
						<span>'.$increment_id.'</span>
					</td>
				</tr>
				<tr>
					<td align="left">
						<label>'.$this->__("Hour").' :</label>
						<span>'.$current_time.'</span>
					</td>
					<td align="right">
						<label>'.$this->__("Seller").' :</label>
						<span>'.$current_user_name.'</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="left">
						<label>'.$this->__("Shop").' :</label>
						<span>'.$store_name.'</span>
					</td>
				</tr>
			</table>
			';
			$data.=$html1;
			// create some HTML for horizontal line
			$html = '<hr>';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html;
			// create some HTML product details table
			$products = $order->getAllItems();
			//echo'<pre>';print_r($products);die;
			// create some HTML product details table
			$tax_amount=round($order['tax_amount'],2);
			$subtotal=round($order['subtotal_invoiced'],2);
			$total_discount=round($order['discount_invoiced'],2);
			$total=round($order['total_invoiced'],2);
			$tax_per=array();
			foreach($products as $product_details)
			{
				//echo'<pre>';print_r($product_details);die;
				$qty=round($product_details['qty_invoiced']);
				$price_incl_tax=round($product_details['price_incl_tax'],2)*$qty;
				$discount=round($product_details['discount_amount'],2);
				$options = $product_details->getProductOptions();
				$custom_option_values="";
				if(!empty($options['options']))
				{
					foreach($options['options'] as $custom_options)
					{
						$custom_option_values.='<br/>&nbsp;&nbsp;<label><b><i>'.$custom_options['label'].'</i>:</b></label>
												<label>&nbsp;&nbsp;'.$custom_options['value'].'</label>';	
					}
				}
				//$tax_per=$tax_per+$product_details['tax_percent'];
				if($product_details['tax_percent']!=0)
				{
					if(!in_array($product_details['tax_percent'],$tax_per))
					{
						$tax_amount=0;
						foreach($products as $product_data)
						{
							if($product_details['tax_percent']==$product_data['tax_percent'])
							{
								$tax_amount=$tax_amount+$product_data['tax_amount'];	
							}
						}
						$tax_per_data.='
										<tr>
											<td></td>
											<td align="right"><b>'.$this->__("VAT").' '.round($product_details['tax_percent'],2).'%</b></td>
											<td align="left">&nbsp;&nbsp;<b>'.number_format($tax_amount,2).' '.$currency_symbol.'</b></td>
										</tr>';
					}
				}
				$tax_per[]=$product_details['tax_percent'];
				$products_tr.='<tr>
									<td align="center">'.round($product_details['qty_invoiced']).'</td>
									<td align="center">'.$product_details['name'].'<br/>'.$custom_option_values.'</td>
									<td align="center">'.number_format($price_incl_tax,2).' '.$currency_symbol.'</td>
									<td align="center">'.number_format($discount,2).' '.$currency_symbol.'</td>
								</tr>';
			}//die;
			$html = '
				<table style="margin:0px auto">
					<tr>
						<th style="width:10%" align="center">'.$this->__("Qty").'</th>
						<th style="width:40%" align="center">'.$this->__("Product").'</th>
						<th style="width:30%" align="center">'.$this->__("Incl.Tax").'</th>
						<th style="width:20%" align="center">'.$this->__("Discount").'</th>
					</tr>
					'.$products_tr.'
					<tr>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><b>'.$this->__("Sub_total :").'</b></td>
						<td align="left">&nbsp;'.number_format($subtotal,2).' '.$currency_symbol.'</td>
					</tr>
					<tr>
						<td></td>
						<td align="right"><b>'.$this->__("Discount :").'</b></td>
						<td align="left">&nbsp;'.number_format($total_discount,2).' '.$currency_symbol.'</td>
					</tr>
					'.$tax_per_data.'
					<tr>
						<td></td>
						<td align="right"><b>'.$this->__("Total Price :").'</b></td>
						<td align="left">&nbsp;'.number_format($total,2).' '.$currency_symbol.'</td>
					</tr>
				</table>
			';
			//Commented code
			/*<tr>
				<td></td>
				<td><b>'.$this->__("VAT").' '.$tax_per.'%</b></td>
				<td>&nbsp;&nbsp;<b>'.$tax_amount.' '.$currency_symbol.'</b></td>
			</tr>*/
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html;
			if($payment_method=='Multiple Payment')
			{
				$bank_title=Mage::getStoreConfig("payment/banktransfer/title");
				$check_title=Mage::getStoreConfig("payment/checkmo/title");
				$cash_title=Mage::getStoreConfig("payment/cashondelivery/title");
				$voucher_title=Mage::getStoreConfig("payment/voucher/title");
					
				$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
				$select = $connection->select()->from($multiplepayment_table, array('*'))->where('order_id=?',$order_id);
				$rowArray =$connection->fetchRow($select);   //return row
				if($rowArray['bank_amount']>0)
				{
					$bank_data='<tr>
									<td></td>
									<td align="right">'.$this->__("Bank :").'</td>
									<td>'.number_format($rowArray['bank_amount'],2).'</td>
								</tr>';
				}
				if($rowArray['check_amount']>0)
				{
					$check_data='<tr>
									<td></td>
									<td align="right">'.$this->__("Check :").'</td>
									<td>'.number_format($rowArray['check_amount'],2).'</td>
								</tr>';
				}
				if($rowArray['cash_amount']>0)
				{
					$cash_data='<tr>
									<td></td>
									<td align="right">'.$this->__("Cash :").'</td>
									<td>'.number_format($rowArray['cash_amount'],2).'</td>
								</tr>';
				}
				if($rowArray['voucher']>0)
				{
					$voucher='<tr>
								<td></td>
								<td align="right">'.$this->__("Voucher :").'</td>
								<td>'.number_format($rowArray['voucher'],2).'</td>
							  </tr>';
				}
				if($rowArray['credit_memo']>0)
				{
					$credit_memo_data='<tr>
										   <td></td>
									       <td align="right">'.$this->__("Credit_memo :").'</td>
										   <td>'.number_format($rowArray['credit_memo'],2).'</td>
									   </tr>';
				}
				$multiple_payment_data='
										'.$bank_data.'
										'.$check_data.'
										'.$cash_data.'
										'.$voucher.'
										'.$credit_memo_data.'';	
			}
			$html = '
				<table style="margin:0px auto">
					<tr>
						<td width="10%"></td>
						<td align="right" width="40%">
							<b>'.$this->__("Payment mode :").'</b>
						</td>
						<td align="left" width="50%">&nbsp;'.$payment_method.'</td>
					</tr>
					'.$multiple_payment_data.'
				</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');	
			$data.=$html;
			// create some HTML for horizontal line
			$html = '<hr>';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html;
			$html = '<table align="center">
				<tr>
					<td style="width:10%"></td>
					<td style="width:80%">'.$this->__("Thank you for your visit").'</td>
					<td style="width:10%"></td>
				</tr>
				<tr>
					<td style="width:10%"></td>
					<td style="width:80%">'.$footer.'</td>
					<td style="width:10%"></td>
				</tr>
			</table>';
			$html1 = '
				<table align="center" style="width:250px;margin:0px auto;text-align:center;">
					<tr>
						<td>'.$this->__("Thank you for your visit").'</td>
					</tr>
					<tr>
						<td>'.$footer.'</td>
					</tr>
				</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html1;
			//Close and output PDF document
			$filename='Receipt_'.$order_id;
			$fn = Mage::getBaseDir('base').'/credit_memo_ticket1/'.$filename.'.pdf';
			$pdf->Output($fn, 'F');
			return $data;
		}
		
		
//***************Function for print credit memo ticket*************************
		public function credit_memo_ticket($order_id,$creditmemo_id)
		{
			$resource = Mage::getSingleton('core/resource');
			$pos_sales_report_table = $resource->getTableName('pos_sales_report');
			$pos_credit_memo_table = $resource->getTableName('pos_credit_memo');
			$multiplepayment_table = $resource->getTableName('multiplepayment');
			
			$store_name=Mage::getStoreConfig("pos/pointofsales/store_name");
			$header=Mage::getStoreConfig("pos/credit_memo/ticket_header");
			$footer=Mage::getStoreConfig("pos/credit_memo/ticket_footer");
			$width=Mage::getStoreConfig("pos/credit_memo/ticket_width");
			$exp_week=Mage::getStoreConfig("pos/credit_memo/exp_date_week");
			$exp_month=Mage::getStoreConfig("pos/credit_memo/exp_date_month");
			$currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
			$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();
			//$unit=Mage::getStoreConfig("pos/pointofsales/receipt_unit");
			$unit='mm';
			$margin_left=Mage::getStoreConfig("pos/credit_memo/ticket_margin_left");
			define(PDF_UNIT,'in');
			define(PDF_PAGE_FORMAT,'A1');
				
			//$tcpdf = new TCPDF_TCPDF();
			$custom_layout = array($width,8);
			$pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,$custom_layout, true, 'UTF-8', false);
			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->setPageUnit($unit);
			
			// set margins
			$pdf->SetMargins($margin_left,5,5,true);
			
			$pdf->setPageOrientation('',false,0);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
  
			$pdf->SetAutoPageBreak(TRUE, 15);
			// set font
			$pdf->SetFont('times', '', 10);
			
			// add a page
			$pdf->AddPage();
  			$data="";
			$html = '
			<table align="center" style="width:90%;margin:0px auto 20px auto;text-align:center;">
				<tr style="margin-bottom:10px;">
					<td style="font-size:14px;">
						<b>'.$store_name.'</b>
					</td>
				</tr>
				<tr>
					<td>
						'.$header.'
					</td>
				</tr>
			</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$row_data=$html;
			//Get data from credit memo table
			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
			$select = $connection->select()->from($pos_credit_memo_table, array('*'))->where('credit_memo_id=?',$creditmemo_id);
			$rowArray =$connection->fetchRow($select);   //return row
			//Get Order Details
			$order=Mage::getModel('sales/order')->load($order_id); //use an entity id here
			$order_increment_id=$order['increment_id'];
			//echo'<pre>';print_r($order);
			
			//Calculate refund amount for a credit memo
			$creditMemos = Mage::getResourceModel('sales/order_creditmemo_collection');
			$creditMemos->addFieldToFilter('order_id', $order_id);
			$creditMemos->load();
			foreach($creditMemos as $data1)
			{
			  if($creditmemo_id==$data1['increment_id'])
			  {
				  $refund_amount=number_format($data1['grand_total'],2);
			  }
			}
  
			$timestamp = strtotime($rowArray['exp_date']);
			$exp_date=date("d/m/Y",$timestamp);
			
			$customer_id=$rowArray['customer_id'];
			$refund_type=$rowArray['refund_type'];
			//Get customer name from customer table
			$customer = Mage::getModel('customer/customer')->load($customer_id);
			$customer_name=$customer['firstname'].' '.$customer['lastname'];	
			// create some HTML content for date and vendor section
			if($refund_type=='create_voucher')
			{
				$exp_date_data='<tr height="5">
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>
										<strong>
											<label>'.$this->__("Valable till").' :</label>
											<span>'.$exp_date.'</span>
										</strong>
									</td>
								</tr>';
			}
			$html = '
			<table align="center" style="width:90%;margin:0px auto;text-align:center;font-size:20px;">
				<tr>
					<td>
						<strong>
							<label>'.$this->__("Customer").' :</label>
							<span>'.$customer_name.'</span>
						</strong>
					</td>
				</tr>
				<tr height="10">
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<strong>
							<label>'.$this->__("Value").' :</label>
							<span>'.$refund_amount.' '.$currency_symbol.'</span>
						</strong>
					</td>
				</tr>
				<tr height="5">
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<strong>
							<label>'.$this->__("Credit Memo no.").' </label>
							<span>'.$creditmemo_id.'</span>
						</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>
							<label>'.$this->__("for order no.").' </label>
							<span>'.$order_increment_id.'</span>
						</strong>
					</td>
				</tr>
				'.$exp_date_data.'
				<tr height="10">
					<td>&nbsp;</td>
				</tr>
			</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$row_data.=$html;
			// create some HTML for horizontal line
			$html = '<hr>';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data.=$html;
			$html = '
				<table align="center" style="width:90%;margin:0px auto;text-align:center;">
					<tr>
						<td>'.$this->__("Thank you for your visit").'</td>
					</tr>
					<tr>
						<td>'.$footer.'</td>
					</tr>
				</table>
			';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$row_data.=$html;
			//Close and output PDF document
			$filename='Ticket_'.$creditmemo_id;
			$fn = Mage::getBaseDir('base').'/credit_memo_ticket/'.$filename.'.pdf';
			$pdf->Output($fn, 'F');
			return $row_data;
		}
		
		//***************Function for pos_sales_report_pdf*************************
		public function pos_sales_report_pdf($pos_user_id,$date_from,$date_to)
		{
			$resource = Mage::getSingleton('core/resource');
			$pos_sales_report_table = $resource->getTableName('pos_sales_report');
			$pos_credit_memo_table = $resource->getTableName('pos_credit_memo');
			$multiplepayment_table = $resource->getTableName('multiplepayment');
			
			$store_name=Mage::getStoreConfig("pos/pointofsales/store_name");
			$header=Mage::getStoreConfig("pos/pointofsales/receipt_header");
			$footer=Mage::getStoreConfig("pos/pointofsales/receipt_footer");
			$width=Mage::getStoreConfig("pos/pointofsales/receipt_width");
			$currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
			$currency_symbol=Mage::app()->getLocale()->currency( $currency_code )->getSymbol();
			//$unit=Mage::getStoreConfig("pos/pointofsales/receipt_unit");
			$unit='mm';
			$margin_left=Mage::getStoreConfig("pos/pointofsales/receipt_margin_left");
			define(PDF_UNIT,'in');
			define(PDF_PAGE_FORMAT,'A4');
			
			//$tcpdf = new TCPDF_TCPDF();
			$custom_layout = array(100,8);
			$pdf = new TCPDF_TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true, 'UTF-8', false);
			$pdf->SetPrintHeader(false);
			$pdf->SetPrintFooter(false);
			$pdf->setPageUnit($unit);
			
			// set margins
			$pdf->SetMargins(0,15,0,true);
			
			$pdf->setPageOrientation('',false,0);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			$pdf->SetAutoPageBreak(TRUE, 15);
			// set font
			$pdf->SetFont('times', '', 10);
			
			// add a page
			$pdf->AddPage();
  			
			$connection = Mage::getSingleton('core/resource')->getConnection('core_read');
			//Condition for heading data//
			/*if(!empty($date_from))
			{
				$date_to=date('Y-m-d', strtotime($date_to. ' + 1 days'));
				$from_to=$this->__("- From :").$date_from.$this->__("- To :").$date_to;
			}*/
			if(!empty($pos_user_id))
			{
				$select = $connection->select()->from($pos_sales_report_table)->where('pos_user_id=?',$pos_user_id);
				$rowArray =$connection->fetchAll($select);   //return row
				$user=$this->__("- POS user :").$rowArray[0]['pos_user_name'];
			}
			
			//Get order ids from pos_sales_report table
			if(empty($pos_user_id))
			{
				$select = $connection->select()->from($pos_sales_report_table, array('order_id'));
			}
			else
			{
				$select = $connection->select()->from($pos_sales_report_table, array('order_id'))->where('pos_user_id=?',$pos_user_id);
			}
			$rowArray =$connection->fetchAll($select);   //return row
			//echo'<pre>';print_r($rowArray);die;
			foreach($rowArray as $data)
			{
				$sales_data[] = array('eq' => $data['order_id']);		
			}
			$sales_record = Mage::getModel('sales/order')->getCollection()
			->addFieldToFilter('entity_id',$sales_data);
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
				$date_froms = date('Y-m-d H:i:s', strtotime($date_from));
				$date_tos = date('Y-m-d H:i:s', strtotime($date_to));
				$sales_record->addAttributeToFilter('created_at', array('from' => $date_froms,'to'=>$date_tos));
				$date_to=date('Y-m-d', strtotime($date_to. ' - 1 days'));
				$dateto=date('m-d-Y', strtotime($date_to));
				$from_to=$this->__("- From :").$date_from.$this->__("- To :").$dateto;
			}
			// create some HTML content for header content
			$html = '<table align="left" style="font-size:18px;padding: 0px 0px 10px 0px;">
						<tr>
							<th width="2%" style="padding-bottom:10px"></th>
							<th width="98%" style="padding-bottom:10px">
								'.$this->__("Sales report").$from_to.$user.'
							</th>
						</tr>
					</table>
					<table style="font-size:14px;padding: 7px 0px 4px 0px;text-align:left;">
						<hr>
						<tr>
							<th width="2%"></th>
							<th width="15%">'.$this->__("Invoice/CM").'</th>
							<th width="36%">'.$this->__("Customer").'</th>
							<th width="22%">'.$this->__("Payment method").'</th>
							<th width="15%">'.$this->__("Total Tax incl.").'</th>
							<th width="10%">'.$this->__("Date").'</th>
						</tr>
						<hr>
					</table>';
			$html1 = '<table style="font-size:18px;padding: 20px 0px 10px 0px;text-align: left;width:100%;">
						<tr>
							<th width="2%" style="padding-bottom:10px"></th>
							<th width="98%" style="padding-bottom:10px">
								'.$this->__("Sales report").$from_to.$user.'
							</th>
						</tr>
					</table>
					<table style="font-size:14px;padding: 7px 0px 4px 0px;text-align:left;width:100%">
						<tr>
							<th width="2%"></th>
							<th width="15%">'.$this->__("Invoice/CM").'</th>
							<th width="36%">'.$this->__("Customer").'</th>
							<th width="22%">'.$this->__("Payment method").'</th>
							<th width="15%">'.$this->__("Total Tax incl.").'</th>
							<th width="10%">'.$this->__("Date").'</th>
						</tr>
					</table>';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data_row.=$html1;
			
			$total_bank_amount=0;
			$total_check_amount=0;
			$total_cash_amount=0;
			$total_voucher_amount=0;
			$total_returned_credit_memo_amount=0;
			$paid_by_credit_memo=0;
			$total_invoice_price_excl_tax=0;
			$total_invoice_tax_value=0;
			$total_credit_memo_price_excl_tax=0;
			$total_credit_memo_tax=0;

			$user = mage::getModel('admin/user')->load($pos_user_id);
			$initial_count=0;
			foreach($sales_record as $data)
			{
				//Get values from each record
				$customer_id=$data['customer_id'];
				$order_id=$data['entity_id'];
				$select = $connection->select()->from($pos_sales_report_table)->where('order_id=?',$order_id);
				$rowArray =$connection->fetchrow($select);
				$pos_user=$rowArray['pos_user_name'];
				$invoice_id=$data['increment_id'];
				$fname=$data['customer_firstname'];
				$lname=$data['customer_lastname'];
				if($customer_id=="")
				{
					$fname=Mage::getStoreConfig("pos/notifications/guest_fname");
					$lname=Mage::getStoreConfig("pos/notifications/guest_lname");
				}
				$full_name=$fname.' '.$lname;
				$Allitems=$data->getAllItems();
				$product_data="";
				foreach($Allitems as $items)
				{
					//Calculate price_excl_tax per product
					$ind_price=$items['original_price'];
					$ind_qty=$items['qty_invoiced'];
					$price_total=$ind_price*$ind_qty;
					$ind_discount=$items['discount_amount'];
					$row_total=$price_total-$ind_discount;
					$ind_tax=$items['tax_percent'];
					$ind_total_excl_tax=$row_total*100/(100+$ind_tax);
					$ind_vat_value=$row_total-$ind_total_excl_tax;
					$total_invoice_price_excl_tax=$total_invoice_price_excl_tax+$ind_total_excl_tax;
					$total_invoice_tax_value=$total_invoice_tax_value+$ind_vat_value;
					
					$product_options=$items->getProductOptions();
					$product_options=$product_options['options'];
					$product_custom_options="";
					
					if($product_options)
					{
						foreach($product_options as $options)
						{
							$label=$options['label'];
							$value=$options['value'];
							$product_custom_options.='<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$label.' <b>:</b> '.$value;
						}
						$product_custom_options.='<br/>';
					}
					$qty=round($items["qty_invoiced"]);
					$name=$items["name"];
					$product_data.='&nbsp;&nbsp;'.$qty." &times; ".$name.$product_custom_options;
				}
				$payment_method = $data->getPayment()->getMethodInstance()->getTitle();
				$payment_code = $data->getPayment()->getMethodInstance()->getCode();
				//Code for get payment amount
				switch($payment_code)
				{
					case "banktransfer":
						$total_bank_amount=$total_bank_amount+$data['grand_total'];
					break;
					case "checkmo":
						$total_check_amount=$total_check_amount+$data['grand_total'];
					break;
					case "cashondelivery":
						$total_cash_amount=$total_cash_amount+$data['grand_total'];
					break;	
				}
				$payment_data='';
				if($payment_method=='Multiple Payment')
				{
					$bank_title=Mage::getStoreConfig("payment/banktransfer/title");
					$check_title=Mage::getStoreConfig("payment/checkmo/title");
					$cash_title=Mage::getStoreConfig("payment/cashondelivery/title");
					$voucher_title=Mage::getStoreConfig("payment/voucher/title");
					
					$select = $connection->select()->from($multiplepayment_table)->where('order_id=?',$order_id);
					$rowArray =$connection->fetchrow($select);
					//Get bank amount
					$bank=$rowArray['bank_amount'];
					if($bank>0)
					{
						$total_bank_amount=$total_bank_amount+$bank;
						$payment_data.='<br/>'.$bank_title.' <b>:</b> '.$bank.' '.$currency_symbol;
					}
					//Get check amount
					$check=$rowArray['check_amount'];
					if($check>0)
					{
						$total_check_amount=$total_check_amount+$check;
						$payment_data.='<br/>'.$check_title.' <b>:</b> '.$check.' '.$currency_symbol;
					}
					
					//Get cash amount
					$cash=$rowArray['cash_amount'];
					if($cash>0)
					{
						$payment_data.='<br/>'.$cash_title.' <b>:</b> '.$cash.' '.$currency_symbol;
						$total_cash_amount=$total_cash_amount+$cash;
					}
					
					//Get voucher amount
					$voucher=$rowArray['voucher'];
					if($voucher>0)
					{
						$payment_data.='<br/>'.$this->__("Voucher").' <b>:</b> '.$voucher.' '.$currency_symbol;
						$total_voucher_amount=$total_voucher_amount+$voucher;
					}
					
					//Get promo_code amount
					$promo_code=$rowArray['promo_code'];
					if($promo_code>0)
					$payment_data.='<br/>'.$this->__("Promo").' <b>:</b> '.$promo_code.' '.$currency_symbol;
					
					//Get credit memo amount
					$credit_memo=$rowArray['credit_memo'];
					if($credit_memo>0)
					{
						//$total_returned_credit_memo_amount=$total_returned_credit_memo_amount+$credit_memo;
						$paid_by_credit_memo=$paid_by_credit_memo+$credit_memo;
						$payment_data.='<br/>'.$this->__("Credit memo").' <b>:</b> '.$credit_memo.' '.$currency_symbol;
					}
					
					$payment_method=$this->__("Multiple Payment").$payment_data;
				}
				$excl_tax=$data['subtotal_invoiced'];
				//$total_discount=$data['discount_invoiced'];
				$grand_total=$data['grand_total'];
				//$grand_total=$grand_total-$total_discount;
				//$total_invoice_tax=$total_invoice_tax+$data['tax_amount'];
				$total_invoice=$total_invoice+$grand_total;
				$created_at=$data['created_at'];
				$invoice_date=date('Y/m/d', strtotime($created_at));
				//Get values from each record
				$total_records.='<table style="padding: 10px 0px 15px 0px;width:100%">
				 <tr style="font-size:11px;">
					<td width="2%"></td>
					<td width="15%">'.$this->__("Invoice").'<br/>'.$invoice_id.'<br/>'.$this->__("POS User").'<b>:</b><br/>'.$pos_user.'</td>
					<td width="36%">'.$full_name.'<br/><br/>
						'.$this->__("Products").'<br/>
						'.$product_data.'
					</td>
					<td width="22%">'.$payment_method.'</td>
					<td width="15%" align="center">
						'.number_format($grand_total,2).' '.$currency_symbol.'
					</td>
					<td width="10%">'.$invoice_date.'</td> 
				</tr></table>';
				
				//*************Code for get credit memo details
				$creditMemos = Mage::getResourceModel('sales/order_creditmemo_collection');
				$creditMemos//->addFieldToFilter('order_id', $order_id);
				->addFieldToFilter('created_at', array('from' => $date_froms,'to'=>$date_tos));
				$creditMemos->load();
				$total_credit_memos=$creditMemos->count();
				if($total_credit_memos!=0)
				{
					if($initial_count==0)
					{
						$i=1;
						foreach($creditMemos as $data)
						{
							$credit_memo_id=$data['increment_id'];
							if($pos_user_id)
							{
								$select = $connection->select()->from($pos_credit_memo_table)->where('pos_user=?',$user['username']);
								$rowArray =$connection->fetchrow($select);
								// echo'<pre>';print_r($rowArray);
								if($credit_memo_id!=$rowArray['credit_memo_id'])
								continue;
							}
							else
							{
								$select = $connection->select()->from($pos_credit_memo_table)->where('credit_memo_id=?',$credit_memo_id);
								$rowArray =$connection->fetchrow($select);
								//echo'<pre>';print_r($rowArray);
								
							}
							
							if($i==$total_credit_memos)
							{
								$break_point='<hr>';	
							}
							$pos_user=$rowArray['pos_user'];
							$refund_type=$rowArray['refund_type'];
							$grand_total=$data['grand_total'];
							if($refund_type=='refund_money')
							{
								$payment_method='Refund Money : -'.round($grand_total,2).' '.$currency_symbol;
								$total_refund_money=$total_refund_money+$grand_total;
							}
							else
							{
								$payment_method='Credit Memo : -'.round($grand_total,2).' '.$currency_symbol;	
								$total_credit_memo_voucher=$total_credit_memo_voucher+$grand_total;
							}
							$total_credit_memo_amount=$total_credit_memo_amount+$grand_total;
							$created_at=$data['created_at'];
							$credit_memo_date=date('Y/m/d', strtotime($created_at));
							$Allitems=$data->getAllItems();
							$product_data="";
							foreach($Allitems as $items)
							{
								$product_id=$items['product_id'];
								
								//Calculate price excl tax for credit memo products
								$product = Mage::getModel('catalog/product')->load($product_id);
								$taxClassId = $product->getData("tax_class_id");
								$taxClasses = Mage::helper("core")->jsonDecode(Mage::helper("tax")->getAllRatesByProductClass());
								$taxRate = $taxClasses["value_".$taxClassId];
								if(empty($taxRate))
								$taxRate=0;
								$ind_price=$items['price_incl_tax'];
								$ind_qty=$items['qty'];
								$price_total=$ind_price*$ind_qty;
								$ind_discount=$items['discount_amount'];
								$row_total=$price_total-$ind_discount;
								$ind_tax=$taxRate;
								$ind_total_excl_tax=$row_total*100/(100+$ind_tax);
								$ind_vat_value=$row_total-$ind_total_excl_tax;
								$total_credit_memo_price_excl_tax=$total_credit_memo_price_excl_tax+$ind_total_excl_tax;
								$total_credit_memo_tax=$total_credit_memo_tax+$ind_vat_value;
								
								$sales_record = Mage::getModel('sales/order')->load($order_id);
								$Allitems=$sales_record->getAllItems();
								$credit_memo_options="";
								foreach($Allitems as $getdata)
								{
									$pro_id=$getdata['product_id'];
									if($pro_id==$product_id)
									{
										$product_options=$getdata->getProductOptions();
										$product_options=$product_options['options'];
										if($product_options)
										{
											foreach($product_options as $options)
											{
												$label=$options['label'];
												$value=$options['value'];
												$credit_memo_options.='<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$label.' <b>:</b> '.$value;
											}
											$credit_memo_options.='<br/>';
										}
									}	
								}
								$qty=round($items["qty"]);'<br/>';
								$name=$items["name"];
								$product_data.='&nbsp;&nbsp;'.$qty." &times; ".$name.$credit_memo_options;
							}
							$total_credits.='<table style="padding: 10px 0px 15px 0px;width:100%">
							 <tr style="font-size:11px;">
								<td width="2%"></td>
								<td width="15%">'.$this->__("Credit Memo").'<br/>'.$credit_memo_id.'<br/>'.$this->__("POS User").' <b>:</b><br/>'.$pos_user.'</td>
								<td width="36%">'.$full_name.'<br/><br/>
									'.$this->__("Products").'<br/>
									'.$product_data.'
								</td>
								<td width="22%">'.$payment_method.'</td>
								<td width="15%" align="center">
									-'.number_format($grand_total,2).' '.$currency_symbol.'
								</td>
								<td width="10%">'.$credit_memo_date.'</td> 
							</tr></table>'.$break_point;	
						$i++;
						}
					}
					$initial_count++;
				}
				else
				{
					$total_records.='<hr>';
				}	
				//*************Code for get credit memo details
			}
			$total_records.=$total_credits;
			$html=$total_records;
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data_row.=$html;	
			
			$total_incl_tax=$total_invoice-$total_credit_memo_amount;
			//$total_invoice_tax=$total_incl_tax-$total_excl_tax;
			//Calculate total tax and price excl_tax
			$total_excl_tax=$total_invoice_price_excl_tax-$total_credit_memo_price_excl_tax;
			$total_tax=$total_invoice_tax_value-$total_credit_memo_tax;
			
			if($total_credit_memo_amount>0)
			{
				$total_credit_memo_amount_data=$this->__("Total Credit Memo").' : '.number_format($total_credit_memo_amount,2).$currency_symbol.'';	
			}
			//$total_remaining_credit_memo=$total_returned_credit_memo_amount-$total_credit_memo_amount;
			if($total_bank_amount>0)
			{
				$total_bank_cart_data=$this->__("Total bank").' : '.number_format($total_bank_amount,2).' '.$currency_symbol.'<br/>';
			}
			if($total_cash_amount>0)
			{
				$total_cash_cart_data=$this->__("Total cash").' : '.number_format($total_cash_amount,2).' '.$currency_symbol.'<br/>';
			}
			if($total_check_amount>0)
			{
				$total_check_cart_data=$this->__("Total check").' : '.number_format($total_check_amount,2).' '.$currency_symbol.'<br/>';
			}
			if($total_voucher_amount>0)
			{
				$total_voucher_cart_data=$this->__("Total voucher").' : '.number_format($total_voucher_amount,2).' '.$currency_symbol.'<br/>';
			}
			$final_credit_memo_data=-$total_credit_memo_voucher+$paid_by_credit_memo;
			if($final_credit_memo_data)
			{
				$total_remaining_credit_memo_data=$this->__("Total Credit Memo").' : '.number_format($final_credit_memo_data,2).' '.$currency_symbol.'<br/>';
			}
			if($total_refund_money>0)
			{
				$total_refund_money_data=$this->__("Total refund money").' : -'.number_format($total_refund_money,2).' '.$currency_symbol.'<br/>';
			}
			
			$html='<table style="padding: 70px 20px 0px 20px;font-size:16px;text-align:right;" width="100%">
						<tr>
							<td width="45%"><strong>'.$this->__("Totals").'</strong>
								<div style="border-top:1px gray solid;">
									'.$this->__("Total tax excl.").' <span>: '.number_format($total_excl_tax,2).' '.$currency_symbol.'</span>
								</div>
								'.$this->__("Tax").': '.number_format($total_tax,2).' '.$currency_symbol.'
								<div style="border-bottom:1px gray solid;">
									'.$this->__("Total tax incl.").' <span>: '.number_format($total_incl_tax,2).' '.$currency_symbol.'</span>
								</div><br/>
								'.$this->__("Total Invoice").' : '.number_format($total_invoice,2).' '.$currency_symbol.'<br/>
								'.$total_credit_memo_amount_data.'
							</td>
							<td width="10%"></td>
							<td width="45%">
								<div style="border-bottom:1px gray solid;">
									<strong>'.$this->__("Details").'</strong>
								</div>
								'.$total_bank_cart_data.'
								'.$total_cash_cart_data.'
								'.$total_check_cart_data.'
								'.$total_voucher_cart_data.'
								'.$total_remaining_credit_memo_data.'
								'.$total_refund_money_data.'
								<div style="border-bottom:1px gray solid;"></div>
							</td>
						</tr>
					</table>';
			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');
			$data_row.=$html;
			//Close and output PDF document
			$filename='credit_memo_ticket4'.date('d-m-Y');
			$fn = Mage::getBaseDir('base').'/credit_memo_ticket4/'.$filename.'.pdf';
			$pdf->Output($fn, 'F');
			return $data_row;	
		}
}
	 