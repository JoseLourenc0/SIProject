	var ligado=false;
	var troca=0;

	function sendState(){
		let time = $('#selectTime').val()
		if(ligado==false){
			troca=1;
		}
		if(ligado==true){
			troca=0;
		}
		$.ajax({
			url: 'troca.php',
			method: 'POST',
			data: {state: troca,time: time},
			dataType: 'json'
		}).done(function(resultado){
			console.log(resultado);
		})
		console.log('troca = '+troca);
	}

	function getESPState(){
		$.ajax({
			url: 'getdata.php',
			method:'GET',
			dataType: 'json'
		}).done(function(resultado){
			if(resultado!=='State not found'){
				ligado=resultado[0].state;
				if(ligado==false){

					document.getElementById('state').innerHTML='Data logging disabled';
					document.getElementById('state').style.background="#cf3a30";
					document.getElementById('state').style.color="#edcecc";
					
				}else{

					document.getElementById('state').innerHTML='Data logging enabled';
					document.getElementById('state').style.background="#0c6921";
					document.getElementById('state').style.color="#3ec95e";

				}
				
			}else{
				document.getElementById('state').innerHTML='State not found or not registered yet!';
				document.getElementById('state').style.background="#cf3a30";
				document.getElementById('state').style.color="#edcecc";
			}
			document.getElementById('state').style.padding="0.6em 0 0 0";
			document.getElementById('state').style.height="2.3em";
		})
	}
	getESPState();
	setInterval(function(){getESPState();},5000);