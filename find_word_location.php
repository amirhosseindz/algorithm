<?php
/* 
After catching your classroom students cheating before, you realize your students are getting craftier and hiding words in 2D grids of letters. The word may start anywhere in the grid, and consecutive letters can be either immediately below or immediately to the right of the previous letter.

Given a grid and a word, write a function that returns the location of the word in the grid as a list of coordinates. If there are multiple matches, return any one.

grid1 = [
    ['c', 'c', 't', 'n', 'a', 'x'],  
    ['c', 'c', 'a', 't', 'n', 't'],  
    ['a', 'c', 'n', 'n', 't', 't'],  
    ['t', 'n', 'i', 'i', 'p', 'p'],  
    ['a', 'o', 'o', 'o', 'a', 'a'],
    ['s', 'a', 'a', 'a', 'o', 'o'],
    ['k', 'a', 'i', 'o', 'k', 'i'],
]

word1 = "catnip"
word2 = "cccc"
word3 = "s"
word4 = "ant"
word5 = "aoi"
word6 = "ki"
word7 = "aaoo"
word8 = "ooo"

grid2 = [['a']]
word9 = "a"

find_word_location(grid1, word1) => [ (1, 1), (1, 2), (1, 3), (2, 3), (3, 3), (3, 4) ]
find_word_location(grid1, word2) =>
       [(0, 0), (1, 0), (1, 1), (2, 1)]
    OR [(0, 0), (0, 1), (1, 1), (2, 1)]
find_word_location(grid1, word3) => [(5, 0)]
find_word_location(grid1, word4) => [(0, 4), (1, 4), (2, 4)] OR [(0, 4), (1, 4), (1, 5)]
find_word_location(grid1, word5) => [(4, 5), (5, 5), (6, 5)]
find_word_location(grid1, word6) => [(6, 4), (6, 5)]
find_word_location(grid1, word7) => [(5, 2), (5, 3), (5, 4), (5, 5)]
find_word_location(grid1, word8) => [(4, 1), (4, 2), (4, 3)]
find_word_location(grid2, word9) => [(0, 0)]

Complexity analysis variables:

r = number of rows
c = number of columns
w = length of the word
*/

$grid1 = [
  ['c', 'c', 't', 'n', 'a', 'x'],
  ['c', 'c', 'a', 't', 'n', 't'],
  ['a', 'c', 'n', 'n', 't', 't'],
  ['t', 'n', 'i', 'i', 'p', 'p'],
  ['a', 'o', 'o', 'o', 'a', 'a'],
  ['s', 'a', 'a', 'a', 'o', 'o'],
  ['k', 'a', 'i', 'o', 'k', 'i']
];

$word1 = "catnip";
$word2 = "cccc";
$word3 = "s";
$word4 = "ant";
$word5 = "aoi";
$word6 = "ki";
$word7 = "aaoo";
$word8 = "ooo";

$grid2 = [['a']];
$word9 = "a";

function find_word_location(array $grid, string $word): array
{
  $cordinates = [];

  $wordArr = [];
  for($wi = 0; $wi < strlen($word); $wi++) {
    $wordArr[] = $word[$wi];
    $cordinates[] = null;
  }

  $pos = 0;
  $breakPoints = [];
  $end = false;
  for($y = ($y ?? 0); $y < count($grid); $y++) {

    for($x = ($x ?? 0); $x < count($grid[$y]); $x++) {

      if(
        $wordArr[$pos] === $grid[$y][$x] && (
          !isset($wordArr[$pos+1]) || (
            $wordArr[$pos+1] === ($grid[$y+1][$x] ?? null) ||
            $wordArr[$pos+1] === ($grid[$y][$x+1] ?? null)
          )
        )
      ) {

        if($pos === 0) {
            $breakPoints[] = ['point' => [$x+1, $y], 'pos' => $pos];
        }

        $cordinates[$pos] = [$y, $x];
        $pos++;

        if(count($wordArr) === $pos) {
          $end = true;
          break;
        }

        if(($wordArr[$pos] ?? null) === ($grid[$y+1][$x] ?? null)) {
          if(($wordArr[$pos] ?? null) === ($grid[$y][$x+1] ?? null)) {
            $breakPoints[] = ['point' => [$x+1, $y], 'pos' => $pos];
          }

          break;
        }

      } else {

        if(! $breakPoints) {
          $point = [$x+1, $y];
          if($x+1 === count($grid[$y])) {
            $point = [0, $y+1];
          }

          $breakPoints[] = ['point' => $point, 'pos' => 0];
          $cordinates = [];
        }

        $breakPoint = array_pop($breakPoints);
        
        $x = $breakPoint['point'][0];
        $y = $breakPoint['point'][1]-1;
        $pos = $breakPoint['pos'];
        
        break;
      }

    }

    if($end) {
      break;
    }
  }

  return $cordinates;

}

$result = find_word_location($grid1, $word1);
echo "\n" . 'word1:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word2);
echo "\n" . 'word2:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word3);
echo "\n" . 'word3:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word4);
echo "\n" . 'word4:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word5);
echo "\n" . 'word5:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word6);
echo "\n" . 'word6:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word7);
echo "\n" . 'word7:' . "\n";
var_dump($result);

$result = find_word_location($grid1, $word8);
echo "\n" . 'word8:' . "\n";
var_dump($result);

$result = find_word_location($grid2, $word9);
echo "\n" . 'word9:' . "\n";
var_dump($result);
