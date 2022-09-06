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
        $this->template = strtolower(trim($template));
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
        $this->view = strtolower(trim($view));
    }

}