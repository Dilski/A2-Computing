	<?php
	
		include('../includes/connection.php');
		include('security.php');
	
		$date = date_create(input_get('date'));
		
		$month = date_format($date, 'm');
		$year = date_format($date, 'Y');
		
		$weekday = date("l", mktime(0,0,0,$month,1,$year));
		
		switch($weekday)
		{
			case 'Monday': 
				$first = 1;
				break;
			case 'Tuesday': 
				$first = 2;
				break;
			case 'Wednesday': 
				$first = 3;
				break;
			case 'Thursday': 
				$first = 4;
				break;
			case 'Friday': 
				$first = 5;
				break;
			case 'Saturday': 
				$first = 6;
				break;
			case 'Sunday': 
				$first = 7;
				break;
		}
		
		$last = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		
		
		if($month == 1)
		{ 
			$prevMonth = 12; 
			$prevYear = $year-1;
		}
		else
		{
			$prevMonth = $month - 1;
			$prevYear = $year;
		}
		
		$prevMonth = sprintf("%02d", $prevMonth);
		
		$lengthLastMonth = cal_days_in_month(CAL_GREGORIAN, $prevMonth, $prevYear);
		
		if($month == 12)
		{
			$nextMonth = 01;
			$nextYear = $year+1;
		}
		else
		{
			$nextMonth = $month+1;
			$nextYear = $year;
		}
		
		$nextMonth = sprintf("%02d", $nextMonth);
		
	
		$prevMonthDate = date_create($prevYear.'-'.$prevMonth.'-00 00:00:00');
		$nextMonthDate = date_create($nextYear.'-'.$nextMonth.'-00 00:00:00');
		
		$firstLastMonth = $lengthLastMonth - $first + 2;
		
		$numbers = array();
		$types = array();
		$actualDates = array();
		
		
		for ($i = $firstLastMonth; $i <= $lengthLastMonth; $i++)
			{
				$actualDate = $prevYear.'-'.$prevMonth.'-01';
				array_push($numbers, $i);
				array_push($types, ' class="prev-month"');
				array_push($actualDates, $actualDate);
			}
		
		for ($j = 1; $j <= $last; $j++)
			{	
				$jj = sprintf("%02d", $j);
				$actualDate = $year.'-'.$month.'-'.$jj;
				
				$sql = "SELECT * FROM `job` WHERE `jobStart` <= '$actualDate' AND `jobEnd` >= '$actualDate' ";
				$query = mysql_query($sql, $connection);
				if(mysql_num_rows($query)==0)
				{
					array_push($types, '');	
				}
				else
				{	
					array_push($types, ' class="events"');
				}
				
				array_push($numbers, $j);
				array_push($actualDates, $actualDate);
			}
		
		$l = 1;
		
		for ($k = ($last+1); $k<42; $k++)
			{	
				$actualDate = $nextYear.'-'.$nextMonth.'-01';
				array_push($numbers, $l);
				$l = $l+1;
				array_push($types, ' class="next-month"');
				array_push($actualDates, $actualDate);
			}
			
			
		
		
	?>
       
       
    <div class="panel-body">
    
    
	  	
		
	
			
	
	<h2 style="text-align: center;"><?php echo date_format($date, 'F Y');?> </h2>
	
	<a class='btn btn-default' href="../calendar.php?date=<?php echo($prevYear.'-'.$prevMonth); ?>"> <?php echo date("F Y", mktime(0,0,0,$prevMonth,1,$prevYear));?> </a>  <a class='btn btn-default' style="float:right;" href="../calendar.php?date=<?php echo($nextYear.'-'.$nextMonth); ?>"> <?php echo date("F Y", mktime(0,0,0,$nextMonth,1,$nextYear));?> </a>

	</div>

    
    
    
    
	<table class="calendar">
		<thead>
			<tr>
				<th>Mon<span>day</span></th>
				<th>Tue<span>sday</span></th>
				<th>Wed<span>nesday</span></th>
				<th>Thu<span>rsday</span></th>
				<th>Fri<span>day</span></th>
				<th>Sat<span>urday</span></th>
				<th>Sun<span>day</span></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
			<tr>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">th</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
				<td<?php echo(array_shift($types));?>>
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">st</span></span></h3>
					<?php job(array_shift($actualDates)); ?>
				</td>
			</tr>
		</tbody>
	</table>
    
    
    
 <!-- events
 
 
 <td class="events">
					<h3 class="day"><span class="num"><?php echo(array_shift($numbers));?><span class="suffix">rd</span></span></h3>
					<ul>
						<li><a href="/event/1/">Event One</a></li>
						<li><a href="/event/2/">Event Two</a></li>
						<li><a href="/event/3/">Event Three</a></li>
					</ul>
				</td>
				
				--> 
    
  