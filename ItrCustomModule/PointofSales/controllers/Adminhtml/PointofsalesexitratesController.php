<?php

class ItrCustomModule_PointOFSales_Adminhtml_PointofsalesexitratesController extends Mage_Adminhtml_Controller_Action

{

	public function indexAction()

    {

	   $this->loadLayout();

	   $this->_title($this->__("Point Of Sales"));

	   $this->renderLayout(); 

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
		$select = $connection->select()->from($pos_sales_report_table, array('order_id'));
		$rowArray =$connection->fetchAll($select); 
		foreach($rowArray as $data)
		{
			$sales_data[] = array('eq' => $data['order_id']);		
		}
		//echo'<pre>';print_r($sales_data);die;
		
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
		//echo sizeof($product_ids);die;
		//echo'<pre>';print_r($product_ids);die;
		$product_ids_exp=implode(',',$product_ids);
		
		
		//*****************Calculate total sold products**********************//

		/*$select = $connection->select()->from($table_stock_movement)->where('sm_target_stock=0 and sm_product_id IN ('.$product_ids_exp.')');
		$rowArray =$connection->fetchAll($select);
		foreach($rowArray as $total_qtys)
		{	
			if(!in_array($product_total_qtys[$total_qtys["sm_product_id"]],$product_total_qtys))
			{
				$product_total_qtys[$total_qtys["sm_product_id"]][0]=$total_qtys["sm_qty"];	
			}
			else
			{
				$old_qty=$product_total_qtys[$total_qtys["sm_product_id"]][0];
				$product_total_qtys[$total_qtys["sm_product_id"]][0]=$old_qty+$total_qtys["sm_qty"];	
			}
		}*/

		

		//*****************Calculate Total sold products**********************//

		$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');
		$products_entire_period =$connection->fetchAll($select);
		//echo'<pre>';print_r(sizeof($products_entire_period));die;
		foreach($products_entire_period as $total_qtys)
		{	
			$sm_date=date('m/d/Y', strtotime($total_qtys['sm_date']));
			if(strtotime($sm_date)>=strtotime($datefrom))
			{	
				if($total_qtys["sm_target_stock"]>0)
				$total_qtys["sm_qty"]=0;
				if(!in_array($product_total_sold[$total_qtys["sm_product_id"]],$product_total_sold))
				{
					$product_total_sold[$total_qtys["sm_product_id"]][0]=$total_qtys["sm_qty"];	
				}
				else
				{
					$old_qty=$product_total_sold[$total_qtys["sm_product_id"]][0];
					$product_total_sold[$total_qtys["sm_product_id"]][0]=$old_qty+$total_qtys["sm_qty"];	
				}
			}
			else
			{
				$total_qtys["sm_qty"]=0;
				if(!in_array($product_total_sold[$total_qtys["sm_product_id"]],$product_total_sold))
				{
					$product_total_sold[$total_qtys["sm_product_id"]][0]=$total_qtys["sm_qty"];	
				}
				else
				{
					$old_qty=$product_qty[$total_qtys["sm_product_id"]][0];
					$product_total_sold[$total_qtys["sm_product_id"]][0]=$old_qty+$total_qtys["sm_qty"];	
				}	
			}
		}
		//echo'<pre>';print_r($product_total_sold);die;

		

		

		//*****************Calculate sold products in entire period**********************//
		//$select = $connection->select()->from($table_stock_movement)->where('sm_product_id IN ('.$product_ids_exp.')');
		//$rowArray =$connection->fetchAll($select);
		//echo'<pre>';print_r($rowArray);
		//foreach($rowArray as $total_qtys)products_entire_period
		foreach($products_entire_period as $total_qtys)
		{	
			$sm_date=date('m/d/Y', strtotime($total_qtys['sm_date']));
			if(strtotime($sm_date)>=strtotime($datefrom) && strtotime($sm_date)<=strtotime($dateto))
			{	
				if($total_qtys["sm_target_stock"]>0)
				$total_qtys["sm_qty"]=0;
				if(!in_array($product_qty[$total_qtys["sm_product_id"]],$product_qty))
				{
					$product_qty[$total_qtys["sm_product_id"]][0]=$total_qtys["sm_qty"];	
				}
				else
				{
					$old_qty=$product_qty[$total_qtys["sm_product_id"]][0];
					$product_qty[$total_qtys["sm_product_id"]][0]=$old_qty+$total_qtys["sm_qty"];	
				}
			}
			else
			{
				$total_qtys["sm_qty"]=0;
				if(!in_array($product_qty[$total_qtys["sm_product_id"]],$product_qty))
				{
					$product_qty[$total_qtys["sm_product_id"]][0]=$total_qtys["sm_qty"];	
				}
				else
				{
					$old_qty=$product_qty[$total_qtys["sm_product_id"]][0];
					$product_qty[$total_qtys["sm_product_id"]][0]=$old_qty+$total_qtys["sm_qty"];	
				}	
			}
		}
		//echo'<pre>';print_r(sizeof($product_qty));

		

		

		//***********Calculate quantity added into period**************//
		//$select = $connection->select()->from($table_stock_movement);
		//$rowArray =$connection->fetchAll($select);
		//foreach($rowArray as $qapdata)
		foreach($products_entire_period as $qapdata)
		{
			//echo $date=$qapdata['sm_date'];
			$sm_date=date('m/d/Y', strtotime($qapdata['sm_date']));
			if(strtotime($sm_date)>=strtotime($datefrom) && strtotime($sm_date)<=strtotime($dateto))
			{
				if($qapdata["sm_target_stock"]<1)
				$qapdata["sm_qty"]=0;
				if(!in_array($product_qap[$qapdata["sm_product_id"]],$product_qap))
				{
					$product_qap[$qapdata["sm_product_id"]][0]=$qapdata["sm_qty"];	
				}
				else
				{
					$old_qty=$product_qap[$qapdata["sm_product_id"]][0];
					$product_qap[$qapdata["sm_product_id"]][0]=$old_qty+$qapdata["sm_qty"];	
				}
			}
			//elseif(strtotime($sm_date)>=strtotime($datefrom))
			if(strtotime($sm_date)>=strtotime($datefrom))
			{
				if($qapdata["sm_target_stock"]<1)
				$qapdata["sm_qty"]=0;
				if(!in_array($product_total_qap[$qapdata["sm_product_id"]],$product_total_qap))
				{
					$product_total_qap[$qapdata["sm_product_id"]][0]=$qapdata["sm_qty"];	
				}
				else
				{
					$old_qty=$product_total_qap[$qapdata["sm_product_id"]][0];
					$product_total_qap[$qapdata["sm_product_id"]][0]=$old_qty+$qapdata["sm_qty"];	
				}	
			}
			else
			{
				$qapdata["sm_qty"]=0;
				if(!in_array($product_qap[$qapdata["sm_product_id"]],$product_qap))
				{
					$product_qap[$qapdata["sm_product_id"]][0]=$qapdata["sm_qty"];
					$product_total_qap[$qapdata["sm_product_id"]][0]=$qapdata["sm_qty"];	
				}
				else
				{
					$old_qty=$product_qap[$qapdata["sm_product_id"]][0];
					$product_qap[$qapdata["sm_product_id"]][0]=$old_qty+$qapdata["sm_qty"];	
					
					$old_qty=$product_total_qap[$qapdata["sm_product_id"]][0];
					$product_total_qap[$qapdata["sm_product_id"]][0]=$old_qty+$qapdata["sm_qty"];	
				}
			}
		}
		//echo'<pre>';print_r($product_total_qap);

		

		//************Calculate stock products********************//
		//$select = $connection->select()->from($table_cataloginventory_stock_item);
		$select = $connection->select()->from($table_cataloginventory_stock_item)->where('product_id IN ('.$product_ids_exp.')');
		$rowArray =$connection->fetchAll($select);
		foreach($rowArray as $stockdata)
		{
			$product_stock[$stockdata['product_id']]=round($stockdata['qty'],2);
			
			//Calculation to get stock at beginning of the period
			$QBP[$stockdata['product_id']]=$product_stock[$stockdata['product_id']]+$product_total_sold[$stockdata["product_id"]][0];
			if($product_total_qap[$stockdata["product_id"]][0]>0)
			{
				$QBP[$stockdata['product_id']]=$QBP[$stockdata['product_id']]-$product_total_qap[$stockdata["product_id"]][0];
			}
			
			//Calculation Qty on the end of period [QBP + QAP]
			$QEP[$stockdata['product_id']]=$QBP[$stockdata['product_id']]+$product_qap[$stockdata["product_id"]][0]-$product_qty[$stockdata["product_id"]][0];
			
			//Calculation Exit Rate QSP / (QBP + QAP) * 100%
			$exit_rate[$stockdata['product_id']]=($product_qty[$stockdata["product_id"]][0]/$QEP[$stockdata['product_id']])*100;
		}
		//echo'<pre>';print_r($QBP);die;

		$sales_record = Mage::getModel('sales/order')->getCollection()
		//->addAttributeToFilter('created_at', array('from' => $date_from,'to'=>$date_to))
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
			foreach($Allitems as $items)
			{
				$product_details = Mage::getModel('catalog/product')->load($items["product_id"]);
				
				//echo'<pre>';print_r($product_details);die;
				if(!in_array($items["name"],$product_name))
				{
					$product_name[]=$items["name"];
					$manufacture=$product_details->getAttributeText('manufacturer');
					$final_exit_rates_data[$i]['sku']=$items["sku"];
					$final_exit_rates_data[$i]['name']=$items["name"];
					$final_exit_rates_data[$i]['manufacture']=$manufacture;
					$final_exit_rates_data[$i]['qbp']=$QBP[$items['product_id']];
					$final_exit_rates_data[$i]['qsp']=$product_qty[$items["product_id"]][0];
					$final_exit_rates_data[$i]['qap']=$product_qap[$items["product_id"]][0];
					$final_exit_rates_data[$i]['qep']=$QEP[$items['product_id']];
					$final_exit_rates_data[$i]['exit_rate']=$exit_rate[$items['product_id']];
					$total_records++;
					$i++;
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
				$this->__('SKU'),
				$this->__('Product name'),
				$this->__('Manufacture'),
				$this->__('QBP'),
				$this->__('QSP'),
				$this->__('QAP'),
				$this->__('QEP'),
				$this->__('Exit Rate')
			);

			foreach($final_exit_rates_data as $data)
			{
				$_customersData[] = array(
					$data["sku"],
					$data["name"],
					$data['manufacture'],
					$data['qbp'],
					$data['qsp'],
					$data['qap'],
					$data['qep'],
					round($data['exit_rate'],2)
				);
			}
			//echo'<pre>';print_r($_customersData);

			

			// Magento builtin class that will save your data as CSV
			$csv = new Varien_File_Csv();
			$filename=date('d-m-Y,h-i-s');
			$baseurl=str_replace('index.php/','',Mage::getBaseUrl());
			$baseurl=$baseurl.'credit_memo_ticket2/'.$filename.'.csv';
			$customerdata_path = Mage::getBaseDir('base').'/credit_memo_ticket2/'.$filename.'.csv';
			$csv->saveData($customerdata_path, $_customersData);

			//$this->_prepareDownloadResponse($fileName, $baseurl);
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

							<td class="a-left">'.$data["sku"].'</td>

							<td class="a-left">'.$data["name"].'</td>

							<td class="a-left">'.$data['manufacture'].'</td>

							<td class="a-right">'.$data['qbp'].'</td>

							<td class="a-right">'.$data['qsp'].'</td>

							<td class="a-right">'.$data['qap'].'</td>

							<td class="a-right">'.$data['qep'].'</td>

							<td class="a-right">'.round($data['exit_rate'],2).'</td>

						</tr>';	

				$counter++;

				$j++;

			}

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