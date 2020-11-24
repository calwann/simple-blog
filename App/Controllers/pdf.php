<?php

use App\Core\Controller;

use Dompdf\Dompdf;

class pdf extends Controller
{
  public function index()
  {
    header('Location: /');
  }

  public function file($file, $extension)
  {
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    ob_start();
    require "assets/pdf/" . $file . "." . $extension;
    $dompdf->loadHtml(ob_get_clean());

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('Nome do Arquivo PDF', ["Attachment" => false]);
  }
}
