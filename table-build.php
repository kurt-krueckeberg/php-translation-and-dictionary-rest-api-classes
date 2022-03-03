<?php

$table_start =<<<TABLE_ST
+----------------------------------------------------------------------------------------------+----------------------------------------------------------------------------------------------+
|                                                                                              |                                                                                              | 
|                                                                                              |                                                                                              | 
+==============================================================================================+==============================================================================================+
TABLE_ST;

 $arr = split($de, $length); // maximizes the number of words in column, with a starting and ending ' '.

 foreach ($arr as $part) {

    $de_td  =  '| ' . $de  . $padding;
    $end_td =  '| ' . $en  . $padding;

    echo "| $de_td | $en_td |\n"; // row contents


 }
 echo "+ $spaces | $spaces +\n"; // end of row, start of next
