# PDFFormsFiller

[![forthebadge](http://forthebadge.com/images/badges/gluten-free.svg)](http://forthebadge.com)
[![forthebadge](http://forthebadge.com/images/badges/contains-cat-gifs.svg)](http://forthebadge.com)

[![Build Status](https://travis-ci.org/Ghostfly/PDFFormsFiller.svg?branch=master)](https://travis-ci.org/Ghostfly/PDFFormsFiller)
[![Coverage Status](https://coveralls.io/repos/github/Ghostfly/PDFFormsFiller/badge.svg?branch=master)](https://coveralls.io/github/Ghostfly/PDFFormsFiller?branch=master)
[![Total Downloads](https://poser.pugx.org/ghostfly/pdf-forms-filler/downloads)](https://packagist.org/packages/ghostfly/pdf-forms-filler)
[![License](https://poser.pugx.org/ghostfly/pdf-forms-filler/license)](https://packagist.org/packages/ghostfly/pdf-forms-filler)
[![composer.lock](https://poser.pugx.org/ghostfly/pdf-forms-filler/composerlock)](https://packagist.org/packages/ghostfly/pdf-forms-filler)

Fill Acrobat forms easily using pure PHP

## Requirements
- PHP >= 7.1.0

## Install :
```
$ composer require tomi/pdf-forms-filler
```

## Example :
- clone repository
- go to example folder
- composer install
- run [index.php](https://github.com/i-Tom/PDFFormsFiller/blob/master/example/index.php)

## Usage :
You need to do a PDF Form with Acrobat, and the string to convert is given by this page :

[Find Form Field coordinates](https://www.setasign.com/products/setapdf-core/demos/find-form-field-coordinates/)

Use Converter who gives you a JSON Array containing fields with locations / page, in a form usable by the Generator

```
$converter = new Converter($string);
$converter->getPagesWithFieldsCount();
$json = $converter->formatFieldsAsJson($pages);

echo json;
```

Use PDF Generator with one array containing every field with id -> value
And one array containing every field with id -> llx, lly, urx, ury, page

```
$pdfGenerator = new PDFGenerator($coords, $data, 'P', 'pt', 'A4');
$pdfGenerator->start($original, $dest);
```

If your original PDF is not handled by fpdf, you can convert it using this service :

[Convert PDF](https://docupub.com/pdfconvert/) with "Acrobat 4.0 (PDF 1.3)"

Don't care about form fields on file to send to generator, the locations are determined using the latest PDF format. 

If you need a full example : [index.php](https://github.com/i-Tom/PDFFormsFiller/blob/master/example/index.php).

## Tests
```
$ ./vendor/bin/phpunit tests
```

## Code coverage
```
$ ./vendor/bin/phpunit tests --coverage-text --coverage-clover build/logs/clover.xml
```

Done. ;)
