<?php

// src/OC/PlatformBundle/Controller/AnimalController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use OC\PlatformBundle\Entity\Animal;
use OC\PlatformBundle\Entity\Mammifere;
use OC\PlatformBundle\Entity\Reptile;
use OC\PlatformBundle\Entity\Oiseau;
use OC\PlatformBundle\Entity\Categorie;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use OC\PlatformBundle\Form\MammifereType;
use OC\PlatformBundle\Form\OiseauType;
use OC\PlatformBundle\Form\ReptileType;

class AnimalController extends Controller
{
   public function viewAnimalAction()
  {
	$em = $this->getDoctrine()->getManager();
	$animal = $em->getRepository('OCPlatformBundle:Animal')->findAll();
	return new Response($this->get('templating')->render('OCPlatformBundle:Animal:index.html.twig', array('TabAnimaux'=>$animal)));
	
  }
  
  public function addAnimalAction(Request $request){
	// On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();
	

	//On cré l'objet Reptile
	$reptile = new Reptile();
	
	$form = $this->get('form.factory')->createBuilder(ReptileType::class, $reptile)
	  ->getForm()
    ;
	//On cré l'objet Mammifere
	$mammifere = new mammifere();
	
	$formMam = $this->get('form.factory')->createBuilder(MammifereType::class, $mammifere)
	  ->getForm()
    ;
	//On cré l'objet Oiseau
	$oiseau = new Oiseau();
	
	$formOis = $this->get('form.factory')->createBuilder(OiseauType::class, $oiseau)
	  ->getForm()
    ;
	
	if ($request->isMethod('POST')) {
		
		$form->handleRequest($request);
		$formMam->handleRequest($request);
		$formOis->handleRequest($request);
		
		if ($form->isValid()) {
			$em->persist($reptile);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Animal ajoute');
	
	
			return $this->redirectToRoute('oc_platform_viewAnimal');
		}else if ($formMam->isValid()) {
			$em->persist($mammifere);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Animal ajoute');
	
	
			return $this->redirectToRoute('oc_platform_viewAnimal');
		}else if ($formOis->isValid()) {
			$em->persist($oiseau);
			$em->flush();
			$request->getSession()->getFlashBag()->add('notice', 'Animal ajoute');
	
	
			return $this->redirectToRoute('oc_platform_viewAnimal');
		}
	
	}
	return $this->render('OCPlatformBundle:Animal:form.html.twig', array('form' => $form->createView(),'formMam' => $formMam->createView(),'formOis' => $formOis->createView()));
  }
  
   public function editAction($nom, Request $request){
   
	$em = $this->getDoctrine()->getManager();
    
    $animal = $em->getRepository('OCPlatformBundle:Animal')->findOneByNom($nom);
	
	if($animal instanceof Mammifere){
		$form = $this->get('form.factory')->create(MammifereType::class, $animal);
	}else if($animal instanceof Reptile){
		$form = $this->get('form.factory')->create(ReptileType::class, $animal);
	}else{
		$form = $this->get('form.factory')->create(OiseauType::class, $animal);
	}
	
	
    if ($request->isMethod('POST')) {
		$form->handleRequest($request);
			if ($form->isValid()) {
				
				$em->persist($animal);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Animal ajoute');
		
				return $this->redirectToRoute('oc_platform_viewAnimal');
			}
    }


    return $this->render('OCPlatformBundle:Animal:form.html.twig', array('form' => $form->createView()));
  }
   
   public function deleteAction($nom){
    $em = $this->getDoctrine()->getManager();
    $animal = $em->getRepository('OCPlatformBundle:Animal')->findOneByNom($nom);
	$em->remove($animal);
    $em->flush();
    return $this->redirectToRoute('oc_platform_viewAnimal');
  }
}
?>