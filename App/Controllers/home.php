<?php

use App\Core\Controller;
use App\Auth;

class Home extends Controller
{
  public function index()
  {
    $note = $this->model('Note');
    $data = $note->get();

    $this->view(
      'home/index',
      $data = ['notes' => $data]
    );
  }

  public function search()
  {
    $search = isset($_POST['search']) ? $_POST['search'] : $_SESSION['search'];
    $_SESSION['search'] = $search;

    $note = $this->model('Note');
    $data = $note->getSearch($search);

    $this->view(
      'home/index',
      $data = ['notes' => $data]
    );
  }

  public function login()
  {
    $msg = array();

    if (isset($_POST['login'])) {
      if (empty($_POST['email']) or empty($_POST['passwd'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        $msg[] = Auth::Login($email, $passwd);
        //header('Location: /home/index');
      }
    }

    $this->view(
      'home/login',
      $data = ['msg' => $msg]
    );
  }

  public function logout()
  {
    Auth::logout();

    $this->index();
  }
}
