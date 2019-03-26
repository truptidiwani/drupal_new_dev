<?php
namespace Drupal\weather_cast\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
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
   
  public function build() {
    //return \Drupal::formBuilder()->getForm('Drupal\drupal_form\Form\BaseForm');
    $config = $this->getConfiguration();
    $city = isset($config['city']) ? $config['city'] : '';   
    // $desc = isset($config['desc']) ? $config['desc'] : 'Beautiful and scenic beauty';    
    // $img = isset($config['img']) ? $config['img'] : 'https://www.google.com/url?sa=i&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjdpoTB0Z3hAhVRg-YKHRvIAXAQjRx6BAgBEAU&url=https%3A%2F%2Fwww.123rf.com%2Fphoto_56228354_beautiful-goa-province-beach-in-india-with-fishing-boats-and-stones-in-the-sea.html&psig=AOvVaw0VbJ-MBmjR-sYNfHacoknL&ust=1553615127034952';    

    return array(
         '#markup' => $this->t('@city', array('@city'=> $city)),
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
          '#default_value' => isset($config['city'])? $config['city'] : '',
        );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->ConfigurationValue('city', $form_state->getValue('city'));
    
  }
    }
  