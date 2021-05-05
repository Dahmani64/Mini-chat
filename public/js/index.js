
// afficher menu box pour close
$(document).ready(function(){

    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });

    $('.creer_Compte').click(function(){
        // if(err1 == 1){
        //     event.preventDefault(); 
         //}
        // alert(err1);
     });


        });
        
 // hide and show login and registed inscription
$('.message a').click(function(){
    //alert('hello world');
    $('#divalert').css('display','none')
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    var subnavs = doc.querySelectorAll(".alert");
    for (let i = 0; i < subnavs.length; i++) {
        subnavs.innerHtml = "";
        
    } 
    

});
$('.message a').click(function(){
   var subnavs = doc.querySelectorAll(".alert")
    for (let i = 0; i < subnavs.length; i++) {
        subnavs.style.innerHtml = "";
        
    } });

/******************************************************/

// afficher div  pour changer pseudo et mot de passe 
var buttonview = document.getElementById('changerPass');
var form = document.getElementById('formChanger');
buttonview.addEventListener('click',function () {
if(form.style.display == 'block'){
    form.style.display = 'none';
}else{
    form.style.display = 'block';
}
});

var afficherparam = document.getElementById('afficheparam');
var divparam = document.getElementById('imgpseudopass');
var commentaireView = document.getElementById('commentaireView');
var homeView = document.getElementById('home');
//view setting change image and password and pseudo
afficherparam.addEventListener('click',function () {

    divparam.style.display = 'block';
    commentaireView.style.display = 'none';

});
//view setting change image and password and pseudo
homeView.addEventListener('click',function () {

    divparam.style.display = 'none';
    commentaireView.style.display = 'block';

});
var clickdivListeAmis = document.getElementById('click_amis_connecte');
var divListeAmis = document.getElementById('amis_connecte');

clickdivListeAmis.addEventListener('click',function () {

    if(divListeAmis.style.height == '25px'){
    divListeAmis.style.height = '200px'
}else{
    divListeAmis.style.height = '25px'
}

});

//minimiser message
/*
var recepteurMessage  = document.getElementById('recepteurMessage');
var divmessage  = document.getElementById('divmessage');
var conversation  = document.getElementById('conversation');
var saisieMessageConversation  = document.getElementById('saisieMessageConversation');
recepteurMessage.addEventListener('click',function () {
    var divmessage  = document.getElementById('divmessage');
var conversation  = document.getElementById('conversation');
var saisieMessageConversation  = document.getElementById('saisieMessageConversation');
var recepteurMessage  = document.getElementById('recepteurMessage');

    if(divmessage.style.height == '250px'){
        recepteurMessage.style.height='100%';
        divmessage.style.height='30px';
        conversation.style.display = 'none';
        saisieMessageConversation.style.display = 'none';
    }else{
        recepteurMessage.style.height='15%';
        divmessage.style.height='250px';
        conversation.style.display = 'block';
        saisieMessageConversation.style.display = 'block';
    }
    

});
*/
//minimise box conversation
var minimiser = document.querySelector('#minimiser');
var chat  = document.querySelector('#discussion');
var headerChat  = document.querySelector('#discussion .card-header');
var bodyChat  = document.querySelector('#discussion #bodyConversation');
var footerChat  = document.querySelector('#discussion .card-footer');
minimiser.addEventListener('click',function () {
    if( chat.style.height != '85px'){
        chat.style.height = '85px'; 
        bodyChat.style.visibility = 'hidden';
        footerChat.style.visibility = 'hidden';
    }else{
        chat.style.height = '350px'; 
        bodyChat.style.visibility = 'visible';
        footerChat.style.visibility = 'visible';
    }
});
//close box conversation
closeConversation = document.getElementById('closeConversation');
closeConversation.addEventListener('click', function () {
   var discussion  = document.getElementById('discussion');
   discussion.style.visibility = 'hidden';
   bodyChat.style.visibility = 'hidden';
   footerChat.style.visibility = 'hidden';
});