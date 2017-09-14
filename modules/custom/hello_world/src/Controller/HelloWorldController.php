<?php

/**
 * @file
 * Contains \Drupal\hello_world\Controller\HelloWorldController
 */

namespace Drupal\hello_world\Controller;

class HelloWorldController {

  public function hello() {
    $config = \Drupal::config('hello_world.adminsettings');
    return array(
      '#title' => 'Hello World',
      '#markup' => $config->get('message'),
    );
  }

}
