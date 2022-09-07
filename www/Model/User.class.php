<?php
namespace App\Model;

//use App\Interface\Model;
use App\Utils\ORM;

//implements Model
class User extends ORM
{

    protected ?Int $id = null;
    protected ?String $firstname;
    protected ?String $lastname;
    protected ?String $email;
    protected ?String $pwd;
    protected ?String $date_updated;
    protected ?String $date_inserted;

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


    public function getRegisterForm(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "id"=>"register-form",
                "class"=>"form",
                "submit"=>"S'inscrire"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "required"=>true,
                    "id"=>"firstname-input",
                    "class"=>'form-control',
                    "min"=>2,
                    "max"=>30,
                    "error"=>"Le prénom doit faire entre 2 et 30 caractères"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "required"=>true,
                    "id"=>"lastname-input",
                    "class"=>'form-control',
                    "min"=>2,
                    "max"=>60,
                    "error"=>"Le nom doit faire entre 2 et 60 caractères"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                    "id"=>"email-input",
                    "class"=>'form-control',
                    "error"=>"Format de votre email incorrect"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "id"=>"password-input",
                    "class"=>'form-control',
                    "error"=>"Votre mot de passe doit faire au minimum 8 caractères avec une minuscule, une majuscule et un chiffre"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmation",
                    "required"=>true,
                    "id"=>"passwordConfirm-input",
                    "class"=>'form-control',
                    "error"=>"Confirmation incorrect",
                    "confirm"=>"pwd"
                ],
            ]
        ];
    }

}