<?php

/**
 * @file
 * Contains origin.page.inc.
 *
 * Page callback for Origin entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Origin templates.
 *
 * Default template: origin.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_origin(array &$variables) {
  // Fetch Origin Entity Object.
  $origin = $variables['elements']['#origin'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
