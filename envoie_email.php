<?php
session_start();    
?>   
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=camagru;charset=utf8', 'root', 'rootroot');
    } catch (Exception $e) {
                die('error :' . $e->getMessage());
            }
        $to = $_POST['email'];
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"Camagru"<zfadia@student.42.fr>'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $sujet  ="Récupération de mot de passe " ;
        $pseudo = $_POST['pseudo'];
        $message = '
         <html>
         <head>
           <title>Récupération de mot de passe</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>

                     <div align="center"> Bonjour <b>'.$pseudo.'</b></div>
                     Voici votre code de récupération: <b>'.$token.'</b>
                     A bientôt sur <a href="http://localhost:8080/camagru/confirmemail.php?pseudo=$pseudo&kys_email=$token">récupération_de_mot_depasse.com</a> !

                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         mail($to, $sujet, $message, $header);
            //header("Location:http://127.0.0.1/path///127.0.0.1/path/
        echo '<p>consulte tes e-mail</p>';
    
?>