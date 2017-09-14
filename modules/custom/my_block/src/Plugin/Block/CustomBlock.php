<?php

/**
 * @file
 * A custom block
 */

namespace Drupal\my_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * My custom block
 * @Block(
 *  id = "my_custom_block_demo",
 *  admin_label = @Translation("My Custom Block Test"),
 *  category = @Translation("Blocks")
 * )
 */
class CustomBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    
    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();
    
    // Add a form field to the existing block configuration form.
    
    $form['org_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Organization'),
      '#default_value' => isset($config['org_name']) ? $config['org_name'] : '',
    );
    $form['org_loc'] = array(
      '#type' => 'textfield',
      '#title' => t('Location'),
      '#default_value' => isset($config['org_loc']) ? $config['org_loc'] : '',
    );
    $form['org_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID'),
      '#default_value' => isset($config['org_mail']) ? $config['org_mail'] : '',
    );
    $form['org_phn'] = array(
      '#type' => 'number',
      '#title' => t('Phone'),
      '#default_value' => isset($config['org_phn']) ? $config['org_phn'] : '',
    );    
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('org_name', $form_state->getValue('org_name'));
    $this->setConfigurationValue('org_loc', $form_state->getValue('org_loc'));
    $this->setConfigurationValue('org_mail', $form_state->getValue('org_mail'));
    $this->setConfigurationValue('org_phn', $form_state->getValue('org_phn'));
  }

  
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    
    $org_name = isset($config['org_name']) ? $config['org_name'] : '';
    $org_loc = isset($config['org_loc']) ? $config['org_loc'] : '';
    $org_mail = isset($config['org_mail']) ? $config['org_mail'] : '';
    $org_phn = isset($config['org_phn']) ? $config['org_phn'] : '';
    
    return array(
      '#markup' => $this->t('Organuzation: @org <br/> Location: @loc <br/> E-Mail: @mail <br/> Phone: @phn', array('@org' => $org_name, '@loc' => $org_loc, '@mail' => $org_mail, '@phn' => $org_phn)),
    );
  }
  /**
   * 
   * @param AccountInterface $account
   * @return type
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access administration pages');
  }  
  
}
