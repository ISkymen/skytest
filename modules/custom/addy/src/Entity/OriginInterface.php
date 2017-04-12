<?php

namespace Drupal\addy\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface for defining Origin entities.
 *
 * @ingroup addy
 */
interface OriginInterface extends  ContentEntityInterface, EntityChangedInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Origin name.
   *
   * @return string
   *   Name of the Origin.
   */
  public function getName();

  /**
   * Sets the Origin name.
   *
   * @param string $name
   *   The Origin name.
   *
   * @return \Drupal\addy\Entity\OriginInterface
   *   The called Origin entity.
   */
  public function setName($name);


}
