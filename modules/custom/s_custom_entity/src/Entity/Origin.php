<?php

namespace Drupal\s_custom_entity\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Origin entity.
 *
 * @ingroup s_custom_entity
 *
 * @ContentEntityType(
 *   id = "origin",
 *   label = @Translation("Origin"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\s_custom_entity\OriginListBuilder",
 *     "views_data" = "Drupal\s_custom_entity\Entity\OriginViewsData",
 *     "translation" = "Drupal\s_custom_entity\OriginTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\s_custom_entity\Form\OriginForm",
 *       "add" = "Drupal\s_custom_entity\Form\OriginForm",
 *       "edit" = "Drupal\s_custom_entity\Form\OriginForm",
 *       "delete" = "Drupal\s_custom_entity\Form\OriginDeleteForm",
 *     },
 *     "access" = "Drupal\s_custom_entity\OriginAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\s_custom_entity\OriginHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "origin",
 *   data_table = "origin_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer origin entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "origin",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/origin/{origin}",
 *     "add-form" = "/admin/structure/origin/add",
 *     "edit-form" = "/admin/structure/origin/{origin}/edit",
 *     "delete-form" = "/admin/structure/origin/{origin}/delete",
 *     "collection" = "/admin/structure/origin",
 *   },
 *   field_ui_base_route = "origin.settings"
 * )
 */
class Origin extends ContentEntityBase implements OriginInterface {


  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['origin'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Origin'))
      ->setDescription(t("The Additive's Origin."))
      ->setSettings(array(
        'max_length' => 20,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'text_default',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['info'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Origin info'))
      ->setDescription(t("The Origin's info."))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'text_textfield',
        'weight' => 0,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
