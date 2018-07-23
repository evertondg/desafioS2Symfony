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
 ***   @Route("/api")
 **/
class ApiController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     *   @Route("/person", name="getPeople")
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
     *   @Route("/person/{idperson}", name="getPerson")
     *
     **/
    public function getPerson($idperson){

        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Person')->findBy(['personid' => $idperson]);

        $people = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($people);
    }



    /**
     ***   @Route("/document", name="getDocuments")
     *     @Method("GET")
     **/
    public function getDocuments(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Document')->findAll();

        $documents = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($documents);
    }


    /**
     ***   @Route("/document/{id}", name="getDocument")
     *     @Method("GET")
     **/
    public function getDocument($id){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Document')->find($id);

        $document = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($document);
    }


    /**
     ***   @Route("/item", name="getItems")
     *     @Method("GET")
     **/
    public function getItems(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->findAll();

        $itemsList = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($itemsList);
    }

    /**
     ***   @Route("/item/{id}", name="getItem")
     *     @Method("GET")
     **/
    public function getItem($id){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->find($id);

        $itemsList = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($itemsList);
    }


    /**
     ***   @Route("/item/order/{orderid}", name="getItemOrder")
     *     @Method("GET")
     **/
    public function getItemPerson($orderid){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Item')->findBy(['orderid'=> $orderid]);
        $itemsList = $this->get('jms_serializer')->serialize($items,'json');
        return new Response($itemsList);
    }




    /**
     ***   @Route("/phone", name="getPhones")
     *     @Method("GET")
     **/
    public function getPhones(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Phone')->findAll();

        $phones = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($phones);
    }


    /**
     ***   @Route("/phone/person/{idperson}", name="getPhone")
     *     @Method("GET")
     **/
    public function getPhonePerson($idperson){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Phone')->findBy(['personid' => $idperson]);

        $phones = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($phones);
    }



    /**
     ***   @Route("/shipto", name="shipTo")
     *     @Method("GET")
     **/
    public function getShipto(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shipto')->findAll();

        $shipto = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shipto);
    }


    /**
     ***   @Route("/shipto/order/{orderid}", name="shipToOrder")
     *     @Method("GET")
     **/
    public function getShiptoOrder($orderid){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shipto')->findBy(['orderid'=> $orderid]);

        $shipto = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shipto);
    }


    /**
     ***   @Route("/shiporder", name="shipOrders")
     **/
    public function getShipOrders(){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shiporder')->findAll();

        $shiporders = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shiporders);
    }


    /**
     ***   @Route("/shiporder/person/{idperson}", name="shipOrdersPerson")
     **/
    public function getShipOrdersPerson($idperson){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shiporder')->findBy(['orderperson' => $idperson]);



        $shipordersPerson = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shipordersPerson);
    }


    /**
     ***   @Route("/shiporder/{id}", name="shipOrder")
     **/
    public function getShipOrder($id){
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AppBundle:Shiporder')->find($id);

        $shiporder = $this->get('jms_serializer')->serialize($items,'json');

        return new Response($shiporder);
    }

}
