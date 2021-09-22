var isOn=false
var state=0

function sendState(){

	let time = $('#selectTime').val()

	if(isOn==false){
		state=1;
	}
	if(isOn==true){
		state=0;
	}

	$.ajax({

		url: 'scripts/php/changestatus.php',
		method: 'POST',
		data: {
			state,
			time
		},
		dataType: 'json'

	}).done(e=>{

		e === 1 ? '' : console.log(e)

	})
}

function getESPState(){
	$.ajax({

		url: 'scripts/php/getdata.php',
		method:'GET',
		dataType: 'json'

	}).done(function(resultado){

		if(resultado!=='State not found'){
			isOn=resultado[0].state;
			if(isOn==false){

				document.getElementById('state').innerHTML='Data logging disabled'
				document.getElementById('state').style.background="#cf3a30"
				document.getElementById('state').style.color="#edcecc"
					
			}else{

				document.getElementById('state').innerHTML='Data logging enabled'
				document.getElementById('state').style.background="#0c6921"
				document.getElementById('state').style.color="#3ec95e"

			}
				
		}else{

			document.getElementById('state').innerHTML='State not found or not registered yet!'
			document.getElementById('state').style.background="#cf3a30"
			document.getElementById('state').style.color="#edcecc"

		}

		document.getElementById('state').style.padding="0.6em 0 0 0"
		document.getElementById('state').style.height="2.3em"

	})
}

getESPState();
setInterval(
	function(){
		getESPState()
	},5000)