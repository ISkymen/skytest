<?php

/**
 * @file
 * Contains addy_origin.page.inc.
 *
 * Page callback for Origin entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Origin templates.
 *
 * Default template: addy_origin.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_addy_origin(array &$variables) {
  // Fetch Origin Entity Object.
  $addy_origin = $variables['elements']['#addy_origin'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
