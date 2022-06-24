<?php
declare(strict_types=1);
namespace LanguageTools;

/*
  Since Pons Dictionary often return results when there are related words, an array ofr more than one PonsDictResult 
  may be returned by PonsDictionary::search(string $input_word, string $src_lang, string $dest_trag).
   
 */

class  PonseDictResult {

   //  type most often is "entry", meaning dictionary entry. May be "entry_with_secondary_entries" translation.
   public readonly string $type;             
   
  // The headword is usually the word you would lookup in a printed dictionary.
  
   public readonly string $headword; 

   /*
   headword_full may include additional information, such as phonetics, gender, etc. .
   For each part of speech there is one rom (roman numeral). For example "cut" may be a
   noun, adjective, interjection, transitive or intransitive verb and has the roms I to V.

   The the gender (if a noun) is contained within <span> tags:
        <span class='...'>...</span>
    */
   public readonly string $headword_full; 

   // pos is the part of speech: noun, verb, adjective, etc
   public readonly string $pos;             

   public readonly array  $definitions; 

   public function __construct(public readonly string $type, public readonly string $headword, public readonly string $headword_full, public readonly string $pos, public readonly array  $definitions) {}
}
