<?php
namespace Drupal\weather_cast\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class WeatherForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     * Returns a unique string identifying the form.
     */

    public function getFormId(){
        return 'weather_cast.settings';
    }

    /**
     * {@inheritdoc}
     * Gets the configuration names that will be editable.
     */
    protected function getEditableConfigNames() {
        return [ 
          'weather_cast.settings',
        ];
    }

    /**
    * {@inheritdoc}
    *Form constructor. 
    *Overrides FormInterface::buildForm	
    */
    public function buildForm(array $form, FormStateInterface $form_state){
        $config=$this->config('weather_cast.settings');
        $form['appid']=[
            '#type'=> 'textfield',
            '#title'=> $this->t('App ID'),
            '#default_value'=>$config->get('app'),   
            
        ];
        return parent::buildForm($form, $form_state); 
    }

    /**
     * {@inheritdoc}
     * Form validation handler.
     * Overrides FormInterface::validateForm
     */
    public function validateForm(array &$form, FormStateInterface $form_state){
        
    }

    /**
     * {@inheritdoc}
     * Form submission handler.
     * Overrides FormInterface::submitForm
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $values = $form_state->getValues();
        $this->config('weather_cast.settings')
             ->set('app', $values)
             ->save();
        parent::submitForm($form, $form_state);
    }
}
