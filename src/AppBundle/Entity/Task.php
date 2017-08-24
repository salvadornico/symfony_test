<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TaskRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due", type="date")
     */
    private $due;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_done", type="boolean")
     */
    private $is_done = false;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;


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
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set due
     *
     * @param \DateTime $due
     * @return Task
     */
    public function setDue($due)
    {
        $this->due = $due;

        return $this;
    }

    /**
     * Get due
     *
     * @return \DateTime 
     */
    public function getDue()
    {
        return $this->due;
    }

    /**
     * Set is_done
     *
     * @param boolean $isDone
     * @return Task
     */
    public function setIsDone($isDone)
    {
        $this->is_done = $isDone;

        return $this;
    }

    /**
     * Get is_done
     *
     * @return boolean 
     */
    public function getIsDone()
    {
        return $this->is_done;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
	 * @return Task
	 *
	 * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->created_at = new \DateTime();

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
