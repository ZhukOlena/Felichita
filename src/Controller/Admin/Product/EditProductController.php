<?php

declare(strict_types=1);

namespace App\Controller\Admin\Product;

use App\Entity\Product;
use App\Form\Type\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

#[AsController]
class EditProductController
{
    public function __construct(
        private Environment $twig,
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager,
        private UrlGeneratorInterface $urlGenerator
    ){
    }

    #[Route(
        path: '/admin/products/{productId}/edit',
        name: 'admin_product_edit',
        requirements: ['productId' => '\d+']

    )]
    public function __invoke(Request $request, int $productId): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->find($productId);

        $form = $this->formFactory->create(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagePathType = $form->get('imagePath')->getData();

            $this->entityManager->persist($product);
            $this->entityManager->flush();

            $redirectUrl = $this->urlGenerator->generate('admin_product_list');

            /** @var  $session */
            $session = $request->getSession();
            $session->getFlashBag()->add('success', 'Successfuly edited product.');

            return new RedirectResponse($redirectUrl);
        }

        $content = $this->twig->render('Admin/Product/product-edit.html.twig', [
        'category_form' => $form->createView(),
        ]);

        return new Response($content);
    }
}