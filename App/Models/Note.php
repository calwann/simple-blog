<?php

use App\Core\Model;

class Note extends Model
{
  public $title;
  public $text;
  public $image;

  public function post()
  {
    $sql = 'INSERT INTO notes (title, text, image) VALUES (?, ?, ?)';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->title, \PDO::PARAM_STR);
    $stmt->bindValue(2, $this->text, \PDO::PARAM_STR);
    $stmt->bindValue(3, $this->image, \PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "Cadastrado com sucesso!";
    } else {
      return "Erro ao cadastrar!";
    }
  }

  public function get($attr = '')
  {
    if ($attr == '') {
      $sql = 'SELECT * FROM notes';

      $stmt = Model::getConn()->prepare($sql);

      $stmt->execute();
    } else {
      $sql = 'SELECT id, ' . $attr . ' FROM notes';

      $stmt = Model::getConn()->prepare($sql);

      $stmt->execute();
    }

    if ($stmt->rowCount() > 0) {
      $response = $stmt->fetchALL(\PDO::FETCH_ASSOC);

      return $response;
    } else {
      return [];
    }
  }

  public function getOne($attr, $value)
  {
    $sql = 'SELECT * FROM notes WHERE ' . $attr . ' = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $value, \PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = $stmt->fetch(\PDO::FETCH_ASSOC);

      return $response;
    } else {
      return [];
    }
  }

  public function getSearch($value)
  {
    $sql = 'SELECT * FROM notes WHERE title LIKE ? COLLATE utf8_general_ci';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, "%{$value}%", \PDO::PARAM_STR); // Busca precisa de %{ ... }%

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $response;
    } else {
      return [];
    }
  }

  public function update($id)
  {
    $sql = 'UPDATE notes SET title = ?, text = ? WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $this->title, \PDO::PARAM_STR);
    $stmt->bindValue(2, $this->text, \PDO::PARAM_STR);
    $stmt->bindValue(3, $id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "Atualizado com sucesso!";
    } else {
      return "Erro ao Atualizar!";
    }
  }

  public function delete($id)
  {
    $getImage = $this->getOne('id', $id);
    if (!empty($getImage['image'])) {
      unlink("assets/uploads/" . $getImage['image']);
    }

    $sql = 'DELETE FROM notes WHERE id = ?';

    $stmt = Model::getConn()->prepare($sql);
    $stmt->bindValue(1, $id, \PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "Deletado com sucesso!";
    } else {
      return "Erro ao deletar!";
    }
  }
}
