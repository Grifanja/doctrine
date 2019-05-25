<?php

/**
 * Class User
 *
 * @Entity @Table(name="users")
 *
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue  **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Coloum(type="string")  **/
    protected $email;

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
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }



}