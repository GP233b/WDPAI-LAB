<?php
require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE usr_email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(

            $user['usr_email'],
            $user['usr_password'],
            $user['usr_name'],
            $user['usr_surname'],
            $user['usr_salt'],
            $user['usr_id']
        );
    }
    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users(usr_email ,usr_password , usr_name,usr_surname,usr_salt) VALUES (?,?,?,?,?)
        ');
        $stmt->execute([$user->getEmail() , $user->getPassword(), $user->getName(), $user->getSurname(),  $user->getSalt()]);


    }
}