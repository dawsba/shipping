<?php

/**
 * Developed by Barrie Dawson
 * Email: bdawson@pandorasystems.net
 * Tel : 07944 834 170
 */


// Demo of structure

// Autoloader for example purpose
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// debug log for quick test
$log = '';

/**
 * Start new instance of Daily batch
 *
 * Presume we have no existing data and no ORM/Entity
 */
$batch = new \Models\Batch();

// Start the batch and capture the start time
$log .= $batch->startBatch()->format('YmdHis') . '<br>';

// Consignment 1
// Sending parcel data to RoyalMail on end of day Email
$batch->newConsignment(
    $batch->getCourierByName('RoyalMail'),
    array(
        'test1',
        'test2',
    )
);

// Consignment 2
// Sending parcel data to ANC on end of day FTP
$batch->newConsignment(
    $batch->getCourierByName('ANC'),
    array(
        'test3',
        'test4',
    )
);

// Get a var list of all consignments for debug or dump
$log .= print_r($batch->getConsignments(), true) . '<br>';

// End of day - EndBatch - capture timestamp
$log .= $batch->endBatch()->format('YmdHis') . '<br>';

// Dump debug log for example use
print_r($log);