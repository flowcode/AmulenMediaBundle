<?php

namespace Flowcode\MediaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\OneToMany;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Gallery
 */
class Gallery {

    const TYPE_PRODUCT = "gallery_product";
    const TYPE_SLIDER = "gallery_slider";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled;

    /**
     * @OneToMany(targetEntity="\Amulen\MediaBundle\Entity\GalleryItem", mappedBy="gallery", cascade={"persist"})
     * @ORM\OrderBy({"position" = "ASC"})
     * */
    protected $galleryItems;

    /**
     * @ManyToMany(targetEntity="Amulen\ClassificationBundle\Entity\Tag")
     * @JoinTable(name="media_gallery_tag",
     *      joinColumns={@JoinColumn(name="gallery_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * */
    protected $tags;

    function __construct() {
        $this->galleryItems = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->type = self::TYPE_SLIDER;
        $this->enabled = true;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Add galleryItems
     *
     * @param \Amulen\MediaBundle\Entity\GalleryItem $galleryItems
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function addGalleryItem(\Amulen\MediaBundle\Entity\GalleryItem $galleryItems) {
        $galleryItems->setGallery($this);
        $this->galleryItems[] = $galleryItems;

        return $this;
    }

    /**
     * Remove galleryItems
     *
     * @param \Amulen\MediaBundle\Entity\GalleryItem $galleryItems
     */
    public function removeGalleryItem(\Amulen\MediaBundle\Entity\GalleryItem $galleryItems) {
        $this->galleryItems->removeElement($galleryItems);
    }

    /**
     * Get galleryItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGalleryItems() {
        return $this->galleryItems;
    }

    /**
     * Add tags
     *
     * @param \Amulen\ClassificationBundle\Entity\Tag $tags
     * @return Gallery
     */
    public function addTag(\Amulen\ClassificationBundle\Entity\Tag $tags) {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Flowcode\ClassificationBundle\Entity\Tag $tags
     */
    public function removeTag(\Amulen\ClassificationBundle\Entity\Tag $tags) {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    public function __toString() {
        return $this->name;
    }

}
