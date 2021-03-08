<?php

if($_POST["flag"]=="com")
{
	$path ="../images/";

			$comlogo=$_FILES['upload_com_logo']['name'];
			
			$imgname = "logo.png";
			$tmpname = $_FILES['upload_com_logo']['tmp_name'];
			$size = $_FILES['upload_com_logo']['size'];

			
				$image=$path . $imgname;
				move_uploaded_file($tmpname, $image);
  			
  		
}
if($_POST["flag"]=="fav")
{
	$path ="../images/";

			$comlogo=$_FILES['upload_fav_logo']['name'];
			
			$imgname = "favicon.png";
			$tmpname = $_FILES['upload_fav_logo']['tmp_name'];
			$size = $_FILES['upload_fav_logo']['size'];

			
				$image=$path . $imgname;
				move_uploaded_file($tmpname, $image);
  			
  		
}
