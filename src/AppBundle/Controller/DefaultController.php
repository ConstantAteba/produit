<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Produit\ProduitBundle\Entity\produit;
use Produit\ProduitBundle\Form\produitType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/new/", name="new")
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('Produit\ProduitBundle\Form\produitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file=$form['image']->getData();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('images_directory'),$filename);
            $produit->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/catalogue/", name="catalogue")
     */
    public function ShowAllAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('Produit\ProduitBundle\Form\produitType', $produit);
        // replace this example code with whatever you need
        $all=$this->getDoctrine()->getRepository("ProduitBundle:produit")->findAll();
        return $this->render('produit/new.html.twig');
    }
}
