<?php
// Classe Chapitre
class Ticket
{
    // Attributs
    private $_id;
    private $_title;
    private $_content;
    private $_DateTimeAdd;
    private $_dateTimeLastModified;

    // Le constructeur => Cette méthode permettra de créer un objet Chapitre à chaque instanciation de la classe
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    // Méthode d'hydratation de l'objet
    public function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
        {
            // Le nom de la méthode à appeler sera determiner par la clé de l'array $donnees
            // La premiére lettre de la clé sera transformer en majuscule avec "ucfirst"
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method)) // Vérifie que le setter à appeler existe
            {
                // Appelle le setter
                $this->$method($value);
            }
        }
    }

    // Setter ID => Modifie l'attribut correspondant à l'ID du chapitre
    public function setId($id)
    {
        $id = (int) $id; // Force la conversion en nombre

        // Vérifie que ce nombre est positif
        if($id > 0)
        {
            // Si c'est bon, on assigne la valeur à l'attribut correspondant
            $this->_id = $id;
        }
    }

    // Setter titre => Modifie l'attribut correspondant au titre du chapitre
    public function setTitle($title)
    {
        if(!is_string($title)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('Le titre du chapitre doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_title = $title;
    }

    // Setter contenu => Modifie l'attribut correspondant au contenu du chapitre
    public function setContent($content)
    {
        if(!is_string($content)) // S'il ne s'agit pas d'une chaine de caractères
        {
            trigger_error('Le contenu du chapitre doit être une chaine de caractères', E_USER_WARNING);
            return;
        }

        $this->_content = $content;
    }

    // Setter dateHeureAjout => Modifie l'attribut correspondant à la date et l'heure d'ajout du chapitre
    public function setDateTimeAdd($dateTimeAdd)
    {
        $this->_dateTimeAdd = $dateTimeAdd;
    }

    // Setter dateHeureDerniereModification => Modifie l'attribut correspondant à la dte et l'heure de la dérniere modification du chapitre
    public function setDateTimeLastModified($dateTimeLastModified)
    {
        $this->_dateTimeLastModified = $dateTimeLastModified;
    }

    // Getter ID => Renvoie l'attribut correspondant à l'ID du chapitre
    public function id()
    {
        return $this->_id;
    }

    // Getter titre => Renvoie l'attribut correspondant au titre du chapitre
    public function title()
    {
        return $this->_title;
    }

    // Getter contenu => Renvoie l'attribut correspondant au contenu du chapitre
    public function content()
    {
        return $this->_content;
    }

    // Getter dateHeureAjout => Renvoie l'attribut correspondant à la dte et l'heure d'ajout du chapitre
    public function dateTimeAdd()
    {
        return $this->_dateTimeAdd;
    }

    // Getter dateHeureDerniereModification => Renvoie l'attribut correspondant à la dte et l'heure de la dérniere modification du chapitre
    public function dateTimeLastModified()
    {
        return $this->_dateTimeLastModified;
    }
}
