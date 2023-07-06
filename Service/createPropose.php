<?php
session_start();
require_once '../Config/config.php';
require_once '../Repository/PropositionRepository.php';

$propositionRepository = new propositionRepository($db);
        
if ($propositionRepository->createPropose($itemName, $price, $link, $categoryId)) {
        echo "Propozycja została utworzona.";
    } else {
        echo "Wystąpił błąd podczas tworzenia propozycji.";
    }

require_once $createProposeView;