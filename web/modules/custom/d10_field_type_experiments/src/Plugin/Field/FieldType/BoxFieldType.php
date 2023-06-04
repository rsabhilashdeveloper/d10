<?php

namespace Drupal\d10_field_type_experiments\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Defines the 'box' field type.
 *
 * @FieldType(
 *   id = "box",
 *   label = @Translation("Box"),
 *   category = @Translation("General"),
 *   default_widget = "d10_field_type_experiments_boxwidget",
 *   default_formatter = "string"
 * )
 *
 * @DCG
 * If you are implementing a single value field type you may want to inherit
 * this class form some of the field type classes provided by Drupal core.
 * Check out /core/lib/Drupal/Core/Field/Plugin/Field/FieldType directory for a
 * list of available field type implementations.
 */
class BoxFieldType extends FieldItemBase
{

  /**
   * {@inheritdoc}
   */
  public static function defaultStorageSettings()
  {
    $settings = ['shape' => 'rectangle'];
    return $settings + parent::defaultStorageSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function storageSettingsForm(array &$form, FormStateInterface $form_state, $has_data)
  {
    $element['shape'] = [
      '#type' => 'select',
      '#title' => $this->t('Shape'),
      '#options' => [
        'circle' => $this->t('Circle'),
        'square' => $this->t('Square'),
        'rectangle' => $this->t('Rectangle')
      ],
      '#default_value' => $this->getSetting('shape'),
      '#disabled' => $has_data,
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty()
  {
    $value = $this->get('length')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition)
  {

    // @DCG
    // See /core/lib/Drupal/Core/TypedData/Plugin/DataType directory for
    // available data types.
    $properties['length'] = DataDefinition::create('string')
      ->setLabel(t('Length'))
      ->setRequired(TRUE);
    $properties['height'] = DataDefinition::create('string')
      ->setLabel(t('Height'))
      ->setRequired(TRUE);
    $properties['color'] = DataDefinition::create('string')
      ->setLabel(t('Color'))
      ->setRequired(TRUE);

    return $properties;
  }



  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition)
  {

    $columns = [
      'length' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Length of box.',
        'length' => 255,
      ],
      'height' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Height of box.',
        'length' => 255,
      ],
      'color' => [
        'type' => 'varchar',
        'not null' => FALSE,
        'description' => 'Color of box.',
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
