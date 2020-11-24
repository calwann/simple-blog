<?php

use App\Core\Model;
use App\Auth;

class User extends Model
{
  public $name;
  public $email;
  public $passwd;

  public function post()
  {
    $sql = 'INSERT INTO users (name, email, passwd) VALUES (?, ?, ?)';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->name, \PDO::PARAM_STR);
    $stmt->bindValue(2, $this->email, \PDO::PARAM_STR);
    $stmt->bindValue(3, $this->passwd, \PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "Cadastrado com sucesso!";
    } else {
      return "Erro ao cadastrar!";
    }
  }

  public function updateInfo($id)
  {
    $sql = 'UPDATE users SET name = ?, email = ? WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->name, \PDO::PARAM_STR);
    $stmt->bindValue(2, $this->email, \PDO::PARAM_STR);
    $stmt->bindValue(3, $id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
      Auth::loginUpdated();
      return "Atualizado com sucesso!";
    } else {
      return "Erro ao Atualizar!";
    }
  }

  public function updatePasswd($id)
  {
    $sql = 'UPDATE users SET passwd = ? WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->passwd, \PDO::PARAM_STR);
    $stmt->bindValue(2, $id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
      Auth::loginUpdated();
      return "Atualizado com sucesso!";
    } else {
      return "Erro ao Atualizar!";
    }
  }
  /*
  public function delete($id)
  {
    $sql = 'DELETE FROM notes WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "Deletado com sucesso!";
    } else {
      return "Erro ao deletar!";
    }
  }*/
}
