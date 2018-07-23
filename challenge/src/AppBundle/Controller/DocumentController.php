<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Document;
use AppBundle\Entity\Person;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Shiporder;
use AppBundle\Entity\Shipto;
use AppBundle\Entity\Item;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DocumentController extends Controller
{
    /**
     * @Route("/upload-file", name="uploadFile")
     */
    public function indexAction($name)
    {
//        return $this->render('', array('name' => $name));
        return new Response("Ok");
    }


    /**
     *
     * @Method({"GET", "POST"})
     * @Route("document/upload", name="documentUpload")
     */
    public function ajaxSnippetImageSendAction(Request $request)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");

        $document = new Document();
        $media = $request->files->get('file');

        $document->setFile($media);
        $document->setPath($media->getPathName());
        $document->setName($media->getClientOriginalName());
        $document->setProcessed(0);

        $document->upload();
        $em->persist($document);
        $em->flush();


        return new JsonResponse(array('success' => true));
    }

    /**
     * @Method({"GET"})
     * @Route("document/folder/list", name="documentFolderList")
     */
    public function listAllFilesInFolder(){

        $diretorio = scandir(__DIR__.'/../../../web/files/uploads/');
        $arquivos = array_splice($diretorio, 0, 2); // exclude . e ..

//      return new Response($diretorio);
        return $this->render('document/index.html.twig',[
            'arquivos' => $diretorio
        ]);



    }

    /**
     * @Method({"GET"})
     * @Route("document/list", name="documentList")
     */
    public function listAllFiles(){

        $em = $this->getDoctrine()->getManager();

        $documents = $em->getRepository('AppBundle\Entity\Document')->findAll();

        return $this->render('document/index.html.twig',[
            'arquivos' => $documents
        ]);



    }

    /**
     * @Method({"GET"})
     * @Route("document/delete/{id}",name="deleteFile")
     */
    public function deleteFileFromFolder($id){

        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository('AppBundle\Entity\Document')->find($id);

        if (!$doc) {
            throw $this->createNotFoundException('No document found for id '.$id);
            $deletedFile = false ;
        }else{

            $em->remove($doc);
            $em->flush();
            $file = __DIR__.'/../../../web/files/uploads/'.$doc->getName();
            unlink($file);
            $deletedFile = true ;

        }

        return new JsonResponse(array('success' => $deletedFile,'message'=> 'o Arquivo  "'.$doc->getName().'" foi excluído da base de dados e da pasta de upload'));
    }

    /**
     * @Method({"GET"})
     * @Route("document/process/{id}",name="processFile")
     */
    public function processXML($id){
        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository('AppBundle\Entity\Document')->find($id);

        if (!$doc) {
            throw $this->createNotFoundException(
                'No Document found for id '.$id
            );
        }

        $file = __DIR__.'/../../../web/files/uploads/'.$doc->getName();


        $xml = simplexml_load_string(file_get_contents($file));
        $json = json_encode($xml);

        $arrayJson = json_decode($json, true);

        if (isset($arrayJson['person'])){


            $this->persistPeople($arrayJson);
            $doc->setProcessed(1);
            $em->flush();


        }else{

            $this->persistShiporder($arrayJson);
            $doc->setProcessed(1);
            $em->flush();

        }

        $processedFile = 'Arquivo "'. $doc->getName() .'" Processado com sucesso';


        return new Response( $processedFile);

    }


    /*REFATORAR CODIGO*/
    public function persistPeople($people){

        foreach ( $people["person"] as $peopleItem){

            $person = new Person();
            $person->setPersonid($peopleItem["personid"]);
            $person->setPersonname($peopleItem["personname"]);
            $this->persistPhones($peopleItem["phones"],$peopleItem["personid"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

        }


    }

    public function persistPhones($phones,$person){


        $length = count($phones);
        for ($i = 0; $i <= $length ; $i++) {
            $phone = new Phone();
            $phone->setPersonid($person);
            $phone->setPhone($phones["phone"][$i]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();
        }
    }

    /* END PEOPLE XML FUNCTIONS */




    public function persistShiporder($shiporders){

        foreach ( $shiporders["shiporder"] as $shipordersItem){
            $em = $this->getDoctrine()->getManager();


            $shiporder = new Shiporder();
            $shiporder->setOrderid($shipordersItem["orderid"]);
            $shiporder->setOrderperson($shipordersItem["orderperson"]);


            $this->persistShipto($shipordersItem["shipto"],$shipordersItem["orderid"]);
            $this->persistItems($shipordersItem["items"],$shipordersItem["orderid"]);

            $em->persist($shiporder);
            $em->flush();



        }


    }

    public function persistShipto($shipto,$orderid){
        $em = $this->getDoctrine()->getManager();


            $to = new Shipto();
            $to->setOrderid($orderid);
            $to->setName($shipto["name"]);
            $to->setAddress($shipto["address"]);
            $to->setCity($shipto["city"]);
            $to->setCountry($shipto["country"]);

            $em->persist($to);
            $em->flush();




    }

    public function persistItems($items,$orderid){
        $em = $this->getDoctrine()->getManager();



        foreach ( $items as $it){



            if (!isset($it[0])){

                $item = new Item();
                $item->setOrderid($orderid);
                $item->setTitle($it["title"]);
                $item->setNote($it["note"]);
                $item->setQuantity($it["quantity"]);
                $item->setPrice($it["price"]);
                $em->persist($item);
                $em->flush();
            }else{

                foreach ($it as $itm) {
                    $item = new Item();
                    $item->setOrderid($orderid);
                    $item->setTitle($itm["title"]);
                    $item->setNote($itm["note"]);
                    $item->setQuantity($itm["quantity"]);
                    $item->setPrice($itm["price"]);
                    $em->persist($item);
                    $em->flush();
                }

            }
        }


    }

    /* REFATORAR CODIGO */


}
