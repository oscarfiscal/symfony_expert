<?php

namespace App\Controller;

use App\Entity\Marker;
use App\Form\MarkerType;
use App\Repository\MarkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tag;
use App\Form\TagType;

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
function new (Request $request, MarkerRepository $markerRepository): Response {
    $marker = new Marker();
    $form = $this->createForm(MarkerType::class, $marker);
    $form->handleRequest($request);

    $Tag = new Tag();
    $formTag = $this->createForm(TagType::class, $Tag, [
        'action' => $this->generateUrl('new_tag_ajax'),
    ]);

    if ($form->isSubmitted() && $form->isValid()) {
        $tags = $form->get('tag')->getData();

        foreach ($tags as $tag) {
           
        }
        $markerRepository->save($marker, true);
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
function edit(Request $request, Marker $marker, MarkerRepository $markerRepository): Response
    {
    $form = $this->createForm(MarkerType::class, $marker);
    $form->handleRequest($request);
    $Tag = new Tag();
    $formTag = $this->createForm(TagType::class, $Tag, [
        'action' => $this->generateUrl('new_tag_ajax'),
    ]);

    if ($form->isSubmitted() && $form->isValid()) {

        $markerRepository->save($marker, true);
        $this->addFlash('success', 'Marker updated successfully.');

        return $this->redirectToRoute('app_category', [], Response::HTTP_SEE_OTHER);
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