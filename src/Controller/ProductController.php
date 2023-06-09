<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_list')]
    public function index(ProductRepository $productRepository): Response
    {

        $products = $productRepository->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products,
        ]);
    }
    #[Route('/product/{id}', name: 'product_item')]
    public function item(Product $product): Response
    {      
        return $this->render('product/item.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/accueil', name: 'product_discount')]
    public function discount(ProductRepository $productRepository): Response
    {      
        $products = $productRepository->findBy(['discount' => true]);

        return $this->render('product/discount.html.twig', [
            'products' => $products
        ]);
    }
}
