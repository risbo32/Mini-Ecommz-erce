
<?php 

sleep(2);
$connexion=mysqli_connect('localhost','root','');
mysqli_select_db($connexion,'boutique');




if(isset($_POST['requete'])){
    $requete=$_POST['requete'];


     //   if(!isset($_FILES))
            // echo "Pas de fichier envoyé <br>";

        switch ($requete) {
            case 'login':
                
                $email=$_POST['email'];
                $pass=$_POST['password'];

                $req="select * from user where email='$email' and password='".sha1($pass)."'";
               // echo "$req <br>";
                $res=mysqli_query($connexion,$req);

                if(count($res)>0){
                    $don=mysqli_fetch_assoc($res);
                  //  print_r($res);
                    
                    session_start();
                    echo $don['username'];
                    $_SESSION['user']=$don['username'];
                    mysqli_close($connexion);
                   // echo json_encode($don);
                  //  echo "ok";
                    echo $don['username'];

                  //  header('location:../pages/movies.php');
                }

                else{
                    echo "none";
                }


                break;
            
            case 'inscription':
                # code...
            
            $email=$_POST['email'];
            $username=$_POST['username'];
            $pass=$_POST['password'];
            
            $req="insert  into user (email, username ,password  ) values ( '$email' ,'$username' , '".sha1($pass)."')";
          // echo "$req";
           
            $res=mysqli_query($connexion,$req) ;
          //echo(mysqli_error($connexion));
           // echo "<br>  $username a ete ajouté(e)";  
            session_start();
            $_SESSION['user']=$username;
            header('location:../pages/accueil.php');
                break;


             case 'importer':

             $titre=$_POST['titre'];
             $description=$_POST['description'];
             $titre=$_POST['titre'];
             $img=$_FILES['poster']['name'];
             $categorie=$_POST['categorie'];
            // $filemov=$_FILES['film']['name'];
			//print_r($_POST);

			$file=$_FILES["film"]["tmp_name"];
			$filename=$_FILES["film"]['name'];
			$ext='.'.pathinfo($filename,PATHINFO_EXTENSION);
			$newfilename=uniqid().$ext;
			//move_uploaded_file($file, '../videos/'.$newfilename);

          //   copy($_FILES['film']['tmp_name'], '../videos/'.$filemov);
             copy($_FILES['poster']['tmp_name'], '../img/'.$img);
             $requete="insert into movies (filemov , titre , img , description, categorie ) values ( '$newfilename', '$titre' ,'$img' ,'$description','$categorie' )";
             $connexion=mysqli_connect('localhost','root','');
            //  echo("<br>". $requete);
             mysqli_select_db($connexion,'boutique') or die("erreur sélection base");
             //echo "<br> $requete <br>";
             mysqli_query($connexion,$requete) ;
             // echo (mysqli_error($connexion));
            
            // header('location:../pages/movies.php');
            
            
             

                break;

            default:
                # code...
                break;
        }


}
else echo "Pas de valeur";

if(isset($_GET['deconnexion']))
{

  unset($_SESSION['user']);
    session_destroy();
    header('location:../index.html');

}

 ?>
