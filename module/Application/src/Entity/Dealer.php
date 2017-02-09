<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 2-2-17
 * Time: 13:33
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dealer")
 *
 * @category Application
 * @package  Entity
 */
class Dealer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $name;

    // TODO manyToMany
    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $meta1;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $meta2;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getMeta1()
    {
        return $this->meta1;
    }

    /**
     * @param string $meta1
     */
    public function setMeta1($meta1)
    {
        $this->meta1 = $meta1;
    }

    /**
     * @return string
     */
    public function getMeta2()
    {
        return $this->meta2;
    }

    /**
     * @param string $meta2
     */
    public function setMeta2($meta2)
    {
        $this->meta2 = $meta2;
    }

    /**
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id       = !empty($data['id']) ? $data['id'] : null;
        $this->name     = !empty($data['name']) ? $data['name'] : null;
        $this->city     = !empty($data['city']) ? $data['city'] : null;
        $this->meta1    = !empty($data['meta1']) ? $data['meta1'] : null;
        $this->meta2    = !empty($data['meta2']) ? $data['meta2'] : null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'city'  => $this->city,
            'meta1' => $this->meta1,
            'meta2' => $this->meta2,
        ];
    }
}
