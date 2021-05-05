<?php
 function dbConnect()
 {
     $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
     return $db;
 }

 function saveMessage($id_conversation,$emetteur, $recepteur, $contenu_msg){

  $db = dbConnect();
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
  $db = dbConnect();
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

  $db = dbConnect();
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
  $db = dbConnect();
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
  $empty = getIdConversation($user1, $user2); 
  if(empty($empty))
     {
        addNewIdConversation($user1, $user2);
        echo 'no conversation found';
            }else{
       $id_conversation = getIdConversation($user1, $user2);
      $lastMessage =  getLast10MessageConversation($id_conversation);
     while ($donnes = $lastMessage->fetch()) {
      echo 'emetteur: '.$donnes['emetteur'].' ' ;
      echo 'recepteur: '.$donnes['recepteur'].' ' ;
     echo $donnes['contenu_msg'].' ' ;
       echo $donnes['date'].'</br>' ;
     }
     
     }
}
/*
fonction vérifié s'il y a une ancienne conversation entre 
deux user et inserer messagee tourne les dernier message si non 
ajouter une nouvelle id conversation entre les deux inserer 
nouvelle message et retourner des messages inserer
*/
function insertGetLast10MessageConversation($user1, $user2, $message)
{
 $id_conversation = getIdConversation($user1, $user2);
    if(empty($id_conversation))
     {
          addNewIdConversation($user1, $user2);
          $new_id_conversation = getIdConversation($user1, $user2);
          saveMessage($new_id_conversation,$user1, $user2, $message);
          $lastMessage =  getLast10MessageConversation($new_id_conversation);
          while ($donnes = $lastMessage->fetch()) 
          {
            echo 'emetteur: '.$donnes['emetteur'].' ' ;
            echo 'recepteur: '.$donnes['recepteur'].' ' ;
           echo $donnes['contenu_msg'].' ' ;
             echo $donnes['date'].'</br>' ;
          } 
    }else{
           //$id_conversation = $this->getIdConversation($user1, $user2);
           saveMessage($id_conversation, $user1, $user2, $message);
           $lastMessage = getLast10MessageConversation($id_conversation);
           while ($donnes = $lastMessage->fetch()) 
           {
            echo 'emetteur: '.$donnes['emetteur'].' ' ;
            echo 'recepteur: '.$donnes['recepteur'].' ' ;
           echo $donnes['contenu_msg'].' ' ;
             echo $donnes['date'].'</br>' ;
           }
        }
}


function getAllUsersConnect()
{
  $db = dbConnect();
  $req = $db->prepare('SELECT id_user, pseudo FROM users_connect ');
  $req->execute();
//return $req ;
   $tableUserConnect = array();
   while ($donnes = $req->fetch()){
       $table = array($donnes['id_user'],$donnes['pseudo']);
         array_push($tableUserConnect,$table);
       }
    return $tableUserConnect ;
}
 function getAllUsers(){
  $tableUserConnect = getAllUsersConnect();
  $db = dbConnect();
  $req = $db->prepare('SELECT id, pseudo FROM membres ');
  $req->execute();
   $tableUser = array();
   while ($donnes = $req->fetch())
     {
        $table = array($donnes['id'],$donnes['pseudo']);
          array_push($tableUser,$table);
      }
      /*
        //affiche all users
        echo '****************************************************************</br>';
        echo 'all users</br>';
        echo '****************************************************************</br>';

  $tailleAllUser = count($tableUser);
    for ($i=0; $i < $tailleAllUser ; $i++) 
      { 
          for ($j=0; $j < 2 ; $j++) 
               {  
                 echo $tableUser[$i][$j];
               }   
           echo '</br>';
       }
       //affiche user connect
       echo '****************************************************************</br>';
       echo 'all users connect</br>';
       echo '****************************************************************</br>';

       $tailleUserConnect = count($tableUserConnect);
    for ($i=0; $i < $tailleUserConnect ; $i++) 
      { 
          for ($j=0; $j < 2 ; $j++) 
               {  
                 echo $tableUserConnect[$i][$j];
               }   
           echo '</br>';
       }*/
  //return $tableUser ;
  // parcourir deux tableaux et 
  //mélangé user plus users connect et unajouté un champ
  //1 connecté ou 0 non connecté
  //$tableUserConnect
  //$tableUser
  //$tailleAllUser
  //$tailleUserConnect 
  $tailleUserConnect = count($tableUserConnect);
  $tailleAllUser = count($tableUser);
  $tableMelange = array();
  for($i=0; $i < $tailleAllUser ; $i++) 
   { 
     for($j=0; $j < $tailleUserConnect ; $j++) 
        { 
          if($tableUser[$i][1] == $tableUserConnect[$j][1]){
              $table = array($tableUser[$i][0],$tableUser[$i][1],1);
              $j = $tailleUserConnect;
          }else{
            $table = array($tableUser[$i][0],$tableUser[$i][1],0);
          }
          
        }
        array_push($tableMelange,$table);
   }
return $tableMelange ;
/*
              // affiche table melange
          echo '****************************************************************</br>';
          echo 'table melange</br>';
          echo '****************************************************************</br>';
$tailleTableMelange = count($tableMelange);
    for ($i=0; $i < $tailleTableMelange ; $i++) 
      { 
          for ($j=0; $j < 3 ; $j++) 
               {  
                 echo $tableMelange[$i][$j];
               }   
           echo '</br>';
       }
*/

  }

/**********************************************************************
***********------------------teste-------------------******************
**********************************************************************/
/*
  $user1="moh";
  $user2="ali";
  $message="c moi";
verifGetLast10MessageConversation($user1, $user2);
*/
//insertGetLast10MessageConversation($user1, $user2, $message);

getAllUsers();
