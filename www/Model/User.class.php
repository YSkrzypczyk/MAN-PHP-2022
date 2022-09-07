<?php
namespace App\Model;

use App\Interface\Model;

class User implements Model
{

    private ?Int $id;
    private ?String $firstname;
    private ?String $lastname;
    private ?String $email;
    private ?String $pwd;
    private ?String $date_updated;
    private ?String $date_inserted;

    /**
     * @return Int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param Int|null $id
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param String|null $firstname
     * @return User
     */
    public function setFirstname(?string $firstname): User
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
        return $this;
    }

    /**
     * @return String|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param String|null $lastname
     * @return User
     */
    public function setLastname(?string $lastname): User
    {
        $this->lastname = strtoupper(trim($lastname));
        return $this;
    }

    /**
     * @return String|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param String|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = strtolower(trim($email));
        return $this;
    }

    /**
     * @return String|null
     */
    public function getPwd(): ?string
    {
        return $this->pwd;
    }

    /**
     * @param String|null $pwd
     * @return User
     */
    public function setPwd(?string $pwd): User
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * @return String|null
     */
    public function getDateUpdated(): ?string
    {
        return $this->date_updated;
    }

    /**
     * @return String|null
     */
    public function getDateInserted(): ?string
    {
        return $this->date_inserted;
    }



}