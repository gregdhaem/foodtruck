<?php

namespace App\Controller;

use App\Entity\MenuSection;
use App\Form\MenuSectionType;
use App\Repository\MenuSectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu/section")
 */
class MenuSectionController extends AbstractController
{
    /**
     * @Route("/", name="menu_section_index", methods={"GET"})
     */
    public function index(MenuSectionRepository $menuSectionRepository): Response
    {
        return $this->render('menu_section/index.html.twig', [
            'menu_sections' => $menuSectionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="menu_section_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menuSection = new MenuSection();
        $form = $this->createForm(MenuSectionType::class, $menuSection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menuSection);
            $entityManager->flush();

            return $this->redirectToRoute('menu_section_index');
        }

        return $this->render('menu_section/new.html.twig', [
            'menu_section' => $menuSection,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_section_show", methods={"GET"})
     */
    public function show(MenuSection $menuSection): Response
    {
        return $this->render('menu_section/show.html.twig', [
            'menu_section' => $menuSection,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="menu_section_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MenuSection $menuSection): Response
    {
        $form = $this->createForm(MenuSectionType::class, $menuSection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_section_index');
        }

        return $this->render('menu_section/edit.html.twig', [
            'menu_section' => $menuSection,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_section_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MenuSection $menuSection): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuSection->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menuSection);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_section_index');
    }
}
