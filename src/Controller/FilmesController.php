<?php

namespace App\Controller;

use App\Entity\Filmes;
use App\Form\FilmesType;
use App\Repository\FilmesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filmes")
 */
class FilmesController extends Controller
{
    /**
     * @Route("/", name="filmes_index", methods="GET")
     */
    public function index(FilmesRepository $filmesRepository, Request $request): Response
    {
        $paginator = $this->get("knp_paginator");
        $filmes = $filmesRepository->findAll();
        $filmes = $paginator->paginate($filmes, $request->query->getInt('page', 1), 8);

        return $this->render('filmes/index.html.twig', ['filmes' => $filmes]);
    }

    /**
     * @Route("/new", name="filmes_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $filme = new Filmes();
        $form = $this->createForm(FilmesType::class, $filme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($filme);
            $em->flush();

            return $this->redirectToRoute('filmes_index');
        }

        return $this->render('filmes/new.html.twig', [
            'filme' => $filme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filmes_show", methods="GET")
     */
    public function show(Filmes $filme): Response
    {
        return $this->render('filmes/show.html.twig', ['filme' => $filme]);
    }

    /**
     * @Route("/{id}/edit", name="filmes_edit", methods="GET|POST")
     */
    public function edit(Request $request, Filmes $filme): Response
    {
        $form = $this->createForm(FilmesType::class, $filme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('filmes_edit', ['id' => $filme->getId()]);
        }

        return $this->render('filmes/edit.html.twig', [
            'filme' => $filme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="filmes_delete", methods="DELETE")
     */
    public function delete(Request $request, Filmes $filme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filme->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($filme);
            $em->flush();
        }

        return $this->redirectToRoute('filmes_index');
    }
}
