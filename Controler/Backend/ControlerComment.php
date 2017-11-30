<?php
class ControlerComment
{
    private $_commentManager;

    // Le controleur instanciera le manager dédié aux commentaires
    public function __construct()
    {
        // Crée l'objet Manager
        $this->setCommentManager(new CommentsManager()); // Manager des commentaires
    }

    // Méthode qui envoie vers la bonne méthode pour la décision
    public function decisionComment($get)
    {
        if(isset($get['approve']) && ($get['approve'] == 'on')) // On souhaite approuver un commentaire
        {
            $this->approveComment($get);
        }
        else if(isset($get['comment']) && ($get['comment'] == "on") && (isset($get['idTicket']))) // On souhaite afficher les commentaires d'un chapitre
        {
            $this->displayCommentsTicket($get);
        }
        else if(isset($get['alertComments']) && ($get['alertComments'] == 'on')) // On souhaite afficher les commentaires signaler
        {
            $this->displayCommentsSignal();
        }
    }

    // Méthode qui affiche les commentaires d'un chapitre
    private function displayCommentsTicket($get)
    {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $get['idTicket'] = intval($get['idTicket']);

        if($get['idTicket'] != 0)
        {
            // Appel la méthode de récupération des commentaires d'un chapitre
            $comments = $this->commentManager()->getListCommentsTicket($get['idTicket']);

            // Définition du texte de la page
            if(count($comments) == 1)
            {
                $titleSection = 'Voici le commentaire pour le chapitre : <br><span>' . $comments[0]->titleTicket() . '</span>';
            }
            else if(count($comments) > 1)
            {
                $titleSection = 'Voici les commentaires pour le chapitre :<br><span>' . $comments[0]->titleTicket() . '</span>';
            }
            else // Si le nombre de commentaire et égale à 0
            {
                $titleSection = '';
            }

            // Crée l'objet de la vue
            $view = new View('Comment');

            // Appel la méthode qui génère la vue
            $view->generate(array(
                'comments' => $comments,
                'titleSection' => $titleSection
            ));
        }
        else
        {
            throw new Exception("Un identifiant contenu dans l'URL est incorrect");
        }
    }

    // Méthode qui affiche les commentaires signaler
    private function displayCommentsSignal()
    {
        // Appel la méthode de récupération des commentaires signaler
        $comments = $this->commentManager()->getListCommentsAlert();

        if(count($comments) == 1)
        {
            $titleSection = 'Vous avez ' . count($comments) . ' commentaire signaler :';
        }
        else if(count($comments) > 1)
        {
            $titleSection = 'Vous avez ' . count($comments) . ' commentaires signaler :';
        }
        else // Si le nombre de commentaire et égale à 0
        {
            header('Location:admin.php');
        }

        // Crée l'objet de la vue
        $view = new View('Comment');

        // Appel la méthode qui génère la vue
        $view->generate(array(
            'comments' => $comments,
            'titleSection' => $titleSection
        ));
    }

    // Méthode qui approuve un commentaire
    private function approveComment($get)
    {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $get['id'] = intval($get['id']);

        if($get['id'] != 0)
        {
            // Lance la méthode qui approuvera un commentaire
            $this->commentManager()->approve($get['id']);

            // On essaye de deviner à partir de quel page l'utilisateur à approuver un commentaire
            if(isset($get['alertComments']) && ($get['alertComments'] == 'on')) // Depuis l'affichage des commentaires signaler
            {
                // Retourne le nombre de commentaire signaler
                $nbCommentAlert = count($this->commentManager()->getListCommentsAlert());

                if($nbCommentAlert != 0) // Si il y'a toujours des commentaires à approuver
                {
                    // Redirection vers la page qui affichera la suite des commentaires à afficher
                    $urlRedirection = 'Location:admin.php?displayComment=comment&alertComments=on';
                    header($urlRedirection);
                }
            }
            else // Ou depuis l'affichage des commentaires d'un chapitre
            {
                // Renvoie l'utilisateur sur la derniere page visiter
                header("Location: $_SERVER[HTTP_REFERER]");
            }
        }
        else
        {
            throw new Exception("Identifiant de commentaire incorrect");
        }
    }

    public function deleteComment($idComment)
    {
        // Appel de la méthode de suppression d'un commentaire
        $this->commentManager()->delete($idComment);
    }

    // Setter commentManager
    public function setCommentManager($commentManager) { $this->_commentManager = $commentManager; }
    // Getter commentManager
    public function commentManager() { return $this->_commentManager; }
}
