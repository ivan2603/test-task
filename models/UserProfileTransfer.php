<?php

class UserProfileTransfer
{
    private $login;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    /**
     * @return mixed
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstName() {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastName() {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param $login
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @param $firstname
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    /**
     * @param $lastname
     */
    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    /**
     * @param $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @param $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

}