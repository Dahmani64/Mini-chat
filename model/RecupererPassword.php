<?php
namespace tests\ajaxEspacemembre\Model;
require_once("model/Manager.php");
class RecupererPassword  extends Manager
{


   function recupererPassword($email)
   {
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT id, pseudo, pass, email FROM membres WHERE email = :email');
        $req->execute(array('email' => $email));
       $res = $req->fetch();
       //echo $valid.'</br>';

      if(empty($res)){
          echo"email invalide";
          echo "<a href='index.php'> Acceuil</a>";
      }else{
           
         $x='0123456789abcdefghijklmnopqrstuvwxyz';
         $l=10;
         $pasw=substr(str_shuffle(str_repeat($x, ceil($l/strlen($x)))),1,$l) ;
        // echo $pasw.'</br>';
         $nvpass = md5($pasw);

         $req2 = $db->prepare('UPDATE membres SET pass = :nvpass WHERE email = :email');
         $req2->execute(array(
            'email' => $email,
            'nvpass' => $nvpass
            ));


        // echo rand() . "\n";
         //echo"hello";
         //print_r($res);
        // $email= strip_tags($_POST['mailForget']);
         $msg = " votre nouveau mot de passe :".$pasw." https://calipsu.000webhostapp.com/minichat/";
         $mySubject ="recuperer mot de passe";
         mail($email,$mySubject,$msg,"calipsu@chat.com" );
        //echo $email.'</br>';
         echo"un nouveau mot de pase deja envoyer . verifier votre boite de messagerie";
       echo"<script>
         setTimeout(
            function() {
                   window.location.href ='index.php';
              }, 5000);
      </script>";
      
      }
   }
   
}

