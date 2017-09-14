<?php

/**
 * @file
 * Contains \Drupal\dynamic_content\Controller\DynamicContent
 */

namespace Drupal\dynamic_content\Controller;

use Drupal\Core\Controller\ControllerBase;

class DynamicContent {

  public function changeContent($dynamic_content) {
    return array(
      '#title' => 'Dynamic Content',
      '#markup' => t('Hello @dmc', array('@dmc' => $dynamic_content)),
    );
  }

}
