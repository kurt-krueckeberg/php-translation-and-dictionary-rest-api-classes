<?php


 foreach ($file as $line) {
   if (strpos($line, "%table%") === 0)  
		 
/* 
 * Append to .css file:
 * div.table-col-percent-p1-p2-p3-etc table {
    }
 * 
 *
 *
 */
   add_css(); 
   add_div(); // <div class="table-x%-y%-z%-etc"> 
             
 }
