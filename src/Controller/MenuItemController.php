<?php

namespace App\Controller;

use App\Entity\MenuItem;
use App\Form\MenuItemType;
use App\Repository\MenuItemRepository;
use App\Repository\MenuSectionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/menu/item")
 */
class MenuItemController extends AbstractController
{
    /**
     * @Route("/", name="menu_item_index", methods={"GET"})
     */
    public function index(MenuItemRepository $menuItemRepository, MenuSectionRepository $menuSectionRepository): Response
    {
        return $this->render('menu_item/index.html.twig', [
            'menu_items' => $menuItemRepository->findAll(),
            'menu_sections' => $menuSectionRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="menu_item_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $menuItem = new MenuItem();
        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $menuItem->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menuItem);
            $entityManager->flush();

            return $this->redirectToRoute('menu_item_index');
        }

        return $this->render('menu_item/new.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_item_show", methods={"GET"})
     */
    public function show(MenuItem $menuItem): Response
    {
        return $this->render('menu_item/show.html.twig', [
            'menu_item' => $menuItem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="menu_item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MenuItem $menuItem): Response
    {
        $form = $this->createForm(MenuItemType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_item_index');
        }

        return $this->render('menu_item/edit.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="menu_item_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MenuItem $menuItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menuItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_item_index');
    }
}
