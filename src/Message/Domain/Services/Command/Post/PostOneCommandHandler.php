<?php

namespace FullStackTest\Message\Domain\Services\Command\Post;


use FullStackTest\Message\Domain\Model\Message;
use FullStackTest\Message\Domain\Model\MessageRepository;

/**
 * Class PostOneCommandHandler
 * @package FullStackTest\Message\Domain\Services\Command\Post
 */
class PostOneCommandHandler
{
    /** @var  MessageRepository */
    private $repository;

    /**
     * PostOneCommandHandler constructor.
     * @param MessageRepository $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PostOneCommand $command
     */
    public function __invoke(PostOneCommand $command)
    {
        $message = Message::fromString($command->message());
        $this->repository->save($message);
    }
}