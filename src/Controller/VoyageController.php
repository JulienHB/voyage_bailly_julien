<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/voyage')]
class VoyageController extends AbstractController
{
    #[Route('/', name: 'voyage_index', methods: ['GET'])]
    public function index(VoyageRepository $voyageRepository): Response
    {
        return $this->render('voyage/index.html.twig', [
            'voyages' => $voyageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'voyage_new', methods: ['GET', 'POST'])]
    public function new(Request $request,SluggerInterface $slugger): Response
    {
        $voyage = new Voyage();
        $form = $this->createForm(VoyageType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                      
            $image1 = $form -> get('image1')->getData();
            $image2 = $form -> get('image2')->getData();
            $image3 = $form -> get('image3')->getData();
            $pdf = $form -> get('brochure')->getData();

            if($image1) {
                $originalFileName = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image1->guessExtension();

                try {
                    $image1->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage1($newFileName);
            }
            if($image2) {
                $originalFileName = pathinfo($image2->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image2->guessExtension();

                try {
                    $image2->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage2($newFileName);
            }
            if($image3) {
                $originalFileName = pathinfo($image3->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image3->guessExtension();

                try {
                    $image3->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage3($newFileName);
            }

            if($pdf) {
                $originalFileName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$pdf->guessExtension();

                try {
                    $pdf->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setBrochure($newFileName);
            }

            $tags=$form->get('tags')->getData();
            foreach ($tags as $tag) {
                $voyage->addTag($tag);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyage);
            $entityManager->flush();

            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'voyage_show', methods: ['GET'])]
    public function show(Voyage $voyage): Response
    {
        return $this->render('voyage/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    #[Route('/{id}/edit', name: 'voyage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voyage $voyage, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(VoyageType::class, $voyage);
        $img1src=$voyage->getImage1();
        $img2src=$voyage->getImage2();
        $img3src=$voyage->getImage3();
        $pdfsrc=$voyage->getBrochure();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($voyage->getImage1() != $img1src) {
                $image1 = $form -> get('image1')->getData();
                $originalFileName = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image1->guessExtension();

                try {
                    $image1->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage1($newFileName);
            }
            if($voyage->getImage2() != $img2src) {
                $image2 = $form -> get('image2')->getData();
                $originalFileName = pathinfo($image2->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image2->guessExtension();

                try {
                    $image2->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage2($newFileName);
            }
            if($voyage->getImage3() != $img3src) {
                $image3 = $form -> get('image3')->getData();
                $originalFileName = pathinfo($image3->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$image3->guessExtension();

                try {
                    $image3->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setImage3($newFileName);
            }

            if($voyage->getBrochure() !=  $pdfsrc) {
                $pdf = $form -> get('brochure')->getData();
                $originalFileName = pathinfo($pdf->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName.'-'.uniqid().'.'.$pdf->guessExtension();

                try {
                    $pdf->move($this ->getParameter('upload_directory'), $newFileName);
                }
                catch (FileException $e) {
                    var_dump($e);
                }
                $voyage->setBrochure($newFileName);
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('voyage/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'voyage_delete', methods: ['POST'])]
    public function delete(Request $request, Voyage $voyage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyage_index', [], Response::HTTP_SEE_OTHER);
    }
}
