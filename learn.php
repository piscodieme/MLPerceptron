<?php


/* Initialisation des poids */
    define ( "Nb_poids" , 3) ; // Dans notre cas le nombre de poids est égal à 3
    function initialisation_poids()
    {
        $W = array();
        for ($i=0; $i < Nb_poids; $i++) { 
            $W[$i] = rand(-20,20)/10;
        }

        return $W;
    }

    /* Calcul de la sortie observée*/
    function calculer_sortie($X, $W)
    {
        $somme = 0;
        //var_dump($X['x1']); exit;

        for ($i=0; $i < sizeof($W); $i++) {
            $X[$i] = str_replace(',','.',$X[$i]); 
            $somme = $somme + $W[$i] * (float)$X[$i];
            //var_dump($X[$i]).'<br/>';
        }
        if ($somme > 0) {
            $sortie_obs = 1;
        } else {
            $sortie_obs = 0;
        }
        return $sortie_obs;
    }

    /* Mise à jour des poids */
    function MAJ_poids($X, $W, $sorties_obs, $sorties_att)
    {
        for ($i=0; $i < sizeof($X); $i++) { 
            $X[$i] = str_replace(',','.',$X[$i]);
            $W[$i] = (float)$W[$i] + ((int)$sorties_att - (int)$sorties_obs)*$X[$i];
        }
        
        return $W;
    }
    
?>