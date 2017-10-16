<?php

namespace FullStackTest\Message\Domain\Services\Command\Post;


/**
 * Class PostOneCommand
 * @package FullStackTest\Message\Domain\Services\Command\Post
 */
class PostOneCommand
{
    /** @var  null|string */
    private $message;

    /**
     * PostOneCommand constructor.
     * @param null|string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function message()
    {
        return $this->message;
    }
}