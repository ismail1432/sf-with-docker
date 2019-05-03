<?php

namespace App\Entity;

use App\Legacy\Normalizer\AbstractLegacyNormalizer;
use App\Legacy\Normalizer\PostNormalizer;
use App\Legacy\Entity\SynchronizeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post implements SynchronizeInterface
{
    public function __construct()
    {
        $this->parutionDate = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $parutionDate;

    /**
     * @return mixed
     */
    public function getParutionDate(): \DateTimeInterface
    {
        return $this->parutionDate;
    }

    /**
     * @param mixed $parutionDate
     */
    public function setParutionDate($parutionDate): void
    {
        $this->parutionDate = $parutionDate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getcontent(): ?string
    {
        return $this->content;
    }

    public function setcontent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFQCNNormalizer(): string
    {
        return PostNormalizer::class;
    }
}
