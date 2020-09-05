<?php

/**
 * @param node object
 * @return Array of faq content type categories
 */

use Drupal\taxonomy\Entity\Term;

function get_faq_categories_by_node($node) {
  $category_node_list = $node->get('field_faq_categories')->getValue();
  $category_list = [];
  foreach ($category_node_list as $cat) {
    array_push($category_list, ['id' => $cat['target_id'], 'term' => Term::load($cat['target_id'])->getName()]);
  }

  return $category_list;
}




/**
 * @return Array of faq nodes
 */

function get_faq_node_list() {

  $node_list = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'faq']);
  $custom_list = [];

  foreach ($node_list as $node) {
    $title = !empty($node->get('title')->getValue()) ?
      $node->get('title')->getValue()[0]['value'] : '';

    $answer = !empty($node->get('field_answer_1')->getValue()) ?
      $node->get('field_answer_1')->getValue()[0]['value'] : '';

    $category = !empty($node->get('field_category')->getValue()) ?
      $node->get('field_category')->getValue()[0]['target_id'] : '';

    $weight = !empty($node->get('field_weight')->getValue()) ?
      $node->get('field_weight')->getValue()[0]['value'] : "0";


    array_push($custom_list, [
      'title' => $title,
      'answer' => $answer,
      'category' => $category,
      'weight' => $weight
    ]);
  };

  usort($custom_list, function ($a, $b) {
    return intval($a['weight']) - intval($b['weight']);
  });

  return $custom_list;
}
