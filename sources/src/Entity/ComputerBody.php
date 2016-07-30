<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 13.05.16
 * Time: 20:42
 */

namespace HsBremen\WebApi\Entity;

/**
 * @SWG\Definition(required={"name"}, @SWG\XmL(name="ComputerBody"))
 */
class ComputerBody extends Component implements \JsonSerializable
{

    /**
     * @SWG\Property()
     * @var string
     */
    private $formFactor;

    public function __construct($id, $name, $price, $formFactor)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->formFactor = $formFactor;
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
            'form factor'   => $this->formFactor,
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
    public function getFormFactor()
    {
        return $this->formFactor;
    }

    /**
     * @param mixed $formFactor
     */
    public function setFormFactor($formFactor)
    {
        $this->formFactor = $formFactor;
    }


}