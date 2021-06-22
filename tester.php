
<?php
    include 'learn.php';
    include 'upload_test.php'

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
                                                    <a class="nav-link" href="#testes" data-toggle="tab">
                                                        <i class="material-icons">done_all</i>
                                                        Teste
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="apprentissage">
                                            <div class="d-flex badge-noeuds_finaux">
                                                <span style="width: 300px"
                                                class="badge badge-pill badge-success finaux">Teste perceptron avec ;</span>
                                            </div>
                                            <div class="d-flex badge-noeuds_finaux">
                                                <span class="badge badge-pill badge-secondary"><?php echo $_POST['poids_1'] ?></span>
                                                <span class="badge badge-pill badge-secondary"><?php echo $_POST['poids_2'] ?></span>
                                                <span class="badge badge-pill badge-secondary"><?php echo $_POST['poids_3'] ?></span>
                                            </div>
                                            <br><br>
                                            <div class="d-flex badge-title">
                                                <span class="badge badge-pill badge-primary">ligne -</span>
                                                <span class="badge badge-pill badge-primary">Attendue</span>
                                                <span class="badge badge-pill badge-primary">Obtenue</span>
                                                <span class="badge badge-pill badge-primary nom_fl">Nom fleur</span>
                                                
                                            </div>
                                            <?php
                                                function tester()
                                                {
                                                    $row = -1;
                                                    $Poids  = array(
                                                        0 => (float)$_POST['poids_1'] ,
                                                        1 => (float)$_POST['poids_2'] , 
                                                        2 => (float)$_POST['poids_3'] 
                                                    );

                                                    //var_dump($Poids);exit; 
                                                    /* Teste d'ouverture du ficher */
                                                    if (($handle = fopen("./uploads/teste.csv", "r")) !== FALSE) {

                                                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                                                            
                                                            $row++;
                                                            if ($row == 0) {
                                                                continue;  // on saute la premiere ligne
                                                            }
                                                            $X = array(
                                                                0 => 1,
                                                                1 => $data[1],
                                                                2 => $data[2],
                                                            );

                                                            $sortie_obs = calculer_sortie($X,$Poids);
                                                            if($sortie_obs == 0){ ?> <!-- IRIS 1 -->
                                                                <div class="d-flex badge-noeuds">
                                                                    <span class="badge badge-pill badge-success"><?php echo $row ?></span>
                                                                    <span class="badge badge-pill badge-success"><?php echo $data[3] ?></span>
                                                                    <span class="badge badge-pill badge-success"><?php echo $sortie_obs?></span>
                                                                    <span class="badge badge-pill badge-success nom_fl"><?php echo $data[4] ?></span>
                                                                </div><?php                                                 
                                                                
                                                            }else{ ?>
                                                                <div class="d-flex badge-noeuds">
                                                                    <span class="badge badge-pill badge-info "><?php echo $row ?></span>
                                                                    <span class="badge badge-pill badge-info "><?php echo $data[3] ?></span>
                                                                    <span class="badge badge-pill badge-info "><?php echo $sortie_obs?></span>
                                                                    <span class="badge badge-pill badge-info nom_fl"><?php echo $data[4] ?></span>
                                                                </div>
                                                            <?php }

                                                                
                                                        }
                                                        fclose($handle); ?>
                                                
                                                        
                                                        <?php
                                                        return $Poids;
                                                    }
                                                }
                                                $f = tester();
                                            ?>
                                       
                                        </div>
                                        
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