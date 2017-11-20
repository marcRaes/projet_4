<?php
require_once('Controler/Frontend/ControlerIndex.php');
require_once('Controler/Frontend/ControlerConnect.php');
require_once('Controler/Frontend/ControlerRegistration.php');
require_once('Controler/Frontend/ControlerDisplayTicket.php');

class Router
{
    private $_ctrlIndex;
    private $_ctrlConnect;
    private $_ctrlRegistration;
    private $_ctrlDisplayTicket;

    public function __construct()
    {
        $this->setCtrlIndex(new ControlerIndex());
        $this->setCtrlConnect(new ControlerConnect());
        $this->setCtrlRegistration(new ControlerRegistration());
        $this->setCtrlDisplayTicket(new ControlerDisplayTicket());
    }

    public function routeRequest()
    {
        try
        {
            if(isset($_GET['action'])) // Si action existe on a demander une page
            {
                if($_GET['action'] == 'ticket') // Page affichage chapitre
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST") // Un formulaire à était envoyer
                        {
                            if(isset($_POST['reportComment']) && ($_POST['reportComment'] == 'reportComment')) // Un Lecteur à signaler un commentaire
                            {
                                $_POST['idComment'] = intval($_POST['idComment']);

                                if($_POST['idComment'] != 0)
                                {
                                    // Appel la méthode de signalement d'un commentaire
                                    $this->ctrlDisplayTicket()->alertComment($_POST['idComment']);
                                }
                                else
                                {
                                    throw new Exception("Identifiant de commentaire incorrect");
                                }
                            }
                            else if(isset($_POST['publicationComment']) && ($_POST['publicationComment'] == 'publicationComment')) // Un lecteur souhaite publier un commentaire
                            {
                                if(isset($_SESSION['emailAdress']) && (isset($_SESSION['idMember'])))
                                {
                                    // Verifie que le membre existe et appel la méthode de publication d'un commentaire
                                    $this->ctrlDisplayTicket()->testMember($_POST['idTicket'], $_SESSION['emailAdress'], $_SESSION['idMember'], $_POST['comment']);
                                }
                                else {
                                    // On connecte ou on enregistre le membre et on appel la méthode de publication d'un commentaire
                                    $this->ctrlDisplayTicket()->addMemberComment($_POST['idTicket'], $_POST['emailAdress'], $_POST['password'], $_POST['comment']);
                                }
                            }
                        }

                        if(isset($_GET['id']))
                        {
                            // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
                            $_GET['id'] = intval($_GET['id']);

                            if($_GET['id'] != 0)
                            {
                                // Affichage d'un chapitre et de ses commentaires
                                $this->ctrlDisplayTicket()->displayTicket($_GET['id']);
                            }
                            else
                            {
                                throw new Exception("Identifiant de chapitre incorrect");
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'connection')
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            $this->ctrlConnect()->callConnectMember($_POST);
                        }
                        $this->ctrlConnect()->viewConnectMember();
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'registration')
                {
                    try
                    {
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            $this->ctrlRegistration()->registrationMember($_POST);
                        }
                        $this->ctrlRegistration()->viewRegistrationMember();
                    }
                    catch(Exception $e)
                    {
                        $this->error($e->getMessage());
                    }
                }
                else if($_GET['action'] == 'deconnect')
                {
                    session_destroy();

                    // Renvoie l'utilisateur sur la derniere page enregistrer
                    header("Location: $_SERVER[HTTP_REFERER]");
                }
            }
            else
            {
                $this->ctrlIndex()->callGetTickets();
            }
        }
        catch(Exception $e)
        {
            $this->error($e->getMessage());
        }
    }

    // Affiche une erreur
    private function error($msgErreur) {
        $viewError = new View("Error");
        $viewError->generate(array('msgErreur' => $msgErreur));
    }

    // Setter ctrlIndex
    public function setCtrlIndex($ctrlIndex) { $this->_ctrlIndex = $ctrlIndex; }
    // Getter ctrlIndex
    public function ctrlIndex() { return $this->_ctrlIndex; }

    // Setter ctrlConnect
    public function setCtrlConnect($ctrlConnect) { $this->_ctrlConnect = $ctrlConnect; }
    // Getter ctrlConnect
    public function ctrlConnect() { return $this->_ctrlConnect; }

    // Setter ctrlRegistration
    public function setCtrlRegistration($ctrlRegistration) { $this->_ctrlRegistration = $ctrlRegistration; }
    // Getter ctrlRegistration
    public function ctrlRegistration() { return $this->_ctrlRegistration; }

    // Setter ctrlDisplayTicket
    public function setCtrlDisplayTicket($ctrlDisplayTicket) { $this->_ctrlDisplayTicket = $ctrlDisplayTicket; }
    // Getter ctrlDisplayTicket
    public function ctrlDisplayTicket() { return $this->_ctrlDisplayTicket; }
}
