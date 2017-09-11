/*<!--#-------------------------------------------------------------------------------
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
-->*/
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function checkCookie() {
	var username = getCookie("username");
	var con = document.getElementsByClassName("connection");
	var cons = con[0].innerHTML;
	var constr = "Connection Failed";
	if (cons != constr) {
		alert("Welcome again " + username);
	} else {
		username = prompt("UserName", "root");
		var password = prompt("password", "test123");
		var dbname = prompt("dbname", "imdb");
		setCookie("username", username, 1);
		setCookie("password", password, 1);
		setCookie("dbname", dbname, 1);
		window.location.reload();
	}
}
function suggest() {
	var str = document.getElementById("squery").value;
	var d = document.getElementById("degrees");
	if (str == 'null') {
		document.getElementbyId("suggestion").innerHTML = "";
		d.style.display = 'none';
	}
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("suggestion").innerHTML = this.responseText;
			d.style.display = 'block';
			deg.style.display = 'block';

		}
	}
	xmlhttp.open("GET", "php/search_actor.php?q=" + str, true);
	xmlhttp.send();
}
function first_degree() {
	var sel = document.getElementById("actorsOpt");
	var index = sel.options[sel.selectedIndex].value;
	var name=sel.options[sel.selectedIndex].text;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("firstTable").innerHTML = this.responseText;
			// ft.style.display='block';
		}
	}
	xmlhttp.open("GET", "php/first_degree.php?id=" + index+"&name="+name, true);
	xmlhttp.send();
	second_degree();
	third_degree();
	fourth_degree();
}
function second_degree() {
	var sel = document.getElementById("actorsOpt");
	var index = sel.options[sel.selectedIndex].value;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("secondTable").innerHTML = this.responseText;
			// ft.style.display='block';
		}
	}
	xmlhttp.open("GET", "php/second_degree.php?id=" + index, true);
	xmlhttp.send();
}
function third_degree() {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("thirdTable").innerHTML = this.responseText;
			// ft.style.display='block';
		}
	}
	xmlhttp.open("GET", "php/third_q.php", true);
	xmlhttp.send();
}
function fourth_degree() {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("fourthTable").innerHTML = this.responseText;
			// ft.style.display='block';
		}
	}
	xmlhttp.open("GET", "php/fourth_q.php", true);
	xmlhttp.send();
}
function genre_suggest() {

	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("genreSuggestion").innerHTML = this.responseText;

		}
	}
	xmlhttp.open("GET", "php/2genre.php?q=1", true);
	xmlhttp.send();

}
function genrize() {

	var sel = document.getElementById("genreList");
	var index = sel.options[sel.selectedIndex].value;
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			
			document.getElementById("absTable").innerHTML = this.responseText;
			// ft.style.display='block';
		}
	}
	xmlhttp.open("GET", "php/2genre.php?q=" + index, true);
	xmlhttp.send();
}