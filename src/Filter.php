<?php

declare(strict_types=1);

namespace FilterPHP;

use DOMDocument;

class Filter
{
  public static function filter(string $html, array $data): string
  {
    $filterHTML = new HTMLFilter;
    $filterCSS = new CSSFilter;

    // Run the HTML trough the filters
    $html = $filterHTML->filter($html, $data);
    $html = $filterCSS->filter($html);

    // return the filtered html
    return $html;
  }
}
