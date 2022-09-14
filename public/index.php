<?php

include_once('./vendor/autoload.php');

use Renolab\Rge\DomaineService;
use Renolab\Rge\EntrepriseService;

$domaineService = new DomaineService();
$entrepriseService = new EntrepriseService();

/*
var_dump($domaineService->all());
var_dump($domaine = $domaineService->find('Pompe à chaleur : chauffage'));

var_dump($entrepriseService->find('79056711900025', new \DateTime()));
*/
var_dump($entrepriseService->search('Isolation des murs par l\'extérieur', '84007', 10));
