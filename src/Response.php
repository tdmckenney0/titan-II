<?php 

namespace TitanII;

/**
 * Gemini Response
 * 
 * @see gemini://gemini.circumlunar.space/docs/specification.gmi
 */
class Response {
    /**
     * Valid Response Codes
     */
    const CODES = [10, 11, 20, 30, 31, 40, 41, 42, 43, 44, 50, 51, 52, 53, 59, 60, 61, 62];

    /**
     * Response Code
     * 
     * @var int 
     */
    private int $code = 20;

    /**
     * Meta Data
     * 
     * @var string
     */
    private string $meta = "application/octet-stream";

    /**
     * Body Content. 
     * 
     * @var string
     */
    private string $content = "";

    /**
     * Set the Response code. 
     *  
     * @param int Code.
     * 
     * @return self Method chaining.
     * 
     * @throws Exception If not a valid code. 
     */
    public function setCode(int $code): self
    {
        if (!in_array($code, self::CODES)) {
            throw new \Exception("Not a valid Gemini response code!");
        }

        $this->code = $code;

        return $this;
    }

    /**
     * Get the Response Code
     * 
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * Set Meta Data
     * 
     * @param string
     * 
     * @return self Method chaining.
     */
    public function setMeta(string $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * Get the Response Meta
     * 
     * @return string
     */
    public function getMeta(): string
    {
        return $this->meta;
    }

    /**
     * Set the Response content. 
     * 
     * @param string 
     * 
     * @return self Method chaining.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get the Response content
     * 
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Magic Method
     */
    public function __toString(): string
    {
        return $this->code . ' ' . $this->meta . "\r\n" . $this->content;
    }
}
