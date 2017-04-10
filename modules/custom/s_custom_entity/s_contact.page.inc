<?php

/**
 * @file
 * Contains s_contact.page.inc.
 *
 * Page callback for S-Contact entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for S-Contact templates.
 *
 * Default template: s_contact.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_s_contact(array &$variables) {
  // Fetch SkyContact Entity Object.
  $s_contact = $variables['elements']['#s_contact'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
