<?php

declare(strict_types=1);

namespace wombat\filterphp;

use DOMDocument;

class Table
{
  public static function generate(string $html, array $data)
  {
    $document = new DOMDocument();
    @$document->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $tableRows = $document->getElementsByTagName('tr');
    foreach ($tableRows as $tableRow) {
      $itemsAttr = $tableRow->getAttribute('items');
      if (isset($data[$itemsAttr])) {
        if (is_array($data[$itemsAttr])) {
          foreach ($data[$itemsAttr] as $itemsData) {
            $newRow = $document->createElement('tr');
            $tableData = $tableRow->getElementsByTagName('td');
            foreach ($tableData as $td) {
              $columnName = $td->nodeValue;
              $newTd = $document->createElement('td');
              if (property_exists($itemsData, $columnName)) {
                $newTd->nodeValue = $itemsData->{$columnName};
              } else {
                echo "<br> $columnName is not part of the items array";
              }
              $newRow->appendChild($newTd);
            }
            $tableRow->parentNode->appendChild($newRow);
          }
          $tableRow->parentNode->removeChild($tableRow);
        } else {
          echo "The $itemsAttr must be an array.";
        }
      }
    }

    $updatedHtml = $document->saveHTML();

    return $updatedHtml;
  }
}
