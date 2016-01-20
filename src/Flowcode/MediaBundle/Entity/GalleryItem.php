<?php

namespace Flowcode\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;


/**
 * GalleryItem
 */
class GalleryItem {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="smallint")
     */
    protected $position;

    /**
     *@var \Amulen\PageBundle\Entity\Page
     *
     * @ManyToOne(targetEntity="\Amulen\PageBundle\Entity\Page")
     * @JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $page;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    protected $link;

    /**
     * @OneToOne(targetEntity="\Amulen\MediaBundle\Entity\Media", cascade={"persist"})
     * @JoinColumn(name="media_id", referencedColumnName="id")
     * */
    protected $media;

    /**
     * @ManyToOne(targetEntity="\Amulen\MediaBundle\Entity\Gallery", inversedBy="galleryItems")
     * @JoinColumn(name="gallery_id", referencedColumnName="id")
     * */
    protected $gallery;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return \Amulen\MediaBundle\Entity\GalleryItem
     */
    public function setPosition($position) {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition() {
        return $this->position;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return \Amulen\MediaBundle\Entity\GalleryItem
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink() {
        return $this->link;
    }


    /**
     * Set media
     *
     * @param \Amulen\MediaBundle\Entity\Media $media
     * @return \Amulen\MediaBundle\Entity\GalleryItem
     */
    public function setMedia(\Amulen\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Amulen\MediaBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set gallery
     *
     * @param \Amulen\MediaBundle\Entity\Gallery $gallery
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function setGallery(\Amulen\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Amulen\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set page
     *
     * @param \Amulen\PageBundle\Entity\Page $page
     * @return \Amulen\MediaBundle\Entity\GalleryItem
     */
    public function setPage(\Amulen\PageBundle\Entity\Page $page = null) {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Amulen\PageBundle\Entity\Page
     */
    public function getPage() {
        return $this->page;
    }

}
