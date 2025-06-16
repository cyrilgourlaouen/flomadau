<?php

namespace App\Service;

use App\Entity\JourOuvertureOffre;
use App\Manager\JourOuvertureOffreManager;

class HoraireManage 
{
    public function setHourly(int $idOffre): void
    {
        $jourOuvertureOffre = new JourOuvertureOffre();
        $jourOuvertureOffreManager = new JourOuvertureOffreManager();
        if (isset($_POST["lundi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["lundi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["lundi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["lundi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(1);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["mardi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["mardi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["mardi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["mardi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(2);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["mercredi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["mercredi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["mercredi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["mercredi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(3);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["jeudi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["jeudi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["jeudi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["jeudi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(4);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["vendredi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["vendredi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["vendredi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["vendredi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(5);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["samedi_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["samedi_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["samedi_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["samedi_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(6);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        } elseif (isset($_POST["dimanche_ouverture"])) {
            for ($i=0; $i < sizeof($_POST["dimanche_ouverture"]); $i++) { 
                $jourOuvertureOffre->setHoraireDebut($_POST["dimanche_ouverture"][$i]);
                $jourOuvertureOffre->setHoraireFin($_POST["dimanche_fermeture"][$i]);
                $jourOuvertureOffre->setIdJour(7);
                $jourOuvertureOffre->setIdJour($idOffre);
            }
        }
        $jourOuvertureOffreManager->add($jourOuvertureOffre);
    }    
}