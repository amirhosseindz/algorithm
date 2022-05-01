<?php

function find_embedded_word(array $words, string $string): ?string
{
  $stringArr = [];
  for($i = 0; $i < strlen($string); $i++) {
    $char = $string[$i];
    $stringArr[$char] = ($stringArr[$char] ?? 0) + 1;
  }

  foreach($words as $word) {
    $wordArr = [];
    for($i = 0; $i < strlen($word); $i++) {
      $char = $word[$i];
      $wordArr[$char] = ($wordArr[$char] ?? 0) + 1;
    }

    $has = true;
    foreach($wordArr as $char => $num) {
      if(isset($stringArr[$char]) && $num <= $stringArr[$char]) {
        continue;
      }

      $has = false;
      break;
    }

    if($has) {
      return $word;
    }
  }

  return null;
}
