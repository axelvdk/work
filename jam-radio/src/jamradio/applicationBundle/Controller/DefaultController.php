<?php
namespace jamradio\applicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use jamradio\applicationBundle\Entity\User;
use jamradio\applicationBundle\Form\UserType;
use jamradio\applicationBundle\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class DefaultController extends Controller
{
    public function indexAction()
    {
       $session = new Session(new MockFileSessionStorage());

       return $this->render('jamradioapplicationBundle:Default:index.html.twig', array(
            'id_user'=>$session->get('id'),
       ));
    }

    public function profileAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        

        if ($form->isSubmitted()) {

          $em = $this->getDoctrine()->getManager();

          $em->persist($user);
          $em->flush();
          return $this->redirectToRoute('jamradioapplication_homepage');
        }

        return $this->render('jamradioapplicationBundle:Default:user-profile.html.twig',array(
          'form'=>$form->createView(),
        ));
    }

    public function loginAction(Request $request)
    {
      $session = new Session(new MockFileSessionStorage());

      $user = new User();
      $repository = $this
         ->getDoctrine()
         ->getRepository('jamradioapplicationBundle:User');

         $form = $this->createFormBuilder($user)
          ->add('email', TextType::class)
          ->add('password', PasswordType::class)
          ->add('save', SubmitType::class, array('label' => 'Login'))
          ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted()){
            $data = $form->getData();
            $user_email = $repository->findOneBy(array('email' => $data->getEmail()));
            $user_password = $repository->findOneBy(array('password' => $data->getPassword()));
            if(!empty($user_email) && !empty($user_password))
            {
              $session->set('id_user', $user_email->getId());
              return $this->render('jamradioapplicationBundle:Default:index.html.twig', array(
                  'id_user'=>$user_email->getId(),
                ));
            }
            else {
              return $this->render('jamradioapplicationBundle:Default:login.html.twig', array(
                'form'=>$form->createView(),
              ));
            }
          }
       return $this->render('jamradioapplicationBundle:Default:login.html.twig', array(
         'form'=>$form->createView(),
       ));
    }

    public function formAction()
    {
        return $this->render('jamradioapplicationBundle:Default:essential-forms.html.twig');
    }
}
