<?php

namespace Drupal\d10_dimension_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the 'd10_dimension_field_dimensionwidget' field widget.
 *
 * @FieldWidget(
 *   id = "d10_dimension_field_dimensionwidget",
 *   label = @Translation("Dimension Widget"),
 *   field_types = {"d10_dimension_field_dimension_field"},
 * )
 */
class DimensionwidgetWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'foo' => 'bar',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $element['foo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Foo'),
      '#default_value' => $this->getSetting('foo'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary[] = $this->t('Foo: @foo', ['@foo' => $this->getSetting('foo')]);
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    // $foo = $this->getFieldSetting('description_text');
    // dump($foo);
    $element['box_length'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->box_length) ? $items[$delta]->box_length : NULL,
    ];
    $element['box_height'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->box_height) ? $items[$delta]->box_height : NULL,
    ];
    $element['box_color'] = [
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->box_color) ? $items[$delta]->box_color : NULL,
    ];

    return $element;
  }

}
