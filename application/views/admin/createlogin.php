<?php
//include_once("config.php");
//include_once("functions.php");
include "test.php";
error_reporting(1);	







$name= $_POST['username'];
$email= $_POST['email'];
$pss= $_POST['password'];
$copass= $_POST ['confermpassword'];


	     

switch($_GET['login'])
{
  case 'signup' : 
  	if($pss==$copass)
	{
	     $sql1 = "Select * from login where email = '".$email."'";
	     $rs = mysql_query($sql1);
	     if(mysql_num_rows($rs)>0)
	     {
	        echo("User Already exsits move to next page..");
	        echo("<a href='logout.php?logout'>Logout</a>"); 
	     }
	     else
	     {
		$sql="INSERT INTO login(Name,Email,Password) VALUES('$name','$email','$pss')";
		$query=mysql_query($sql);
		echo "Thankyou For Joining us";
		echo("<a href='logout.php?logout'>Logout</a>");
	     }
	}
	elseif ($pss!==$copass)
	{
		echo "Password Not Match";
	}
	break;
	
 case 'manual' : $sql1 = "Select * from admin_user where username = '".$name."'";
	     $rs = mysql_query($sql1);
	     if(mysql_num_rows($rs)>0)
	     {
	        echo("User successfully Logedin..");
	        header("Location:admin2.php");
	     }
	     else{
	    // echo "Please <a href='signup.html' >Signup </a> for Login";
	     }
	     break;
	     
 default : 
        //  $user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
 	if(isset($user_profile))
		{
		  $name = $user_profile["first_name"];
		  $email = $user_profile['email'];
		}
		
 
        $sql1 = "Select * from login where email = '".$email."'";
	     $rs = mysql_query($sql1);
	     if(mysql_num_rows($rs)>0)
	     {
	        echo("User Already exsits move to next page..");
	        echo("<a href='logout.php?logout'>Logout</a>"); 
	     }
	     else
	     {
	        $sql="INSERT INTO login(Name,Email,Password) VALUES('$name','$email','$pss')";
	        
		$query=mysql_query($sql);
		echo "Thankyou For Joining us";
		echo("<a href='logout.php?logout'>Logout</a>");
		}
	}