<?php
/*
Plugin Name: Octopus8 CiviCRM Status Updater - Stripe Plugin
Plugin URI: https://www.octopus8.com/
Description: Octopus8 Custom Plugin to update the status of contribution inside CiviCRM from Stripe payment.
Version: 1.0.0
Author: SU
Author URI: https://www.octopus8.com/
*/

// Function to trigger the update by calling an external script
function trigger_civicrm_status_update($activity_id, $status_code)
{
    include_once '/var/www/html/wp-content/plugins/civicrm/civicrm.settings.php';
    civicrm_initialize();

    try {

        $results = civicrm_api4('Activity', 'update', [
            'values' => [
                'status_id' => $status_code,
            ],
            'where' => [
                ['id', '=', $activity_id],
            ],
            'checkPermissions' => TRUE,
        ]);


        error_log("CiviCRM Activity update result sumy: " . print_r($results, true));
        return "Successfully Updated Yayyyy";
    } catch (Exception $e) {
        error_log('Failed to update CiviCRM activity status sumy: ' . $e->getMessage());

        return "Error sumy";
    }

}
