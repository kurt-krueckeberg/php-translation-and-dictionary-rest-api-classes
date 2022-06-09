<?php
declare(strict_types=1);
namespace LanguageTools;

class FileReader extends \SplFileObject  {

   public function __construct(string $fname)
   {
       parent::__construct($fname, "r");
       $this->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
   }
}
