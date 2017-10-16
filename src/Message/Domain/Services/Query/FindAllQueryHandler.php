<?php

namespace FullStackTest\Message\Domain\Services\Query;


use FullStackTest\Message\Domain\Model\MessageRepository;

/**
 * Class FindAllQueryHandler
 * @package FullStackTest\Message\Domain\Services\Query
 */
class FindAllQueryHandler
{
    /** @var  MessageRepository */
    private $repository;

    /**
     * FindAllQueryHandler constructor.
     * @param MessageRepository $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return array|null
     */
    public function __invoke()
    {
        try {
            return $this->repository->findAll();
        } catch (\Exception $exception) {
            return [];
        }
    }
}