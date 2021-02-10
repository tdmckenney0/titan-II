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

    /**
     * Get the Hostname. 
     * 
     * @return string|null
     */
    public function getHost(): ?string
    {
        return parse_url($this->url, PHP_URL_HOST);
    }

    /**
     * Get the Path. 
     * 
     * @return string|null
     */
    public function getPath(): ?string
    {
        return parse_url($this->url, PHP_URL_PATH);
    }

    /**
     * Get the path, but as an array.
     * 
     * @return array
     */
    public function tokenizePath(): array
    {
        $path = trim(trim($this->getPath()), '/');

        return explode('/', $path);
    }

    /**
     * Get the Query. 
     * 
     * @return string|null
     */
    public function getQuery(): ?string
    {
        return parse_url($this->url, PHP_URL_QUERY);
    }
}
