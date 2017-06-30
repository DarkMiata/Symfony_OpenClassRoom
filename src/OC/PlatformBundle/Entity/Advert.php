<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertRepository")
 */
class Advert
{
  /**
   * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
  private $image;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @var \DateTime
   *
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @var string
   *
   * @ORM\Column(name="title", type="string", length=255)
   */
  private $title;

  /**
   * @var string
   *
   * @ORM\Column(name="author", type="string", length=255)
   */
  private $author;

  /**
   * @var string
   *
   * @ORM\Column(name="content", type="string", length=255)
   */
  private $content;

  /**
   * @ORM\Column(name="published", type="boolean")
   */
  private $published;

  public function __construct()
  {
    // Par défaut, la date de l'annonce est la date d'aujourd'hui
    $this->date = new \Datetime();
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param \DateTime $date
   */
  public function setDate($date)
  {
    $this->date = $date;
  }

  /**
   * @return \DateTime
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @param string $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param string $author
   */
  public function setAuthor($author)
  {
    $this->author = $author;
  }

  /**
   * @return string
   */
  public function getAuthor()
  {
    return $this->author;
  }

  /**
   * @param string $content
   */
  public function setContent($content)
  {
    $this->content = $content;
  }

  /**
   * @return string
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set published
   *
   * @param boolean $published
   *
   * @return Advert
   */
  public function setPublished($published)
  {
      $this->published = $published;

      return $this;
  }

  /**
   * Get published
   *
   * @return boolean
   */
  public function getPublished()
  {
      return $this->published;
  }

  /**
   * Set image
   *
   * @param \OC\PlatformBundle\Entity\Image $image
   *
   * @return Advert
   */
  public function setImage(\OC\PlatformBundle\Entity\Image $image)
  {
      $this->image = $image;

      return $this;
  }

  /**
   * Get image
   *
   * @return \OC\PlatformBundle\Entity\Image
   */
  public function getImage()
  {
      return $this->image;
  }
}
