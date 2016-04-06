<?php

/**
 * @file
 * Holds RawImagePath FieldFormatter.
 */

namespace Drupal\manati_custom_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Cache\Cache;

/**
 * RawImagePath Field Formatter.
 *
 * @FieldFormatter(
 *  id = "raw_image_path",
 *  label = @Translation("Raw Path Image"),
 *  description = @Translation("Display the absolute url of the image file"),
 *  field_types = {"image"}
 * )
 */
class RawImagePath extends ImageFormatter {


  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element = parent::settingsForm($form, $form_state);
    unset($element['image_link']);
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    return parent::settingsSummary();
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    $files = $this->getEntitiesToView($items, $langcode);

    // Early opt-out if the field is empty.
    if (empty($files)) {
      return $elements;
    }

    $image_style_setting = $this->getSetting('image_style');
    $image_style = $this->imageStyleStorage->load($image_style_setting);
    $cache_tags = $image_style->getCacheTags();

    foreach ($files as $delta => $file) {
      $image_uri = $file->getFileUri();
      $cache_tags = Cache::mergeTags($cache_tags, $file->getCacheTags());
      $url = $image_style->buildUrl($image_uri, TRUE);

      // Extract field item attributes for the theme function, and unset them
      // from the $item so that the field template does not re-render them.
      $item = $file->_referringItem;
      $item_attributes = $item->_attributes;
      unset($item->_attributes);

      $elements[$delta] = array(
        '#type' => 'markup',
        '#markup' => $url,
        '#cache' => array(
          'tags' => $cache_tags,
        ),
      );
    }

    return $elements;
  }

}
