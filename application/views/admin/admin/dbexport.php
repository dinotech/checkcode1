
<?php
$data['id']="pt";
$this->load->view('admin/vwHeader',$data);
?>
<?php $username = "root"; 
$password = ""; 
$hostname = "localhost"; 
//if((isset($_GET['dbexport'])) && ($_GET['dbexport']!="")){
	//if((isset($_POST['submit']))){
	{
	
	$dbname   = 'mysql';//$_GET['dbexport'];


//$dbname="test";

// if mysqldump is on the system path you do not need to specify the full path
// simply use "mysqldump --add-drop-table ..." in this case
//$dumpfname ="D:\\sqldump\\".$dbname ."_".uniqid()."_".date("Y-m-d_H-i-s").".sql";
$dumpfname ="E:\\xampp\\htdocs\\ankit\\CS\\sqldump\\".$dbname ."_".uniqid()."_".date("Y-m-d_H-i-s").".sql";
$command = "C:\\xampp\mysql\bin\mysqldump --add-drop-table --host=$hostname --user=$username ";
if ($password) 
        $command.= "--password=". $password ." "; 
$command.= $dbname;
$command.= " > ".$dumpfname;
echo $command;
system($command);



// zip the dump file

//$zipfname = "D:\\sqldump\\".$dbname.".zip";
$zipfname = "E:\\xampp\\htdocs\\ankit\\CS\\sqldump\\".$dbname.".zip";
$zip = new ZipArchive();

if($zip->open($zipfname,ZIPARCHIVE::CREATE)) 
{
   $zip->addFile("E:\\xampp\\htdocs\\ankit\\CS\\sqldump\\".$dumpfname ,$dumpfname);
   $zip->close();
}
 
// read zip file and send it to standard output
if (file_exists($zipfname)) {
	
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($zipfname));
    flush();
    readfile($zipfname);
 exit;
}}
?>
<!--dbexport.php-->
<form name="dbu" id="dbu" action="">
<center><br/><br/><br/><br/><br/><br/><div style="margin-top:100px;"><!--<b style="font-size:20px">Database Name:</b><select name="dbexport" id="dbexport" >
<option>cdcol</option>
<option>mydb</option>
<option>mysql</option>
<option>phpmyadmin</option>
<option>sampledb</option>
<option>tailor_deepees</option>
<option>tailor_febric</option>
<option>tailor_shop</option>
</select><br/>-->
<input type="submit" class="btn btn-success" value="Export Database"></div>
</center></form>
