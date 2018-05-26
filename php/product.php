<?php

//$_POST['requete']="liste";
//$_POST['requete']="supp";
if(isset($_POST['requete'])){
$lien=mysqli_connect("localhost","root","");
mysqli_select_db($lien, "product_db");
sleep(1);
	switch ($_POST['requete']) {
		case 'liste':

		$requete= "select *  from produit";

		$reslts=mysqli_query($lien,$requete);

		$json='[';
		$tab=array();
		while ($res=mysqli_fetch_assoc($reslts)) {
			# code...

		array_push($tab, json_encode($res));
		}
		
		$json.=implode(',', $tab);

		$json.=']';
		echo($json);
		//echo('test');
		break;

		case  'ajout':
			# code...
		if($_FILES['image']['error']==0){
		$designation=$_POST['designation'];
		$image=$_FILES['image']['name'];
		$prix=$_POST['prix'];
		//print_r($_POST);
		echo("<br>");
		//print_r($_FILES);
		$requete= "insert into produit ( designation, prix, image )  values ( '$designation' , '$prix',  '$image' )";
  		echo($requete);
		$reslts=mysqli_query($lien,$requete);

		echo(mysqli_error($lien));
		if (!mysqli_error($lien)) {
			# code...
			 copy($_FILES['image']['tmp_name'], '../img/'.$image);
		}
		
			}
		
			break;

			case 'supp':
			{
   				$id=$_POST['id'];
				$requete ="delete from produit where id =$id";
				//echo($requete);
				mysqli_query($lien,$requete);
				echo(mysqli_error($lien));
				//echo("Cest fait");

			}
			break;
			default: 
			break;
}
}



?>