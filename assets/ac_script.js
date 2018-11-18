

var popups = document.getElementsByClassName("secret");
for (var i=0; i<popups.length; i++){
	popups[i].addEventListener("click",showSecret,false);
        console.log("popups werden gezählt");
}


function showSecret(e) {
	var dayClicked=e.target.getAttribute("data-daycount");
	console.log("Es wurde Tür nummer "+dayClicked+" geklickt.");
	
	var secret = document.getElementById("secret_"+dayClicked);
	console.log(secret);
	secret.classList.toggle("hidden");
}

function closePopup(e){
	console.log("Hallo Close!");
	console.log(e);
	e.path[2].classList.toggle("hidden");
	
}
