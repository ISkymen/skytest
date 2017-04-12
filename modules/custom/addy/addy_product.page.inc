<?php

/**
 * @file
 * Contains addy_product.page.inc.
 *
 * Page callback for Product entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Product templates.
 *
 * Default template: addy_product.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_addy_product(array &$variables) {
  // Fetch Product Entity Object.
  $addy_product = $variables['elements']['#addy_product'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
