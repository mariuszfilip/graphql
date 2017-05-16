<?php
/**
 * Created by PhpStorm.
 * User: mariusz
 * Date: 09.05.17
 * Time: 16:04
 */

namespace AppBundle\Entity;

class Client {

    private $id;
    private $name;
    private $surname;
    private $pesel;

    /**
     * Client constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $pesel
     */
    public function __construct($id, $name, $surname, $pesel)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->pesel = $pesel;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    public function toArray()
    {
        return
            [
                'pesel'=>$this->getPesel(),
                'name'=>$this->getName(),
                'surname'=>$this->getSurname()
            ];
    }


}