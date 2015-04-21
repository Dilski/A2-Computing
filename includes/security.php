 <?php
	
	function input_required($fieldName, $message)
		{
			global $error;
			
			if (empty($_POST[$fieldName])) {
			     $error.= $message."<br />";
			   } else {
		   		$data = $_POST[$fieldName];
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
		     	return $data;
			   }
		}
		
	function input($fieldName)
		{
		   	$data = $_POST[$fieldName];
		   	$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
				
		    return $data;
		}
		
	function input_get($fieldName)
		{
		   	$data = $_GET[$fieldName];
		   	$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
				
		    return $data;
		}
		
	function dateCheck($firstDate, $endDate, $message)
	{
		if (strtotime($firstDate) > strtotime($endDate)) 
		{
    		global $error;
    		$error.= $message.'<br />';
		}	
	}