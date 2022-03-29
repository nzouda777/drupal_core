<?php 

/**
 * @file
 * Contains \Drupal\rsvplist\Form\RSVPForm
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * provides an RSVP EMAIL FORM;
 */

class RSVPForm extends FormBase{
/**
 * (@heritage)
 */
public function getFormId(){
    return 'rsvplist_email_form';
}
public function buildForm(array $form, FormStateInterface $form_state){
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->nid->value;
    $form['email'] = array(
        '#title' => t('Email address'),
        '#type' => 'textfield',
        '#size' => 25,
        '#description' => t("we'll send updates to the email address your provide."),
        '#required' => TRUE,
    );
    $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('RSPV'),
    );
    $form['nid'] = array(
        '#type' => 'hidden',
        '#value' => $nid,
    );
    return $form;
}
public function validateForm(array &$form, FormStateInterface $form_state){
    $value = $form_state->getValue('email');
    if($value == !\Drupal::service('email.validator')->isValid($value)){
        $form_state->setErrorByName('email', t('the email address %mail is not valid', array('%mail' => $value)));
    }
}
public function submitForm(array &$form, FormStateInterface $form_state){
    drupal_set_message(t('the form is working.'));
}
}

?>