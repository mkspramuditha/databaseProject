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
//        $query = "SELECT * FROM `users` WHERE `username` = '$username'";
        $query = "SELECT * FROM `users` JOIN roles ON users.roleId = roles.roleId WHERE `username` = '$username' ";
//        var_dump($query);
//        exit;
        $result  = mysqli_query($connection, $query);
//        var_dump($connection->error);
//        exit;
        $row = mysqli_fetch_array($result);
//        var_dump($row);
//        exit;
        if($row !=null){
            $user = new Users();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setEmail($row['email']);
            $user->setRoles(array($row['roleId']));
//            var_dump("shan");
//            exit;
            return $user;
        }
        else{
//            var_dump("error");
//            exit;
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