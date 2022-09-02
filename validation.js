var formInputs = document.getElementsByClassName('form-control');
var spanErrors = document.getElementsByClassName('error-statement');

function submitForm() {
	
	//var formInputs = document.getElementsByClassName('form-control');
	//var spanErrors = document.getElementsByClassName('error-statement');
	
	//console.log(formInputs[2].id);
	//return false;
	  
	for(var i = 0; i < formInputs.length; i++) {
		
	    if (formInputs[i].value === '')
	    {
		  spanErrors[i].style.display = 'block';
		  return false;
	    }
	  
		if (formInputs[i].id === 'confirmpassword') 
		{
			if (formInputs[i-1].value != formInputs[i].value) 
			{
				alert("Password and Confirm Password Field do not match  !!");
				document.signup.confirmpassword.focus();
				return false;
			}
		} 
	  
	}
	 return true;
}
	
function removeValidationError(inputId) {
	
		var errorStatement = document.getElementById(inputId);
		errorStatement.style.display = 'none';
	}
	
function emailCheck() {
	
	var emailInput = document.getElementById('emailid');
	
	const xhttp = new XMLHttpRequest();
	xhttp.open("GET", "checkmail.php?emailid=" + emailInput.value);
	xhttp.send();
	xhttp.onload= function() {
		var response = JSON.parse(this.response);
		if (response.status === false) {
			emailError.innerHTML = response.message;
			emailError.style.display = 'block';
			submitbutton.disabled = true;
			return false;
		}
		if (response.status === true) {
			emailError.style.display = 'none';
			submitbutton.disabled = false;
			return true;
		}
	}
}


	
	