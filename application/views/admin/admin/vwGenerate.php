<?php ob_start();?>
<?php
/*header("Content-Type: text/csv");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Content-Transfer-Encoding: binary\n");
header('Content-Disposition: attachment; filename="report.xls"');*/

$segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
$currentSegment = $segments[5];
		
if($currentSegment=="dealer")
	{ 
	echo "Sr.No"."\t"."Dealer Name"."\t"."Address"."\t"."Phone No."."\t"."Mobile No."."\n\n"; 
    $i=0;
	foreach($row as $rows)
	   {
        echo $i++."\t".$rows['d_name']."\t".$rows['d_address']."\t".$rows['phone']."\t".$rows['mobile']."\n";
	    }
	}
	

if($currentSegment=="godown")
	{ 
	echo "Sr.No"."\t"."Godown Name"."\t"."Address"."\t"."Phone No"."\t"."Mobile No"."\t"."City"."\t"."State"."\n\n"; 
    $j=0; //echo "<pre>"; print_r($row);
	foreach($row as $rows)
	   { 
		   foreach($rows as $rw)
		   { 
			echo $j."\t".$rw['g_name']."\t".$rw['g_address']."\t".$rw['ph_no']."\t".$rw['mob']."\t".$rw['city']."\t".$rw['state']."\n";
			$j++;
			}
	   }	
	}
	
if($currentSegment=="sales")
	{ 
	echo "<pre>"; print_r($row);
	foreach($row as $rows)
	   { 
		   foreach($rows as $rw)
		   { 
			echo $j."\t".$rw['g_name']."\t".$rw['g_address']."\t".$rw['ph_no']."\t".$rw['mob']."\t".$rw['city']."\t".$rw['state']."\n";
			$j++;
			}
	   }
	}
?>