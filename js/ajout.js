
alert('test1');/*
$(function(){

 alert('test');

	$('#monform').submit(function (event){
			event.preventDefault();
			var formdata =new FormData(this);
			$.ajax(

	{
		url:$('#monform').attr('action'),
		type:'POST',
		processData:false,
		contentType:false,
		cache:false,
		data:formdata,
		success:function(data){
				$('#loading').html(data);
				
			
		},
		error:function(xhr, status , errorMessage){
				$('#loading').html('Erreur '+status+': '+errorMessage);
		},
		beforeSend:function(xhr){
			
			
			$('#loading').html('chargement...');
		},
		complete:function(xhr){

		$('#loading').html('Formulaire traite');
			
		     setTimeout(function (){

		     	$('#loading').html('Affichage liste des produits ...');
		     	 document.location.href='index.html';
		     },2000); 
		}

	}
		);

	});
});*/