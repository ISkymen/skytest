<?php

namespace Drupal\s_custom_entity\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining S-Contact entities.
 *
 * @ingroup s_custom_entity
 */
interface SkyContactInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the S-Contact name.
   *
   * @return string
   *   Name of the S-Contact.
   */
  public function getName();

  /**
   * Sets the S-Contact name.
   *
   * @param string $name
   *   The S-Contact name.
   *
   * @return \Drupal\s_custom_entity\Entity\SkyContactInterface
   *   The called S-Contact entity.
   */
  public function setName($name);

  /**
   * Gets the S-Contact creation timestamp.
   *
   * @return int
   *   Creation timestamp of the S-Contact.
   */
  public function getCreatedTime();

  /**
   * Sets the S-Contact creation timestamp.
   *
   * @param int $timestamp
   *   The S-Contact creation timestamp.
   *
   * @return \Drupal\s_custom_entity\Entity\SkyContactInterface
   *   The called S-Contact entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the S-Contact published status indicator.
   *
   * Unpublished S-Contact are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the S-Contact is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a S-Contact.
   *
   * @param bool $published
   *   TRUE to set this S-Contact to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\s_custom_entity\Entity\SkyContactInterface
   *   The called S-Contact entity.
   */
  public function setPublished($published);

}
