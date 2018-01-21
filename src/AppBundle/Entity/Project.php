<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
//use Vich\UploaderBundle\Mapping\Annotation as Vich;



/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 *
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @var string
     */

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $strapline;

    /**
     * @return mixed
     */
    public function getStrapline()
    {
        return $this->strapline;
    }

    /**
     * @param mixed $strapline
     */
    public function setStrapline($strapline)
    {
        $this->strapline = $strapline;
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublished;

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @var array
     *
     * @ORM\Column(name="files", type="array", length=255)
     * @Assert\NotBlank(message="You must select at least one valid image file.")
     *
     */
    private $files;

// Might need to add an @return to annotation block below

    public function setFiles($files = NULL)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get images
     *
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

}
