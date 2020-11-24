<?php

namespace App;

use App\Core\Model;

class Auth
{
  public static function login($email, $passwd)
  {
    $sql = 'SELECT * FROM users WHERE email = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $email, \PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = $stmt->fetch(\PDO::FETCH_ASSOC);
      if (password_verify($passwd, $response['passwd'])) {
        $_SESSION['logged'] = true;
        $_SESSION['userId'] = $response['id'];
        $_SESSION['userName'] = $response['name'];
        $_SESSION['userEmail'] = $response['email'];
        return "Acesso realizado!";
      } else {
        return "Senha inválida!";
      }
    } else {
      return "Email inválido!";
    }
  }

  public static function loginUpdated()
  {
    self::checkLogin();

    $sql = 'SELECT * FROM users WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $_SESSION['userId'], \PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = $stmt->fetch(\PDO::FETCH_ASSOC);
      $_SESSION['userName'] = $response['name'];
      $_SESSION['userEmail'] = $response['email'];
      return "Informações atualizadas!";
    } else {
      return "ID inválido!";
    }
  }

  public static function logout()
  {
    session_destroy();
    header('Location: /home/index');
    exit;
  }

  public static function checkLogin()
  {
    if (!isset($_SESSION['logged'])) {
      session_destroy();
      header('Location: /home/index');
      exit;
    }
  }
}
