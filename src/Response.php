<?php 

namespace TitanII;

/**
 * Gemini Response
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

    public function __construct()
    {
    }

    public function setCode(int $code): self
    {
        if (!in_array($code, self::CODES)) {
            throw new \Exception("Not a valid Gemini response code!");
        }

        $this->code = $code;

        return $this;
    }

    public function setMeta(string $meta): self
    {
        $this->meta = $meta;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function __toString(): string
    {
        return $this->code . ' ' . $this->meta . "\r\n" . $this->content;
    }
}
