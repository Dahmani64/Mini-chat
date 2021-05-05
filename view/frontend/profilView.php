<?php
/*
echo $_SESSION['id'];
print_r($_SESSION);
echo '</br>tabeau post: </br>';
print_r($_POST);
echo session_id();
echo '</br>session name </br>';
echo session_name();
*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="public/css/box.css">
        <link rel="stylesheet" href="public/css/index.css" />
        <link rel="stylesheet" href="public/boot441/css/bootstrap.min.css" />
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <!--
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
           -->
        <script type="text/javascript" src="public/js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="public/boot441/js/bootstrap.min.js"></script>

        <!--
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>        
          -->
        <title>Faceommek</title>

    </head>
<body style="background-color:#ddd;">
    
<!--bare de navigation-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark" style="background-color:#222222;">
  
 <a class="navbar-brand" href="#"><h1>Faceommek</h1></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

   <div class="collapse navbar-collapse" id="navbarNavDropdown" >
    <ul class="navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" href="#">
           <button class='btn btn-info' id="home">Home</button> 
         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">

        <div id="afficheparam" >
                  <button class="btn btn-info">setting</button>
                  <span id="idUtilisateur" style="color:#343a40;"><?php echo $_SESSION['id'];?></span>
              </div>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
                     
            <div style="display:inline-block;border:1px solid white;border-radius:25px;width:35px;height:35px;">
               <img id="imgProfil" src="uploads/<?php echo  $_SESSION['photo'];?>">
            </div>
            <span id="utilisateur" style="" ><?= $_SESSION['pseudo']?></span>

         </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><form id="formdeconnexion"  method="post" action="index.php" >   
                       <input  name="deconnexion" type="hidden" value="deconnexion">
                       <input class="btn btn-info" type="submit" value="LogOut" /> 
                    </form></a>
      </li>
    </ul>
  </div>
</nav>
<!--fin bare de navigation-->

<!-- la tète de la gape contient titre pseudo image btn connexion-->
<div id='header' class = "row" style="display:none;">
      <div id="titre" class="col-sm-5  "> <h1>Faceommek</h1> </div>
      <div id='profil' class="col-sm-6" >
         <div class="row" >

              <div id="afficheparam" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 header-nav">
                  <button class="btn btn-info">setting</button>
                  <span id="idUtilisateur" style="color:#222222;"><?php echo $_SESSION['id'];?></span>
              </div>  

              <div  class="col-xs-12 col-sm-4 col-md-4 col-lg-4 header-nav">
                      <img  src="uploads/<?php echo  $_SESSION['id'];?>.jpg">
                       <span id="utilisateur" ><?= $_SESSION['pseudo']?></span>
              </div>
           
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 header-nav">
                    <form id="formdeconnexion"  method="post" action="index.php" >   
                       <input  name="deconnexion" type="hidden" value="deconnexion">
                       <input class="btn btn-primary" type="submit" value="LogOut" /> 
                    </form>
              </div>            
         </div>
     </div>  
</div>
<!--  //////////////////////////////////////////////////////////// -->
<!--  //////////////////////////////////////////////////////////// -->
<!--  //////////////////////////////////////////////////////////// -->
<!--  choisissez image de profil plus pseudo et mot de passe-->
<div class="row" id="imgpseudopass" style="display:none;margin:0px;">
     <!--  changezimage -->
       <div class="col-12  col-sm-6 col-md-6 " id="images" >
          <h5>change your picture<h5>
           <form action="cibleUploadImage.php" method="post" enctype="multipart/form-data">            
            <input class="btn btn-info" type="file" name="monfichier">
            <input class=" btn btn-primary" type="submit" value="Valider" style="display:inline;">              
          </form> 
       </div>
     <!--  changez votre mot de passe et pseudo -->
       <div class="col-12  col-sm-6 col-md-6" id="divchangepseudo"  >
            <h5 id='changerPass'>Chanage password and pseudo name:</h5>
            <div class="" id='formChanger'>
               <form  method="post" action="index.php" class="login-form"><br>
                  <input type="text" name="chpseudo" placeholder="Ancien pseudo" value=""/><br>
                  <input type="password" name="chpass" placeholder="Ancien mot de passe" value=""/><br>
                  <input type="text" name="chnvpseudo" placeholder="Nouveau pseudo"/><br>
                  <input type="password" name="chnvpass" placeholder="Nouveau mot de passe"/><br>
                  <input type="submit" Value="UPDATE" id=""/>
               </form>             
            </div>
       </div>
</div>
<!--******************************************************************-->
<!--********************DERNIER MESSAGE INSERT MESSAGE****************-->
<!--******************************************************************-->


<!--listes 10 derniers commentaire-->

<div class="row" style="margin:0px;" id="commentaireView">
    <div class="col-sm-12" >
       
           <h4 class="text-center">Last ten comments</h4>
           <div id="derniersCommentaires"> 

           </div>
           <form  method="post" action="" class="form-inline" style="width:260px;margin:auto;">
             
                 <input  name="pseudo" type="hidden" id="pseudoSend" value="<?=$_SESSION['pseudo']?>">  
                 <div class="form-group">
                    <div class="">
                          <input type="textarea" name ="message" class="form-control" id="messageSend" placeholder="your comment">            
                    </div>
                 </div>
             
                  <div class="form-group">
                        <input type="submit" id="ajouterMessageindex" class="btn btn-primary" value="Send">
                 </div>
               
          </form>
           <table  >
                               <?php
                 if(isset($listLastMessage))
                   {
                      while($donne = $listLastMessage->fetch())
                      { ?>
                          <tr>
                               <td>
                                  <?php echo strip_tags($donne ['pseudo']);?>
                                </td>
                                <td>
                                    <?php echo strip_tags($donne ['message']); ?>
							           </td>
                           <tr><?php 
                      } $listLastMessage->closeCursor();
                    }?>
            </table> 
             <!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
         


       
       
    </div>
</div>
<!--***********************************************************-->
<!--****************LISTE DE AMIS CONNECTE*******************-->
<!--***********************************************************-->
<div id ="amis_connecte" >
       <div id ="click_amis_connecte" style="border-bottom:1px solid #e8e8e8;">
            Chat
       </div>
       
    <?php 
    $taille = count($listUsers);
    //$listUsers[$i][0] => id user
    //$listUsers[$i][1] => pseudo user
    //$listUsers[$i][2] => =1 en ligne =0 hors ligne
    
         for ($i=0; $i < $taille ; $i++) 
              {if($listUsers[$i][1]==$_SESSION['pseudo']){}else{?>
                        <div class="row" style="margin:0px;" id="<?php echo $listUsers[$i][0]?>" onclick="myFunction('<?php echo $_SESSION['pseudo'] ?>','<?php echo $listUsers[$i][1] ?>', '<?php echo $listUsers[$i][0] ?>', '<?php echo $listUsers[$i][2] ?>')">
                            
                                     <div class="col-8  col-sm-8  col-md-8 col-lg-6 col-xl-8" >
                                        <img  class="imageAmieConnecter" src="uploads/<?php echo  $listUsers[$i][3];?>">
                                         <?php echo $listUsers[$i][1];?>
                                     </div> 
                                     <div class="col-4 col-sm-4 col-md-4 col-lg-6 col-xl-4 text-right" >
                                        <?php if($listUsers[$i][2]==1){
                                                ?><button id="cercleEnLinge"></button><?php
                                         }else{
                                            ?><button id="cercleHorsLinge"></button><?php
                                         }?>
                                           
                                     </div> 
                                 
                       </div>
                     <?php }} ?>
       
    
</div >

 
 <!--FENETRE DISCUSSION-->
  
    <div id="discussion" class="card col-sm-5" style="visibility:hidden;">
				 <!--header dicussion -->
						<div class="card-header msg_head" style="height:90px;" >
					       <!--IMAGE + CHAT WITHKHALID + VIDEO + PHONE--> 
                               <div class="d-flex bd-highlight"  >
								<div class="img_cont" id="imgHeaderAmie">
									 <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									 <span class="online_icon"></span>
								</div>
								<div class="user_info"> 
									 <p>Chat with <span id="nomAmie">Khalid<span></p>
								</div>
								<div class="video_cam">
                                    <!--<span><i class="fas fa-video"></i></span><span><i class="fas fa-phone"></i></span>-->
                                    <span id="closeConversation"><i class="fa fa-times"></i></span>
                                    <span id="minimiser"><i class="fa fa-minus"></i></span>
                                    
								</div>
                               </div>
				          	<!--FIN IMAGE + CHAT WITHKHALID + VIDEO + PHONE--> 
					
                           <!--MENU 3 POINT
						       <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							   <div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
                                    <li><i class="fas fa-ban"></i> Block</li>
                                    <li id="closeConversation">Close </li>
								</ul>
                               </div>
                               -->
						   <!--FIN MENU 3 POINT-->
                        </div>
                <!-- fin hreader dicussion -->

                       <!--******** BODY DISCUSSION**********-->       
                  <div id="bodyConversation" class="card-body msg_card_body">
                  </div>
				             <!-- fin BODY DISCUSSION-->

                  <!--********FOOTER DISCUSSION **********-->
					<div class="card-footer">
						  <div class="input-group">
                                
                                <div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                </div>
                                
                                <textarea  id="dataMsg" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                
								<div class="input-group-append" id="sendMsg" >
                                    <span class="input-group-text send_btn">
                                         <i class="fas fa-location-arrow"></i>
                                    </span>
                                </div>
                                
						  </div>
					</div>
         <!--********FIN FOOTER DISCUSSION **********-->
    </div>
    
<!-- FIN FENETRE DISCUSSION --->

</body>

 
 <script type="text/javascript" src="public/js/index.js"></script>
 <script type="text/javascript" src="public/js/ajax.js"></script>
 <!--<script src="public/js/box.js"></script>-->

</html>

 
    