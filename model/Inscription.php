<?php
namespace tests\ajaxEspacemembre\Model;
require_once("model/Manager.php");
class Inscription  extends Manager
{
  function verifInscription($pseudo, $pass, $retap_pass, $email ){
try {
  $all="";
     $a="";$b="";$c="";$d="";
       $valeur = 0;
       
       
       if(empty($pseudo) || empty($pass) || empty($retap_pass) || empty($email) ){
        $d='<div class="alert">ne laissez pas un champ vide</div>';
        $valeur++;
    }

     if($this->pseudoExist($pseudo)){  
       $a= '<div class="alert">vérifier votre pseudo</div>';
       $valeur++;
     } 
     if(!$this->verifemailValide($email)){
       $b='<div class="alert">vérifier votre email</div>';   
       $valeur++;
      }
     if(!$this->verifMotDEPasseIdentique($pass,$retap_pass)){
         $c='<div class="alert">les deux mot de passe soient identique</div>';
         $valeur++;
        }
          if($valeur == 0){
            $this->insertData($pseudo, $pass, $email); 
            
            require('view/frontend/connexionView.php');
           }else{
           
            echo  '<div style="background-color: crimson;color: #f2f2f2;border: 1px solid black;width:50%;margin-left:25%;
            " id="divalert">'.$a.''.$b.''.$c.''.$d.'</div>';

            require('view/frontend/inscriptionView.php');
              
               }

  } catch (\Throwable $th) {
                           throw $th;
                    }
}

   function insertData($pseudo, $pass, $email){
      $pass = md5($pass);
      $db = $this->dbConnect();
      $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, photo, date_inscription) VALUES(:pseudo, :pass, :email, :photo, CURDATE())');
      $resultat = $req->execute(array(
          'pseudo' => $pseudo,
          'pass' => $pass,
          'email' => $email,
          'photo' => 'default.png'
          ));
$req->closeCursor();
  
  }
  function pseudoExist($pseudo){
   $db = $this->dbConnect();
   $req = $db->prepare('SELECT pseudo  FROM membres where pseudo = :pseudo');
   $req->execute(array('pseudo' => $pseudo));
   $donnees = $req->fetch();
       //$req->closeCursor();
       //return $donnees ;  
       if (!empty($donnees)){
         return true ;
       } else {
          return false ;
       }
       $req->closeCursor();
 }
 function verifMotDEPasseIdentique($mp1,$mp2){
   if(($mp1 != $mp2))
   {
   return false ;
   }else{
     return true ;
   }
 }
 
 function verifemailValide($email){
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
      {
      return false;
      }else{
        return true;
      }
 }

}

