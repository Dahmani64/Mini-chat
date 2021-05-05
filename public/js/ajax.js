
//fonction affiche la conversation entre deux personne chasue seconde
var nomRecepteurMessage;
var idRecepteurMessage;
var nomUtilisateurConnecte = document.getElementById('utilisateur').innerText;
var idutilisateurConnecte = document.getElementById('idUtilisateur').innerText;
var  bodyConversation = document.getElementById('bodyConversation');
var nomAmie = document.getElementById('nomAmie');
//fonction déclanche chaque seconde pour récupérer les messages envoyer
setInterval(function() {
   var discussion  = document.getElementById('discussion');
       if(discussion.style.visibility == 'visible'){
   getLastTeenMessageConversation (nomUtilisateurConnecte,nomRecepteurMessage,idRecepteurMessage);
       }else{}
}, 2000);

//fonction affiche le boite de dialogue avec une amie
var divDiscussion  = document.getElementById('discussion'); 
function myFunction(nomUtilisateurLogin,nomAmiDiscuter, idUtilisateurDiscuter, statuts){
   //régler la visibilté de body et footer conversation
   var bodyChat  = document.querySelector('#discussion #bodyConversation');
   var footerChat  = document.querySelector('#discussion .card-footer');
   bodyChat.style.visibility = 'visible';
   footerChat.style.visibility = 'visible';
   if(statuts == 0 ){
     // alert('is zero');
   }
   idRecepteurMessage = idUtilisateurDiscuter;
   nomRecepteurMessage =nomAmiDiscuter;
   divDiscussion.style.visibility = 'visible';
   nomAmie.innerText = nomAmiDiscuter;
   var imgHeaderAmie  = document.getElementById('imgHeaderAmie');
   if(statuts == 0 ){
      imgHeaderAmie.innerHTML = '<img src="uploads/'+idUtilisateurDiscuter+'.jpg" class="rounded-circle user_img"><span class="offline_icon"></span>';

    }else{
      imgHeaderAmie.innerHTML = '<img src="uploads/'+idUtilisateurDiscuter+'.jpg" class="rounded-circle user_img"><span class="online_icon"></span>';

    }
     getLastTeenMessageConversation (nomUtilisateurLogin, nomAmiDiscuter, idUtilisateurDiscuter);
}  
// on load page charger les 10 dernier commentaire
window.addEventListener('load', (event) => {
  getLastTeenPost ();

});
  

//fonction récupérer les 10 dernier commentaires
function getLastTeenPost () {
             var xhr = new XMLHttpRequest ();
             xhr.open('POST','index.php');
             var value1 = encodeURIComponent('all');
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('all=' + value1);
             xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState === XMLHttpRequest.DONE && (xhr.status === 200 || xhr.status === 0)) 
               {
                  var res = document.getElementById('derniersCommentaires');  
                      affiche(xhr.responseText, res);
                } 
             });
            

};

//Ajouter le dernier commentaire et afficher les 10 commentaire message
var ajouterMessage = document.getElementById('ajouterMessageindex');  
ajouterMessage.addEventListener('click',function()
{  
   event.preventDefault();   
   var xhr = new XMLHttpRequest();
   xhr.open('POST','index.php');  
      var value1 = document.getElementById('pseudoSend').value; 
      var value2 = document.getElementById('messageSend').value;
      value1 = encodeURIComponent(value1);
      value2 = encodeURIComponent(value2);
     // var xhr = new XMLHttpRequest ();
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send('pseudo=' + value1 +'&message='+value2);
      xhr.addEventListener('readystatechange', function() 
       {
          if (xhr.readyState === XMLHttpRequest.DONE && (xhr.status === 200 || xhr.status === 0)) 
            {
                getLastTeenPost();
               document.getElementById('messageSend').value="";
            }
        });
        
});

//récupérer les 10 dernier mesaage entre deux user
function getLastTeenMessageConversation (user1, user2, idUser) 
{
       var xhr = new XMLHttpRequest ();
       xhr.open('POST','index.php');
       var user1 = encodeURIComponent(user1);
       var user2 = encodeURIComponent(user2);
       xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
       xhr.send('user1=' + user1 + '&user2=' + user2);

       xhr.addEventListener('readystatechange', function() {
           if (xhr.readyState === XMLHttpRequest.DONE && (xhr.status === 200 || xhr.status === 0)) 
           {       
               var res = document.getElementById('conversation'); 
              afficheConversation(xhr.responseText, idUser , user2);   
            } 
      });
};                                       
//inserer un messagerécupérer les 10 dernier mesaage entre deux user
sendMsg = document.getElementById('sendMsg');
sendMsg.addEventListener('click',function () { 
        dataMsg = document.getElementById('dataMsg').value; 
        insertMessageGetLastTeenMessageConversation (nomUtilisateurConnecte, nomRecepteurMessage, dataMsg)

});

function insertMessageGetLastTeenMessageConversation (user1, user2, message) 
{
     var xhr = new XMLHttpRequest ();
     xhr.open('POST','index.php');
     var user1 = encodeURIComponent(user1);
     var user2 = encodeURIComponent(user2);
     var message = encodeURIComponent(message);
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     xhr.send('user1=' + user1 + '&user2=' + user2 + '&message=' + message);

    xhr.addEventListener('readystatechange', function() {
       if (xhr.readyState === XMLHttpRequest.DONE && (xhr.status === 200 || xhr.status === 0)) 
           {       
           afficheConversation(xhr.responseText, idRecepteurMessage,user2);
           } 
       });

}; 


function affiche(variable, res)
   {
          res.innerHTML = '';  
          var table = document.createElement('table');
          table.setAttribute('id','myTable');
          var ligne = document.createElement('tr');
          var rep = variable.split('|');

           for (var i = 0; i < rep.length ; i=i+2) { 
                    ligne.innerHTML+='<td><span>'+rep[i+1]+'</span></td><td class="tdTable2" style="">'+rep[i]+'</td>';
                    table.appendChild(ligne);
                    var ligne = document.createElement('tr');

                 }
                 res.appendChild(table);
    }

    //fonction pour afficher la conversation
function afficheConversation(variable, idUser, user)
{
   if (variable.length == 0){
         bodyConversation.innerHTML = '<p class="tdTable2"> sai hello</p>';
   }else{
           
           bodyConversation.innerHTML="";
           var rep = variable.split('|');
           // date contenu emetteur inverse 
             for (var i = 0; i < rep.length ; i=i+3) 
             { 
               if(user == rep[i+2])
                 {
                   recev(idUser,rep[i+1], rep[i]);      
                 }else{
                     send(idutilisateurConnecte,rep[i+1], rep[i]);
                      }
              }
                

        }
}

// fonction pour creer les message dans la boite de dialogue elle prend
// l'id pour l'image le contenu du message et la date d'ennvoie
 function recev(idUser,contenuMsg, dateMsg){
  var  bodyConversation = document.getElementById('bodyConversation');
   var divImageRecepteur,imageRecepteur, spanTime, textMessage,divTimeText, divConteneurMessageRecepteur ;
  
  divImageRecepteur = document.createElement('div');
  imageRecepteur = document.createElement('img');
  
  divTimeText = document.createElement('div');
  textMessage = document.createTextNode(contenuMsg);
  spanTime = document.createElement('span');
  
  divConteneurMessageRecepteur = document.createElement('div')

  //insérer des attribut
  imageRecepteur.src = "uploads/"+idUser+".jpg";
  imageRecepteur.setAttribute('class', 'rounded-circle user_img_msg');
  divImageRecepteur.setAttribute('class', 'img_cont_msg');
  divImageRecepteur.appendChild(imageRecepteur);

  divTimeText.setAttribute('class', 'msg_cotainer');
  spanTime.setAttribute('class', 'msg_time');
  spanTime.textContent=dateMsg;
  divTimeText.appendChild(textMessage);
  divTimeText.appendChild(spanTime);

  divConteneurMessageRecepteur.setAttribute('class', 'd-flex justify-content-start mb-4');
  divConteneurMessageRecepteur.appendChild(divImageRecepteur);
  divConteneurMessageRecepteur.appendChild(divTimeText);
  bodyConversation.appendChild(divConteneurMessageRecepteur);
 }
  function send(idUser,contenuMsg, dateMsg) {
    var  bodyConversation = document.getElementById('bodyConversation');
   var divImageRecepteur,imageRecepteur, spanTime, textMessage,divTimeText, divConteneurMessageRecepteur ;
  
  divImageRecepteur = document.createElement('div');
  imageRecepteur = document.createElement('img');
  
  divTimeText = document.createElement('div');
  textMessage = document.createTextNode(contenuMsg);
  spanTime = document.createElement('span');
  
  divConteneurMessageRecepteur = document.createElement('div')

  //insérer des attribut
  imageRecepteur.src = "uploads/"+idUser+".jpg";
  imageRecepteur.setAttribute('class', 'rounded-circle user_img_msg');
  divImageRecepteur.setAttribute('class', 'img_cont_msg');
  divImageRecepteur.appendChild(imageRecepteur);

  divTimeText.setAttribute('class', 'msg_cotainer_send');
  spanTime.setAttribute('class', 'msg_time_send');
  spanTime.textContent= dateMsg;
  divTimeText.appendChild(textMessage);
  divTimeText.appendChild(spanTime);

  divConteneurMessageRecepteur.setAttribute('class', 'd-flex justify-content-end mb-4');
  divConteneurMessageRecepteur.appendChild(divTimeText);
  divConteneurMessageRecepteur.appendChild(divImageRecepteur);
  
  bodyConversation.appendChild(divConteneurMessageRecepteur);
  }
   
//fermer la discussion

  /*
  function afficheConversation22S(variable, res, idUser, user)
{
   if (variable.length == 0) {
      res.innerText = 'dites bonjour';
   }else{
          res.innerHTML = '';  
          var table = document.createElement('table');
          table.setAttribute('id','tableConversation');
          table.setAttribute('class','');
          var ligne = document.createElement('tr');
          var rep = variable.split('|');
           for (var i = 0; i < rep.length ; i=i+3) { 
              if(user == rep[i] ){

                     ligne.innerHTML+='<td><img src="uploads/'+idUser+'.jpg"></td><td>'+rep[i]+'</td><td>'+rep[i+1]+'</td><td>'+rep[i+2]+'</td>';
                     table.appendChild(ligne);
                     var ligne = document.createElement('tr');

              }else{

                     ligne.innerHTML+='<td>'+rep[i]+'</td><td>'+rep[i+1]+'</td><td>'+rep[i+2]+'</td>';
                     table.appendChild(ligne);
                    var ligne = document.createElement('tr');
              }
          }

      res.appendChild(table);
     }
}*/


 
   /*Fonction anonyme pour afficher les 10 dernier message 
en refresh la page
(function test () {
             var reponse = document.getElementById('reponseText');
             var xhr = new XMLHttpRequest ();
             xhr.open('POST','indexAjax.php');
             var value1 = encodeURIComponent('all');
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('all=' + value1);
             xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState === XMLHttpRequest.DONE && (xhr.status === 200 || xhr.status === 0)) 
               {
                      affiche(xhr.responseText);
                } 
             });
})()
*/ 