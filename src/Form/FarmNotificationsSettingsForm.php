<?php

namespace Drupal\farm_notifications\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a farm notifications settings form.
 */
class FarmNotificationsSettingsForm extends ConfigFormbase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'farm_notifications.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'farm_notifications_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateinterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['server_address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server Address'),
      '#description' => $this->t('Enter notification server address.'),
	  '#default_value' => $config->get('server_address'),
    ];
	
	
	
   $form['server_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Server Type'),
      '#description' => $this->t('Select notification server type.'),
      '#options' => [
        'node_red' => $this->t('Node-Red'),
        'ntfy' => $this->t('ntfy'),
		'telegram' => $this->t('Telegram'),
      ],
	  '#default_value' => $config->get('server_type'),
    ];
	
	

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('server_address', $form_state->getValue('server_address'))
	  ->set('server_type', $form_state->getValue('server_type'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}