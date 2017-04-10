<?php

/**
 * @file
 * Contains additive.page.inc.
 *
 * Page callback for Additive entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Additive templates.
 *
 * Default template: additive.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_additive(array &$variables) {
  // Fetch Additive Entity Object.
  $additive = $variables['elements']['#additive'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
