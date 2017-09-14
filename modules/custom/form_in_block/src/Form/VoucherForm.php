<?php

/**
 * @file
 * Contains \Drupal\form_in_block\Form\VoucherForm.
 */

namespace Drupal\form_in_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class VoucherForm extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  protected function getEditableConfigNames() {
    return [
      'voucher_form.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'voucher_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#required' => TRUE,
    );
    $form['voucher_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Voucher number'),
      '#required' => TRUE,
    );
    /* $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit Button'),
      );
      $form['actions']['#type'] = 'actions';
      $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
      ); */
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate name field
    if (!$form_state->getValue('name') || empty($form_state->getValue('name')) || !ctype_alpha($form_state->getValue('name'))) {
      $form_state->setErrorByName('name', $this->t('Voucher name field should not blank and accept only charecter.'));
    }
    // Validate Voucher number
    if (!$form_state->getValue('voucher_number') || empty($form_state->getValue('voucher_number')) || !ctype_digit($form_state->getValue('voucher_number'))) {
      $form_state->setErrorByName('voucher_number', $this->t('Voucher number field should not blank and accept only integer value.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $values = array(
      'name' => $form_state->getValue('name'),
      'voucher_number' => $form_state->getValue('voucher_number'),
    );
    $insert = db_insert('voucher')
        ->fields(array(
          'name' => $values['name'],
          'voucher_number' => $values['voucher_number'],
        ))
        ->execute();
    drupal_set_message($this->t('Your Voucher details have been saved successfully !!!'));
  }

}
