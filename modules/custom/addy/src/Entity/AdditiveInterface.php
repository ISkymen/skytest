<?php

namespace Drupal\addy\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Additive entities.
 *
 * @ingroup addy
 */
interface AdditiveInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Additive name.
   *
   * @return string
   *   Name of the Additive.
   */
  public function getName();

  /**
   * Sets the Additive name.
   *
   * @param string $name
   *   The Additive name.
   *
   * @return \Drupal\addy\Entity\AdditiveInterface
   *   The called Additive entity.
   */
  public function setName($name);

  /**
   * Gets the Additive creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Additive.
   */
  public function getCreatedTime();

  /**
   * Sets the Additive creation timestamp.
   *
   * @param int $timestamp
   *   The Additive creation timestamp.
   *
   * @return \Drupal\addy\Entity\AdditiveInterface
   *   The called Additive entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Additive published status indicator.
   *
   * Unpublished Additive are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Additive is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Additive.
   *
   * @param bool $published
   *   TRUE to set this Additive to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\addy\Entity\AdditiveInterface
   *   The called Additive entity.
   */
  public function setPublished($published);

}
