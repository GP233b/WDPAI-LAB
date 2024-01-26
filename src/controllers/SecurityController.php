<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {


    public function login()
    {

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);


        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }


        if (!$this->verifyPassword($password,$user->getPassword(),$user->getSalt())) {

            return $this->render('login', ['messages' => ['Wrong password!']]);
        }



        $idUser = $user->getID();
        $url = "http://$_SERVER[HTTP_HOST]/home?idUser=$idUser";
        header("Location: $url");
        exit();
    }

    public function register()
    {

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }

        $options = [
            'cost' => 13,
        ];
        $salt = password_hash(random_bytes(22), PASSWORD_BCRYPT, $options);


        $hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT, $options);


        $user = new User($email, $hashedPassword, $name, $surname,$salt);


        $userRepository->addUser($user);





        return $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
    }


    function verifyPassword($userInputPassword, $storedHashedPassword, $storedSalt) {

        $combinedPassword = $userInputPassword . $storedSalt;


        return password_verify($combinedPassword, $storedHashedPassword);
    }


}