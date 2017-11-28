<?php
require_once('Controler/Backend/ControlerAdminSecure.php'); // Instancie le controleur qui controle l'accés à l'administration du blog
require_once('Controler/Backend/ControlerAdmin.php'); // Instancie le controleur de la page d'accueil de l'administration du blog
require_once('Controler/Backend/ControlerTicket.php'); // Instancie le controleur des chapitres
require_once('Controler/Backend/ControlerComment.php'); // Instancie le controleur des commentaires
require_once('View/Backend/View.php'); // Instancie le controleur de la vue

class Router
{
    private $_ctrlAdminSecure;
    private $_ctrlAdmin;
    private $_ctrlTicket;
    private $_ctrlComment;

    public function __construct()
    {
        // Crée les different objets Controler
        $this->setCtrlAdminSecure(new ControlerAdminSecure());
        $this->setCtrlAdmin(new ControlerAdmin());
        $this->setCtrlTicket(new ControlerTicket());
        $this->setCtrlComment(new ControlerComment());
    }

    public function routeRequest()
    {
        // Vérifie si un membre est connecter et si il a le bon statut pour administrer le blog
        if(isset($_SESSION['statusMember']) && ($_SESSION['statusMember'] == 'administrateur'))
        {
            // Lance une méthode de reconnection du membre avec vérification de la session enregistrer
            if($this->ctrlAdminSecure()->autorizationEnter($_SESSION))
            {
                // Appel des fonctions et insertion du fichier "vueAdmin.php" avec une gestion des erreurs
                try
                {
                    if(isset($_GET['action']))
                    {
                        if($_GET['action'] == 'ticket') // Affiche le formulaire d'ajout ou de modification d'un chapitre
                        {
                            if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire à était envoyer
                            {
                                if(trim($_POST['titleTicket']) && (trim($_POST['contentTicket'])))
                                {
                                    $this->ctrlTicket()->decisionTicket($_POST);
                                }
                            }
                            $this->ctrlTicket()->ticket($_GET);
                        }
                        else if($_GET['action'] == 'comment') // Affiche les commentaires
                        {
                            $this->ctrlComment()->decisionComment($_GET);
                        }
                        else if($_GET['action'] == 'delete') // Permet de supprimer un chapitre ou un commentaire
                        {
                            if(isset($_GET['deleteComment']) && (isset($_GET['idComment'])) && ($_GET['deleteComment'] == 'on')) // Suppression d'un commentaire
                            {
                                $_GET['idComment'] = intval($_GET['idComment']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

                                if($_GET['idComment'] != 0)
                                {
                                    $this->ctrlComment()->deleteComment($_GET['idComment']);

                                    // Renvoie l'utilisateur sur la derniere page enregistrer
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                                else
                                {
                                    throw new Exception("Identifiant de commentaire incorrect");
                                }
                            }
                            else if(isset($_GET['deleteTicket']) && (isset($_GET['idTicket'])) && ($_GET['deleteTicket'] == 'on')) // Suppresion d'un chapitre
                            {
                                $_GET['idTicket'] = intval($_GET['idTicket']); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

                                if($_GET['idTicket'] != 0)
                                {
                                    // Méthode de suppression d'un chapitre
                                    $this->ctrlAdmin()->deleteTicket($_GET['idTicket']);

                                    // Renvoie l'utilisateur sur la derniere page enregistrer
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                                else
                                {
                                    throw new Exception("Identifiant de chapitre incorrect");
                                }
                            }

                            if($_SERVER["REQUEST_METHOD"] == "POST")
                            {
                                if(isset($_POST['deleteTicket']) && (isset($_POST['idTicket'])) && (is_array($_POST['idTicket'])) && ($_POST['deleteTicket'] == 'on')) // Suppresion de plusieurs chapitres
                                {
                                    for($i = 0; $i < count($_POST['idTicket']); $i++)
                                    {
                                        $_POST['idTicket'][$i] = intval($_POST['idTicket'][$i]); // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec

                                        if($_POST['idTicket'][$i] != 0) // La fonction de suppression est appelé autant de fois qu'il y'a de chapitres
                                        {
                                            // Méthode de suppression d'un chapitre
                                            $this->ctrlAdmin()->deleteTicket($_POST['idTicket'][$i]);
                                        }
                                        else
                                        {
                                            throw new Exception("Identifiant de chapitre incorrect");
                                        }
                                    }

                                    // Renvoie l'utilisateur sur la derniere page enregistrer
                                    header("Location: $_SERVER[HTTP_REFERER]");
                                }
                            }
                        }
                    }
                    else
                    {
                        $this->ctrlAdmin()->accueilAdmin();
                    }
                }
                catch(Exception $e)
                {
                    $this->error($e->getMessage());
                }
            }
        }
        else // L'autorisation n'a pas était approuver on affiche le formulaire de connexion de l'administration
        {
            try
            {
                if($_SERVER["REQUEST_METHOD"] == "POST") // Si le formulaire de connexion à était envoyer
                {
                    if(trim($_POST['emailAdress']) && (trim($_POST['password'])))
                    {
                        $_SESSION['errorAdmin'] = $this->ctrlAdminSecure()->connectAdmin($_POST['emailAdress'], $_POST['password']);
                    }
                }
                $this->ctrlAdminSecure()->adminSecure();
            }
            catch (Exception $e)
            {
                $this->error($e->getMessage());
            }
        }
    }

    // Affiche une erreur
    private function error($msgErreur) {
        $viewError = new View("Error");
        $viewError->generate(array('msgErreur' => $msgErreur));
    }

    // Setter ctrlAdminSecure
    public function setCtrlAdminSecure($ctrlAdminSecure) { $this->_ctrlAdminSecure = $ctrlAdminSecure; }
    // Getter ctrlAdminSecure
    public function ctrlAdminSecure() { return $this->_ctrlAdminSecure; }

    // Setter ctrlAdmin
    public function setCtrlAdmin($ctrlAdmin) { $this->_ctrlAdmin = $ctrlAdmin; }
    // Getter ctrlAdmin
    public function ctrlAdmin() { return $this->_ctrlAdmin; }

    // Setter ctrlTicket
    public function setCtrlTicket($ctrlTicket) { $this->_ctrlTicket = $ctrlTicket; }
    // Getter ctrlTicket
    public function ctrlTicket() { return $this->_ctrlTicket; }

    // Setter ctrlComment
    public function setCtrlComment($ctrlComment) { $this->_ctrlComment = $ctrlComment; }
    // Getter ctrlTicket
    public function ctrlComment() { return $this->_ctrlComment; }
}
