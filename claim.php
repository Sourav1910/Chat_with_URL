<?php

//Getting the values of post parameters

$room=$_POST['room'];

//Checking for string size

if(strlen($room)>20 or strlen($room)<2)
{
	$message="Please type a name between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';
}

//Checking whether roomname is alphanumeric

else if(!ctype_alnum($room))
{
	$message="Please choose an alphanumeric roomname";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>';

}

else
{	
	//Connecting to database
	include 'db_connect.php';
}

//Check if room already exists

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'; ";

$result=mysqli_query($conn,$sql);
if($result)
{
	if(mysqli_num_rows($result) > 0)
	{
		$message="Please choose a different roomname.This room is already claimed.";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>';
	}
	else
	{
		$sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP);";
		if(mysqli_query($conn,$sql))
		{
			$message="Your room is ready and you can chat now!";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost/chatroom/rooms.php?roomname='.$room.'";';
			echo '</script>'; 
		}
	}
}
else
{
	echo mysqli_error($conn);
}
?>