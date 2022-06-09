<?php
declare(strict_types=1);
namespace LanguageTools;

// SeeDeepl-doc.md 
class iTransTranslator extends RestClient implements TranslateInterface {
   
   static $trans = array('method' => 'POST', 'route' => "");

   static $languages = [
[ "language" => "af", "name" => "Afrikaans"],
[ "language" => "sq", "name" => "Albanian"],
[ "language" => "ar", "name" => "Arabic"],
[ "language" => "az", "name" => "Azerbaijani"],
[ "language" => "bn", "name" => "Bengali"],
[ "language" => "bs", "name" => "Bosnian"],
[ "language" => "bg", "name" => "Bulgarian"],
[ "language" => "my", "name" => "Burmese"],
[ "language" => "zh-CN", "name" => "Chinese (Simplified)"],
[ "language" => "zh-TW", "name" => "Chinese (Traditional)"],
[ "language" => "hr", "name" => "Croatian"],
[ "language" => "cs", "name" => "Czech"],
[ "language" => "da", "name" => "Danish"],
[ "language" => "nl", "name" => "Dutch"],
[ "language" => "en", "name" => "English"],
[ "language" => "et", "name" => "Estonian"],
[ "language" => "fa", "name" => "Farsi/Persian"],
[ "language" => "fi", "name" => "Finnish"],
[ "language" => "fr", "name" => "French"],
[ "language" => "ka", "name" => "Georgian"],
[ "language" => "de", "name" => "German"],
[ "language" => "el", "name" => "Greek"],
[ "language" => "he", "name" => "Hebrew"],
[ "language" => "hi", "name" => "Hindi"],
[ "language" => "hu", "name" => "Hungarian"],
[ "language" => "is", "name" => "Icelandic"],
[ "language" => "id", "name" => "Indonesian"],
[ "language" => "it", "name" => "Italian"],
[ "language" => "ja", "name" => "Japanese"],
[ "language" => "ko", "name" => "Korean"],
[ "language" => "lv", "name" => "Latvian"],
[ "language" => "lt", "name" => "Lithuanian"],
[ "language" => "mk", "name" => "Macedonian"],
[ "language" => "ms", "name" => "Malay"],
[ "language" => "mn", "name" => "Mongolian"],
[ "language" => "ne", "name" => "Nepali"],
[ "language" => "no", "name" => "Norwegian"],
[ "language" => "pl", "name" => "Polish"],
[ "language" => "pt-BR", "name" => "Portuguese (Brazil)"],
[ "language" => "pt-PT", "name" => "Portuguese (Portugal)"],
[ "language" => "ro", "name" => "Romanian"],
[ "language" => "ru", "name" => "Russian"],
[ "language" => "sr", "name" => "Serbian"],
[ "language" => "sk", "name" => "Slovakian"],
[ "language" => "sl", "name" => "Slovenian"],
[ "language" => "so", "name" => "Somali"],
[ "language" => "es", "name" => "Spanish"],
[ "language" => "sw", "name" => "Swahili"],
[ "language" => "sv", "name" => "Swedish"],
[ "language" => "tl", "name" => "Tagalog"],
[ "language" => "ta", "name" => "Tamil"],
[ "language" => "th", "name" => "Thai"],
[ "language" => "tr", "name" => "Turkish"],
[ "language" => "uk", "name" => "Ukrainian"],
[ "language" => "ur", "name" => "Urdu"],
[ "language" => "vi", "name" => "Vietnamese"] ];

   public function __construct(ClassID $id)
   {   
      parent::__construct($id);
   }

   final public function getTranslationLanguages() : array
   {
       return self::$languages;
   } 

   final public function translate(string $input, string $dest, $src="") : string 
   {
       $json = [ 'source' => ['dialect' => $src, 'text' => $input], 'target' => ['dialect' => $dest] ];

       $contents = $this->request(self::$trans['method'],self::$trans['route'], ['json' => $json]); 

       $obj = json_decode($contents);

       return $obj->target->text;
   }
}
