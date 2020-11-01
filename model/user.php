<?php

// chaque instance de user REPRESENTE une ligne dans la table user

class User
{
	private $_id, $_fname, $_lname, $_email, $_password, $_country, $_region, $_zipcode, $_address, $_picture;
	
  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }
  
  // GETTERS //
  
  public function getId()
  {
    return $this->_id;
  }

    public function getFname()
  {
    return $this->_fname;
  }

  public function getLname()
  {
    return $this->_lname;
  }

  public function getEmail()
  {
    return $this->_email;
  }

    public function getPassword()
  {
    return $this->_password;
  }

  public function getCountry()
  {
    return $this->_country;
  }

	public function getRegion()
  {
    return $this->_region;
  }

  	public function getZipcode()
  {
    return $this->_zipcode;
  }

  	public function getAddress()
  {
    return $this->_address;
  }

	public function getPicture()
  {
    return $this->_picture;
  }

  // SETTERS //
  
  public function setId($id)
  {
    $id = (int) $id;
    
    if ($id > 0)
    {
      $this->_id = $id;
    }
  }

    public function setLname($lname)
  {

    if (is_string($lname))
    {
      $this->_lname = $lname;
    }
   
  }

        public function setFname($fname)
  {

    if (is_string($fname))
    {
      $this->_fname = $fname;
    }
   
  }
      public function setEmail($email)
  {

    if (is_string($email))
    {
      $this->_email = $email;
    }
   
  }
      public function setPassword($pwd)
  {

    if (is_string($pwd))
    {
      $this->_password = $pwd;
    }
   
  }
      public function setCountry($country)
  {

    if (is_string($country))
    {
      $this->_country = $country;
    }
   
  }
      public function setRegion($region)
  {

    if (is_string($region))
    {
      $this->_region = $region;
    }
   
  }
      public function setZipcode($zipcode)
  {

    if (is_string($zipcode))
    {
      $this->_zipcode = $zipcode;
    }
   
  }
      public function setAddress($address)
  {

    if (is_string($address))
    {
      $this->_address = $address;
    }
   
  }
      public function setPicture($picture)
  {

    if (is_string($picture))
    {
      $this->_picture = $picture;
    }
   
  }
}

?>