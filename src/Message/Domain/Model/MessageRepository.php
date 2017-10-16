<?php

namespace FullStackTest\Message\Domain\Model;


interface MessageRepository
{
    public function save(Message $message);

    public function findAll(): ?array;
}