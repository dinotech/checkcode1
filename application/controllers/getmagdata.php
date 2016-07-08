<?php


if(isset($_GET['type'])){  echo $_GET['type'];   }

	$this->load->model('home_model');
	$magazines = $this->home_model->get_data('magazine');
	//print_r($magazines);
	
	?>