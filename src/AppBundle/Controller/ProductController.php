<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait;  //  For createFormBuilder()
use Symfony\Component\Form\Form;                                //  For createView()
use Symfony\Component\Form\FormBuilder;                         //  For getForm()

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Product;                                   //  Entity Schema
use AppBundle\Entity\Category;                                  //  Entity Schema
use Doctrine\ORM\EntityManagerInterface;                        //  To create an entry in the db


class ProductController extends Controller
{

    /**
     * @Route("/products/add", name="addProducts")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('title', TextType::class)
                ->add('category', TextType::class)
                ->add('description', TextareaType::class, [ 'required' => false, ])
                ->add('price', NumberType::class)
                ->add('submit', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $this->createAction($form->getNormData());
        }

        return $this->render('product/add.html.twig', [
            'addForm' => $form->createView(),
        ]);
    }

    public function createAction($datas)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();

        $product->setTitle($datas['title']);
        $product->setDesc($datas['description']);
        $product->setPrice($datas['price']);
        $product->setCategory($datas['category']);

        $category = $this->getDoctrine()
                        ->getRepository(Category::class)
                        ->findOneByTitle($datas['category']);
        if(!$category)
        {
            $category = new CategoryController;
            $category->createAction($datas['category']);
        }

        $entityManager->persist($product);

        $entityManager->flush();

    }

    public function editAction()
    {
    }

    /**
     *  @Route("/products/list", name="listProducts")
     *  @Method({"GET", "POST"})
     */
    public function listAction()
    {
        $products = $this->getDoctrine()
                ->getRepository(Product::class)
                ->findAll();
        return $this->render('product/list.html.twig',[
            'products' => $products,
        ]);
    }

    public function deleteAction()
    {
    }

    /**
     *  @Route("/products/{id}", name="showProduct")
     */
    public function showAction()
    {
    }
}
