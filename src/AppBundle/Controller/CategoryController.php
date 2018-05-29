<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait;  //  For getDoctrine()
use Symfony\Component\Form\Form;                                //  For createView()
use Symfony\Component\Form\FormBuilder;                         //  For getForm()

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Category;                                  //  Entity Schema
use Doctrine\ORM\EntityManagerInterface;                        //  To create an entry in the db

class CategoryController extends Controller
{

	/**
	 *	@Route("/categories/add", name="addCategory")
	 *	@Method({"GET", "POST"})
	 */
	public function addAction(Request $request)
	{
		$datas = $request->request->all();

		if($datas)
		{
			dump($datas);
		}
 
		$categories = $this->getDoctrine
						->getRepository(Category::class)
						->findAll();
		return $this->render('product/add.html.twig', [
			"categories" => $categories,
		]);
	}

    public function createAction($title, $parent = 0)
    {
        //$entityManager = $this->getDoctrine()->getManager();

    	dump($this);

        $category = new Category;

        $category->setTitle($title);
        $category->setParent($parent);

        //$entityManager->persist($category);
        //$entityManager->flush();
    }
}