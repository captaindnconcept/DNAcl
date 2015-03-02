<?php

/**
 * File for Acl Class
 *
 * @category  User
 * @package   User_Acl
 * @author    Marco Neumann <webcoder_at_binware_dot_org>
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 * http://p0l0.binware.org/index.php/2012/02/18/zend-framework-2-authentication-acl-using-eventmanager/
 */

namespace DNAcl;

/**
 * @uses Zend\Acl\Acl
 * @uses Zend\Acl\Role\GenericRole
 * @uses Zend\Acl\Resource\GenericResource
 */
use Zend\Permissions\Acl\Acl as ZendAcl,
    Zend\Permissions\Acl\Role\GenericRole as Role,
    Zend\Permissions\Acl\Resource\GenericResource as Resource;

/**
 * Class to handle Acl
 *
 * This class is for loading ACL defined in a config
 *
 * @category User
 * @package  User_Acl
 * @copyright Copyright (c) 2011, Marco Neumann
 * @license   http://binware.org/license/index/type:new-bsd New BSD License
 */
class Acl extends ZendAcl {

   /** Default Role */
   const DEFAULT_ROLE = 'guest';

   /**
    * Constructor
    * @param array $roles
    * @param array $resources
    * @return void
    * @throws AclException
    */
   public function __construct(array $roles, array $resources) {
      $this->createRoles($roles);
      $this->createResources($resources);
   }

   /**
    * Adds Roles to ACL
    * @param array $roles
    * @return Acl
    */
   private function createRoles(array $roles) {
      foreach ($roles as $name => $parent) {
         if ($this->hasRole($name)) {
            continue;
         }
         if (empty($parent)) {
            $parent = [];
         } else {
            $parent = explode(',', $parent);
         }
         $this->addRole(new Role($name), $parent);
      }
      return $this;
   }

   /**
    * Adds Resources to ACL
    *
    * @param array $resources
    * @return User\Acl
    * @throws AclException
    */
   private function createResources(array $resources) {
      foreach ($resources as $permission => $controllers) {
         foreach ($controllers as $controller => $actions) {
            $this->applyControllerACL($permission, $controller, $actions);
         }
      }
      return $this;
   }

   /**
    * 
    * @param string $permission
    * @param string $controller
    * @param string $actions
    * @throws AclException
    */
   private function applyControllerACL($permission, $controller, $actions) {
      if ($controller === 'all') {
         $controller = null;
      } else {
         if (!$this->hasResource($controller)) {
            $this->addResource(new Resource($controller));
         }
      }
      foreach ($actions as $action => $role) {
         if ($action === 'all') {
            $action = null;
         }
         if ($permission === 'allow') {
            $this->allow($role, $controller, $action);
         } elseif ($permission === 'deny') {
            $this->deny($role, $controller, $action);
         } else {
            throw new AclException('No valid permission defined: ' . $permission);
         }
      }
   }

}
