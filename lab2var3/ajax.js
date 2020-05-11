// Инициализация ajax

var ajax; // глобальная переменная для хранения обработчика запросов
InitAjax();
function InitAjax() {
	try { /* пробуем создать компонент XMLHTTP для IE старых версий */
	ajax = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (e) {
		try {//XMLHTTP для IE версий >6
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {// XMLHTTP для Mozilla и остальных
				ajax = new XMLHttpRequest();
			} catch(e) { ajax = 0; }
		}
	}
}


// Первая форма - Формат HTML

function get1() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var sVal = document.getElementById("select1").value;
	ajax.onreadystatechange = UpdateForm1;
	var params = 'nurse=' + encodeURIComponent(sVal);
	ajax.open("GET", "result-forms/nurse.php?"+params);
	ajax.send(null);
}
function UpdateForm1() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var result = document.getElementById('result1');
			result.innerHTML = ajax.responseText;

		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}


// Вторая форма - Формат XML

function get2() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var sVal = document.getElementById("select2").value;
	ajax.onreadystatechange = UpdateForm2;
	var params = 'nursechoose=' + encodeURIComponent(sVal);
	ajax.open("GET", "result-forms/choose.php?"+params);
	ajax.send(null);
}
function UpdateForm2() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var res 	= document.getElementById('result2');
			var result 	= "";

			var rows = ajax.responseXML.firstChild.children;
			for (var i = 0; i < rows.length; i++) {
				result += "<li>" + rows[i].children[0].firstChild.nodeValue + "</li>";
			}
			res.innerHTML = result;
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}


// Третья форма - Формат JSON

function get3() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var sVal = document.getElementById("select3").value;
	ajax.onreadystatechange = UpdateForm3;
	var params = 'shift_choose=' + encodeURIComponent(sVal);
	ajax.open("GET", "result-forms/shifts.php?"+params);
	ajax.send(null);
}
function UpdateForm3() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var res 	= document.getElementById('result3');
			var result 	= "";

			var rows = JSON.parse(ajax.responseText);
			for (var i = 0; i < rows.length; i++) {
				result += '<li>';
				result += rows[i].name + ' — ' + rows[i].date + ' — ' + rows[i].department;
				result += '</li>';
			}
			res.innerHTML = result;
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}


// Четвертая форма - Формат HTML

function get4() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var nurse_id = document.getElementsByName("nurse_id")[0].value;
	var nurse_name = document.getElementsByName("nurse_name")[0].value;
	var nurse_date = document.getElementsByName("nurse_date")[0].value;
	var nurse_depart = document.getElementsByName("nurse_depart")[0].value;
	var nurse_shift = document.getElementsByName("nurse_shift")[0].value;

	ajax.onreadystatechange = UpdateForm4;
	var params = 'nurse_id=' + encodeURIComponent(nurse_id) + '&nurse_name=' + encodeURIComponent(nurse_name) 
	+ '&nurse_date=' + encodeURIComponent(nurse_date) + '&nurse_depart=' + encodeURIComponent(nurse_depart) + '&nurse_shift='
	+ encodeURIComponent(nurse_shift);

	ajax.open("GET", "insert-forms/insert-nurse.php?"+params);
	ajax.send(null);
}
function UpdateForm4() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var res 	= document.getElementById('result4');
			
			res.innerHTML = '<li>' + ajax.responseText + '</li>';
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}

// Пятая форма - Формат XML

function get5() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var ward_id = document.getElementsByName("ward_id")[0].value;
	var ward_name = document.getElementsByName("ward_name")[0].value;

	ajax.onreadystatechange = UpdateForm5;
	var params = 'ward_id=' + encodeURIComponent(ward_id) + '&ward_name=' + encodeURIComponent(ward_name);

	ajax.open("GET", "insert-forms/insert-ward.php?"+params);
	ajax.send(null);
}
function UpdateForm5() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var res 	= document.getElementById('result5');
			var result 	= ajax.responseXML.firstChild.children;
			
			res.innerHTML = '<li>' + result[0].firstChild.nodeValue + '</li>';
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}


// Шестая форма - Формат JSON

function get6() {
	if (!ajax) {
		alert("Ajax не инициализирован");
		return;
	}
	var ward_id = document.getElementsByName("connection_nurse_name")[0].value;
	var ward_name = document.getElementsByName("connection_ward_name")[0].value;

	ajax.onreadystatechange = UpdateForm6;
	var params = 'nurse_name=' + encodeURIComponent(ward_id) + '&ward_name=' + encodeURIComponent(ward_name);

	ajax.open("GET", "insert-forms/insert-connection.php?"+params);
	ajax.send(null);
}
function UpdateForm6() {
	if (ajax.readyState == 4) {
		if (ajax.status == 200) {
			// если ошибок нет
			var res 	= document.getElementById('result6');
			
			
			res.innerHTML = '<li>' + JSON.parse(ajax.responseText) + '</li>';
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}

}