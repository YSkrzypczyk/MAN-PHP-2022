<?php

abstract class SQL
{
    public function save(): void
    {
        if (is_null($this->id)) {
            echo "INSERT en bdd";
        }
        else {
            echo "UPDATE en bdd";
        }
    }
}

class Page extends SQL
{
    protected ?Int $id = null;
    private String $title;
    private String $content;


    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}

class Post extends SQL
{
    protected ?Int $id = null;
    private String $title;
    private String $content;
    private Int $category;

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return Int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param Int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

}


$myPage = new Page();
$myPage->setId(2);
$myPage->setTitle("Ma super page");
$myPage->setContent("Lorem ipsum ...");
$myPage->save();


$myPost = new Post();
$myPost->setTitle("Mon super article");
$myPost->setContent("Lorem ipsum ...");
$myPost->setCategory(2);
$myPost->save();
