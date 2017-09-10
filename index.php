<!--#-------------------------------------------------------------------------------
# Copyright (C) 2017
# Authors:
# Sohan Nipunage <smn57958@uga.edu>
# Dnyanada Shirsat <dds69748@uga.edu>
# Akshay Agashe <aa84678@uga.edu>
# Niyati Shah <nhs01063@uga.edu>
# 
# *For using this project anywhere, contact authors for permission*
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#-------------------------------------------------------------------------------
-->
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<title>MyMDB by CodeBusters</title>
<link rel="stylesheet" href="css/styles.css" />
<link href="https://fonts.googleapis.com/css?family=Lobster"
	rel="stylesheet">

<link rel="stylesheet"
	href="https://fonts.googleapis.com/icon?family=Material+Icons">

<script>
var username=window.prompt("Username","root");
var password=window.prompt("Password","test123");
var dbname=window.prompt("Database name","imdb");
if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open("GET","php/cookie.php?username="+username+"&password="+password+"&dbname="+dbname,true);
		xmlhttp.send();
		document.getElementById("connection").innerHTML="Hello";
	function suggest()
	{
		var str=document.getElementById("squery").value;
		var d=document.getElementById("degrees");
		if(str=='null')
		{
			document.getElementbyId("suggestion").innerHTML="";
			d.style.display='none';
		}
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("suggestion").innerHTML=this.responseText;
				d.style.display='block';
				deg.style.display='block';
				
			}
		}
		xmlhttp.open("GET","php/search_actor.php?q="+str,true);
		xmlhttp.send();
	}
	function first_degree()
	{
		var sel=document.getElementById("actorsOpt");
		var index=sel.options[sel.selectedIndex].value;
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("firstTable").innerHTML=this.responseText;
				//ft.style.display='block';
			}
		}
		xmlhttp.open("GET","php/first_degree.php?id="+index,true);
		xmlhttp.send();
		second_degree();
		third_degree();
		fourth_degree();
	}
	function second_degree()
	{
		var sel=document.getElementById("actorsOpt");
		var index=sel.options[sel.selectedIndex].value;
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("secondTable").innerHTML=this.responseText;
				//ft.style.display='block';
			}
		}
		xmlhttp.open("GET","php/second_degree.php?id="+index,true);
		xmlhttp.send();
	}
	function third_degree()
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("thirdTable").innerHTML=this.responseText;
				//ft.style.display='block';
			}
		}
		xmlhttp.open("GET","php/third_q.php",true);
		xmlhttp.send();
	}
		function fourth_degree()
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("fourthTable").innerHTML=this.responseText;
				//ft.style.display='block';
			}
		}
		xmlhttp.open("GET","php/fourth_q.php",true);
		xmlhttp.send();
	}

	</script>
</head>
<body>
	<div id="connection"><?php include ('php/db_handler.php');connector::connect();connector::discond();connector::disconnect()?></div>
	<div id="header">
		<div class="htext">
			<font color="red">"</font>Everything <span class="bwh">I</span> <span
				id="underline">learned</span> I <span class="bwh">learned</span>
			from the <span
				style="background-color: black; color: red; border-radius: 10px;">movies</span><font
				color="red">"</font> <span class="auth">― Audrey Hepburn</span>
		</div>
	</div>
	<div id="main">
		<div id="qtitle">
			#1 Choose your <span class="bwh">favorite</span> <span id="underline">Actor</span>
		</div>
		<p>
			Please enter first Name of the actor in the search bar : <input
				type="text" id="squery" placeholder="Tom">
			<button onclick="suggest()">Search</button>
		</p>
		<p id="suggestion"></p>
		<button id="deg" onclick="first_degree()">Degree It!</button>
		<br />
	</div>
	<div id="degrees">
		<div class="firstDegree">
			<div id="qtitle">
				#2 <span class="bwh">First</span> Degree
			</div>
			<br /> <span class="fuschia"> Movies in which your favorite Actor has
				worked with Actor *Kevin Bacon* </span><br /> <span id="firstTable"></span>
		</div>
		<div class="secondDegree">
			<div id="qtitle">
				#3 <span class="bwh">Second</span> Degree
			</div>
			<br /> <span class="fuschia"> Actors and movies on second Degree with
				*Kevin Bacon* </span><br /> <span id="secondTable"></span>
		</div>
		<div class="thirdDegree">
			<div id="qtitle">
				#4 <span class="bwh">Genre</span> with Maximum Number of Movies
			</div>
			<br /> <span id="thirdTable"
				style="font-size: 40px; background-color: black; color: white; border-radius: 20px"></span>
		</div>
		<div class="fourthDegree">
			<div id="qtitle">
				#5 <span class="bwh">Actors</span>Who also directed movies
			</div>
			<br /> <span id="fourthTable"></span>
		</div>
	</div>
	<div id="footer">
		<p>Copyright 2017. All rights reserved. Website Designed and Developed
			by SoHaN NiPuNaGe.</p>
		<br /> <a id="mailto"
			href="mailto:smn57958@uga.edu?Subject=CSCI-8380_AIS-SOHAN"
			target="_top">Contact SoHaN by Mail</a>
	</div>
</body>

</html>

