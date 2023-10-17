<?php

declare(strict_types=1);

namespace Wombat\Filterphp;

class HTMLFilter
{
  public static function filter(string $html, array $data): string
  {
    $filteredHtml = Table::generate($html, $data);
    return $filteredHtml;
  }
}
