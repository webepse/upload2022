<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire</h1>
    <form method="POST" action="traitement.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom: </label>
            <input type="text" id="nom" name="nom">
        </div>
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="200000">
            <label for="fichier">Fichier : </label><input type="file" id="fichier" name="fichier">
        </div>
        <input type="submit" value="envoyer"/>

        <?php 
            if(isset($_GET['error']))
            {
                echo "<div class='error'>Un problème est survenu</div>";
            }

        ?>
    </form>
</body>
</html>