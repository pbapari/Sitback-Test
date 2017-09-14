<?php

/**
 * 
 */

namespace Drupal\demo_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class DemoForm extends ConfigFormBase {
  /**
   * {@inheritdoc}.
   */  
  
  protected function getEditableConfigNames() {
    return [
      'demo_form.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'demo_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('demo_form.adminsettings');
    $form['email'] = array(
      '#type' => 'email',
      '#title' => $this->t('Enter your email ID'),
      '#description' => $this->t('Please enter email address'),
      '#default_value' => $config->get('email'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->config('demo_form.adminsettings')
        ->set('email', $form_state->getValue('email'))
        ->save();
  }

}
