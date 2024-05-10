<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserProfileTransfer;

class UserController extends BaseController {

    private UserModel $user;
    private UserProfileTransfer $userProfile;

    /**
     * UserController constructor.
     */
    public function __construct() {
        $this->user = new UserModel();
        $this->userProfile = new UserProfileTransfer;
    }

    /**
     * Action Index
     */
    public function actionIndex() {
        require_once (ROOT.'/app/views/user/index.php');
    }

    /**
     * Action register user
     */
    public function actionRegister() {
        session_start();
        if (isset($_POST) && !empty($_POST)) {
            $status = 'Error';

            if (isset($_POST['login']) && !empty($_POST['login'])
                && isset($_POST['firstname']) && !empty($_POST['firstname'])
                && isset($_POST['lastname']) && !empty($_POST['lastname'])
                && isset($_POST['email']) && !empty($_POST['email'])
                && isset($_POST['password']) && !empty($_POST['password'])
            ) {
                $login = trim($_POST['login']);
                $firstname = trim($_POST['lastname']);
                $lastname = trim($_POST['lastname']);
                $email = trim($_POST['email']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $this->userProfile->setLogin($login);
                $this->userProfile->setFirstname($firstname);
                $this->userProfile->setLastName($lastname);
                $this->userProfile->setEmail($email);
                $this->userProfile->setPassword($password);

                $status = $this->user->register($this->userProfile);
            }
            if ($status === '') {
                $this->redirect('/user/login');
            } else {
                $this->redirect('/user/register');
            }
        }
        if (isset($_SESSION['user']['role']) && !empty($_SESSION['user']['role'])) {
            $this->redirect('/vehicle/list');
        }
        require_once (ROOT.'/app/views/user/register.php');
    }

    /**
     * Action login user
     */
    public function actionLogin() {
        session_start();

        if (isset($_POST) && !empty($_POST)) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $user = $this->user->login($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user']['login'] = $user['login'];
                $_SESSION['user']['role'] = $user['role'];

            }
            if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
                $this->redirect('/user/register');
            }
        }
        if (isset($_SESSION['user']['role']) && !empty($_SESSION['user']['role'])) {
            $this->redirect('/vehicle/list');
        }

        require_once (ROOT.'/app/views/user/login.php');
    }

    /**
     * Action logout user
     */
    public function actionLogout() {
        session_start();
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $this->redirect('/');
    }
}