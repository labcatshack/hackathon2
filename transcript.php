<?php
session_start();
//include('functions.php');
//include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Class Central</title>	
</head>
	<?php 
	$gradids = array();
	$ids = findCompletedIds($userid); 
	//print_r($ids);
	foreach($ids as $id){
		list($classid) = $id;
		list($classid, $classname, $academyid, $credits, $ap, $honors, $classrating, $gradereq) = getClassInfo($classid);
		//echo $classname;
		array_push($gradids, $credits);
	}
	$totalcredits = array_sum($gradids);
	//echo $totalcredits;
	$perecentprog = ($totalcredits/24)*100;
	?>
	<h2>Graduation Progress: <progress id = "gradprogress" value = "<?php echo $perecentprog;?>" max = "100"></progress></h2>
<body>
	<div id="whole">
	<div id ="ttable">
	<h2>Transcript</h2>	
	<table class="transcript">
		<tr>
			<th>Requirement</th>
			<th>Includes</th>
			<th>Credits</th>
		</tr>
		<tr>
			<td>Art</td>
			<td></td>
			<td>0.5</td>
		</tr>
		<tr>
			<td>Electives</td>
			<td></td>
			<td>3.5</td>
		</tr>
		<tr>
			<td>English</td>
			<td>English I, English II, English III/AP English Language, English IV/AP Literature</td>
			<td>4.0</td>
		</tr>
		<tr>
			<td>Health & Gym</td>
			<td>Health, PE I, PE II</td>
			<td>1.5</td>
		</tr>
		<tr>
			<td>Math</td>
			<td>Algebra I, Geometry, Algebra II</td>
			<td>4.0</td>
		</tr>
		<tr>
			<td>Music</td>
			<td></td>
			<td>0.5</td>
		</tr>
		<tr>
			<td>Science</td>
			<td>2 lab sciences</td>
			<td>4.0</td>
		</tr>
		<tr>
			<td>Social Studies</td>
			<td>World History I & II, US History, DC History, US Government</td>
			<td>4.0</td>
		</tr>
		<tr>
			<td>World Language</td>
			<td>2 credits from the same language</td>
			<td>2.0</td>
		</tr>
		<tr>
			<td colspan="2">TOTAL</td>
			<td>24.0</td>
		</tr>
	</table>
	</div>
	<div id="academy">
	<h2>Academy Information</h2>
	<table class="atable">
			<tr>
				<td><a href="https://wilsonhs.org/apps/pages/?uREC_ID=127891&type=d" target="_blank" class="al">Academic Athletic Acheivement</a></td>
				<td><a href="https://wilsonhs.entest.org/apps/pages/?uREC_ID=127892&type=d" target="_blank" class="bl">Academy of Finance</a></td>
			</tr>
			<tr>
				<td><a href="https://wilsonhs.entest.org/apps/pages/index.jsp?uREC_ID=229320&type=d" target="_blank" class="bl">Academy of Hospitality and Tourism</a></td>
				<td><a href="https://wilsonhs.entest.org/apps/pages/?uREC_ID=127893&type=d" target="_blank" class="al">Creative Media Academy</a></td>
			</tr>
			<tr>
				<td><a href="https://wilsonhs.entest.org/apps/pages/?uREC_ID=127894&type=d" target="_blank" class="al">JROTC Leadership Academy</a></td>
				<td><a href="https://wilsonhs.entest.org/apps/pages/?uREC_ID=127896&type=d" target="_blank" class="bl">WISP</a></td>
			</tr>
			<tr>
				<td><a href="https://www.wilsonhs.org/ourpages/auto/2021/10/29/40031331/Academy%20of%20Information%20Technology.pdf?rnd=1636494080446" target="_blank" class="bl">Academy of Information Technology</a></td>
				<td><a href="https://www.wilsonhs.org/ourpages/auto/2021/10/29/40031331/Academy%20of%20Engineering.pdf?rnd=1636494080446" target="_blank" class="al">Engineering</a></td>
			</tr>
			<tr>
				<td><a href="https://www.wilsonhs.org/ourpages/auto/2021/10/29/40031331/Academy%20of%20Health%20Science.pdf?rnd=1636494080446" target="_blank" class="al">Academy of Health Sciences</a></td>
				<td><a href="https://www.wilsonhs.org/ourpages/auto/2021/10/29/40031331/Academy%20of%20Environmental%20Science%20_1_.pdf?rnd=1636494080446" target="_blank" class="bl">Academy of Environmental Science</a></td>
			</tr>
			<tr>
				<td colspan="2"><a href="https://www.wilsonhs.org/apps/pages/?uREC_ID=127895&type=d" target="_blank" class="bl">SciMaTech</a></td>
			</tr>
		</table>
		</div>
	</div>
</body>
</html>