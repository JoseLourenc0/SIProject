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

	}).done(function(result){

		if(result!=='State not found'){
			isOn=result.state
			if(isOn==false){

				document.getElementById('state').innerHTML='Data logging disabled'
				document.getElementById('state').style.background="#cf3a30"
				document.getElementById('state').style.color="#edcecc"
					
			}else{

				document.getElementById('state').innerHTML=`Data logging enabled <br> Interval: ${result.timeesp} min`
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
		path = 'index.html';
	}

	var target = $('#navbarSupportedContent ul li a[href="'+path+'"]');
	// Add active class to target link
	target.parent().addClass('active');
});

getESPState()
setInterval(
	function(){
		getESPState()
	},5000)