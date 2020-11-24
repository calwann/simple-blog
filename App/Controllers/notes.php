<?php

use App\Core\Controller;
use App\Auth;

class Notes extends Controller
{
  public function show($id)
  {
    $note = $this->model('Note');
    $data = $note->getOne('id', $id);

    $this->view(
      'notes/show',
      $data
    );
  }

  public function new()
  {
    Auth::checkLogin();

    $msg = array();

    if (isset($_POST['post'])) {
      if (empty($_POST['title']) or empty($_POST['text'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        // codeguy/upload
        $storage = new \Upload\Storage\FileSystem('assets/uploads');
        $file = new \Upload\File('foo', $storage);

        // Optionally you can rename the file on upload
        $new_filename = uniqid();
        $file->setName($new_filename);

        // Validate file upload
        // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
        $file->addValidations(array(
          // Ensure file is of type "image/png"
          new \Upload\Validation\Mimetype(array('image/png', 'image/gif', 'image/bmp', 'image/jpeg')),

          //You can also add multi mimetype validation
          //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

          // Ensure file is no larger than 5M (use "B", "K", M", or "G")
          new \Upload\Validation\Size('20M')
        ));

        // Access data about the file that has been uploaded
        $data = array(
          'name'       => $file->getNameWithExtension(),
          'extension'  => $file->getExtension(),
          'mime'       => $file->getMimetype(),
          'size'       => $file->getSize(),
          'md5'        => $file->getMd5(),
          'dimensions' => $file->getDimensions()
        );

        // Try to upload file
        try {
          // Success!
          $file->upload();
          $msg[] = 'Upload feito com sucesso!';

          $note = $this->model('Note');
          $note->title = $_POST['title'];
          $note->text = $_POST['text'];
          $note->image = $data['name'];

          $msg[] = $note->post();
        } catch (\Exception $e) {
          // Fail!
          $errors = $file->getErrors();
          $msg[] = implode("<br>", $errors);
        }
      }
    }

    $this->view(
      'notes/new',
      $data = ['msg' => $msg]
    );
  }

  public function edit($id)
  {
    Auth::checkLogin();

    $msg = array();
    $note = $this->model('Note');

    if (isset($_POST['update'])) {
      if (empty($_POST['title']) or empty($_POST['text'])) {
        $msg[] = 'Os campos não podem ser em branco!';
      } else {
        $note->title = $_POST['title'];
        $note->text = $_POST['text'];

        $msg[] = $note->update($id);
      }
    }

    $data = $note->getOne('id', $id);

    $this->view(
      'notes/edit',
      $data = ['notes' => $data, 'msg' => $msg]
    );
  }

  public function exclude($id)
  {
    Auth::checkLogin();

    $msg = array();

    $note = $this->model('Note');

    $msg[] = $note->delete($id);

    $data = $note->get();

    $this->view(
      'home/index',
      $data = ['notes' => $data, 'msg' => $msg]
    );
  }
}
