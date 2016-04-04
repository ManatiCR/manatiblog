<?php /**
 * @file
 * Contains \Drupal\manati_custom_formatters\Plugin\Field\FieldFormatter\TagsArray.
 */

namespace Drupal\manati_custom_formatters\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldFormatter(
 *  id = "tags_array",
 *  label = @Translation("Tags Array"),
 *  description = @Translation("Display a list of tags as an array"),
 *  field_types = {"taxonomy_term_reference"}
 * )
 */
class TagsArray extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element = parent::settingsForm($form, $form_state);
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
  public function viewElements(FieldItemListInterface $items) {

    $elements = array();

    foreach ($items as $delta => $item) {
      var_export($item);
    }

    return $elements;

  }

}


