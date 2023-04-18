<?php

namespace Drupal\audio_streaming_player\Plugin\Field\FieldWidget;

use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Define the "audio streaming player field type".
 *
 * @FieldWidget(
 *   id = "audio_streaming_player_widget",
 *   label = @Translation("Audio Streaming Player Field Widget"),
 *   description = @Translation("Desc for Audio Streaming Player Field Widget"),
 *   field_types = {
 *     "audio_streaming_player_type"
 *   }
 * )
 */
class AudioStreamingPlayerWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter the Stream URL'),
      '#prefix' => "<span>" . $this->getFieldSetting("moreinfo") . "</span>",
      '#default_value' => $items[$delta]->url ?? NULL,
      '#attributes' => [
        'placeholder' => $this->getSetting('placeholder'),
      ],
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return ['placeholder' => 'default'] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t(
      "placeholder text: @placeholder",
      ["@placeholder" => $this->getSetting("placeholder")]
    );

    return $summary;
  }

}
