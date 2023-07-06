<?php
session_start();
require_once '../Config/config.php';
require_once '../Repository/PropositionRepository.php';

$propositionRepository = new propositionRepository($db);
$id = $_SESSION['id'];
$propositionRepository->showMyPropositions($id);

$propositionsList = $propositionRepository->showMyPropositions($id);

require_once $myPropositionsView;