<?php
namespace tests\ajaxEspacemembre\Model;
require_once('model/Manager.php');
class Message  extends Manager
{

   
     function ajouteMessage($pseudo, $message)
    {
          if ( empty($pseudo) OR empty($message)) {
            header('location: index.php');
            
          }else{
            $message = str_replace('|', '', $message);
            $this->saveData($pseudo,$message);
            header('location: index.php');
            //require('view/frontend/profilView.php');
          }
    }
        
        



      
      function saveData($pseudo,$message){ 
        
        echo $pseudo;
        echo $message;
$db = $this->dbConnect();
$req = $db->prepare('INSERT INTO minichat(pseudo, msg, date_creation)VALUES(:pseudo, :messagee, NOW())');
$req->execute(array(
              'pseudo' => $pseudo,
              'messagee' => $message
            ));
              $req->closeCursor();
    }

    function ajouteMessageAjax($pseudo, $message)
    {
      
        if ( empty($pseudo) OR empty($message)) {
           // do no thing
        }else{
          echo'ajouterMessageAjax model  else';
          $message = str_replace('|', '', $message);
          $this->saveData($pseudo,$message);
        }
          
    }

    function getLastMessage(){
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT * FROM minichat ORDER BY id DESC LIMIT 0,7');
      $req->execute();
      return $req ;
          }

 

 function getLastMessageAjax(){
    $result2= array(); 
    $db = $this->dbConnect();

      $req = $db->prepare('SELECT * FROM minichat ORDER BY id DESC LIMIT 0,7');
        $req->execute();


      while ($donnes = $req->fetch()) { 
       
        $results  = array($donnes['pseudo'],$donnes['msg']);
        array_push($result2,$donnes['pseudo']);
        array_push($result2,$donnes['msg']);
    
      }
      $result2 = array_reverse($result2);
      echo implode('|', $result2);
      $req->closeCursor();
    }
    
  }


     // print_r($result2);
     // echo implode('|', $result2);
       /*
      $taille = count($result2);
      //echo $taille;
      for ($i=0; $i <$taille ; $i++) { 
        for ($j=0; $j < 2 ; $j++) {  
          echo $result2[$i][$j];
          }   
          echo '|*|*|';
        }*/
      
