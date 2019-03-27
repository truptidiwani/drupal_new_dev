<?php

namespace Drupal\weather_cast\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;
use Drupal\file\Entity\File;
//use Drupal\Component\Serialization\Json;
/**
 * Provides a weather_custom_block with a simple text.
 *
 * @Block(
 *   id = "weather_custom_block",
 *   admin_label = @Translation("My block"),
 * )
 */
class MyBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() 
  {
    $config = $this->getConfiguration();
    $city = isset($config['city']) ? $config['city'] : '';   
    $desc = isset($config['desc']) ? $config['desc'] : '';   

    $conf = \Drupal::config('weather_cast.settings');
    $appid= $conf->get('app');
    $serv= \Drupal::service('weather_cast.weather');
    $call = $serv->get_weather($city);
    $jsonObj = json_decode($call);

    //kint($jsonObj);
    //exit();
    //print_r ($jsonObj);

    $image = $config['img'];
    $file = File::load($image[0]);
    $img = $file->getFileUri();
    return array(
     '#theme' => 'weather_cast',
     '#city' => $city,
     '#description' => $desc,
     '#image' => $img,
     '#temp_min' => $jsonObj->main->temp_min ,
     '#temp_max' => $jsonObj->main->temp_max,
     '#pressure'=> $jsonObj->main->pressure,
     '#humidity'=> $jsonObj->main->humidity,
     '#wind'=> $jsonObj->wind->speed,

    );
   }
  
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    $form['city'] = array(
          '#type' => 'textfield',
          '#title'=> t('City :'),
        );
    $form['desc'] = array(
          '#type' => 'textarea',
          '#title'=> t('Description :'),
        );
    $form['image'] = array(
        '#type' => 'managed_file',
        '#upload_location' => 'public://upload/trupti',
        '#title' => t('Image'),
        '#upload_validators' => [
            'file_validate_extensions' => ['jpg', 'jpeg', 'png', 'gif']
        ],
        '#description' => t('The image to display'),
        '#required' => true
    );
    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state )
   {
        $this->setConfigurationValue('city', $form_state->getValue('city'));
        $this->setConfigurationValue('desc', $form_state->getValue('desc'));
        $this->setConfigurationValue('img', $form_state->getValue('image'));
        $image = $form_state->getValue('img');
        //$this->configuration['image'] = $image;
        $file = \Drupal\file\Entity\File::load($image[0]);
        $file->setPermanent();
        $file->save();    
  }
}