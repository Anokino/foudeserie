<?php
    namespace App\service;
    use PDO;
use ProxyManager\ProxyGenerator\PropertyGenerator\PublicPropertiesMap;

    class PdoFouDeSerie {
        private static $monPdo;
        public function __construct($serveur, $bdd, $user, $mdp) {
            PdoFouDeSerie::$monPdo= new PDO($serveur. ';'. $bdd,$user,$mdp);
        }
    
    

        public function getLesSeries()
    {
        $res = PdoFouDeSerie::$monPdo->prepare('select * from serie');
        $res->execute(); 
        $lesSeries = $res->fetchAll();
    return $lesSeries;
    }
    

        public function getNBSeries() {
            $res = PdoFouDeSerie::$monPdo->prepare('select count(*) from serie');
            $res->execute();
            $nbSeries = $res->fetch();
            return $nbSeries[0];
        }

        }
    
?>