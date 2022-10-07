<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

/*
$source = 'en';
$target = 'fr';
$text = 'Hello World!';
$trans = new GoogleTranslate();
$result = $trans->translate($source, $target, $text);
// Good morning
echo $result. " ";



$text = 'My tailor is rich and Alison is in the kitchen with Bob.';
$detector = new LanguageDetector\LanguageDetector();
$language = $detector->evaluate($text)->getLanguage();
echo $language; // Prints something like 'en'
*/

function getLanguage($text){
    $detector = new LanguageDetector\LanguageDetector();
    $language = $detector->evaluate($text)->getLanguage();
    return $language;
}

function translate($text, $target){
    $source = getLanguage($text);
    $trans = new GoogleTranslate();
    $result = $trans->translate($source, $target, $text);
    return $result. " ";
    
}
?>