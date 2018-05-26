$(function (){

	//alert('test');

	updater();

	

	  
});

 function suppr(idobjet){

	   	 $.ajax({
            url:'php/product.php',
            type:'post',
            data:{requete:'supp',id:idobjet},
            beforeSend:function(){
                alert('suppressrion en cours');
               
            },
            success:function(data){
                
            	//alert("résultat suppression "+data);
                
            } ,
            error:function(xhr, status, errorMessage){
               // $('#msg').html('<span class="text-danger">'+ errorMessage + '</span>');
            },
            complete:function(){
                updater();
            }
        });
	   }


	   function  updater(){
	   $.ajax({
            url:'php/product.php',
            type:'post',
            data:{requete:'liste'},
            
            beforeSend:function(){
            	$('#catalogue').html('');
               
               
            },
            success:function(data){
                
               var obj = null;
              // alert(data);
              
                if (data!=null){
                    
                    obj=JSON.parse(data);
                    
                    for (var i = 0; i < obj.length; i++) {
                    	$('#catalogue').append(populer(obj[i]));
                    }
                }

                
            } ,
            error:function(xhr, status, errorMessage){
                $('#msg').html('<span class="text-danger">'+ errorMessage + '</span>');
            },
            complete:function(){
                $('#loading').hide();
            }
        });

}

  function populer (data){

	   	var contenu= '<div class="col-xs-6 col-md-3">'+
      '<img src="img/'+data.image+'" alt="..." height="150" width"150 class="img-thumbnail">'+
      '<div class="caption">'+
     '   <h3><p>'+data.designation+'</p></h3>'+
     'prix: ' +data.prix+'F cfa'+
     '<form  method="post">'+
     '<input type="text" value= '+data.id+' name="id"  hidden="true">'+
     '</form>'+
       ' <p><button href="#" class="btn btn-primary"   onclick="suppr('+data.id+')">Supprimer</button> <button href="#" class="btn btn-default" role="button">Button</button></p>'+
      '</div>';

      return contenu;
	   }