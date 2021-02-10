<?php 

namespace TitanII;

/**
 * Gemini Request
 */
class Request {
    /**
     * Maximum length in bytes of the URL request.
     */
    const MAX_LENGTH = 1024;
    
    /**
     * URL string.
     * 
     * @var string
     */
    private string $url;

    /**
     * @param string Incoming URL request. 
     */
    public function __construct(string $url)
    {
        $this->url = trim(substr($url, 0, self::MAX_LENGTH));
    }

    /**
     * Magic method. 
     */
    public function __toString(): string
    {
        return $this->url;
    }
}
