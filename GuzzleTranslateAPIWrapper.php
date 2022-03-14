<?php
declare(strict_types=1);

// Generic rest translation API wrapper for guzzle/http users.
interface GuzzleTranslateAPIWarpper {
    
    public function prepare_request(string $text, string $source_lang, string $target_lang);

    public function send_request(); 

    public function get_sentences(); // TODO: Return Generic respons object that implements--what?
}
