<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Compte;

/**
 * Class CompteManager
 *
 * @package App\Manager
 */
class CompteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Compte::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Compte::class, $filters);
    }

    /**
     * @param array $filters
     * @param array $order
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
     */
    public function findBy(array $filters, array $order = [], ?int $limit = null, ?int $offset = null)
    {
        return $this->readMany(Compte::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Compte::class);
    }

    public function add(Compte $compte) {
		return $this->create(Compte::class, [
				'nom' => $compte->getNom(),
				'prenom' => $compte->getPrenom(),
				'email' => $compte->getEmail(),
                'telephone' => $compte->getTelephone(),
                'mot_de_passe' => $compte->getMotDePasse(),
                'ville' => $compte->getVille(),
                'code_postal' => $compte->getCodePostal(),
                'nom_rue' => $compte->getNomRue(),
                'numero_rue' => $compte->getNumeroRue(),
                'complement_adresse' => $compte->getComplementAdresse()
			]
		);
	}

    public function addGetId(Compte $compte) {
		return $this->createGetId(Compte::class, [
				'nom' => $compte->getNom(),
				'prenom' => $compte->getPrenom(),
				'email' => $compte->getEmail(),
                'telephone' => $compte->getTelephone(),
                'mot_de_passe' => $compte->getMotDePasse(),
                'ville' => $compte->getVille(),
                'code_postal' => $compte->getCodePostal(),
                'nom_rue' => $compte->getNomRue(),
                'numero_rue' => $compte->getNumeroRue(),
                'complement_adresse' => $compte->getComplementAdresse()
			]
		);
	}

    /**
     * @param Compte $compte
     * @param int $id
     * @return \PDOStatement
     */
    public function updateCompte(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'nom' => $compte->getNom(),
            'prenom' => $compte->getPrenom(),
            'email' => $compte->getEmail(),
            'telephone' => $compte->getTelephone(),
            'mot_de_passe' => $compte->getMotDePasse(),
            'ville' => $compte->getVille(),
            'code_postal' => $compte->getCodePostal(), 
            'nom_rue' => $compte->getNomRue(),
            'numero_rue' => $compte->getNumeroRue(),
            'complement_adresse' => $compte->getComplementAdresse(),
            'url_photo_profil' => $compte->getUrlPhotoProfil()
        ];

        return $this->update(Compte::class, $fields, $id);
    }

    
    public function updateDataCompte(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'nom' => $compte->getNom(),
            'prenom' => $compte->getPrenom(),
            'telephone' => $compte->getTelephone(),
        ];

        return $this->update(Compte::class, $fields, $id);
    }

    
    public function updateEmail(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'email'=> $compte->getEmail(),
        ];
        return $this->update(Compte::class, $fields, $id);
    }

    
    public function updatePassword(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'mot_de_passe'=> $compte->getMotDePasse(),
        ];
        return $this->update(Compte::class, $fields, $id);
    }
}