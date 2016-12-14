<?php

namespace AppBundle\Security;

use AppBundle\Entity\Users;
use AppBundle\Orm\DatabaseHandler;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $connection = DatabaseHandler::getInstance()->connect();
        $query = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result  = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        if($row !=null){
            $user = new Users();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            $user->setRoles(['ROLE_ADMIN']);
            return $user;
        }
        else{
            return new UsernameNotFoundException("Username not found :". $username);
        }

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Users) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
         return $class === 'AppBundle\Entity\Users';
    }

}