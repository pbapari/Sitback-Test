<?php

/**
 * @file
 * Contains \Drupal\form_in_block\Plugin\Block\VoucherBlock.
 */

namespace Drupal\form_in_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a 'article' block.
 *
 * @Block(
 *   id = "voucher_block",
 *   admin_label = @Translation("Voucher block"),
 *   category = @Translation("Voucher block example")
 * )
 */
class VoucherBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\form_in_block\Form\VoucherForm');
    return $form;
  }

}
