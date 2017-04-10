<?php

namespace Drupal\s_custom_entity\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Additive entities.
 *
 * @ingroup s_custom_entity
 */
interface AdditiveInterface extends  ContentEntityInterface {

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
   * @return \Drupal\s_custom_entity\Entity\AdditiveInterface
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
   * @return \Drupal\s_custom_entity\Entity\AdditiveInterface
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
   * @return \Drupal\s_custom_entity\Entity\AdditiveInterface
   *   The called Additive entity.
   */
  public function setPublished($published);

}
