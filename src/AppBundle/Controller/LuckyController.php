<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LuckyController extends Controller
{
	/**
	* @Route("/lucky", name="home")
	*/
	public function displayHomeAction()
	{
		return $this->render('lucky/index.html.twig');
	}

	/**
	* @Route("/lucky/number", name="named")
	* @Method("POST")
	*/
	public function nameAction(Request $request)
	{
		$request->isXmlHttpRequest();

		$name = $request->request->get('name');
		$number = mt_rand(0, 100);

		return $this->render('lucky/number.html.twig', array(
			'name' => $name,
			'number' => $number,
		));
	}

	/**
	* @Route("/lucky/number/{max}", name="number")
	*/
	public function numberAction($max = 100)
	{
		$number = mt_rand(0, $max);
		
		return $this->render('lucky/number.html.twig', array(
			'number' => $number,
		));
	}
}