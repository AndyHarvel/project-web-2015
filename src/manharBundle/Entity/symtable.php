<?php

namespace manharBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * symtable
 */
class symtable
{
    /**
     * @var Integer
     * 
     */
    private $id;

    /**
     * @var string
     */
    private $title;

   
    /**
     * @var string
     */
    private $coment;

    /**
     * @var string
     */
    private $author;

    /**
     * @var array
     */
    private $photo;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \DateTime
     */
    private $time;




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return symtable
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

     /**
     * Set coment
     *
     * @param string $coment
     *
     * @return symtable
     */
    public function setComent($coment)
    {
        $this->coment = $coment;

        return $this;
    }

    /**
     * Get coment
     *
     * @return string
     */
    public function getComent()
    {
        return $this->coment;
    }



    /**
     * Set author
     *
     * @param string $author
     *
     * @return symtable
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }


    
     /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return TZ
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return TZ
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }




    /**
     * Set photo
     *
     * @param array $photo
     *
     * @return Presse
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return array
     */
    public function getPhoto()
    {
        return $this->photo;
    }



   /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pictureName;

    /**
     * @Assert\File(maxSize="500k")
     */
    public $file;
    
    public function getWebPath()
    {
        return null === $this->pictureName ? null : $this->getUploadDir().'/'.$this->pictureName;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return '/images';
     }
    
    public function uploadProfilePicture()
    {
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());
        $this->pictureName = $this->file->getClientOriginalName();
        $this->file = null;
    }

    

public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \Datetime();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

 public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());

        $metadata->addPropertyConstraint('author', new NotBlank());
        $metadata->addPropertyConstraint('coment', new NotBlank());
    }



public static function getTypes()
{
  return array('millieu' => 'millieu', 'attaquant' => 'attaquant', 'defenseur' => 'defenseur', 'gardien' => 'gardien');
}
 
public static function getTypeValues()
{
  return array_keys(self::getTypes());
}
 





}
