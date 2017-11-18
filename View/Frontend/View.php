<?php
class View
{
    // Attribut qui contiendra le nom du fichier associé à la vue
    private $_file;
    // Attribut du titre de la vue
    private $_title;

    // Le constructeur déterminera le nom du fichier vue à partir de l'action
    public function __construct($action)
    {
        $this->setFile("View/Frontend/View" . $action . ".php");
    }

    // Méthode qui génére et affiche la vue
    public function generate($data)
    {
        // Génére la partie spécifique de la vue
        $content = $this->generateFile($this->file(), $data);

        // Génere le gabarit commun
        $view = $this->generateFile('View/Frontend/Template.php', array(
            'title' => $this->title(),
            'content' => $content
        ));

        // Renvoi la vue au navigateur
        echo $view;
    }

    // Méthode qui génere le fichier vue et renvoie le résultat
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            // Les élements du tableau $data seront accessible dans la vue
            extract($data);

            // Démarre la temporisation
            ob_start();
            // Fichier vue
            require $file;
            // Arrête et renvoie la temporisation
            return ob_get_clean();
        }
        else {
            throw new Exception('Fichier ' . $file . ' introuvale');
        }
    }

    // Setter du titre
    public function setTitle($title) { $this->_title = $title; }
    // Getter du titre
    public function title() { return $this->_title; }

    // Setter file
    public function setFile($file) { $this->_file = $file; }
    // Getter file
    public function file() { return $this->_file; }
}
