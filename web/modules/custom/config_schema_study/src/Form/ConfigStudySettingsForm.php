<?php

namespace Drupal\config_schema_study\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Config Schema Study settings for this site.
 */
class ConfigStudySettingsForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'config_schema_study_config_study_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['config_schema_study.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['length'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Length'),
      '#default_value' => $this->config('config_schema_study.settings')->get('length'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('config_schema_study.settings')
      ->set('length', $form_state->getValue('length'))
      ->set('categories', ['a', 'b'])
      ->save();
    parent::submitForm($form, $form_state);
  }
}
