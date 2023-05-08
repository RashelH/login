function validarRecaptcha() {
	var response = grecaptcha.getResponse();
	if(response.length == 0) {
	  // No se ha completado el reCAPTCHA
	  alert("Por favor complete el reCAPTCHA.");
	  return false;
	} else {
	  // El reCAPTCHA se ha completado correctamente
	  return true;
	}
  }
  
  with(document.registro){
	onsubmit = function(e){
	  e.preventDefault();
	  ok = true;
  
	  // Validación de campos
	  if(ok && username.value==""){
		ok=false;
		alert("Debe escribir un nombre de usuario");
		username.focus();
	  }
	  if(ok && fullname.value==""){
		ok=false;
		alert("Debe escribir su nombre");
		fullname.focus();
	  }
	  if(ok && email.value==""){
		ok=false;
		alert("Debe escribir su email");
		email.focus();
	  }
	  if(ok && password.value==""){
		ok=false;
		alert("Debe escribir su password");
		password.focus();
	  }
	  if(ok && confirm_password.value==""){
		ok=false;
		alert("Debe reconfirmar su password");
		confirm_password.focus();
	  }
  
	  if(ok && password.value!= confirm_password.value){
		ok=false;
		alert("Los passwords no coinciden");
		confirm_password.focus();
	  }
  
	  // Validación de reCAPTCHA
	  if(ok && !validarRecaptcha()){
		ok=false;
	  }
  
	  if(ok){ submit(); }
	}
  }
  