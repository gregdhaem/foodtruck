<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuSectionRepository")
 */
class MenuSection
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="menuSections")
     */
    private $user;

    /**
     * @ORM\Column(type="smallint")
     */
    private $sectionNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sectionTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sectionImage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MenuItem", mappedBy="menuSection")
     * @OrderBy({"itemDescription" = "ASC"})
     */
    private $menuItems;

    public function __construct()
    {
        $this->menuItems = new ArrayCollection();
    }

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

    public function getSectionNumber(): ?int
    {
        return $this->sectionNumber;
    }

    public function setSectionNumber(int $sectionNumber): self
    {
        $this->sectionNumber = $sectionNumber;

        return $this;
    }

    public function getSectionTitle(): ?string
    {
        return $this->sectionTitle;
    }

    public function setSectionTitle(string $sectionTitle): self
    {
        $this->sectionTitle = $sectionTitle;

        return $this;
    }

    public function getSectionImage(): ?string
    {
        return $this->sectionImage;
    }

    public function setSectionImage(?string $sectionImage): self
    {
        $this->sectionImage = $sectionImage;

        return $this;
    }

    /**
     * @return Collection|MenuItem[]
     */
    public function getMenuItems(): Collection
    {
        return $this->menuItems;
    }

    public function addMenuItem(MenuItem $menuItem): self
    {
        if (!$this->menuItems->contains($menuItem)) {
            $this->menuItems[] = $menuItem;
            $menuItem->setMenuSection($this);
        }

        return $this;
    }

    public function removeMenuItem(MenuItem $menuItem): self
    {
        if ($this->menuItems->contains($menuItem)) {
            $this->menuItems->removeElement($menuItem);
            // set the owning side to null (unless already changed)
            if ($menuItem->getMenuSection() === $this) {
                $menuItem->setMenuSection(null);
            }
        }

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->sectionTitle;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
