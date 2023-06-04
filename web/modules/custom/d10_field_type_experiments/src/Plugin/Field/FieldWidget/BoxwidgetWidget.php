<?php

namespace Drupal\d10_field_type_experiments\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'd10_field_type_experiments_boxwidget' field widget.
 *
 * @FieldWidget(
 *   id = "d10_field_type_experiments_boxwidget",
 *   label = @Translation("BoxWidget"),
 *   field_types = {"box"},
 * )
 */
class BoxwidgetWidget extends WidgetBase
{

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings()
  {
    return [
      'show_helptext' => true,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state)
  {

    $element['show_helptext'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show help text'),
      '#default_value' => $this->getSetting('show_helptext'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary()
  {
    $summary[] = $this->t('Show help text: @show_helptext', ['@show_helptext' => $this->getSetting('show_helptext')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state)
  {

    $element['length'] = $element + [
      '#type' => 'textfield',
      '#title' => t('Length'),
      '#default_value' => isset($items[$delta]->length) ? $items[$delta]->length : NULL,
    ];
    $element['height'] = $element + [
      '#type' => 'textfield',
      '#title' => 'Height',
      '#default_value' => isset($items[$delta]->height) ? $items[$delta]->height : NULL,
    ];
    $element['color'] = $element + [
      '#type' => 'textfield',
      '#title' => 'Color',
      '#default_value' => isset($items[$delta]->color) ? $items[$delta]->color : NULL,
    ];
    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('class' => array('container-inline')),
      );
    }

    return $element;
  }
}
