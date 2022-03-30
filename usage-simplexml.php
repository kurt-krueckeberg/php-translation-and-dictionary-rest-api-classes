<?php
$xmlstr = <<<XML
<?xml version='1.0' standalone='yes'?>
<movies>
 <movie>
  <title>PHP: Behind the Parser</title>
  <characters>
   <character>
    <name>Ms. Jones</name>
    <actor>Onlivia Actora</actor>
   </character>
   <character>
    <name>Mr. Smith</name>
    <actor>El Act&#211;r</actor>
   </character>
  </characters>
  <plot>
   So, this language. It's like, a programming language. Or is it a
   scripting language? All is revealed in this thrilling horror spoof
   of a documentary.
  </plot>
  <great-lines>
   <line>PHP solves all my web problems</line>
  </great-lines>
  <rating type="thumbs">7</rating>
  <rating type="stars">5</rating>
 </movie>
 <movie>
  <title>The ICPRESS File</title>
  <characters>
   <character>
    <name>Harry Watson</name>
    <actor>Joe Cole</actor>
   </character>
   <character>
    <name>JEan Taylor</name>
    <actor>Lucy Boynton</actor>
   </character>
  </characters>
  <plot>
   IPCRESS File remake.
  </plot>
  <great-lines>
   <line>Play it again, Sam.</line>
  </great-lines>
  <rating type="thumbs">9</rating>
  <rating type="stars">4.7</rating>
 </movie>
</movies>
XML;


$movies = new SimpleXMLElement($xmlstr);

echo $movies->movie[0]->plot;

echo "\n--------------\n";

echo $movies->movie->plot;

echo $movies->movie->{'great-lines'}->line;

echo "\n--------------\n";

echo $movies->movie[1]->plot;

echo "\n--------------\n";

echo $movies->movie[1]->{'great-lines'}->line;

echo "\n--------------\n";

/* For eac <character> node, we echo a separate <name>. */
foreach ($movies->movie->characters->character as $character) {

   echo $character->name, ' played by ', $character->actor, PHP_EOL;
}

echo "\n--------------\n";

/* For eac <character> node, we echo a separate <name>. */
foreach ($movies->movie[1]->characters->character as $character) {

   echo $character->name, ' played by ', $character->actor, PHP_EOL;
}

foreach ($movies->movie[0]->rating as $rating) {
    
    switch((string) $rating['type']) { // Get attributes as element indices
    case 'thumbs':
        echo $rating, ' thumbs up';
        break;
    case 'stars':
        echo $rating, ' stars';
        break;
    }
}

echo "\n--------------\n";

foreach ($movies->xpath('//character') as $character) {
    
    echo $character->name, ' played by ', $character->actor, PHP_EOL;
}
