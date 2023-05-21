<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    #[Route(
        path: '/'
    )]

    public function handleAction(): Response
    {
        return new Response ('Hello Vitalii');
    }
}