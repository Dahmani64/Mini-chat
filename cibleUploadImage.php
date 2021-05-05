<?php
session_start();

?>
<?php

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['monfichier']['size'] <= 10000000)
        {
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                $extension_upload = $infosfichier['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png','JPG', 'JPEG', 'GIF', 'PNG',);
                if (in_array($extension_upload, $extensions_autorisees))
                {
                        ////////////:
                        $name = $_SESSION['id'].'.'.$extension_upload;
                        $path="uploads/".$name;
                        if($_SESSION['photo'] == "default.png"){
                        }else{
                       unlink("uploads/" . $_SESSION['photo']) or die("Failed to <strong class='highlight'>delete</strong> file");
                        }

                        move_uploaded_file($_FILES['monfichier']['tmp_name'], $path);
                        $_SESSION['photo'] = $name;
                        updateImage($_SESSION['id'],$name);
                   
                      echo"<script>window.location.href='index.php';</script>";

                        // On peut valider le fichier et le stocker définitivement
                       // move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/' . basename($_FILES['monfichier']['name']));
                        //echo "L'envoi a bien été effectué !";
                }else {
                        echo"<script>window.location.href='index.php';</script>";
     
                }
        }else {
                echo"<script>window.location.href='index.php';</script>";

        }
}else {
        echo"<script>window.location.href='index.php';</script>";
}

function updateImage($id,$nvphoto){
        $db = new PDO('mysql:host=localhost;dbname=chat;charset=utf8', 'root', '');
        $req = $db->prepare('UPDATE membres SET photo = :nvphoto WHERE id = :id');
        $req->execute(array(
                'nvphoto' => $nvphoto,
                'id' => $id
            ));
            //$req->closeCursor();
}




?>




