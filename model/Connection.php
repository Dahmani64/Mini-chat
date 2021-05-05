<?php
namespace tests\ajaxEspacemembre\Model;
require_once("model/Manager.php");
class Connection  extends Manager
{

   
 public  function connection($pseudo){

      $db = $this->dbConnect();
$req = $db->prepare('SELECT id, pass, photo FROM membres WHERE pseudo = :pseudo');
 $req->execute(array(
   'pseudo' => $pseudo));
$resultat = $req->fetch();
return $resultat ;
   }

 public  function getAllUsersConnect(){
      $db = $this->dbConnect();
$req = $db->prepare('SELECT id_user, pseudo FROM users_connect ');
$req->execute();
return $req ;

   }
   
   function getAllUsers(){
      $reqTableUserConnect = $this->getAllUsersConnect();
      $tableUserConnect = array();

   while ($donnes = $reqTableUserConnect->fetch())
        {
          $table = array($donnes['id_user'],$donnes['pseudo']);
         array_push($tableUserConnect,$table);
        }
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT id, pseudo, photo FROM membres ');
      $req->execute();
       $tableUser = array();

       while ($donnes = $req->fetch())
         {
            $table = array($donnes['id'],$donnes['pseudo'],$donnes['photo']);
              array_push($tableUser,$table);
          }  
      //return $tableUser ;
      // parcourir deux tableaux et //mélangé user plus users connect et unajouté un champ
      //1 connecté ou 0 non connecté//$tableUserConnect//$tableUser
      $tailleUserConnect = count($tableUserConnect);
      $tailleAllUser = count($tableUser);
      $tableMelange = array();
      for($i=0; $i < $tailleAllUser ; $i++) 
       { 
         for($j=0; $j < $tailleUserConnect ; $j++) 
            { 
              if($tableUser[$i][1] == $tableUserConnect[$j][1]){
                  $table = array($tableUser[$i][0],$tableUser[$i][1],1,$tableUser[$i][2]);
                  $j = $tailleUserConnect;
              }else{
                $table = array($tableUser[$i][0],$tableUser[$i][1],0,$tableUser[$i][2]);
              }
              
            }
            array_push($tableMelange,$table);
       }
    return $tableMelange ;
   }

 public  function addUserConnect($id_user, $pseudo){
  //code...
      $db = $this->dbConnect();
      $req = $db->prepare('INSERT INTO users_connect(id_user, pseudo) VALUES(:id_user, :pseudo)');
       $req->execute(array( 'id_user' => $id_user,':pseudo' => $pseudo));
       $req->closeCursor();
     
   }

 public  function deleteUserConnect($id_user){
      $db = $this->dbConnect();
      $req = $db->prepare('DELETE FROM  users_connect WHERE id_user = :id_user');
      $req->execute(array('id_user'=>$id_user));
      $req->closeCursor();
   }


   
}