<?php

class ItrCustomModule_PointOFSales_Adminhtml_PointofsalesexitratesbymanufactureController extends Mage_Adminhtml_Controller_Action

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

	//*****************Method for generate_exitrates********************//

	public function generate_exitratesAction()

	{
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 3000); //3000 seconds = 50 minutes
		$resource = Mage::getSingleton('core/resource');

		$table_stock_movement = $resource->getTableName('stock_movement');
		$pos_sales_report_table = $resource->getTableName('pos_sales_report');

		$table_cataloginventory_stock_item = $resource->getTableName('cataloginventory_stock_item');

		

		$task=$this->getRequest()->getParam('task');

		$type=$this->getRequest()->getParam('grid');

		$datefrom=$this->getRequest()->getParam('datefrom');

		$dateto=$this->getRequest()->getParam('dateto');

		$pagesize=$this->getRequest()->getParam('pagesize');

		$current_page=$this->getRequest()->getParam('page');

		

		$dateto=date('Y-m-d', strtotime($dateto. ' + 1 days'));	

		$view_pagging_value=Mage::getStoreConfig("pos/notifications/view_pagging_values");

		$pagging_values=explode(',',$view_pagging_value);

		//Get order ids from pos_sales_report table

		$connection = Mage::getSingleton('core/resource')->getConnection('core_read');

		$select = $connection->select()->from($pos_sales_report_table, array('order_id'));//->where('pos_user_name=?',$temp_id);

		$rowArray =$connection->fetchAll($select); 

		foreach($rowArray as $data)

		{

			$sales_data[] = array('eq' => $data['order_id']);		

		}

		//echo'<pre>';print_r($sales_data);

		$date_from = date('Y-m-d H:i:s', strtotime($datefrom));

		$date_to = date('Y-m-d H:i:s', strtotime($dateto));

	
		//Get Product Ids which are in selected period
		$select = $connection->select()->from($table_stock_movement)->where('sm_date >= "'.$date_from.'" and sm_date < "'.$date_to.'"');
		$data_entire_period =$connection->fetchAll($select);
		$product_ids=array();
		foreach($data_entire_period as $total_qtys)
		{	
			if(!in_array($total_qtys["sm_product_id"],$product_ids))
			{
				$product_ids[]=$total_qtys["sm_product_id"];
			}
		}
		//echo sizeof($product_ids);
		$product_ids_exp=implode(',',$product_ids);
	
		//*****************Calculate total sold products**********************//
		$product_details = Mage::getModel('catalog/product')->getCollection()
		->addAttributeToFilter('entity_id', array('in' => $product_ids))
		->addAttributeToSelect('manufacturer');
		foreach($product_details as $data)
		{
			$manufacturer=$data->getAttributeText('manufacturer');
			$pro_id=$data['entity_id'];
			if(!empty($manufacturer))
			{
				$manufacture_data[$pro_id]=$manufacturer;
			}
		}
		//echo'<pre>';print_r($manufacture);die;
		
		//*****************Calculate total sold products**********************//
		$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $total_qtys)

		{
			//$product_details = Mage::getModel('catalog/product')->load($total_qtys["sm_product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$total_qtys["sm_product_id"]];
			if(!empty($manufacture))
			{
				$sm_date=date('m/d/Y', strtotime($total_qtys['sm_date']));
	
				if(strtotime($sm_date)>=strtotime($datefrom))
	
				{
	
					if($total_qtys["sm_target_stock"]>0)
	
					$total_qtys["sm_qty"]=0;			
	
					if(!empty($manufacture))
	
					{
	
						if(!in_array($manufacture_pro_total_qtys[$manufacture],$manufacture_pro_total_qtys))
	
						{
	
							$manufacture_pro_total_qtys[$manufacture]=round($total_qtys["sm_qty"],2);	
	
						}
	
						else
	
						{
	
							$old_qty=$manufacture_pro_total_qtys[$manufacture];
	
							$manufacture_pro_total_qtys[$manufacture]=$old_qty+round($total_qtys["sm_qty"],2);	
	
						}
	
					}
					
					
					//***********Calculate quantity added from date to till now**************//
					if($qapdata["sm_target_stock"]<1)

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap_total[$manufacture],$manufacture_product_qap_total))

					{

						$manufacture_product_qap_total[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap_total[$manufacture];

						$manufacture_product_qap_total[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}
	
				}
				//***********Calculate quantity added from date to till now**************//
				else

				{

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap_total[$manufacture],$manufacture_product_qap_total))

					{

						$manufacture_product_qap_total[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap_total[$manufacture];

						$manufacture_product_qap_total[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}

				}
					
					
				
				//*****************Calculate sold products in entire period**********************//
				if(strtotime($sm_date)>=strtotime($datefrom) && strtotime($sm_date)<=strtotime($dateto))
	
				{	
	
					if($total_qtys["sm_target_stock"]>0)
	
					$total_qtys["sm_qty"]=0;
	
					if(!empty($manufacture))
	
					{
	
						if(!in_array($manufacture_product_qty[$manufacture],$manufacture_product_qty))
	
						{
	
							$manufacture_product_qty[$manufacture]=round($total_qtys["sm_qty"],2);	
	
						}
	
						else
	
						{
	
							$old_qty=$manufacture_product_qty[$manufacture];
	
							$manufacture_product_qty[$manufacture]=$old_qty+round($total_qtys["sm_qty"],2);	
	
						}
	
					}
	
				}
	
				else
	
				{
	
					$total_qtys["sm_qty"]=0;
	
					if(!empty($manufacture))
	
					{
	
						if(!in_array($manufacture_product_qty[$manufacture],$manufacture_product_qty))
	
						{
	
							$manufacture_product_qty[$manufacture]=round($total_qtys["sm_qty"],2);	
	
						}
	
						else
	
						{
	
							$old_qty=$manufacture_product_qty[$manufacture];
	
							$manufacture_product_qty[$manufacture]=$old_qty+round($total_qtys["sm_qty"],2);	
	
						}
	
					}		
	
				}
			}

		}

		//echo'<pre>';print_r($manufacture_pro_total_qtys);

		

		//*****************Calculate sold products in entire period**********************//

		/*$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $total_qtys)

		{
			//$product_details = Mage::getModel('catalog/product')->load($total_qtys["sm_product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$total_qtys["sm_product_id"]];
			$sm_date=date('m/d/Y', strtotime($total_qtys['sm_date']));

			if(!empty($manufacture))
			{
				if(strtotime($sm_date)>=strtotime($datefrom) && strtotime($sm_date)<=strtotime($dateto))
	
				{	
	
					if($total_qtys["sm_target_stock"]>0)
	
					$total_qtys["sm_qty"]=0;
	
					if(!empty($manufacture))
	
					{
	
						if(!in_array($manufacture_product_qty[$manufacture],$manufacture_product_qty))
	
						{
	
							$manufacture_product_qty[$manufacture]=round($total_qtys["sm_qty"],2);	
	
						}
	
						else
	
						{
	
							$old_qty=$manufacture_product_qty[$manufacture];
	
							$manufacture_product_qty[$manufacture]=$old_qty+round($total_qtys["sm_qty"],2);	
	
						}
	
					}
	
				}
	
				else
	
				{
	
					$total_qtys["sm_qty"]=0;
	
					if(!empty($manufacture))
	
					{
	
						if(!in_array($manufacture_product_qty[$manufacture],$manufacture_product_qty))
	
						{
	
							$manufacture_product_qty[$manufacture]=round($total_qtys["sm_qty"],2);	
	
						}
	
						else
	
						{
	
							$old_qty=$manufacture_product_qty[$manufacture];
	
							$manufacture_product_qty[$manufacture]=$old_qty+round($total_qtys["sm_qty"],2);	
	
						}
	
					}		
	
				}
			}

		}*/

		//echo'<pre>';print_r($manufacture_product_qty);

		

		//***********Calculate quantity added from date to till now**************//

		/*$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $qapdata)

		{
			//$product_details = Mage::getModel('catalog/product')->load($qapdata["sm_product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$qapdata["sm_product_id"]];
			//echo $date=$qapdata['sm_date'];

			$sm_date=date('m/d/Y', strtotime($qapdata['sm_date']));

			if(!empty($manufacture))

			{

				if(strtotime($sm_date)>=strtotime($datefrom))

				{

					if($qapdata["sm_target_stock"]<1)

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap_total[$manufacture],$manufacture_product_qap_total))

					{

						$manufacture_product_qap_total[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap_total[$manufacture];

						$manufacture_product_qap_total[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}

				}

				else

				{

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap_total[$manufacture],$manufacture_product_qap_total))

					{

						$manufacture_product_qap_total[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap_total[$manufacture];

						$manufacture_product_qap_total[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}

				}

			}

		}*/

		//echo'<pre>';print_r($manufacture_product_qap_total);die;

		

		//***********Calculate quantity added into period**************//

		$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $qapdata)

		{
			//$product_details = Mage::getModel('catalog/product')->load($qapdata["sm_product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$qapdata["sm_product_id"]];
			//echo $date=$qapdata['sm_date'];

			$sm_date=date('m/d/Y', strtotime($qapdata['sm_date']));

			if(!empty($manufacture))

			{

				if(strtotime($sm_date)>=strtotime($datefrom) && strtotime($sm_date)<=strtotime($dateto))

				{

					if($qapdata["sm_target_stock"]<1)

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap[$manufacture],$manufacture_product_qap))

					{

						$manufacture_product_qap[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap[$manufacture];

						$manufacture_product_qap[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}

				}

				else

				{

					$qapdata["sm_qty"]=0;

					if(!in_array($manufacture_product_qap[$manufacture],$manufacture_product_qap))

					{

						$manufacture_product_qap[$manufacture]=$qapdata["sm_qty"];	

					}

					else

					{

						$old_qty=$manufacture_product_qap[$manufacture];

						$manufacture_product_qap[$manufacture]=$old_qty+$qapdata["sm_qty"];	

					}

				}

			}

		}

		//echo'<pre>';print_r($manufacture_product_qap);


		

		//************Calculate total stock products********************//

		$select = $connection->select()->from($table_cataloginventory_stock_item)->where('product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $stockdata)

		{

			//$product_details = Mage::getModel('catalog/product')->load($stockdata["product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$stockdata["product_id"]];
			if(!empty($manufacture))

			{

				if(!in_array($manufacture_product_stock[$manufacture],$manufacture_product_stock))

				{

					$manufacture_product_stock[$manufacture]=round($stockdata['qty'],2);

				}

				else

				{

					$old_qty=$manufacture_product_stock[$manufacture];

					$manufacture_product_stock[$manufacture]=$old_qty+round($stockdata['qty'],2);

				}

			}

		}

		//echo'<pre>';print_r($manufacture_product_stock);

		

		//************Calculate other products********************//

		$select = $connection->select()->from($table_cataloginventory_stock_item)->where('product_id IN ('.$product_ids_exp.')');

		$rowArray =$connection->fetchAll($select);

		foreach($rowArray as $stockdata)

		{
			//$product_details = Mage::getModel('catalog/product')->load($stockdata["product_id"]);
			//$manufacture=$product_details->getAttributeText('manufacturer');
			$manufacture=$manufacture_data[$stockdata["product_id"]];
			if(!empty($manufacture))

			{	

				//************Calculation to get stock at beginning of the period

				if(!in_array($QPB[$manufacture],$QPB))

				{

					$QPB[$manufacture]=$manufacture_product_stock[$manufacture]+$manufacture_pro_total_qtys[$manufacture];				

					if($manufacture_product_qap_total[$manufacture]>0)

					{

						$QPB[$manufacture]=$QPB[$manufacture]-$manufacture_product_qap_total[$manufacture];

					}

				}

				//echo '<pre>';print_r($manufacture_product_qty);

				

				//Calculation Qty on the end of period [QBP + QAP]

				if(!in_array($QPE[$manufacture],$QPE))

				{

					$QPE[$manufacture]=$QPB[$manufacture]+$manufacture_product_qap[$manufacture]-$manufacture_product_qty[$manufacture];

				}

				/*else

				{

					$qpe=$QPB[$manufacture]+$manufacture_product_qap[$manufacture]-$manufacture_product_qty[$manufacture];

					$QPE[$manufacture]=$QPE[$manufacture]+$qpe;

				}*/

				//echo '<pre>';print_r($QPE);

				

				//Calculation Exit Rate QSP / (QBP + QAP) * 100%

				if(!in_array($exit_rate[$manufacture],$exit_rate))

				{

					$exit_rate[$manufacture]=($manufacture_product_qty[$manufacture]/$QPE[$manufacture])*100;

					//$exit_rate[$manufacture]=$manufacture_product_qty[$manufacture]/()

				}

				else

				{

					$exitrate=($manufacture_product_qty[$manufacture]/$QPE[$manufacture])*100;

					$exit_rate[$manufacture]=$exit_rate[$manufacture]+$exitrate;

				}

			}

		}

		//echo'<pre>';print_r($QPB);

	

		$sales_record = Mage::getModel('sales/order')->getCollection()

		->addAttributeToFilter('created_at', array('from' => $date_from,'to'=>$date_to))

		->addFieldToFilter('entity_id',$sales_data);

		//->setCurPage(2) // set the offset (useful for pagination)	

		//->setPageSize($pagging_values[0]); // limit number of results returned;

		$total_records=$sales_record->count();

		

		$product_name=array();

		$total_records=0;

		$i=0;

		foreach($sales_record as $data)

		{

			$Allitems=$data->getAllItems();

			$counter=0;

			foreach($Allitems as $items)

			{

				$product_details = Mage::getModel('catalog/product')->load($items["product_id"]);

				//echo'<pre>';print_r($product_details);die;

				$manufacture=$product_details->getAttributeText('manufacturer');

				if(!empty($manufacture))

				{

					if(!in_array($manufacture,$manufacture_name))

					{

						$manufacture_name[]=$manufacture;

						$final_exit_rates_data[$i]['manufacture']=$manufacture;

						$final_exit_rates_data[$i]['qpb']=abs($QPB[$manufacture]);

						$final_exit_rates_data[$i]['qpa']=$manufacture_product_qap[$manufacture];

						$final_exit_rates_data[$i]['qps']=$manufacture_product_qty[$manufacture];

						$final_exit_rates_data[$i]['qpe']=$QPE[$manufacture];

						$final_exit_rates_data[$i]['exit_rate']=$exit_rate[$manufacture];

						$total_records++;

						$i++;

					}

				}

			}

		}

		// Sort the data with attack descending

		foreach ($final_exit_rates_data as $key => $row) 

		{

			$attack[$key]  = $row['exit_rate'];

		}

		$data=array_multisort($attack, SORT_DESC, $final_exit_rates_data);

		//echo'<pre>';print_r($final_exit_rates_data);

		

		if($type=='exportcsv')

		{

			//***************Code for export csv***************//

			//Set memory limit


			ini_set("memory_limit","1024M");

			$_customersData[] = array(

				$this->__('Manufacture'),

				$this->__('QPB'),

				$this->__('QPA'),

				$this->__('QPS'),

				$this->__('QPE'),

				$this->__('Exit Rate')

			);

			foreach($final_exit_rates_data as $data)

			{

				$_customersData[] = array(

					$data['manufacture'],

					$data["qpb"],

					$data['qpa'],

					$data['qps'],

					$data['qpe'],

					round($data['exit_rate'],2)

				);

			}

			//echo'<pre>';print_r($_customersData);

			

			// Magento builtin class that will save your data as CSV

			$csv = new Varien_File_Csv();

			$filename=date('d-m-Y,h-i-s');

			$baseurl=str_replace('index.php/','',Mage::getBaseUrl());

			$baseurl=$baseurl.'credit_memo_ticket3/'.$filename.'.csv';

			$customerdata_path = Mage::getBaseDir('base').'/credit_memo_ticket3/'.$filename.'.csv';

			$csv->saveData($customerdata_path, $_customersData);

			// Just a notification for you

			$final_data=array("Csv Export successfully",$baseurl);

			//echo'<pre>';print_r($final_data);

			echo implode('&@&',$final_data);

		}

		else

		{

			$j=0;

			$counter=0;

			if($task=='insc' || $task=='desc')

			$current_page=$current_page-1;

			foreach($final_exit_rates_data as $data)

			{

				//Code for pagging

				if($type=='exitrates')

				{

					if($task=='insc' || $task=='desc')

					{

						$get_pag_data=$current_page*$pagesize;	

						if($j<$get_pag_data || $counter==$pagesize)

						{

							$j++;

							continue;	

						}					

					}

				}

				if($task=='view' || !$type)

				{

					if($pagesize==$j)

					continue;	

				}

				if($counter % 2==0)

				{

				  $tr_class="even";

				}

				else

				{

				  $tr_class="";

				}

				$content.='

						  <tr></tr>

						  <tr title="#" class="pointer '.$tr_class.'">

							  <td class="a-left">'.$data['manufacture'].'</td>

							  <td class="a-right">'.$data['qpb'].'</td>

							  <td class="a-right">'.$data['qpa'].'</td>

							  <td class="a-right">'.$data['qps'].'</td>

							  <td class="a-right">'.$data['qpe'].'</td>

							  <td class="a-right">'.round($data['exit_rate'],2).'</td>

						  </tr>';

						  $counter++;

						  $j++;

			}

			//echo'<pre>';print_r($product_qty);

			$content.="<input type='hidden' name='exitrates_total_records' value=".$total_records." id='exitrates_total_records'";

			echo $content;

		}

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