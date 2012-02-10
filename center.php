<style>
	#list{
		-moz-column-count: 3;
		-moz-column-gap: 20px;
		-webkit-column-count: 3;
		-webkit-column-gap: 20px;
		column-count: 3;
		column-gap: 20px;
	}
</style>
<div id="list">
<table><tr><th>Code</th><th>City</th><th>Selections</th></tr><?php
$db=mysqli_connect('localhost','root','nemoabhay','iitjee');
$cities=array(
array('IIT-B','Panaji','Ahmedabad','Rajkot','Surat','Vadodara','Belgaum','Aurangabad','Latur','Mumbai','Nagpur','Nashik','Navi Mumba','Pune ','Thane','Ajmer','Bikaner','Jaipur','Jodhpur','Udaipur','Dubai'),
array('IIT-D','DELHI (East)','Delhi (West)','Delhi (North)','Delhi (South)','Delhi (Central)','Ballabgarh','Faridabad','Gurgaon','Jammu','Indore','Ujjain','Aligarh','Noida','Ghaziabad','Mathura','Dubai'),
array('IIT-G','Itanagar','Dibrugarh','Goalpara','Guwahati','Silchar','Tezpur','Bhagalpur','Gaya','Katihar','Muzaffarpur','Patna','Imphal','Shillong','Siliguri'),
array('IIT-K','Bhopal','Gwalior','Jabalpur','Nainital','Pantnagar','Agra','Allahabad','Gorakhpur','Jhansi','Kanpur','Lucknow','Raebareli'),
array('IIT-KGP','Port Blair','Visakhapatnam','Bhilai','Bilaspur','Raipur','Bokaro','Dhanbad','Jamshedpur','Ranchi','Balasore','Berhampur','Bhubaneswar','Cuttack','0Rourkela','Sambalpur','Gangtok','3Agartala','Asansol','Barddhaman519','Belur','Durgapur','Kharagpur','Kolkata (North)','Kolkata (Salt Lake)','Kolkata (South) ','Malda'),
array('IIT-M','Bapatla','Guntur','Hyderabad','Nellore','Tirupathi','Vijayawada','Warangal','Bangalore','Mangalore','Mysore','Kochi','Kozhikode','Palakkad','Thiruvananthapuram','Trissoor','Puducherry','Chennai','Coimbatore','Madurai','Salem','Tiruchirapalli','Tirunelveli'),
array('IIT-R','Chandigarh','Ambala','Kurukshetra','Panipat','Rohtak','Sonipat','Yamuna Nagar', 'Mandi','Palampur','Shimla','Amritsar','Bhatinda','Jalandhar','Ludhiana','Patiala','Dehradun','Roorkee','Bareilly','Meerut','Moradabad','Saharanpur','Varanasi'));
$cl=array(0,119,216,314,412,526,622,722);
for($i=1;$i<8;$i++){
	$center_max=$cl[$i];
	for($c=$i.'00';$c<=$center_max;$c++)
	{
		$q="SELECT count(regno) from selected where regno like '$c%'";
		$q=mysqli_query($db,$q);
		$q=mysqli_fetch_row($q);
		$q=$q[0];
		$cno=($c%100);
		$name=$cities[$i-1][$cno];
		echo "<tr><td>$c</td><td>$name</td><td>$q</td></tr>";
	}
}
?>
</div>
