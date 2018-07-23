<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Document;
use AppBundle\Entity\Person;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Shiporder;
use AppBundle\Entity\Shipto;
use AppBundle\Entity\Item;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 ***   @Route("/api", name="getPeople")
 **/
class ApiController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     *   @Route("/people", name="getPeople")
     *
     **/
    public function getPeople(){

        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Person')->findAll();

        $people = $this->get('jms_serializer')->serialize($items,'json');

//        foreach ($items as $item) {
//
//            $phones = $em->getRepository('AppBundle\Entity\Phone')->findBy([]);
//
//
//
//            $people[] = array(
//                'id'         => $item->getId(),
//                'personid'   => $item->getPersonid(),
//                'personname' => $item->getPersonname()
//                'personid' => $item->getId(),
//            );
//        }



        return new Response($people);
    }

    /**
     ***   @Route("/documents", name="getDocuments")
     **/
    public function getDocuments(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Document')->findAll();

        $documents = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($documents);
    }

    /**
     ***   @Route("/items", name="getItems")
     **/
    public function getItems(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->findAll();

        $itemsList = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($itemsList);
    }

    /**
     ***   @Route("/phones", name="getPhones")
     **/
    public function getPhones(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Phone')->findAll();

        $phones = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($phones);
    }

    /**
     ***   @Route("/shipto", name="shipTo")
     **/
    public function getShipto(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shipto')->findAll();

        $shipto = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shipto);
    }


    /**
     ***   @Route("/shiporders", name="shipOrders")
     **/
    public function getShipOrders(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shiporder')->findAll();

        $shiporders = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shiporders);
    }
}
