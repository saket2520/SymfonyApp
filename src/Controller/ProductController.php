<?php

declare(strict_types = 1);

namespace App\Controller;

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
     * adds a new product
     *
     * @Route("/", name="add", methods={"POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entitymanager
     *
     * @return JsonResponse
     */
    public function add(Request $request,EntityManagerInterface $entitymanager)
    {
        $product = new Product();
        $product = $product->setProductId($request->query->get('product_id'))
            ->setName($request->query->get('name'))
            ->setAge($request->query->get("age"))
            ->setOwnerName($request->query->get("owner_name"));

        $entitymanager->persist($product);
        $entitymanager->flush();
        return new JsonResponse($product);
    }


    /**
     * deletes a product
     *
     * @Route("/{id}", name="delete", methods={"DELETE"})
     *
     * @param EntityManagerInterface $entitymanager
     * @param int $id
     *
     * @return Response
     */
    public function delete(EntityManagerInterface $entitymanager, $id)
    {
        $product = $entitymanager->getRepository(Product::class)->find($id);
        if($product !== NULL)
            $entitymanager->remove($product);
        $entitymanager->flush();

        return new Response('Successfully deleted the products');
    }


    /**
     * updates a product
     *
     * @Route("/{id}",name="update", methods={"PUT"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entitymanager
     * @param int $id
     *
     * @return Response
     */
    public function update(Request $request, EntityManagerInterface $entitymanager, $id)
    {
        $rep = $entitymanager->getRepository(Product::class);
        $product = $rep->find(['id'=>$id]);
        $productold = clone $product;
        $product = $product->setProductId($request->query->get('product_id'))
            ->setName($request->query->get('name'))
            ->setAge($request->query->get("age"))
            ->setOwnerName($request->query->get("owner_name"));
        $entitymanager->flush();
        return $this->render("product/update.html.twig", ['oldproduct'=>json_decode($productold),'updatedproduct'=>json_decode($product)]);
    }


    /**
     * Fetches an object
     *
     * @Route("/{id<\d+>}", name="get", methods={"GET"})
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function fetchObject($id)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $product = $repository->find($id);
        if($product == NULL)
            throw $this->createNotFoundException('No product found for id-->>'.$id);
        return new JsonResponse($product);
    }


    /**
     * fetches object collection.
     *
     * @Route("/all",name="get_all", methods={"GET"})
     *
     * @return JsonResponse
     */

    public function fetchObjects()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $products = $em->getRepository(Product::class)->findAll();

        return new jsonResponse($products,Response::HTTP_OK);
    }

}
