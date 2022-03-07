<?php
    // vérif si form envoyé ou non
    if(isset($_POST['nom']))
    {
        // vérifier les info envoyée
        // init err
        $err = 0;

        if(empty($_POST['nom']))
        {
            $err=1;
        }else{
            $nom = htmlspecialchars($_POST['nom']);
        }


        // vérif si pas d'erreur 
        if($err==0)
        {
            // gestion de l'image
            if(empty($_FILES['fichier']['tmp_name']))
            {
                // pas de fichier envoyé
                header("LOCATION:index.php?imgerror=1");
            }else{
                // j'ai bien une image et je vais la gérer 

                $dossier = 'images/';
                $fichier = basename($_FILES['fichier']['name']);
                $taille_maxi = 200000;
                $taille = filesize($_FILES['fichier']['tmp_name']);
                $extensions = ['.png', '.gif', '.jpg', '.jpeg'];
                $extension = strrchr($_FILES['fichier']['name'], '.');

                if(!in_array($extension,$extensions)){
                    $imgError = 2; // problème au niveau de l'extension
                }

                if($taille>$taille_maxi)
                {
                    $imgError = 3; // problème pour la taille du fichier
                }

                // vérif si prob avec  le fichier envoyé
                if(isset($imgError))
                {
                    header("LOCATION:index.php?imgerror=".$imgError);
                }else{
                    //  pas de problème donc on va essayer de le déplacer et gérer la syntaxe du nom de fichier
                    //On formate le nom du fichier, strtr remplace tous les KK spéciaux en normaux suivant notre liste
                    $fichier = strtr($fichier,
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); // preg_replace remplace tout ce qui n'est pas un KK normal en tiret

                    // gestion des conflits 

                    $fichiercpt = rand().$fichier;

                    // déplacement du fichier dans le bon dossier avec le bon nom
                    if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.$fichiercpt))
                    {
                        echo "ok";
                    }else{
                        header("LOCATION:index.php?imgerror=4");
                    }

                }




            }


        }else{
            header("LOCATION:index.php?error=".$err);
        }





    }else{
        // form pas envoyé
        header("LOCATION:index.php");
    }

 
?>