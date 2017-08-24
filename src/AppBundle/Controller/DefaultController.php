<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{
	/**
	* @Route("/", name="test")
	*/
	public function testAction()
	{
		return $this->render('base.html.twig');
	}

	/**
     * @Route("/products", name="homepage")
     */
    public function indexAction()
    {
		$repository = $this->getDoctrine()->getRepository('AppBundle:Product');
		$products = $repository->findAllJoinedToCategory();
		return $this->render('products/showAll.html.twig', array(
			'products' => $products,
		));
	}
	
    /**
	 * @Route("/create", name="create")
	 * @Method("post")
     */
    public function createAction(Request $request)
    {
		$name = $request->request->get('name');
		$price = $request->request->get('price');
		$description = $request->request->get('description');
		$category = $request->request->get('category');

		$repository = $this->getDoctrine()->getRepository('AppBundle:Category');
		$product_category = $repository->findOneByName($category);
		if (!$product_category) {
			$product_category = new Category();
			$product_category->setName($category);
		}
		
		$new_product = new Product();
		$new_product->setName($name);
		$new_product->setPrice($price);
		$new_product->setDescription($description);
		$new_product->setCategory($product_category);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($product_category);
		$em->persist($new_product);
		$em->flush();

		$this->addFlash(
            'notice',
            'Product added!'
        );
		return $this->redirectToRoute('homepage');
	}
	
    /**
     * @Route("/show/{id}", name="show")
     */
    public function showAction($id)
    {
		$product = $this->getDoctrine()
			->getRepository('AppBundle:Product')
			->findOneByIdJoinedToCategory($id);

		if (!$product) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}		

		return $this->render('products/showSingle.html.twig', array(
			'product' => $product,
		));
	}
	
	/**
	* @Route("/edit", name="saveEdit")
	* @Method("post")
	*/
	public function editAction(Request $request)
	{
		$id = $request->request->get('id');
		$name = $request->request->get('name');
		$price = $request->request->get('price');
		$description = $request->request->get('description');
		$category = $request->request->get('category');
		
		$repository = $this->getDoctrine()->getRepository('AppBundle:Category');
		$product_category = $repository->findOneByName($category);
		if (!$product_category) {
			$product_category = new Category();
			$product_category->setName($category);
		}
		
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('AppBundle:Product')->find($id);

		if (!$product) {
			throw $this->createNotFoundException(
				"No product found for ID ".$id
			);
		}

		$product->setName($name);
		$product->setPrice($price);
		$product->setDescription($description);
		$product->setCategory($product_category);
		$em->flush();

		$this->addFlash(
            'notice',
            'Edit saved!'
        );
		return $this->redirectToRoute('show', array('id' => $id));
	}

	/**
	* @Route("/edit/{id}", name="edit")
	*/
	public function editFormAction($id)
	{
		$repository = $this->getDoctrine()->getRepository('AppBundle:Product');
		$product = $repository->find($id);

		if (!$product) {
			throw $this->createNotFoundException(
				'No product found for id '.$id
			);
		}

		return $this->render('products/edit.html.twig', array(
			'product' => $product,
		));
	}

	/**
	* @Route("/delete/{id}", name="delete")
	*/
	public function deleteAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$product = $em->getRepository('AppBundle:Product')->find($id);

		if (!$product) {
			throw $this->createNotFoundException(
				"No product found for ID ".$id
			);
		}

		$em->remove($product);
		$em->flush();

		$this->addFlash(
            'notice',
            'Product deleted'
        );
		return $this->redirectToRoute('homepage');
	}
}
