<?php
// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd()
{
    $host_name = 'localhost';
    $database = 'projet_4';
    $user_name = 'root';
    $password = '';

    $bdd = null;

    try {
      $bdd = new PDO("mysql:host=$host_name; dbname=$database; charset=utf8", $user_name, $password);
    } catch (PDOException $e) {
      echo "Erreur!: " . $e->getMessage() . "<br/>";
      die();
    }
    
    return $bdd;
}

// Fonction de vérification des champ de confirmation
function verificationChampsConfirmation($email, $emailConfirmation, $motDePasse, $motDePasseConfirmation)
{
    if($email == $emailConfirmation) // L'adresse mail est confirmer
    {
        if($motDePasse != $motDePasseConfirmation) // Le mot de passe n'est pas confirmer
        {
            return 'Le mot de passe de confirmation ne correspond pas au mot de passe saisi !'; // Retourne le message d'erreur
        }
    }
    else // L'adresse mail n'est pas confirmer
    {
        return 'L\'adresse E-Mail de confirmation ne correspond pas a l\'adresse E-Mail saisi !'; // Retourne le message d'erreur
    }
}

// Fonction de vérification des champs pour l'inscription d'un nouveau membre à partir du formulaire d'inscription
function verificationChampsInscription($emailAdress, $password)
{
    if(filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
    {
        $bdd = getBdd(); // Appel de la fonction de connexion à la BDD
        
        $request = $bdd->prepare('SELECT emailAdress FROM members WHERE emailAdress = ?');
        $request->execute(array($emailAdress)) or die(print_r($request->errorInfo(), TRUE));

        $dataMember = $request->fetch();

        if($dataMember['emailAdress'] != $emailAdress)
        {
            if(strlen($password) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
            {
                $password = password_hash($password, PASSWORD_DEFAULT); // Hash le mot de passe

                return TRUE;
            }
            else
            {
                return 'Le mot de passe doit faire au moins 6 caractères !'; // Retourne le message d'erreur
            }
        }
        else
        {
            return 'Un membre est déja inscrit avec cette adresse E-Mail !'; // Retourne le message d'erreur
        }
    }
    else
    {
        return 'L\'adresse E-Mail saisi n\'est pas valide !'; // Retourne le message d'erreur
    }
}

// Fonction d'inscription d'un nouveau membre
function inscriptionMembre($emailAdress, $password)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    // Enregistre le nouveau membre
    $request = $bdd->prepare('INSERT INTO members(emailAdress, password, status) VALUES(:emailAdress, :password, :status)');
    $request->execute(array(
        'emailAdress' => $emailAdress,
        'password' => $password,
        'status' => 'contributeur'
    )) or die(print_r($request->errorInfo(), TRUE));

    $idNewMember = $bdd->lastInsertId(); // Récupére l'id du nouveau membre

    $_SESSION['connectionMember'] = $idNewMember; // Enregistre l'id du membre dans une session afin de le connecter automatiquement
    $_SESSION['statusMember'] = 'contributeur'; // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog

    return TRUE;
}

// Fonction de connexion d'un membre
function connexionMembre($emailAdress, $password)
{
    if(filter_var($emailAdress, FILTER_VALIDATE_EMAIL)) // Vérifie que l'adresse mail est valide
    {
        if(strlen($password) >= 6) // Vérifie que le mot de passe posséde au moins 6 caractères
        {
            $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

            $request = $bdd->prepare('SELECT id, emailAdress, password, status FROM members WHERE emailAdress = ?');
            $request->execute(array($emailAdress)) or die(print_r($request->errorInfo(), TRUE));
            $dataMember = $request->fetch();

            if($dataMember['emailAdress'] == $emailAdress) // L'adresse mail est reconnu
            {
                if(password_verify($password, $dataMember['password'])) // Vérifie si le mot de passe est correcte
                {
                    $_SESSION['connectionMember'] = $dataMember['id']; // Enregistre l'id du membre dans une session afin de le connecter automatiquement
                    $_SESSION['statusMember'] = $dataMember['status']; // On sauvegarde son statut dans une session afin de s'assurer qu'il n'accede pas à l'administration du blog

                    header('Location:index.php'); // Redirige le membre vars la page d'accueil
                }
                else
                {
                    return 'Mot de passe incorrecte !'; // Retourne le message d'erreur
                }
            }
            else
            {
                return 'Adresse E-Mail non reconnu !'; // Retourne le message d'erreur
            }
        }
        else
        {
            return 'Le mot de passe doit faire au moins 6 caractères !'; // Retourne le message d'erreur
        }
    }
    else
    {
        return 'L\'adresse E-Mail saisi n\'est pas valide !'; // Retourne le message d'erreur
    }
}

/* On cache cette partie qui pourrait servir plus tard...
// Fonction d'inscription d'un nouveau membre avec ajout d'un nouveau commentaire
function inscriptionMembre($email, $motDePasse)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->prepare('INSERT INTO membres(adresseMail, motDePasse, statut) VALUES(:adresseMail, :motDePasse, :statut)');
    $requete->execute(array(
        'adresseMail' => $email,
        'motDePasse' => $motDePasse,
        'statut' => 'contributeur'
    )) or die(print_r($requete->errorInfo(), TRUE));

    $requete = $bdd->prepare('SELECT id FROM membres WHERE adresseMail=? LIMIT 0, 1');
    $requete->execute(array($email)) or die(print_r($requete->errorInfo(), TRUE));

    $idNouveauMembre = $requete->fetchAll(); // On assemble les données reçu

    $_SESSION['connexionMembre'] = $idNouveauMembre[0]['id'];

    header('Location:index.php');
}

// Fonction de connexion d'un membre
function connexionMembre($email, $motDePasse, $commentaire, $idChapitre)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    $requete = $bdd->query('SELECT id, adresseMail, motDePasse, statut FROM membres');
    
    while($donneesMembre = $requete->fetch())
    {
        if($donneesMembre['adresseMail'] == $email)
        {
            if(password_verify($motDePasse, $donneesMembre['motDePasse']))
            {
                if($donneesMembre['statut'] == 'contributeur')
                {
                    $_SESSION['connexionMembre'] = $donneesMembre['id'];
                    
                    if(isset($commentaire)) // Si la fonction à était appelé à partir de la fonction "inscriptionMembre"
                    {
                        enregistrementCommentaire($donneesMembre['id'], $commentaire, $idChapitre); // Enregistre le commentaire dans la BDD
                    }
                    else
                    {
                        header('Location:index.php');
                    }
                }
                else
                {
                    $_SESSION['autorisationEntrer'] = $donneesMembre['id'];
                    header('Location:admin/admin_secure.php');
                }
            }
            else
            {
                return 'Vous étes déja membre, merci de saisir le mot de passe lié à l\'adresse :' . $email;
            }
        }
        else
        {
            return 'Aucun compte n\'est associé à l\'adresse E-Mail indiquer !';
        }
    }
}

// Fonction d'enregistrement d'un nouveau commentaire
function enregistrementCommentaire($idMembre, $commentaire, $idChapitre)
{
    $bdd = getBdd(); // Appel de la fonction de connexion à la BDD

    date_default_timezone_set('Europe/Monaco'); // Définit la zone pour la récupération de l'heure et de la date
    $dateHeure = date("Y-m-d H:i:s"); // Récupere la date et l'heure actuelle

    $requete = $bdd->prepare('INSERT INTO commentaires(commentaire, dateHeureAjout, idChapitre, idMembre) VALUES(:commentaire, :dateHeureAjout, :idChapitre, :idMembre)');
    $requete->execute(array(
        'commentaire' => $commentaire,
        'dateHeureAjout' => $dateHeure,
        'idChapitre' => $idChapitre, // ID du chapitre sera modifier par l'id du chapitre ou le commentaire en question sera inscrit...
        'idMembre' => $idMembre
    )) or die(print_r($requete->errorInfo(), TRUE));
}
*/