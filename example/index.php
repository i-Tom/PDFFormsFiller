<?php
/** @noinspection DuplicatedCode */
require __DIR__ . '/vendor/autoload.php';

use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use FormFiller\PDF\PDFGenerator;

$string = "3 widget annotations found on page 1.
----------------------------------------------

cat_name: 
     llx: 278.585
     lly: 363.377
     urx: 428.585
     ury: 386.902
   width: 150
  height: 23.525


reward: 
     llx: 366.262
     lly: 297.106
     urx: 555.914
     ury: 314.53
   width: 189.652
  height: 17.424


phone: 
     llx: 365.753
     lly: 250.59
     urx: 555.406
     ury: 268.523
   width: 189.653
  height: 17.933
";


$converter = new Converter($string);
$converter->loadPagesWithFieldsCount();
$coords = $converter->formatFieldsAsJSON();

$fields = json_decode($coords, true);

$fieldEntities = [];

foreach($fields as $field) {
    try {
        $fieldEntities[] = Field::fieldFromArray($field);
    } catch (Exception $e) {
        echo "page undefined for field" . $field;
    }
}

$data = [
  'cat_name'    => [
      "size"  => 67,
      'family'  => 'Helvetica',
      "style" => 'B',
      'value' => 'Mickey'
  ],
  'reward' => [
      "size"  => 28,
      'family'  => 'Arial',
      "style" => 'B',
      'value' => '2 beers'
  ],
  'phone' => [
      "size"  => 24,
      'family'  => 'Helvetica',
      "style" => 'B',
      'value' => "+3361265656565"
  ],
];

$original = getcwd() . "/FormAcrobat13.pdf";
$dest = getcwd() . "/FormFilled.pdf";

$pdfGenerator = new PDFGenerator($fieldEntities, $data, 'P', 'pt', 'A4');

try {
    $pdfGenerator->start($original, $dest);
} catch (Exception $e) {
    echo "error" . $e;
    die();
}

echo "done";

