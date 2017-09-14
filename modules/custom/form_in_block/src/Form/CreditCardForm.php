<?php

/**
 * @file
 * Contains \Drupal\form_in_block\Form\CreditCardForm.
 */

namespace Drupal\form_in_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class CreditCardForm extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  protected function getEditableConfigNames() {
    return [
      'credit_card_form.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'credit_card_form';
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
    $form['card'] = array(
      '#type' => 'textfield',
      '#title' => t('Card'),
      '#required' => TRUE,
    );
    $form['cvv'] = array(
      '#type' => 'textfield',
      '#title' => t('CVV'),
      '#required' => TRUE,
    );
    /* $form['actions']['#type'] = 'actions';
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
    // Assert the firstname is valid
    if (!$form_state->getValue('name') || empty($form_state->getValue('name')) || !ctype_alpha($form_state->getValue('name'))) {
      $form_state->setErrorByName('name', $this->t('Name field should not blank and accept only charecter.'));
    }
    // Assert the lastname is valid
    if (!$form_state->getValue('card') || empty($form_state->getValue('card')) || !ctype_digit($form_state->getValue('card'))) {
      $form_state->setErrorByName('card', $this->t('Card field should not blank and accept only integer value.'));
    }
    // Assert the email is valid
    if (!$form_state->getValue('cvv') || !ctype_digit($form_state->getValue('cvv')) || strlen($form_state->getValue('cvv'))!= 3) {
      $form_state->setErrorByName('cvv', $this->t('CVV field should not blank and accept only integer value and length sholud be three.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $values = array(
      'name' => $form_state->getValue('name'),
      'card' => $form_state->getValue('card'),
      'cvv' => $form_state->getValue('cvv'),
    );
    $insert = db_insert('credit_card')
        ->fields(array(
          'name' => $values['name'],
          'card' => $values['card'],
          'cvv' => $values['cvv'],
        ))
        ->execute();

    drupal_set_message($this->t('Your CreditCard details have been saved successfully !!!'));
  }

}
