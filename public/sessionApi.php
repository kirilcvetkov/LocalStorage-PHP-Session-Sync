<?php

require_once '../app.php';

$json = json_decode(file_get_contents('php://input'), true);

if (empty($json['auth']) || ! SetSessionAuth::getInstance()->validate($json['auth'])) {
    exit('Unauthorized');
}

switch ($json['action']) {
    case 'get':
        exit(json_encode(['response' => LocalStorageSession::getInstance()->get($json['name'] ?? null)]));

    case 'set':
        json_encode(['response' =>
            LocalStorageSession::getInstance()->set(
                $json['name'] ?? null,
                $json['value'] ?? null
            )
        ]);
        exit(json_encode(['response' => true]));

    case 'delete':
        json_encode(['response' => LocalStorageSession::getInstance()->delete($json['name'] ?? null)]);
        exit(json_encode(['response' => true]));
}
