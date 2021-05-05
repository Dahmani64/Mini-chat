<?php
session_start();
require('controller/frontend.php');
//require('controller/frontendAjax.php');

try { // On essaie de faire des choses
 
   
    if (isset($_SESSION['pseudo']) && isset($_SESSION['id']) && !isset($_POST['chpseudo']) && !isset($_POST['deconnexion']) &&!isset($_POST['message']) && !isset($_POST['all']) && !isset($_POST['user1'])) {
        //echo'session existe ';
         $listUserConnect = getSessionActive();
         $listUsers = getAllUsers();
       // $listLastMessage =  getLastMessage();
        require('view/frontend/profilView.php');
        
    }elseif (isset($_POST['pseudo']) && isset($_POST['pass']) ) { 
        //echo'connexion ';
        verifConnection(strip_tags($_POST['pseudo']),strip_tags($_POST['pass']));
   
    }elseif (isset($_POST['inspseudo']) && isset($_POST['inspass']) && isset($_POST['insretap_pass'])&&isset($_POST['insemail'])) {
       // echo'inscription';
        verifInscription($_POST['inspseudo'] , $_POST['inspass'], $_POST['insretap_pass'], $_POST['insemail']);
   
    }elseif (isset($_POST['chpseudo']) && isset($_POST['chpass']) && isset($_POST['chnvpseudo'])&&isset($_POST['chnvpass'])) {
       
        changerPassPseudo($_POST['chpseudo'] , $_POST['chpass'], $_POST['chnvpseudo'], $_POST['chnvpass']);    
  
    }elseif (isset($_POST['deconnexion']) && isset($_SESSION['pseudo']) && isset($_SESSION['id']) ) {
       
        deleteSessionActive(strip_tags($_SESSION['id']));
        $_SESSION = array();
        session_destroy();
        require('view/frontend/connexionView.php');
   
    }/*elseif (isset($_POST['pseudo']) && isset($_POST['message']) ) {

        ajouterMessage(strip_tags($_POST['pseudo']), strip_tags($_POST['message']));
    
    }*/else if (isset($_POST['all']) and !isset($_POST['pseudo'])and !isset($_POST['message']) ) {
       
        getLastMessageAjax();

   }else if (isset($_POST['pseudo']) && isset($_POST['message']) ) {
    

    ajouterMessageAjax(strip_tags($_POST['pseudo']), strip_tags($_POST['message']));
     getLastMessageAjax();

   }else if (isset($_POST['user1']) && isset($_POST['user2']) && !isset($_POST['message']) ) {
  
        getLastMessageConversation(strip_tags($_POST['user1']), strip_tags($_POST['user2']));
      
}else if (isset($_POST['user1']) && isset($_POST['user2']) && isset($_POST['message']) ) {
      
      insertAndGetLastMessageConversation(strip_tags($_POST['user1']), strip_tags($_POST['user2']), strip_tags($_POST['message']));
          
} elseif(isset($_POST['forgetPassword'])){
    require('view/frontend/forgetPasswordView.php');
 }elseif(isset($_POST['mailForget'])){
    recupererPassword(strip_tags($_POST['mailForget'])) ;
}else{
                $_SESSION = array();
                session_destroy();
                require('view/frontend/connexionView.php');  
    }


}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();
    echo $errorMessage;
   

}

