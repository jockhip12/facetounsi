<?php

/**
 *  Le manager est le responsable de gérer (consulter, ajouter, modifier et supprimer ...)
 */
class UserManager
{
	
 private $_db; // Instance de PDO
  
  public function __construct($db)
  {
    $this->setDb($db);
  }
  
  public function add(User $user)
  {
    $q = $this->_db->prepare('INSERT INTO user SET fname = :fname, lname = :lname, email = :email, password = :password, country = :country, region = :region, zipcode = :zipcode, address = :address, picture = :picture ');
    $q->bindValue(':fname', $user->getFname());
    $q->bindValue(':lname', $user->getLname());
    $q->bindValue(':email', $user->getEmail());
    $q->bindValue(':password', $user->getPassword());
    $q->bindValue(':country', $user->getCountry());
    $q->bindValue(':region', $user->getRegion());
    $q->bindValue(':zipcode', $user->getZipcode());
    $q->bindValue(':address', $user->getAddress());
    $q->bindValue(':picture', $user->getPicture());
    $q->execute();
    
    $user->hydrate([
      'id' => $this->_db->lastInsertId()
    ]);
  }
  
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM user')->fetchColumn();
  }
  
  public function delete(User $user)
  {
    $this->_db->exec('DELETE FROM user WHERE id = '.$user->getId());
  }
  
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel User ayant pour id $info existe.
    {
      return (bool) $this->_db->query('SELECT COUNT(*) FROM user WHERE id = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->_db->prepare('SELECT COUNT(*) FROM user WHERE email = :email');
    $q->execute([':email' => $info]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT * FROM user WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      
      return new User($donnees);
    }
    else
    {
      $q = $this->_db->prepare('SELECT * FROM user WHERE email = :email');
      $q->execute([':email' => $info]);
    
      return new User($q->fetch(PDO::FETCH_ASSOC));
    }
  }
  
  public function getList($email)
  {
    $users = [];
    
    $q = $this->_db->prepare('SELECT * FROM user WHERE email <> :email ORDER BY fname');
    $q->execute([':email' => $email]);
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $users[] = new User($donnees);
    }
    
    return $users;
  }
  
  public function update(User $user)
  {
    $q = $this->_db->prepare('UPDATE user SET fname = :fname, lname =:lname, pssword=:password, country =:country, region =:region, zipcode = :zipcode, address =:address, picture =:picture WHERE id = :id');
    
 	$q->bindValue(':fname', $user->getFname());
    $q->bindValue(':lname', $user->getLname());
    $q->bindValue(':email', $user->getEmail());
    $q->bindValue(':password', $user->getPassword());
    $q->bindValue(':country', $user->getCountry());
    $q->bindValue(':region', $user->getRegion());
    $q->bindValue(':zipcode', $user->getZipcode());
    $q->bindValue(':address', $user->getAddress());
    $q->bindValue(':picture', $user->getPicture());

    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}


?>