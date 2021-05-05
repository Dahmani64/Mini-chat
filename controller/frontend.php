<?php
 
//use tests\Blog\espacemembre\PostManager;
use tests\AjaxEspacemembre\Model\Connection;
use tests\AjaxEspacemembre\Model\Inscription;
use tests\AjaxEspacemembre\Model\Changerpassword;
use tests\AjaxEspacemembre\Model\Message;
use tests\AjaxEspacemembre\Model\Conversation;
use tests\AjaxEspacemembre\Model\RecupererPassword;

// Chargement des classes
require_once('model/Connection.php');
require_once('model/Inscription.php');
require_once('model/Changerpassword.php');
require_once('model/Message.php');
require_once('model/Conversation.php');
require_once('model/RecupererPassword.php');





function verifConnection($pseudoo,$passs)
{
    $pseudo = $pseudoo;
    $pass = md5($passs);
    $postManager = new  Connection(); // Création objet connection
    $message = new  Message(); // Création objet Message
    $resultat = $postManager->connection($pseudo); // Appel d'une fonction de cet objet
    $isPasswordCorrect = false;
   
    if ($pass == $resultat['pass'] )
    {
        $isPasswordCorrect = true;
    }
    
    if (!$resultat)
    {
        echo '<div style="background-color: crimson;color: #f2f2f2;border: 1px solid black;width:50%;margin-left:25%;
        " id="divalert"><div class="alert">vérifier vos identifiant</div></div>';    
        $_SESSION = array();
        session_destroy();
        require('view/frontend/connexionView.php');
    }
    else
    {
        if ($isPasswordCorrect) {
           // session_id(); 
            
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['photo'] = $resultat['photo'];
            $_SESSION['pseudo'] = $pseudo;
            $postManager->addUserConnect($resultat['id'],$pseudo);
            $listUserConnect = $postManager->getAllUsersConnect();
            $listLastMessage = $message->getLastMessage();
            //require('view/frontend/profilView.php');
            header('location: index.php');
        }
        else {
            echo '<div style="background-color: crimson;color: #f2f2f2;border: 1px solid black;width:50%;margin-left:25%;
        " id="divalert"><div class="alert">vérifier vos identifiant</div></div>';    
            require('view/frontend/connexionView.php');

        }
    }
}
function verifInscription($pseudo, $pass, $retap_pass, $email)
{
    $inscription = new  Inscription(); // Création d'un objet
    $inscription->verifInscription($pseudo, $pass, $retap_pass, $email);
}
function ajouterMessage($pseudo, $message)
{
    $inscription = new  Message(); // Création d'un objet
    $inscription->ajouteMessage($pseudo, $message);
}
function changerPassPseudo($pseudo, $pass, $nvpseudo, $nvpass)
{
    $inscription = new  Changerpassword(); // Création d'un objet

    $inscription->changerPassPseudo($pseudo, $pass, $nvpseudo, $nvpass);

}
function deleteSessionActive($id)
{
    $connection = new  Connection(); // Création d'un objet
    $connection->deleteUserConnect($id);
}


function getSessionActive()
{
    $connection = new  Connection(); // Création d'un objet
    $req = $connection->getAllUsersConnect();
    return $req;
}
function getAllUsers()
{
    $connection = new  Connection(); // Création d'un objet
    $req = $connection->getAllUsers();
    return $req;
}
function getLastMessage()
{
    $Message = new  Message(); // Création d'un objet
    $req = $Message->getLastMessage();
    return $req;
}
/*
if(isset($_POST['all'])){
  $Message = new  Message(); // Création d'un objet
    $Message->getLastMessageAjax();
}*/

 
function getLastMessageAjax(){
    $message = new  Message(); // Création d'un objet
   $message->getLastMessageAjax();
}

function ajouterMessageAjax($pseudo, $message)
{
   $messagee = new  Message(); // Création d'un objet
   $messagee->ajouteMessageAjax($pseudo, $message);
   $messagee->getLastMessageAjax();
}

function getLastMessageConversation($user1, $user2)
{
   $conversation = new  Conversation(); // Création d'un objet
   $conversation->verifGetLast10MessageConversation($user1, $user2);
}
function insertAndGetLastMessageConversation($user1, $user2, $message)
{
   $conversation = new  Conversation(); // Création d'un objet
   $conversation->insertGetLast10MessageConversation($user1, $user2, $message);
}
function recupererPassword($email)
{
   $RecupererPassword = new  RecupererPassword(); // Création d'un objet
   $RecupererPassword->recupererPassword($email);
}


