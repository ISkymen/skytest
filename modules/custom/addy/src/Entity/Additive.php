<?php

namespace Drupal\addy\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Additive entity.
 *
 * @ingroup addy
 *
 * @ContentEntityType(
 *   id = "addy_additive",
 *   label = @Translation("Additive"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\addy\AdditiveListBuilder",
 *     "views_data" = "Drupal\addy\Entity\AdditiveViewsData",
 *     "translation" = "Drupal\addy\AdditiveTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\addy\Form\AdditiveForm",
 *       "add" = "Drupal\addy\Form\AdditiveForm",
 *       "edit" = "Drupal\addy\Form\AdditiveForm",
 *       "delete" = "Drupal\addy\Form\AdditiveDeleteForm",
 *     },
 *     "access" = "Drupal\addy\AdditiveAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\addy\AdditiveHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "addy_additive",
 *   data_table = "addy_additive_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer additive entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/addy/addy_additive/{addy_additive}",
 *     "add-form" = "/admin/structure/addy/addy_additive/add",
 *     "edit-form" = "/admin/structure/addy/addy_additive/{addy_additive}/edit",
 *     "delete-form" = "/admin/structure/addy/addy_additive/{addy_additive}/delete",
 *     "collection" = "/admin/structure/addy/addy_additive",
 *   },
 *   field_ui_base_route = "addy_additive.settings"
 * )
 */
class Additive extends ContentEntityBase implements AdditiveInterface {

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
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Additive entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 6,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['code'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Index'))
      ->setDescription(t('The index of additive (Number after "E" symbol).'))
      ->setDefaultValue(0)
      ->setSettings(array(
        'unsigned' => TRUE,
        'size' => 'small',
        'min' => 100,
        'max' => 1999
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


    $fields['suffix'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Suffix'))
      ->setDescription(t("The suffix of additive (Number or symbol after additive's code)."))
      ->setSettings(array(
        'type' => 'textfield',
        'size' => 5,
        'max_length' => 5,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => 1,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'textfield',
        'size' => 5,
        'max_length' => 5,
        'weight' => 1,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['full_code'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Full code'))
      ->setDescription(t("The full code of additive (With 'E' symbol, code and suffix)."))
      ->setSettings(array(
        'type' => 'textfield',
        'size' => 10,
        'max_length' => 10,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'textfield',
        'size' => 5,
        'max_length' => 5,
        'weight' => 2,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Additive entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => 4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['synonyms'] = BaseFieldDefinition::create('string_long')
      ->setLabel(t('Synonyms'))
      ->setDescription(t('The synonyms of the Additive.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textarea',
        'weight' => 5,
        'settings' => array(
          'rows' => 4,
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['info'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Additive info'))
      ->setDescription(t('The information about Additive.'))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => 6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['origin'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Origin'))
      ->setDescription(t("Additive's orgigin"))
      ->setSetting('target_type', 'addy_origin')
      ->setSettings(array(
        'handler'          => 'default',
        'handler_settings' => array(            // Added
          'auto_create'    => TRUE              // Added
        )
      ))
      ->setDisplayOptions('form', array(
        'type'     => 'entity_reference_autocomplete',
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size'           => 60,
          'placeholder'    => ''
        ),
        'weight'   => 5
      ))
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'string',
        'weight' => 1,
      ))
      ->setRequired(TRUE)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);


    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Additive is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
