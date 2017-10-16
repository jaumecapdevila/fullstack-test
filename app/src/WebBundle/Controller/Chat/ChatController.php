<?php

namespace WebBundle\Controller\Chat;

use FullStackTest\Message\Domain\Model\Message;
use FullStackTest\Message\Domain\Model\MessageRepository;
use FullStackTest\Message\Domain\Services\Query\FindAllQueryHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends Controller
{
    /** @var  FindAllQueryHandler */
    private $service;

    /**
     * ChatController constructor.
     * @param FindAllQueryHandler $service
     */
    public function __construct(FindAllQueryHandler $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/chat", name="homepage")
     * @Method({"GET"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $messages = ($this->service)();
        return $this->render('WebBundle::chat.html.twig', ['messages' => $messages]);
    }
}