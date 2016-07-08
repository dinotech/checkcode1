<?php
class Paymentupload extends CI_Controller {


  public function __construct() {
         parent::__construct();
		 $this->load->model('admin_model');
		 $this->load->model('payment_model');
	     $this->load->library('form_validation');
    }

    public function index() {
		$arr['page'] ='paymentupload';
		$arr['payments']=$this->payment_model->get_payment();
	    	
		$arr['mag']=$this->payment_model->get_mag();
		$arr['user']=$this->payment_model->get_user();
		$arr['subresult']= $this->admin_model->dofindall();
		if(isset($_GET['error'])) {if($_GET['error']=='match_case'){ $arr['error']="Matching Case occure"; }}
    	$arr['data'] = $this->payment_model->findpayment();
    	//print_r($arr);die;
		$this->load->view('admin/vwpaymentupload',$arr);
		}
		
		public function makepay(){
		//echo'<pre>';print_r($_POST);die;
			$this->form_validation->set_rules('offline', 'Mode', 'required');
			if ($this->form_validation->run() == FALSE)
		   {
			   $arr['payments']=$this->payment_model->get_payment();
			   $arr['mag']=$this->payment_model->get_mag();
		       $arr['user']=$this->payment_model->get_user();
			   
		       $this->load->view('admin/vwpaymentupload',$arr);
	     	}else {
				$data = $this->payment_model->findpayment();
				//echo'<pre>';print_r($data);
				
				//die;
				foreach($data as $result)				
				{
					//echo'<pre>';print_r($result);
					if(isset($result['modate']) && $result['modate'] != NULL)
					{
					$timestamp = strtotime($result['modate']);
					}
					else if(isset($result['date']) && $result['date'] != NULL)
					{
					$timestamp = strtotime($result['date']);
					};
				 	$datenew = date('Y-m-d', $timestamp);
				
				if($result['offline'] == $_POST['offline'] && $result['offline'] == 'MoneyOrder')
					{
					 if(($result['amount']==$_POST['amount1'] && $result['sname']==$_POST['sendername1']) ||($result['amount']==$_POST['amount1'] && $result['payid']==$_POST['payid']))	
						{
							$u['newresult'] = $result;
							$u['newdata'] = $this->payment_model->findsubdetail($result['payid'],0,$result['amount']);
							$this->load->view('admin/vwpaymentupdated',$u);
						}
						else
						{
							$u['newresult'] = 0;
							$u['newdata'] = 0;	
						}
						
					}					
				if($result['offline'] == $_POST['offline'] && $result['offline'] == 'DemandDraft')					
					{//print_r($result);
					    if($result['amount']==$_POST['amount2'] && $result['ddnum']==$_POST['ddnum'])
						{
							$u['newresult'] = $result;
							
							$u['newdata'] = $this->payment_model->findsubdetail($result['payid'],0,$result['amount']);
							
							
							
							$this->load->view('admin/vwpaymentupdated',$u);
						}
						else
						{
							$u['newresult'] = 0;
							$u['newdata'] = 0;
						}
					}
				if($result['offline'] == $_POST['offline'] && $result['offline'] == 'BankDeposite')
					{//print_r($result['tensid']);die;
						if(($datenew == $_POST['date'] && $result['amount']==$_POST['amount3'])|| ($result['tensid']==$_POST['tensid'] && $result['amount']==$_POST['amount3']))
						{
							$u['newresult'] = $result;
							if(isset($result['modate']) && $result['modate'] != NULL)
							{
							$u['newdata'] = $this->payment_model->findsubdetail($result['payid'],$result['modate'],$result['amount']);
							} else if(isset($result['date']) && $result['date'] != NULL)
							{
							$u['newdata'] = $this->payment_model->findsubdetail($result['payid'],$result['date'],$result['amount']);
							}
							$this->load->view('admin/vwpaymentupdated',$u);
						}
						else
						{
							$u['newresult'] = 0;
							$u['newdata'] = 0;
						}
					}
					
					
			}
				if($u['newresult'] == 0 && $u['newdata'] == 0)
				{
					$this->load->view('admin/vwpaymentupdated',$u);	
				}
				//print_r($result['sname']);
			//print_r($_POST['offline'].'== MoneyOrder &&'. $result['amount'].' = '.$_POST['amount1'].' && '.$result['sname'].' = '.$_POST['sendername1'].' && '.$result['amount'].' = '.$_POST['amount1']); 
				//echo'<pre>';print_r($_POST);
				//echo'working till here';
		     	//$this->payment_model->makepayment();
				
			}
			
			}
}