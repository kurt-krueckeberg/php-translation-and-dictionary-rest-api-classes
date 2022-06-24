<?php
declare(strict_types=1);
namespace LanguageTools;

/*
interface RecursiveIterator extends Iterator {

   public getChildren() : null | RecursiveIterator
   public hasChildren(): bool
   
   
   public Iterator::current(): mixed
   public Iterator::key(): mixed
   public Iterator::next(): void
   public Iterator::rewind(): void
   public Iterator::valid(): bool
}
*/

/*
   See also: https://stackoverflow.com/questions/64608440/custom-iterator-with-a-callback
 */

class PonsRecursiveIterator extends  \RecursiveIterator {

   private \ArrayObject $arr_obj;
   private \ArrayIterator $top_iter;

   private mixed $current; // current element of the hits array, the array of Pons Dictionary hits returned from calling search().

   private mixed $cur_roms;

   public function __construct(\stdClass $hits, callable $method)
   {
      $this->array_obj = new \ArrayObject($hits);

      $this->top_iter = $this->array_obj->getIterator();
   }

   public hasChildren(): bool
   {
      return ($this->current->roms != 0) ? true : false;  
   }

   public getChildren()
   {
      $this->cur_roms = $this->top_iter->current()->roms;
   } 

   public key() : int
   {
       return $this->current->key() + $this->cur_roms->key();
   }

   public rewind()
   {
       $this->top_iter->rewind();
   } 

   public next()
   {
      $this->cur_roms->next();  
   }

   public rewind()
   {
      $this->top_iter->rewind();
   } 

   public valid() : bool
   {
       return $this->cur_roms->valid();
   }
 
   public current() : \stdClass 
   {
      $current = $this->cur_roms->current();
 
      /*
         Move the PondDictionary::get_results() code here with some changes:
             
         We return only results for a single 'rom':

               ->type            of dicitonary entry: "entry" or "
               ->headword     
               ->full_headword
               ->pos             part of speech  
               ->definitions     definitions array
       */  
      $result = new \stdClass;
      
      // type of dictionary entyr. Most often "entry". If not, then the result is a translation.
      $result->type = $this->current->type;
      
      if (empty($this->cur_rom == 0))  // ??? How to handle??
          return null; 

      /*
         The [Pons documentation ](doc/pons-api.pdf) explains that each separate rom (Roamn numeral) correspondss to a part of speech:

           "For each part of speech there is one rom (roman numeral). For example "cut" may be a
            noun, adjective, interjection, transitive or intransitive verb and has the roms I to V."

          Each rom in turn has an array of arab's. Each arab stands for a specific meaning of the $rom->headword.

          Each arab contains a 'header' string and an array, 'translations', of \stdClass'es. For, say, the input word 'Abschied', the 1st
          rom's first arab:

            echo $element->roms[0]->arabs[0]->header;
          
          is
              `1. Abschied <span class="sense">(Trennung)</span>`
          
          header can contain more spans with more information. The transations array holds \stdClasses with two strings: source and target.
          target is the English translation of the source. It can contain the 'sense', 'gramatical_constructions` 'headword' or an 'example'.
          This information is in a <span>'s class, say: <span class="sense"> or <span class="example"> , etc.

          These span classes are undocumented, however!
       */
      
      $result->headword = $this->cur_rom->rom->headword; 
      
      /* rom->headword_full Contains text with <span class='...'> that give:
       * 1. the part-of-speech, which is also in rom->wordclass
       * 2. the gender, if a noun.
       */
      $result->headword_full = $this->cur_rom->headword_full; 
      
      if (isset($this->cur_rom->wordclass))  {// not sure why this isn't always set.
          
          $result->pos = $this->cur_rom->wordclass;    // Part-of-speech
      }
      
      $definitions = array();

      if (count($rom->arabs) == 0) {

          $result->definitions = $definitions;

          return $result;
      } 
      
      foreach ($rom->arabs as $arab) {
           
          if (count($arab->translations) == 0) // Sometimes there aren't definitions but something else.
              continue;

                  
           foreach($arab->translations as $translation) {
      
                $definitions[] = $translation;//strip_tags($translation->target);
           }

            $result->definitions = $definitions;
       }

       return $result; 
   }
}
