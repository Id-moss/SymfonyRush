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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\User;                                      //  Entity Schema
use Doctrine\ORM\EntityManagerInterface;                        //  To create an entry in the db

use Symfony\Component\HttpFoundation\Session\Session;           //  To create flash messages

class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('email', EmailType::class)
                ->add('password', PasswordType::class)
                ->add('submit', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()){

            $req = $request->request->all();

            $user = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneByEmail($req['form']['email']);
            if(!$user){
                $this->addFlash("error", "No user found .. Wanna register ?");
            } else {
                if($user->checkPwd($req['form']['password'])){
                    $session = new Session();
                    $session->set('name', $user->getFirstname());
                    $session->set('adress', $user->getPostaladress());
                    $session->getFlashBag()->add("success", "Welcome ". $user->getFirstname());
                    return $this->redirect('/products/list');
                } else {
                    $this->addFlash("error", "Are you sure to be ". $user->getFirstname() ." ..?");
                }
            }
        }

        return $this->render('user/login.html.twig', [
            'loginForm' => $form->createView(),
        ]);
    }

    public function logoutAction(Request $request)
    {
        $session = null;
        return $this->redirect('/login');
    }

    /**
     * @Route("/register", name="register")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request)
    {
        $form = $this->createFormBuilder()
                ->add('first_name', TextType::class)
                ->add('last_name', TextType::class)
                ->add('email', EmailType::class)
                ->add('password', PasswordType::class)
                ->add('postal_adress', NumberType::class)
                ->add('submit', SubmitType::class)
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $req = $request->request->all();

            $user = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneByEmail($req['form']['email']);
            if($user){
                $this->addFlash("error", "Email already used !");
            } else {
                $this->createAction($req['form']);
                return $this->redirect('/login');
            }
        }
        return $this->render('user/register.html.twig', [
            'registerForm' => $form->createView(),
        ]);            
    }

    public function createAction($form)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setFirstname($form['first_name']);
        $user->setLastname($form['last_name']);
        $user->setPwd($form['password']);
        $user->setEmail($form['email']);
        $user->setPostaladress($form['postal_adress']);

        $entityManager->persist($user);

        $entityManager->flush();

    }

    public function editAction()
    {
    }

    public function showAction()
    {
    }

    public function deleteAction()
    {
    }
}
