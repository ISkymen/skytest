<?php

namespace Drupal\s_custom_entity\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Additive entities.
 */
class AdditiveViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
