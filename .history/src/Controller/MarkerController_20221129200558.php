<?php

namespace App\Controller;

use App\Entity\Marker;
use App\Entity\MarkerTag;
use App\Entity\Tag;
use App\Form\MarkerType;
use App\Form\TagType;
use App\Repository\MarkerRepository;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/marker')]
class MarkerController extends AbstractController
{
    #[Route('/', name:'app_marker_index', methods:['GET'])]
function index(MarkerRepository $markerRepository): Response
    {
    return $this->render('marker/index.html.twig', [
        'markers' => $markerRepository->findAll(),
    ]);
}

#[Route('/new', name:'app_marker_new', methods:['GET', 'POST'])]
function new (Request $request, MarkerRepository $markerRepository, PersistenceManagerRegistry $doctrine): Response {
    $marker = new Marker();
    $form = $this->createForm(MarkerType::class, $marker);
    $form->handleRequest($request);

    $Tag = new Tag();
    $formTag = $this->createForm(TagType::class, $Tag, [
        'action' => $this->generateUrl('new_tag_ajax'),
    ]);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $doctrine->getManager();
        $entityManager->persist($marker);
        $tags = $form->get('tag')->getData();

        foreach ($tags as $tag) {
            $markerTag = new MarkerTag();
            $markerTag->setMarker($marker);
            $markerTag->setTag($tag);
            $entityManager->persist($markerTag);
        }
        $entityManager->flush();

        $this->addFlash('success', 'Marker created successfully.');

        return $this->redirectToRoute('app_category', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('marker/new.html.twig', [
        'marker' => $marker,
        'form' => $form->createView(),
        'form_tag' => $formTag->createView(),
    ]);
}

#[Route('/{id}', name:'app_marker_show', methods:['GET'])]
function show(Marker $marker): Response
    {
    return $this->render('marker/show.html.twig', [
        'marker' => $marker,
    ]);
}

#[Route('/{id}/edit', name:'app_marker_edit', methods:['GET', 'POST'])]
function edit(Request $request, Marker $marker, MarkerRepository $markerRepository, PersistenceManagerRegistry $doctrine): Response
    {
    $form = $this->createForm(MarkerType::class, $marker);
    $form->handleRequest($request);
    $Tag = new Tag();
    $formTag = $this->createForm(TagType::class, $Tag, [
        'action' => $this->generateUrl('new_tag_ajax'),
    ]);

    $markerTagsCurrent = $marker->getMarkerTags();
    if ($form->isSubmitted()) {
        if ($form->isValid()) {
            $entityManager = $doctrine->getManager();
            $tags = $form->get('tag')->getData();

            foreach ($markerTagsCurrent as $markerTag) {
                $delete= true;
                $tagCurrent = $markerTagsCurrent->getTag();
                foreach ($tags as $tag) {
                if ($tagCurrent->getId() == $tag->getId()) {
                    $delete = false;
                }
                }
                if ($delete) {
                    $marker->remove($markerTag);
                }
                fo
              
            }

            $this->addFlash('success', 'Marker updated successfully.');
            return $this->redirectToRoute('app_category', [], Response::HTTP_SEE_OTHER);
        } 
    }else {
            $tags = [];
            foreach ($markerTagsCurrent as $markerTag) {
                $tags[] = $markerTag->getTag();
            }
            $form->get('tag')->setData($tags);
        }
    

    return $this->render('marker/edit.html.twig', [
        'marker' => $marker,
        'form' => $form->createView(),
        'form_tag' => $formTag->createView(),
    ]);
}

#[Route('/{id}', name:'app_marker_delete', methods:['POST'])]
function delete(Request $request, Marker $marker, MarkerRepository $markerRepository): Response
    {
    if ($this->isCsrfTokenValid('delete' . $marker->getId(), $request->request->get('_token'))) {
        $markerRepository->remove($marker, true);
        $this->addFlash('success', 'Marker deleted successfully.');
    }

    return $this->redirectToRoute('app_category', [], Response::HTTP_SEE_OTHER);
}
}
