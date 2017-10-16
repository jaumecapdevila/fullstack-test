<?php

namespace FullStackTest\Message\Infrastructure;


use FullStackTest\Message\Domain\Model\Message;
use FullStackTest\Message\Domain\Model\MessageRepository;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class InSessionMessageRepository
 * @package FullStackTest\Message\Infrastructure
 */
class InSessionMessageRepository implements MessageRepository
{
    /** @var  Session */
    private $session;

    /**
     * InSessionMessageRepository constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param Message $message
     */
    public function save(Message $message)
    {
        if (empty($this->session->get('messages'))) {
            $this->session->set('messages', [$message->get()]);
            return;
        }
        $messages = $this->session->get('messages');
        array_push($messages, $message->get());
        $this->session->set('messages', $messages);
    }

    /**
     * @return array|null
     */
    public function findAll(): ?array
    {
        return $this->session->get('messages');
    }
}