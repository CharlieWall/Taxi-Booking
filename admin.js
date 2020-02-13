var xhr = createRequest();
function getData(source, divName){
	if (xhr){
		var obj = document.getElementById(divName);
		var req = "value = request";
		xhr.open("POST", source, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200){
				obj.innerHTML = xhr.responseText;
			}
		}
		xhr.send(req);
	}
}//End function getData()

function getNumber(source, divName, reference){
	if(xhr){
		var obj = document.getElementById(divName);
		var req = "ref= " + encodeURIComponent(reference);
		xhr.open("POST", source, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				obj.innerHTML = xhr.responseText;
			}
		}
		xhr.send(req);
	}
}