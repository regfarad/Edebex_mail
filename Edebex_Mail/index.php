<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <title>Bienvenue sur Edebex</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="container">
            <div class="well">
                <div class="row">
                    <div class="col-md-offset-2 col-md-10">
                        <h1>
                            Bienvenue sur la plateforme Edebex <br/>
                            <small>Envoi du mail au débiteur</small>
                        </h1>
                    </div>
                </div>
                <!--                Formulaire-->
                <div class="row">
                    <div class="col-md-offset-2 col-md-3">
                        <form>
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" placeholder="nom">
                                <label for="prenom">Prénom</label>
                                <input type="text" class="form-control" id="prenom" placeholder="prenom">

                                <label for="message">Votre message : </label><br>
                                <textarea rows='6' cols="52" class="form-control" name="message" id="message"></textarea> <br><br>

                                <input type="submit" class="btn btn-info" role="button" name="submit" value="Envoyer">
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </body>
</html>
