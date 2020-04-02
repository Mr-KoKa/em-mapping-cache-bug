<?php

namespace App\Controller;

use App\Entity\Main\Example;
use App\Entity\Main\Item;
use App\Form\Type\ExampleType;
use App\Form\Type\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController {
    /**
     * @Route("/example1")
     * @Template
     */
    public function example1(EntityManagerInterface $em){
        $example = new Example();
        $example->setValue('example value');

        try {
            $em->persist($example);
            $em->flush();
        } catch(\Exception $e){
            return new Response('An error has occurred. '.$e->getMessage());
        }

        return [];
    }

    /**
     * @Route("/example2")
     * @Template
     */
    public function example2(EntityManagerInterface $em){
        $example = $em->getRepository(Example::class)->find(1);
        if(!$example){
            return new Response('No example found.');
        }

        $example->setValue(mt_rand(0, mt_getrandmax()));
        try {
            $em->flush();
        } catch(\Exception $e){
            return new Response('An error has occurred. '.$e->getMessage());
        }

        return [];
    }

    /**
     * @Route("/example3")
     * @Template
     */
    public function example3(Request $request, EntityManagerInterface $em){
        $example = $em->getRepository(Example::class)->find(1);
        if(!$example){
            return new Response('No example found.');
        }

        $form = $this->createForm(ExampleType::class, $example);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->flush();
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/example4")
     * @Template
     */
    public function example4(Request $request){
        $form = $this->createForm(ExampleType::class, new Example());
        $form->handleRequest($request);

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/example5")
     * @Template
     */
    public function example5(Request $request){
        $form = $this->createForm(ItemType::class, new Item());
        $form->handleRequest($request);

        return ['form' => $form->createView()];
    }
}