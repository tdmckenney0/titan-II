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

    public function __construct(string $url)
    {
        $this->url = substr($url, 0, self::MAX_LENGTH);
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
