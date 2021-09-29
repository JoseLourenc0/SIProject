const createNewUser = () => {
	let username = document.getElementById('username').value
	let name = document.getElementById('name').value
	let email = document.getElementById('email').value
	let password = document.getElementById('password').value
	let permission = document.getElementById('permission').value

	if(username && email && password && permission && name) {
		$.ajax({
			url:'scripts/php/createnewuser.php',
			data:
			{
				username,
				name,
				email,
				password,
				permission
			},
			method:'POST',
			dataType:'json'
		}).done(e => {
			console.log(e)
			if(e===1){
				document.getElementById('username').value = ''
				document.getElementById('name').value = ''
				document.getElementById('email').value = ''
				document.getElementById('password').value = ''
				modalConstruct('Success','New User successfully created','btn-success')
			}else{
				modalConstruct('ERROR','Something is wrong','btn-danger')
			}
		})
	}
}

const getUsers = () => {
	$.ajax({
		url:'scripts/php/getusers.php',
		method:'GET',
		dataType:'json'
	}).done( e => {
		console.log(e)
		if(e){

	        let listh = document.getElementById('listUsers')
	        listh.innerHTML = ''

	        e.forEach(element => {
	            let row = listh.insertRow()

	            row.insertCell(0).innerHTML = element.id
	            row.insertCell(1).innerHTML = element.user_name
				row.insertCell(2).innerHTML = element.user_email

	            let btn = document.createElement('button')
	            btn.className = 'btn btn-primary'
	            btn.innerHTML = '<i class="fa fa-search"></i>'
	            btn.id = `id_button_info_${element.id}`
	            btn.onclick = e=>{
	                e.preventDefault()
	                modalConstruct(
	                	'Details',
	                	`
						<p><b>ID:</b> ${element.id} </p>
	                	<p><b>Name:</b> ${element.name} </p>
						<p><b>Username:</b> ${element.user_name} </p>
	                	<p><b>E-mail:</b> ${element.user_email} </p>
	                	<p><b>Permission:</b> ${element.user_permission} </p>
	                	<p><b>Registered at:</b> ${element.creation_date} </p>
	                	`,
	                	'btn-secondary',
	                )
	            }
	            row.insertCell(3).append(btn)

	            let btn2 = document.createElement('button')
	            btn2.className = 'btn btn-danger'
	            btn2.innerHTML = '<i class="fa fa-times"></i>'
	            btn2.id = `id_button_delete_${element.id}`
	            btn2.onclick = e=>{
	                e.preventDefault()
	                console.log('test')
	            }
	            row.insertCell(4).append(btn2)

	        })
	    }else{
	        root.innerHTML += '<div class = "text-light" align = "center">NO USERS YET</div>'
	    }
	})
}

function modalConstruct(modaltitle='Gen',msg='Msg nao registrada',color='btn-primary'){
	let title = document.getElementById('ModalTitle')
	let body = document.getElementById('ModalBody')
	let btn = document.getElementById('ButtonModal')
	title.innerHTML = modaltitle
	body.innerHTML = msg
	btn.classList.remove('btn-success')
	btn.classList.remove('btn-primary')
	btn.classList.remove('btn-secondary')
	btn.classList.remove('btn-danger')
	btn.classList.add(color)
		$(document).ready( () => {
			$('#myModal').css('text-align','left')
			$('#myModal').css('font-size','16px')
			$('#myModal').modal('show')
		})
			
}

// ---------Responsive-navbar-active-animation-----------
function test(){
	var tabsNewAnim = $('#navbarSupportedContent');
	var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
	var activeItemNewAnim = tabsNewAnim.find('.active');
	var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
	var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
	var itemPosNewAnimTop = activeItemNewAnim.position();
	var itemPosNewAnimLeft = activeItemNewAnim.position();
	$(".hori-selector").css({
		"top":itemPosNewAnimTop.top + "px", 
		"left":itemPosNewAnimLeft.left + "px",
		"height": activeWidthNewAnimHeight + "px",
		"width": activeWidthNewAnimWidth + "px"
	});
	$("#navbarSupportedContent").on("click","li",function(e){
		$('#navbarSupportedContent ul li').removeClass("active");
		$(this).addClass('active');
		var activeWidthNewAnimHeight = $(this).innerHeight();
		var activeWidthNewAnimWidth = $(this).innerWidth();
		var itemPosNewAnimTop = $(this).position();
		var itemPosNewAnimLeft = $(this).position();
		$(".hori-selector").css({
			"top":itemPosNewAnimTop.top + "px", 
			"left":itemPosNewAnimLeft.left + "px",
			"height": activeWidthNewAnimHeight + "px",
			"width": activeWidthNewAnimWidth + "px"
		});
	});
}
$(document).ready(function(){
	setTimeout(function(){ test(); });
});
$(window).on('resize', function(){
	setTimeout(function(){ test(); }, 500);
});
$(".navbar-toggler").click(function(){
	$(".navbar-collapse").slideToggle(300);
	setTimeout(function(){ test(); });
});



// --------------add active class-on another-page move----------
jQuery(document).ready(function($){
	// Get current path and find target link
	var path = window.location.pathname.split("/").pop();

	// Account for home page with empty path
	if ( path == '' ) {
		path = 'index.php';
	}

	var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
	// Add active class to target link
	target.parent().addClass('active');
});

getUsers()