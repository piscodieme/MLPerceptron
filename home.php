<?php
    include 'learn.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>
            Perceptron simple. une couche
        </title>
        <meta
            content='width=device-width, initial-scale=1.0, shrink-to-fit=no'
            name='viewport'/>
        <!-- Fonts and icons -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="./assets/css/material-kit.css?v=2.0.7" rel="stylesheet"/>
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="./assets/demo/demo.css" rel="stylesheet"/>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="section section-tabs">
            <div class="container">
                <!-- nav tabs -->
                <div id="nav-tabs">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Tabs with icons on Card -->
                            <div class="card card-nav-tabs">
                                <div class="card-header card-header-primary">

                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#apprentissage" data-toggle="tab">
                                                        <i class="material-icons">model_training</i>
                                                        Apprentissage
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="apprentissage">
                                        <form action="upload_apprentissage.php" method="post" enctype="multipart/form-data">
                                            Upload le ficher:
                                            <input type="file" name="the_file" id="fileToUpload">
                                            <input class="btn btn-primary btn-round" type="submit" name="submit" value="Apprentissage">
                                        </form>
                                            <script>
                                                document
                                                    .querySelector('.custom-file-input')
                                                    .addEventListener('change', function (e) {
                                                        var name = document
                                                            .getElementById("fileToUpload")
                                                            .files[0]
                                                            .name;
                                                        var nextSibling = e.target.nextElementSibling
                                                        nextSibling.innerText = name
                                                    })
                                            </script>
                                            <br><br>
                                            <div class="d-flex badge-title">
                                                <span class="badge badge-pill badge-primary">ligne -</span>
                                                <span class="badge badge-pill badge-primary">Poids 1</span>
                                                <span class="badge badge-pill badge-primary">Poids 2</span>
                                                <span class="badge badge-pill badge-primary">Poids 3</span>
                                                <span class="badge badge-pill badge-primary">
                                                    Attendue</span>
                                                <span class="badge badge-pill badge-primary">
                                                    Obtebue</span>
                                            </div>
                                            <?php
                                                function apprentissage()
                                                {
                                                    $row = -1;
                                                    $Poids = initialisation_poids();
                                                    $cpt = 0;
                                                    /* Teste d'ouverture du ficher */
                                                    if (($handle = fopen("./uploads/apprentissage.csv", "r")) !== FALSE) {
                                                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE && $cpt < 6) {
                                                            
                                                            $row++;
                                                                if ($row == 0) {
                                                                    continue;  // on saute la premiere ligne
                                                                }
                                                                //echo "<br/><br/>======= Affichage des donnees DATA =========== $row <br/> ";
                                                                //var_dump($data);
                                                                $X = array(
                                                                    0 => $data[0],
                                                                    1 => $data[1],
                                                                    2 => $data[2],
                                                                );

                                                                $sortie_obs = calculer_sortie($X,$Poids);?>
                                                                
                                                                <div class="d-flex badge-noeuds">
                                                                    <span class="badge badge-pill badge-info num"><?php echo $row ?></span>
                                                                    <span class="badge badge-pill badge-info noeuds"><?php echo $Poids[0] ?></span>
                                                                    <span class="badge badge-pill badge-info noeuds"><?php echo $Poids[1] ?></span>
                                                                    <span class="badge badge-pill badge-info noeuds"><?php echo $Poids[2] ?></span>
                                                                    <span class="badge badge-pill badge-info attendue"><?php echo $data[3] ?></span>
                                                                    <span class="badge badge-pill badge-info obtenue"><?php echo $sortie_obs ?></span>
                                                                </div>

                                                                <?php
                                                                $Poids = MAJ_poids($X,$Poids,$sortie_obs,$data[3]);
                                                                
                                                                if($sortie_obs - $data[3] == 0){
                                                                    $cpt++;
                                                                }else{
                                                                    $cpt=0;
                                                                }
                                                            // var_dump($sortie_obs); echo'  '.$cpt;
                                                        }
                                                        fclose($handle); ?>
                                                        <div class="alert alert-success">
                                                            <div class="container">
                                                            <div class="alert-icon">
                                                                <i class="material-icons">check</i>
                                                            </div>
                                                            <button type="button" class="close" data-dismiss="alert" >
                                                                <span aria-hidden="true"><i class="material-icons">clear</i></span>
                                                            </button>
                                                            <b>Succes</b> Votre neurone est devenu stable avec comme poids : 
                                                            </div>
                                                        </div>
                                                        <div class="d-flex badge-noeuds_finaux">
                                                            <span class="badge badge-pill badge-success finaux"><?php echo $Poids[0] ?></span>
                                                            <span class="badge badge-pill badge-success finaux"><?php echo $Poids[1] ?></span>
                                                            <span class="badge badge-pill badge-success finaux"><?php echo $Poids[2] ?></span>
                                                        </div>
                                                        <form action="tester.php" method="get">
                                                            <input type="text" name="poids_1" class="d-none" value="<?php echo $Poids[0] ?>">
                                                            <input type="text" name="poids_2" class="d-none" value="<?php echo $Poids[1] ?>">
                                                            <input type="text" name="poids_3" class="d-none" value="<?php echo $Poids[2] ?>">
                                                            
                                                        </form>
                                                        <br><br>
                                                        <form action="tester.php" method="post" enctype="multipart/form-data">
                                                            Upload le ficher:
                                                            <input type="file" name="the_file" id="fileToUpload">
                                                            <input type="text" class="d-none" name="poids_1" value="<?php echo $Poids[0] ?>">
                                                            <input type="text" class="d-none" name="poids_2" value="<?php echo $Poids[1] ?>">
                                                            <input type="text" class="d-none" name="poids_3" value="<?php echo $Poids[2] ?>">
                                                            <input class="btn btn-primary btn-round" type="submit" name="submit" value="Tester">
                                                        </form>
                                                        <?php
                                                        return $Poids;
                                                    }
                                                }
                                                $f = apprentissage();
                                            ?>
                                            
                                        </div>
                                            <script>
                                                document
                                                    .querySelector('.custom-file-input')
                                                    .addEventListener('change', function (e) {
                                                        var name = document
                                                            .getElementById("fileToUpload")
                                                            .files[0]
                                                            .name;
                                                        var nextSibling = e.target.nextElementSibling
                                                        nextSibling.innerText = name
                                                    })
                                            </script>
                                    </div>
                                </div>
                            </div>
                            <!-- End Tabs with icons on Card -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Core JS Files -->
        <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
        <script
            src="./assets/js/core/bootstrap-material-design.min.js"
            type="text/javascript"></script>
        <script src="./assets/js/plugins/moment.min.js"></script>
        <!-- Plugin for the Datepicker, full documentation here:
        https://github.com/Eonasdan/bootstrap-datetimepicker -->
        <script
            src="./assets/js/plugins/bootstrap-datetimepicker.js"
            type="text/javascript"></script>
        <!-- Plugin for the Sliders, full documentation here:
        http://refreshless.com/nouislider/ -->
        <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
        <!-- Google Maps Plugin -->
        <!-- Control Center for Material Kit: parallax effects, scripts for the example
        pages etc -->
        <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                //init DateTimePickers
                materialKit.initFormExtendedDatetimepickers();

                // Sliders Init
                materialKit.initSliders();
            });

            function scrollToDownload() {
                if ($('.section-download').length != 0) {
                    $("html, body").animate({
                        scrollTop: $('.section-download')
                            .offset()
                            .top
                    }, 1000);
                }
            }
        </script>
    </body>
</html>