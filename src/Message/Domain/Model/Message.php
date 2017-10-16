<?php

namespace FullStackTest\Message\Domain\Model;


/**
 * Class Message
 * @package FullStackTest\Message\Domain
 */
/**
 * Class Message
 * @package FullStackTest\Message\Domain
 */
class Message
{
    /** @var  string */
    private $value;

    /**
     * Message constructor.
     * @param string $value
     */
    private function __construct($value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException(sprintf('The message %s is not valid.', $value));
        }
        $this->value = $value;
    }

    /**
     * @param string $value
     * @return Message
     */
    public static function fromString(string $value): Message
    {
        return new self($value);
    }

    /**
     * @param $value
     * @return bool
     */
    public function equals($value): bool
    {
        if (!is_object($value) || !(is_object($value) && $value instanceof self)) {
            return false;
        }
        return $value->get() === $this->get();
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->value;
    }
}