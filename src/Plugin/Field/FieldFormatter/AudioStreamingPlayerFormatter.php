<?php

namespace Drupal\audio_streaming_player\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Define the "audio streaming player formatter".
 *
 * @FieldFormatter(
 *   id = "audio_streaming_player_formatter",
 *   label = @Translation("Audio Streaming Player Formatter"),
 *   description = @Translation("Desc for audio streming player Formatter"),
 *   field_types = {
 *     "audio_streaming_player_type"
 *   }
 * )
 */


class AudioStreamingPlayerFormatter extends FormatterBase {


    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return [
            'skin' => 'Theme ',
        ] + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */

    public function settingsForm(array $form, FormStateInterface $form_state) {
        $form['skin'] = [
            '#type' => 'radios',
            '#title' => $this->t('Select the theme for the player'),
            '#options' => [
                0 => $this->t('Black Player'),
                1 => $this->t('Circular Player'),
                2 => $this->t('Only Text'),

            ],
            '#default_value' => $this->getSetting('skin'),

        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        $about = '';

        if ($this->getSetting('skin') == 0) {
            $about = 'Black';
        } else if ($this->getSetting('skin') == 1) {
            $about = 'Circular';
        } else if ($this->getSetting('skin') == 2) {
            $about = 'Text';
        }
        $summary[] = $this->t("Chosen theme: @skin", ["@skin" => $about]);
        return $summary;
    }

    /**
     * {@inheritdoc}
     */

    public function viewElements(FieldItemListInterface $items, $langcode) {
        $element = [];

        if (($this->getSetting('skin')) == 0) {
            $element[0] = [
                '#theme' => 'audio_streaming_player_black',
            ];
        } else if (($this->getSetting('skin')) == 1) {
            $element[0] = [
                '#theme' => 'audio_streaming_player_circular',
            ];
        } else if (($this->getSetting('skin')) == 2) {
            $element[0] = [
                '#theme' => 'audio_streaming_player_text',
            ];
        }
        return $element;
    }
}
