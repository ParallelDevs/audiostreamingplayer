<?php

namespace Drupal\audio_streaming_player\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a field type of audio streaming player.
 *
 * @FieldType(
 *   id = "audio_streaming_player_type",
 *   label = @Translation("audio streaming player field type"),
 *   category = @Translation("Audio Streaming"),
 *   default_widget = "audio_streaming_player_widget",
 *   default_formatter = "audio_streaming_player_formatter",
 * )
 */
class AudioStreamingPlayerType extends FieldItemBase {



  /**
   * {@inheritdoc}
   */

  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'url' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'skin' => [
          'type' => 'int',
          'default' => 0,
        ],
        'autoplay' => [
          'type' => 'int',
          'default' => 0,
        ],
      ],
    ];
  }


  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'moreinfo' => "streaming player audio settings",
    ] + parent::defaultFieldSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $element = [];
    $element['moreinfo'] = [
      '#type' => 'textfield',
      '#title' => 'More information about this audio streaming player',
      '#required' => false,
      '#default_value' => 'More information',
    ];
    return $element;
  }


  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['url'] = DataDefinition::create('string')->setLabel(t('Create url'));
    $properties['skin'] = DataDefinition::create('integer')->setLabel(t('skin radio'));
    $properties['autoplay'] = DataDefinition::create('boolean')->setLabel(t('auto play'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return [
      'url' => $this->url,
      'skin' => $this->skin,
      'autoplay' => $this->autoplay,
    ];
  }
}
