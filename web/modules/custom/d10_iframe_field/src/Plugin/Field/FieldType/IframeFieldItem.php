<?php

namespace Drupal\d10_iframe_field\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'd10_iframe_field_iframe_field' field type.
 *
 * @FieldType(
 *   id = "d10_iframe_field_iframe_field",
 *   label = @Translation("Iframe Field"),
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
class IframeFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings() {
    $settings = ['foo' => 'wine'];
    return $settings + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data) {

    $element['foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->getSetting('foo'),
      '#disabled' => $has_data,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    $settings = ['bar' => 'beer'];
    return $settings + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {

    $element['bar'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Bar'),
      '#default_value' => $this->getSetting('bar'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('iframe')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    // @DCG
    // See /core/lib/Drupal/Core/TypedData/Plugin/DataType directory for
    // available data types.
    $properties['iframe'] = DataDefinition::create('string')
    ->setLabel(t('Text value'))
    ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  // public function getConstraints() {
  //   $constraints = parent::getConstraints();

  //   $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();

  //   // @DCG Suppose our value must not be longer than 10 characters.
  //   // $options['iframe_code']['Length']['max'] = 10;

  //   // @DCG
  //   // See /core/lib/Drupal/Core/Validation/Plugin/Validation/Constraint
  //   // directory for available constraints.
  //   // $constraints[] = $constraint_manager->create('ComplexData', $options);
  //   return $constraints;
  // }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {

    $columns = [
      'iframe' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Column description.',
        'length' => 255,
      ]
    ];

    $schema = [
      'columns' => $columns,
      // @DCG Add indexes here if necessary.
    ];
    return $schema;

  }

  /**
   * {@inheritdoc}
   */
  // public static function generateSampleValue(FieldDefinitionInterface $field_definition) {
  //   $random = new Random();
  //   $values['iframe_code'] = $random->word(mt_rand(1, 50));
  //   return $values;
  // }

}
