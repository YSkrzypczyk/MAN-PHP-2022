<?php
namespace App\Utils;

class View
{
    private String $template;
    private String $view;

    public function __construct(?String $template = null, ?String $view = null)
    {
        if(!is_null($template))$this->setTemplate($template);
        if(!is_null($view))$this->setView($view);
    }

    /**
     * @return String
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param String $template
     */
    public function setTemplate(string $template): void
    {
        $template = strtolower(trim($template));
        $this->template = "View/".$template.".tpl.php";
        if(!file_exists($this->template))
            die("Le template ".$this->template." n'existe pas.");
    }

    /**
     * @return String
     */
    public function getView(): ?string
    {
        return $this->view;
    }

    /**
     * @param String $view
     */
    public function setView(string $view): void
    {
        $view = strtolower(trim($view));
        $this->view = "View/".$view.".view.php";
        if(!file_exists($this->view))
            die("La vue ".$this->view." n'existe pas.");
    }

    public function __destruct()
    {
        //Afficher le template ???
        include $this->getTemplate();
    }
}