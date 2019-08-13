<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuItemRepository")
 */
class MenuItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="menuItems")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itemDescription;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $itemPrice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $itemImage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MenuSection", inversedBy="menuItems")
     */
    private $menuSection;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onMenu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->itemDescription;
    }

    public function setItemDescription(string $itemDescription): self
    {
        $this->itemDescription = $itemDescription;

        return $this;
    }

    public function getItemPrice()
    {
        return $this->itemPrice;
    }

    public function setItemPrice($itemPrice): self
    {
        $this->itemPrice = $itemPrice;

        return $this;
    }

    public function getItemImage(): ?string
    {
        return $this->itemImage;
    }

    public function setItemImage(?string $itemImage): self
    {
        $this->itemImage = $itemImage;

        return $this;
    }

    public function getMenuSection(): ?MenuSection
    {
        return $this->menuSection;
    }

    public function setMenuSection(?MenuSection $menuSection): self
    {
        $this->menuSection = $menuSection;

        return $this;
    }

    public function getOnMenu(): ?bool
    {
        return $this->onMenu;
    }

    public function setOnMenu(bool $onMenu): self
    {
        $this->onMenu = $onMenu;

        return $this;
    }
}
