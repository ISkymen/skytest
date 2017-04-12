<?php

/**
 * @file
 * Contains addy_additive.page.inc.
 *
 * Page callback for Additive entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Additive templates.
 *
 * Default template: addy_additive.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_addy_additive(array &$variables) {
  // Fetch Additive Entity Object.
  $addy_additive = $variables['elements']['#addy_additive'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
