<?php

namespace App\Controller;


use App\Repository\MenuItemRepository;
use App\Repository\MenuSectionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="app_menu")
     */
    public function index(MenuSectionRepository $menuSectionRepository, MenuItemRepository $menuItemRepository): Response
    {
        return $this->render('menu/index.html.twig', [
            'menu_sections' => $menuSectionRepository->findAll(),
            'menu_items' => $menuItemRepository->findAll(),
        ]);
    }
}
