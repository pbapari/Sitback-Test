<?php

/**
 * @file
 * Contains \Drupal\form_in_block\Plugin\Block\CreditCardBlock.
 */

namespace Drupal\form_in_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "credit_card_block",
 *   admin_label = @Translation("Credit Card block"),
 *   category = @Translation("Credit Card block example")
 * )
 */
class CreditCardBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\form_in_block\Form\CreditCardForm');
    return $form;
  }

}
