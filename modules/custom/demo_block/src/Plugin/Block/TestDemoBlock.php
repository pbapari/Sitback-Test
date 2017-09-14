<?php

/**
 * 
 */

namespace Drupal\demo_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides 'POLS' block
 * 
 * @Block(
 *  id = "test_demo_block",
 *  admin_label = @Translation("Test Demo Block"),
 * )
 */
class TestDemoBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['demo_block_settings'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['demo_block_settings']) ? $config['demo_block_settings'] : 'Please enter',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);

    $this->setConfigurationValue('demo_block_settings', $form_state->getValue('demo_block_settings'));
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $demo_block_settings = isset($config['demo_block_settings']) ? $config['demo_block_settings'] : '';
    return array(
      '#type' => 'markup',
      '#markup' => $this->t('Hello @hello_text', array('@hello_text' => $demo_block_settings)),
    );
  }

}
