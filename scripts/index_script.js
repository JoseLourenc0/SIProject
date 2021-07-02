
var ligado=false;
	var troca=0;

	function Envia(){
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
			data: {estado: troca,time: time},
			dataType: 'json'
		}).done(function(resultado){
			console.log(resultado);
		})
		console.log('troca = '+troca);
	}

	function Pegadado(){
		$.ajax({
			url: 'pegadado.php',
			method:'GET',
			dataType: 'json'
		}).done(function(resultado){
			console.log(resultado);
			ligado=resultado[0].estado;
			console.log(ligado);
			if(ligado==false){
				document.getElementById('estado').innerHTML='DESLIGADO';
				document.getElementById('estado').style.background="#cf3a30";
				document.getElementById('estado').style.color="#edcecc";
				document.getElementById('estado').style.height="2.3em";
				document.getElementById('estado').style.padding="0.2em 0 0 0";
			}else{
				document.getElementById('estado').innerHTML='LIGADO';
				document.getElementById('estado').style.background="#0c6921";
				document.getElementById('estado').style.color="#3ec95e";
				document.getElementById('estado').style.height="2.3em";
				document.getElementById('estado').style.padding="0.4em 0 0 0";
			}
		})
	}
	Pegadado();
	setInterval(function(){Pegadado();},5000);