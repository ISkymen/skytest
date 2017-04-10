<?php

namespace Drupal\s_custom_entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the S-Contact entity.
 *
 * @see \Drupal\s_custom_entity\Entity\SkyContact.
 */
class SkyContactAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\s_custom_entity\Entity\SkyContactInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished s-contact entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published s-contact entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit s-contact entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete s-contact entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add s-contact entities');
  }

}
