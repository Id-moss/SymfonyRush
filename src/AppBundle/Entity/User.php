<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $firstname;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $lastname;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     *
     */
    private $pwd;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $postal_adress;

    /**
     * @ORM\Column(type="smallint")
     *
     */
    private $admin = 0;

    public function getFirstname(){
    	return $this->firstname;
    }

    public function setFirstname($firstname){
    	$this->firstname = $firstname;
    }

    public function getLastname(){
    	return $this->lastname;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function checkPwd($pwd){
        return (($this->pwd == password_hash($pwd, PASSWORD_BCRYPT)) ? 0 : 1);
    }

    public function setPwd($pwd){
        $this->pwd = password_hash($pwd, PASSWORD_BCRYPT);
    }

    public function getPostaladress(){
        return $this->postal_adress;
    }

    public function setPostaladress($postal_adress){
        $this->postal_adress = $postal_adress;
    }

    public function getAdmin(){
        return $this->admin;
    }

    public function setAdmin($admin){
        $this->admin = $admin;
    }
}