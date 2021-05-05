<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="public/css/index.css" />
        <title></title>
        <script src="public/js/jquery-3.4.1.js" ></script>
   <style>
   .alert{  }
   </style>
      </head>
    <body>
    
      <h1 style="margin-left:35%">FACEOMMEk</h1>
      <div class="login-page"> 
        <div  class="form">
          <form method="post" action="index.php" class="register-form">
            <input type="text" id="inspseudo" name="inspseudo" placeholder="pseudo"/><label id="errPseudo"></label>
            <input type="password" id="mdp" name="inspass" placeholder="password"/><label id="errPass"></label>
            <input type="password" id="cmdp" name="insretap_pass" placeholder="retape password"/><label id="errRetapPass"></label>
            <input type="text" id="mail"name="insemail" placeholder="email address"/><label id="errMail"></label>
            <input type="submit" Value="CREATE" id="bouton"/>
            <p class="message">Already registered? <a href="#" id="inscriptionalert" >Sign In</a></p>
          </form>

          <form method="post" action="index.php" class="login-form" >
            <input type="text" id="conPseudo" name="pseudo" placeholder="username" /><label id="errConPseudo"></label>
            <input type="password" id="conPass" name="pass" placeholder="password" /><label id="errConPass"></label>
            <input type="submit" Value="LOGIN" id="bouton" />
            <p class="message">Not registered? <a href="#" id ="connexionalert">Create an account</a></p>
          </form>
          <form method="post" action="index.php" class="login-form" >
            <input  type="submit" name="forgetPassword" value="mot de passe oublier">
          </form>
          
        </div>
        
      </div>
  <script>
    //vérifier pseudo


    $(document).ready(function(){
    var err1 = 1;    
       var inspseudo = document.getElementById('inspseudo');
      var errPseudo = document.getElementById('errPseudo');

      inspseudo.addEventListener('focus', function(e) {
    if(e.target.value.length >= 2){
      errPseudo.innerHTML = "";
      }else{
        errPseudo.style.color = 'red';
        errPseudo.innerHTML = "saisissez au moin deux caractères !";
           }
     });

     inspseudo.addEventListener('blur', function(e) {
   if(e.target.value.length >= 2){
    errPseudo.innerHTML = "";
    err1 = 0;
   }else{
    errPseudo.style.color = 'red';
    errPseudo.innerHTML = "saisissez au moin deux caractères !";
   }
  });

  //verification mot de passe
var mdp = document.getElementById('mdp');
 var errmdp = document.getElementById('errPass');

 mdp.addEventListener('focus', function(e) {
    errmdp.style.color = 'red';
    errmdp.innerHTML = "saisissez au moin six caractères !";

  });

  mdp.addEventListener('blur', function(e) {
   if(e.target.value.length >= 6){
    errmdp.innerHTML = "";
   }else{
    errmdp.innerHTML = "saisissez au moin six caractères !";
   }
  });
//verification confirmation  mot de passe
var cmdp = document.getElementById('cmdp');
 var errcmdp = document.getElementById('errRetapPass');

 cmdp.addEventListener('focus', function(e) {
    errcmdp.style.color = 'red';
    errcmdp.innerHTML = "mot de passe identiques !";

  });

  cmdp.addEventListener('blur', function(e) {
   if(e.target.value === mdp.value && e.target.value.length >= 6){
    errcmdp.innerHTML = "";
   }else if(e.target.value.length < 6){
        errcmdp.innerHTML = "saisissez au moin six caractères !";
   }else{
    errcmdp.innerHTML = "mot de passe non identiques !";
   }
  });
// valider email
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

 var mail = document.getElementById('mail');
 var errMail = document.getElementById('errMail');

 mail.addEventListener('blur', function(e) {
    if (validateEmail(e.target.value)) {
      errMail.innerHTML = "";
  } else{
    errMail.innerHTML = "email non valide !";
    errMail.style.color = 'red';
  }

  });


  $('.creer_Compte').click(function(){
   // if(err1 == 1){
        event.preventDefault(); 
    //}
});








  // vérification pseudo et mot de passe pour connexion
 var conPseudo = document.getElementById('conPseudo');
 var errConPseudo = document.getElementById('errConPseudo');

 conPseudo.addEventListener('blur', function(e) {
   if(e.target.value.length < 2){
    errConPseudo.style.color = 'red';
    errConPseudo.innerHTML = "saisissez au moin deux caractères !";
   }else{
    errConPseudo.innerHTML = "";
   }
  });
  //vérification pass connexion
  var conPass = document.getElementById('conPass');
 var errConPass = document.getElementById('errConPass');

 conPass.addEventListener('blur', function(e) {
   if(e.target.value.length < 6){
    errConPass.style.color = 'red';
    errConPass.innerHTML = "saisissez au moin six caractères !";
   }else{
    errConPass.innerHTML = "";
   }
  });
//

});
 </script>
  <script type="text/javascript" src="public/js/index.js"></script>

  </body>
  </html> 