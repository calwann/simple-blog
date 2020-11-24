<?php

use App\Core\Controller;
use App\Auth;

class Users extends Controller
{
  public function new()
  {
    Auth::checkLogin();

    $msg = array();

    if (isset($_POST['post'])) {
      if (empty($_POST['name']) or empty($_POST['email']) or empty($_POST['passwd'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        $user = $this->model('User');
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

        $msg[] = $user->post();
      }
    }

    $this->view(
      'users/new',
      $data = ['msg' => $msg]
    );
  }

  public function editInfo()
  {
    Auth::checkLogin();

    $msg = array();

    if (isset($_POST['update'])) {
      if (empty($_POST['name']) or empty($_POST['email'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        $user = $this->model('User');
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];

        $msg[] = $user->updateInfo($_SESSION['userId']);
      }
    }

    $this->view(
      'users/editinfo',
      $data = ['msg' => $msg]
    );
  }

  public function editPasswd()
  {
    Auth::checkLogin();

    $msg = array();

    if (isset($_POST['update'])) {
      if (empty($_POST['passwd'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        $user = $this->model('User');
        $user->passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT);

        $msg[] = $user->updatePasswd($_SESSION['userId']);
      }
    }

    $this->view(
      'users/editpasswd',
      $data = ['msg' => $msg]
    );
  }
}
