<?php

namespace Drupal\s_custom_entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Additive entity.
 *
 * @see \Drupal\s_custom_entity\Entity\Additive.
 */
class AdditiveAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\s_custom_entity\Entity\AdditiveInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished additive entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published additive entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit additive entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete additive entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add additive entities');
  }

}
