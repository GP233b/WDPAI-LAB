<?php
class User {
    private $ID;
    private $email;
    private $password;

    public function __construct(
        int $ID,
        string $email,
        string $password
    ) {
        $this->ID = $ID;
        $this->email = $email;
        $this->password = $password;
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


}