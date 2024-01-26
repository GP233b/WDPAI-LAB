<?php
class User {
    private $ID;
    private $email;
    private $password;
    private $surname;
    private $name;
    private $salt;

    public function __construct(

        string $email,
        string $password,
        string $name,
        string $surname,
        string $salt,
        int $ID = null
    ) {
        $this->ID = $ID;
        $this->email = $email;
        $this->password = $password;
        $this->name= $name;
        $this->surname = $surname;
        $this->salt = $salt;

    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getID(): int
    {
        return $this->ID;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getName(): string
    {
        return $this->name;
    }


}