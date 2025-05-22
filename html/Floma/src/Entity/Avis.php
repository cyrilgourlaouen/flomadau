<?php

namespace App\Entity;

class Avis
{
    public const TABLE_NAME = 'avis';

    private int $id;
    private string $titre;
    private float $note;
    private string $commentaire;
    private string $date_publication;
    private string $date_visite;
    private string $contexte_visite;
    private int $nb_like = 0;
    private int $nb_dislike = 0;
    private int $signalements = 0;
    private bool $signalement_pro = false;
    private int $id_offre;
    private int $code_membre;

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getTitre(): string { return $this->titre; }
    public function setTitre(string $titre): void { $this->titre = $titre; }

    public function getNote(): float { return $this->note; }
    public function setNote(float $note): void { $this->note = $note; }

    public function getCommentaire(): string { return $this->commentaire; }
    public function setCommentaire(string $commentaire): void { $this->commentaire = $commentaire; }

    public function getDatePublication(): string { return $this->date_publication; }
    public function setDatePublication(string $date_publication): void { $this->date_publication = $date_publication; }

    public function getDateVisite(): string { return $this->date_visite; }
    public function setDateVisite(string $date_visite): void { $this->date_visite = $date_visite; }

    public function getContexteVisite(): string { return $this->contexte_visite; }
    public function setContexteVisite(string $contexte_visite): void { $this->contexte_visite = $contexte_visite; }

    public function getNbLike(): int { return $this->nb_like; }
    public function setNbLike(int $nb_like): void { $this->nb_like = $nb_like; }

    public function getNbDislike(): int { return $this->nb_dislike; }
    public function setNbDislike(int $nb_dislike): void { $this->nb_dislike = $nb_dislike; }

    public function getSignalements(): int { return $this->signalements; }
    public function setSignalements(int $signalements): void { $this->signalements = $signalements; }

    public function isSignalementPro(): bool { return $this->signalement_pro; }
    public function setSignalementPro(bool $signalement_pro): void { $this->signalement_pro = $signalement_pro; }

    public function getIdOffre(): int { return $this->id_offre; }
    public function setIdOffre(int $id_offre): void { $this->id_offre = $id_offre; }

    public function getCodeMembre(): int { return $this->code_membre; }
    public function setCodeMembre(int $code_membre): void { $this->code_membre = $code_membre; }
}
