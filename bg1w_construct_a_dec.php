<?php

use phpseclib\Net\SSH2;

class DecentralizedNotifier {
    private $notifiers = [];
    private $message;

    public function __construct($notifiers) {
        $this->notifiers = $notifiers;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function notify() {
        foreach ($this->notifiers as $notifier) {
            $this->connectAndNotify($notifier);
        }
    }

    private function connectAndNotify($notifier) {
        $ssh = new SSH2($notifier['host']);
        if (!$ssh->login($notifier['username'], $notifier['password'])) {
            echo "Failed to connect to {$notifier['host']}\n";
            return;
        }

        $ssh->exec("notify-send '{$this->message}'");
        echo "Notified {$notifier['host']}\n";
    }
}

$notifiers = [
    [
        'host' => 'notifier1.example.com',
        'username' => 'notifier1',
        'password' => 'password1',
    ],
    [
        'host' => 'notifier2.example.com',
        'username' => 'notifier2',
        'password' => 'password2',
    ],
    // Add more notifiers as needed
];

_notifier = new DecentralizedNotifier($notifiers);
_notifier->setMessage('Hello from decentralized notifier!');
_notifier->notify();

?>