<?php

namespace Drupal\addy\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Origin entity.
 *
 * @ingroup addy
 *
 * @ContentEntityType(
 *   id = "addy_origin",
 *   label = @Translation("Origin"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\addy\OriginListBuilder",
 *     "views_data" = "Drupal\addy\Entity\OriginViewsData",
 *     "translation" = "Drupal\addy\OriginTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\addy\Form\OriginForm",
 *       "add" = "Drupal\addy\Form\OriginForm",
 *       "edit" = "Drupal\addy\Form\OriginForm",
 *       "delete" = "Drupal\addy\Form\OriginDeleteForm",
 *     },
 *     "access" = "Drupal\addy\OriginAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\addy\OriginHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "addy_origin",
 *   data_table = "addy_origin_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer origin entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/addy/addy_origin/{addy_origin}",
 *     "add-form" = "/admin/structure/addy/addy_origin/add",
 *     "edit-form" = "/admin/structure/addy/addy_origin/{addy_origin}/edit",
 *     "delete-form" = "/admin/structure/addy/addy_origin/{addy_origin}/delete",
 *     "collection" = "/admin/structure/addy/addy_origin",
 *   },
 *   field_ui_base_route = "addy_origin.settings"
 * )
 */
class Origin extends ContentEntityBase implements OriginInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);


    $fields['name'] = BaseFieldDefinition::create('string')
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


    $fields['weight'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Weight'))
      ->setDescription(t('The weight of this term in relation to other terms.'))
      ->setDefaultValue(0)
      ->setSettings(array(
        'size' => 'tiny',
        'min' => 0,
        'max' => 9
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'number_integer',
        'weight' => 4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'number',
        'weight' => 0,
      ));

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

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['parent'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Term Parents'))
      ->setDescription(t('The parents of this term.'))
      ->setSetting('target_type', 'addy_origin')
//      ->setCardinality(BaseFieldDefinition::CARDINALITY_UNLIMITED)
//      ->setCustomStorage(TRUE)

    ->setDisplayOptions('form', array(
      'type' => 'text_textfield',
      'weight' => 0,
    ));

    return $fields;
  }

}
