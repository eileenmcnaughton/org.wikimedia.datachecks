<?php

/**
 * Run data checks.
 *
 * @param $params
 * @return array
 */
function civicrm_api3_data_check($params) {
  $options = datachecks_civicrm_data_fix_get_options();
  if (!empty($params['check'])) {
    $options = array_intersect_key($options, array_flip((array) $params['check']));
  }
  $result = array();
  foreach ($options as $option) {
    $checkObject = new $option['class'];
    $result[$option['name']] = $checkObject->check();
  }
  return civicrm_api3_create_success($result);
}

/**
 * Spec for data check action.
 *
 * @param array $params
 */
function _civicrm_api3_data_check_spec(&$params) {
  $params['check'] = array(
    'options' => datachecks_civicrm_data_get_option_pairs(),
    'name' => 'check',
    'type' => CRM_Utils_Type::T_STRING,
    'description' => ts('Specify the check to run'),
  );
}
