<?php
namespace tests\ajaxEspacemembre\Model;
require_once('model/Manager.php');
class Conversation  extends Manager
{
// enregistrer message dans la base de donneé le contenu +
// id conversation entre qui et qui et la date plus l'émetteur du message

   function saveMessage($id_conversation,$emetteur, $recepteur, $contenu_msg){

      $db = $this->dbConnect();
      $req = $db->prepare('INSERT INTO contenu_conversation(id_conversation, emetteur, recepteur, contenu_msg, date)VALUES(:id_conversation, :emetteur, :recepteur, :contenu_msg, Now())');
      $req->execute(array(
        'id_conversation' => $id_conversation,
          'emetteur' => $emetteur,
          'recepteur' => $recepteur,
           'contenu_msg' => $contenu_msg
          ));
          $req->closeCursor();
   }
   
    // retourne l'id de conversation s'il existe
   function getIdConversation($user1, $user2){
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT id_conversation FROM conversation WHERE user1= :user1 and user2= :user2 OR user1= :user2 and user2= :user1 ');
      $req->execute(array(
            'user1' => $user1,
              'user2' => $user2
              )
      );
      $donnes = $req->fetch();
      return $donnes['id_conversation'];
      $req->closeCursor();
   }
// Ajouter une nouvelle conversation entre deux utilisateur nouveau id conversation
function addNewIdConversation($user1, $user2){

   $db = $this->dbConnect();
   $req = $db->prepare('INSERT INTO conversation(user1, user2)VALUES(:user1, :user2)');
   $req->execute(array(
     'user1' => $user1,
       'user2' => $user2
      ));
     // return $req;
       $req->closeCursor();
}
//retourne les dix drnier message entre deux personne
function getLast10MessageConversation($id_conversation){
   $db = $this->dbConnect();
   $req = $db->prepare('SELECT emetteur, recepteur, contenu_msg, date FROM contenu_conversation WHERE id_conversation= :id_conversation  ORDER BY date DESC LIMIT 0,10');
   $req->execute(array(
         'id_conversation' =>$id_conversation
           )
   );
   return $req ;
   $req->closeCursor();
}

/*fonction vérifié s'il y a une ancienne conversation entre 
deux user et retourne les dernier message si non ajouter une
nouvelle id conversation entre les deux et retourner des messages vide
*/
function verifGetLast10MessageConversation($user1, $user2){
   $result2= array();
   $empty = $this->getIdConversation($user1, $user2); 
   if(empty($empty))
      {
         $this->addNewIdConversation($user1, $user2);
         echo 'no conversation found';
             }else{
        $id_conversation = $this->getIdConversation($user1, $user2);
       $lastMessage = $this-> getLast10MessageConversation($id_conversation);
      while ($donnes = $lastMessage->fetch()) {
        /* echo $donnes['emetteur'].' ' ;
         echo $donnes['recepteur'].' ' ;
         echo $donnes['contenu_msg'].' ' ;
         echo $donnes['date'] ;*/
        // $results  = array($donnes['emetteur'],$donnes['contenu_msg'],$donnes['date']);
         array_push($result2,$donnes['emetteur']);
         array_push($result2,$donnes['contenu_msg']);
         array_push($result2,$donnes['date']);
      }
      $result2 = array_reverse($result2);
      echo implode('|', $result2);
      }
}

/*
fonction vérifié s'il y a une ancienne conversation entre 
deux user et inserer messagere tourne les dernier message si non 
ajouter une nouvelle id conversation entre les deux inserer 
nouvelle message deret retourner des messages vide
*/
function insertGetLast10MessageConversation($user1, $user2, $message)
  {
   $result2= array();
   $id_conversation = $this->getIdConversation($user1, $user2);
      if(empty($id_conversation))
       {
            $this->addNewIdConversation($user1, $user2);
            $new_id_conversation = getIdConversation($user1, $user2);
            $message = str_replace('|', '', $message);
            $this->saveMessage($new_id_conversation,$user1, $user2, $message);
            $lastMessage = $this-> getLast10MessageConversation($new_id_conversation);
            while ($donnes = $lastMessage->fetch()) 
            {
               /*
                echo 'emetteur: '.$donnes['emetteur'].' ' ;
                echo 'recepteur: '.$donnes['recepteur'].' ' ;
               echo $donnes['contenu_msg'].' ' ;
                 echo $donnes['date'] ;
                 */
                array_push($result2,$donnes['emetteur']);
                array_push($result2,$donnes['contenu_msg']);
                array_push($result2,$donnes['date']);
             }
             echo implode('|', $result2); 
      }else{
             //$id_conversation = $this->getIdConversation($user1, $user2);
             $message = str_replace('|', '', $message);
              if(!empty($user1) and !empty($message) and !empty($message) ){

               $this->saveMessage($id_conversation, $user1, $user2, $message);
              }
             

             $lastMessage = $this-> getLast10MessageConversation($id_conversation);
             while ($donnes = $lastMessage->fetch()) 
             {
                /* echo 'emetteur: '.$donnes['emetteur'].' ' ;
                 echo 'recepteur: '.$donnes['recepteur'].' ' ;
                echo $donnes['contenu_msg'].' ' ;
                  echo $donnes['date'] ;*/
                  array_push($result2,$donnes['emetteur']);
                  array_push($result2,$donnes['contenu_msg']);
                  array_push($result2,$donnes['date']);
               }
               $result2 = array_reverse($result2);
               echo implode('|', $result2);
          }
  }






   
}