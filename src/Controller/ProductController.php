<?php

namespace App\Controller;

use Faker;
use App\Entity\Product;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("products", name="products_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="add", methods={"POST"})
     */
    public function add(Request $request,EntityManagerInterface $entitymanager)
    {
        $product = new Product();
        $faker = Faker\Factory::create();
        $product = $product->setProductId($faker->randomNumber(6, false))
            ->setName($faker->name)
            ->setType($faker->colorName)
            ->setAge($faker->year('now'))
            ->setOwnerName($faker->name);

        $entitymanager->persist($product);
        $entitymanager->flush();
        return new JsonResponse($product);  
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(EntityManagerInterface $entitymanager, $id)
    {
        $idn = 2536;
        while(true)
        {
            $product = $entitymanager->getRepository(Product::class)->find($idn);
            if($product === NULL)
                break;
            $entitymanager->remove($product);
            $entitymanager->flush();
            $idn++;
        }
        return new Response('Successfully deleted the products');
    }


    /**
     * @Route("/{id}",name="update", methods={"PUT"})
     */
    public function update(EntityManagerInterface $entitymanager, $id)
    {
        $rep = $entitymanager->getRepository(Product::class);
        $product = $rep->find(['id'=>$id]);
        $productold = clone $product;
        $faker = Faker\Factory::create();
        $product->setName($faker->name);
        $product->setOwnerName($faker->name);

        $entitymanager->flush();
        return $this->render("product/update.html.twig", ['oldproduct'=>$productold,'updatedproduct'=>$product]);
    }


    /**
     * @Route("/{id<\d+>}", name="get", methods={"GET"})
     */
    public function fetchObject($id)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product=$repository->find($id);
        if($product==NULL)
            throw $this->createNotFoundException('No product found for id-->>'.$id);
        var_dump($product);
        return new JsonResponse($product);  
    }

    /**
     * @Route("/all",name="get_all", methods={"GET"})
     */
    public function fetchObjects()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $products = $em->getRepository(Product::class)->findAll();


        return $this->render("product/index2.html.twig", ['products'=>$products]);

    }

}
