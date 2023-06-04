<?php

namespace Drupal\d10_dimension_field\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Defines the 'd10_dimension_field_dimension_field' field type.
 *
 * @FieldType(
 *   id = "d10_dimension_field_dimension_field",
 *   label = @Translation("Dimension Field"),
 *   category = @Translation("General"),
 *   default_widget = "string_textfield",
 *   default_formatter = "string"
 * )
 *
 * @DCG
 * If you are implementing a single value field type you may want to inherit
 * this class form some of the field type classes provided by Drupal core.
 * Check out /core/lib/Drupal/Core/Field/Plugin/Field/FieldType directory for a
 * list of available field type implementations.
 */
class DimensionFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    $settings = ['description_text' => 'Dimension field with various params'];
    return $settings + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {

    $element['description_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#default_value' => $this->getSetting('description_text'),
      '#disabled' => $has_data,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    $settings = ['show_color_field' => true];
    return $settings + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element['show_color_field'] = [
      '#type' => 'boolean',
      '#title' => $this->t('Show color field'),
      '#default_value' => $this->getSetting('show_color_field'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('box_length')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // @DCG
    // See /core/lib/Drupal/Core/TypedData/Plugin/DataType directory for
    // available data types.
    $properties['box_length'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Box Length'))
      ->setRequired(TRUE);
    $properties['box_height'] = DataDefinition::create('string')
    ->setLabel(new TranslatableMarkup('Box Height'))
    ->setRequired(TRUE);
    $properties['box_color'] = DataDefinition::create('string')
    ->setLabel(new TranslatableMarkup('Box Color'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();

    // $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();

    // // @DCG Suppose our value must not be longer than 10 characters.
    // $options['value']['Length']['max'] = 10;

    // // @DCG
    // // See /core/lib/Drupal/Core/Validation/Plugin/Validation/Constraint
    // // directory for available constraints.
    // $constraints[] = $constraint_manager->create('ComplexData', $options);
    return $constraints;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'box_length' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Length of box',
        'length' => 255,
      ],
      'box_height' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Height of box',
        'length' => 255,
      ],
      'box_color' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Color of box',
        'length' => 255,
      ],
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];

    return $schema;
  }
}
