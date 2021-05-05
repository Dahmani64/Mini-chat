<?php
namespace tests\ajaxEspacemembre\Model;
require_once("model/Manager.php");
class Changerpassword  extends Manager
{
// fonction global pour changer mot de passe
function changerPassPseudo($pseudo, $pass, $nvpseudo, $nvpass){
    
    $pseudo = strip_tags($pseudo);
    $nvpseudo = strip_tags($nvpseudo);
    $pass = md5(strip_tags($pass));
    $nvpass = md5(strip_tags($nvpass));
    $id = $this->verifPassPseudoExist($pseudo,$pass);

    if(empty($pseudo) || empty($nvpseudo) || empty($pass) || empty($nvpass) ){
        header('location: index.php');
    }elseif (empty($id))
    {
        header('location: index.php');
    }else
    {
        $this->insertNvPassPseudo($nvpseudo,$nvpass,$id);
        
    }

}
//vérifier si le pseudo et le mot de passe correct 
function verifPassPseudoExist($pseudo,$pass){
    $db = $this->dbConnect();
$req = $db->prepare('SELECT id  FROM membres WHERE pseudo = :pseudo and pass = :pass' );
$req->execute(array(
'pseudo' => $pseudo,
'pass' => $pass,
));
$resultat = $req->fetch();
$req->closeCursor();
$id = $resultat['id'];
return $id;
}
//insert nouveau pseudo et nouveau mot de passe
function insertNvPassPseudo($nvpseudo,$nvpass,$id){


    $db = $this->dbConnect();
$req = $db->prepare('UPDATE membres SET pseudo = :nvpseudo, pass = :nvpass WHERE id = :id');
$req->execute(array(
	'nvpseudo' => $nvpseudo,
	'nvpass' => $nvpass,
	'id' => $id
	));
    $req->closeCursor();


    header('location: index.php');
}

   
}