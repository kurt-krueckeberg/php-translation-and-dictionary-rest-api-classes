<?php

// generic rest translation API wrapper for guzzle/http users.
interface TranslateAPIWarpper {
    
    public function prepare_request(string $text, string $source_lang, string $target_lang);

    public function request(); 

    public function get_reponse(); // TODO: Return Generic respons object that implements--what?
}
