<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 13.05.16
 * Time: 20:45
 */

namespace HsBremen\WebApi\Entity;


class CdDrive extends Component implements \JsonSerializable
{

    private $readingTime;
    private $writingTime;
    private $isWritable;
    private $isBluRay;

    public function __construct($id, $name, $price, $readingTime, $writingTime, $isWritable, $isBluRay  )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->readingTime = $readingTime;
        $this->writingTime = $writingTime;
        $this->isWritable = $isWritable;
        $this->isBluRay = $isBluRay;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'price'         => $this->price,
            'reading time'   => $this->readingTime,
            'writing time'  => $this->writingTime,
            'is writable'   => $this->isWritable,
            'is Blu Ray'    => $this->isBluRay,
        ];
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIsBluRay()
    {
        return $this->isBluRay;
    }

    /**
     * @param mixed $isBluRay
     */
    public function setIsBluRay($isBluRay)
    {
        $this->isBluRay = $isBluRay;
    }

    /**
     * @return mixed
     */
    public function getIsWritable()
    {
        return $this->isWritable;
    }

    /**
     * @param mixed $isWritable
     */
    public function setIsWritable($isWritable)
    {
        $this->isWritable = $isWritable;
    }

    /**
     * @return mixed
     */
    public function getReadingTime()
    {
        return $this->readingTime;
    }

    /**
     * @param mixed $readingTime
     */
    public function setReadingTime($readingTime)
    {
        $this->readingTime = $readingTime;
    }

    /**
     * @return mixed
     */
    public function getWritingTime()
    {
        return $this->writingTime;
    }

    /**
     * @param mixed $writingTime
     */
    public function setWritingTime($writingTime)
    {
        $this->writingTime = $writingTime;
    }


}