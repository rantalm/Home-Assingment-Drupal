<?php

/**
 * @file
 * Contains \Drupal\faq_module\Controller\FaqController.
 */

namespace Drupal\faqm\Controller;

class FaqmController {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('FAQ Module!'),
    );
  }
}
