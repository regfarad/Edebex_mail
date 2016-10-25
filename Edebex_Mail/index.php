<!DOCTYPE html>   
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <title>Bienvenue sur Edebex</title>
    </head>
    <body>

        <div class="container">
            <div class="well">                                         
                <div class="row">                                
                    <div class="col-lg-offset-2 col-lg-10">                    
                        <h1>                  
                            Bienvenue sur la plateforme Edebex <br>
                            <small>Envoi du mail au débiteur</small>
                        </h1>
                    </div>
                </div>
                <!--                Formulaire-->
                <div class="row">
                    <div class="col-lg-offset-2 col-lg-6">
                        <form action="result.php" method="POST" class="form-horizontal col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">    
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="Prénom">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">              
                                    <div class="col-md-12">
                                        <input type="email" class="form-control" name="mail" id="a" placeholder=" à (mail du débiteur)"/> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="datetime">Spécifier l'heure et la date de l'envoi:</label>
                                        <input type="date" name="date">
                                        <input type="time" name="heure">
                                        <br>
                                        <input type="submit" class="btn btn-info" role="button" name="submit" value="Approuver">  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
