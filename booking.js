var xhr = createRequest();
function createBooking(source,divName,custName,custNum,unNum,stNum,stName,surb,dest,puDate,puTime){
//function createBooking(source, divName, custName, custNum, unNum, stNum, stName, surb, dest, puDate, puTime){
	if(xhr){
		var obj = document.getElementById(divName);
		var req = "customerName=" + encodeURIComponent(custName) + "&customerNumber=" + encodeURIComponent(custNum) + "&unitNumber=" + encodeURIComponent(unNum) + "&streetNumber=" + encodeURIComponent(stNum) + "&streetName=" + encodeURIComponent(stName) + "&suburb=" + encodeURIComponent(surb) + "&destination=" + encodeURIComponent(dest) + "&pickupDate= "+encodeURIComponent(puDate) + "&pickupTime=" + encodeURIComponent(puTime);
		xhr.open("POST", source, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function(){
			//Shows state of computation
			if (xhr.readyState == 4 && xhr.status == 200){
				obj.innerHTML = xhr.responseText;
			}
		}
		xhr.send(req);
	}
}