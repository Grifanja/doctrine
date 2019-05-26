<?php


namespace core\main;


/**
 * Class Store
 *
 * @Entity @Table(name="Store")
 *
 **/
class Store
{

    /** @Id @Column(type="integer") @GeneratedValue * */
    protected $id;
    /** @Column(type="string") * */
    protected $name;
    /** @Column(type="string", name="second_name") * */
    protected $secondName = '';
    protected $tmp= '';

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
    public function setId($id): void
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
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * @param mixed $secondName
     */
    public function setSecondName($secondName): void
    {
        $this->secondName = $secondName;
    }


}