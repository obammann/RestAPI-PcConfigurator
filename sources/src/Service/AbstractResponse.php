<?php
/**
 * Created by PhpStorm.
 * User: bigf3
 * Date: 21.07.2016
 * Time: 12:45
 */

namespace HsBremen\WebApi\Service;


use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractResponse implements \JsonSerializable
{

    private $componentName;
    private $componentId;
    private $action;
    private $state;


    public function __construct(){}

    /**
     * This class is used for response in case of some error.
     * So the response will include the name, id, action(current method) & state(content of the error)
     * @param $comName
     * @param $comId
     * @param $action
     * @param $state
     */
    public function initResponse($comName, $comId, $action, $state){
        $this->componentName = $comName;
        $this-> componentId = $comId;
        $this->action = $action;
        $this->state = $state;
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
            'id' => $this->componentId,
            'name' => $this->componentName,
            'action' => $this->action,
            'state' => $this->state,
        ];
    }

    /**
     * @return mixed
     */
    public function getComponentName()
    {
        return $this->componentName;
    }

    /**
     * @param mixed $componentName
     */
    public function setComponentName($componentName)
    {
        $this->componentName = $componentName;
    }

    /**
     * @return mixed
     */
    public function getComponentId()
    {
        return $this->componentId;
    }

    /**
     * @param mixed $componentId
     */
    public function setComponentId($componentId)
    {
        $this->componentId = $componentId;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * welcome response for GET /
     * @return JsonResponse
     */
    public function getWelcomeMessage(){

        return new JsonResponse([
            'Welcome'           => "Willkommen zum RestApi-PCConfigurator",
            'Course'            => "MI_REST_API_ENTWICKLUNG_2016",
            'University'        => "Bremen University of Applied Sciences",
            'Team member_1'     => "Lennard Plog ()",
            'Team member_2'     => "Christoph Schütte ()",
            'Team member_3'     => "Oliver Bammann (360330)",
            'Team member_4'     => "Fabian Redecker (375750)",
        ]);
    }


}