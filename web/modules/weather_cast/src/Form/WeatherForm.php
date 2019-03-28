<?php
namespace Drupal\weather_cast\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
class WeatherForm extends ConfigFormBase {
    public function getFormId()
    {
        return 'weather_cast.settings';
    }
    protected function getEditableConfigNames() {
        return [ 
          'weather_cast.settings',
        ];
    }
    
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config=$this->config('weather_cast.settings');
        $form['appid']=[
            '#type'=> 'textfield',
            '#title'=> $this->t('App ID'),
            '#default_value'=>$config->get('app'),   
            
        ];
        return parent::buildForm($form, $form_state); 
    }
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        
    }
    public function submitForm(array &$form, FormStateInterface $form_state) 
    {
        $values = $form_state->getValues();
        $this->config('weather_cast.settings')
            ->set('app', $values)
            ->save();
        parent::submitForm($form, $form_state);
    }
}