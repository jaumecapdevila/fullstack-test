<?php

namespace ApiBundle\Controller\Chat\Message;

use FullStackTest\Message\Domain\Services\Command\Post\PostOneCommand;
use FullStackTest\Message\Domain\Services\Command\Post\PostOneCommandHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostOneController extends Controller
{
    /** @var  PostOneCommandHandler */
    private $service;

    /**
     * PostOneController constructor.
     * @param PostOneCommandHandler $service
     */
    public function __construct(PostOneCommandHandler $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/messages", name="post_one_message")
     * @Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $message = (!empty($data['message'])) ? $data['message'] : null;
            $command = new PostOneCommand($message);
            ($this->service)($command);
        } catch (\Exception $e) {
            return new JsonResponse(
                ['An unexpected error has occurred. Please try it again later.'],
                500
            );
        }
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}