<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsController]
class RemoveProductController
{
    public function __construct (
        private EntityManagerInterface $entityManager,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    #[Route(
        path: '////admin/products/{productId}Id}/remove',
        name: 'admin_product_remove',
        requirements: ['productId' => '\d+']
    )]
    public function __invoke(Request $request, int $productId): RedirectResponse
    {
        $category = $this->entityManager->getRepository(Product::class)
            ->find($productId);

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        /** @var Session $session */
        $session = $request->getSession();
        $session->getFlashBag()->add('success', 'Successfully removed product.');

        $redirectUrl = $this->urlGenerator->generate('admin_product_list');

        return new RedirectResponse($redirectUrl);

    }
}