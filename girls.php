<center><h3>Don't Misuse</h3><style>
/*
  project: CSS - table design
  type: stylesheet
  description: golden style
  edited: 14.09.2005, Michael Horn
*/
table {
  border-collapse: collapse;
  border: 2px solid #996;
  font: normal 80%/140% verdana, arial, helvetica, sans-serif;
  color: #333;
  background: #fffff0;
  }
caption {
  padding: 0 .4em .4em;
  text-align: left;
  font-size: 1em;
  font-weight: bold;
  text-transform: uppercase;
  color: #333;
  background: transparent;
  }
td, th {
  border: 1px solid #cc9;
  padding: .3em;
  }
thead th, tfoot th {
  border: 1px solid #cc9;
  text-align: left;
  font-size: 1em;
  font-weight: bold;
  color: #444;
  background: #dbd9c0;
  }
tbody td a {
  background: transparent;
  color: #72724c;
  text-decoration: none;
  border-bottom: 1px dotted #cc9;
  }
tbody td a:hover {
  background: transparent;
  color: #666;
  border-bottom: 1px dotted #72724c;
  }
tbody th a {
  background: transparent;
  color: #72724c;
  text-decoration: none;
  font-weight:bold;
  border-bottom: 1px dotted #cc9;
  }
tbody th a:hover {
  background: transparent;
  color: #666;
  border-bottom: 1px dotted #72724c;
  }
tbody th, tbody td {
  vertical-align: top;
  text-align: left;
  }
tfoot td {
  border: 1px solid #996;
  }
.odd {
  color: #333;
  background: #f7f5dc;
  }
tbody tr:hover {
  color: #333;
  background: #fff;
  }
tbody tr:hover th,
tbody tr.odd:hover th {
  color: #333;
  background: #ddd59b;
  }</style>
  </center><?php
//get names
	$c=file_get_contents("final.txt");
	$names=(str_word_count($c,1));
	$db=mysqli_connect('localhost','','','');
	$q="SELECT name, course,reg from results where gender>0 and course <> 'Not Allotted' order by course,name ASC ";
	$q=mysqli_query($db,$q);
	echo "<table><tr><th>Name</th><th width='30%'>Course</th><th>Report</th><th>Search</th></tr>";
	while($row=mysqli_fetch_row($q)){
		if($lc==$row[1])
			$course='';
		else
			$course=$row[1];
		echo "<tr><td>".$row[0]."</td><td>".$course."</td><td><a href='report.php?id=".
		base64_encode($row[2])
		."'>Report As Male</a></td><td><a href='http://www.orkut.co.in/Main#UniversalSearch?q=".$row[0]."'>Orkut</a> OR <A href='http://www.facebook.com/search/?src=os&q=".$row[0]."'>Facebook</a></td></tr>";
		$lc=$row[1];
	}
?>
