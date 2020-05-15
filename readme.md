<h2>ZN Framework Socket Package</h2>
<p>
Follow the steps below for installation and use.
</p>

<h3>Installation</h3>
<p>
You only need to run the following code for the installation.
</p>

```
composer require znframework/package-socket
```

<h3>Documentation</h3>
<p>
Click for <a href="https://docs.znframework.com/soket/soket-kutuphanesi">documentation</a> of your library.
</p>

<h3>Example Usage</h3>
<p>
Basic level usage is shown below.
</p>

```php
<?php require 'vendor/autoload.php';

# File: server.php
$socket = ZN\Socket\Server::run('tcp', '127.0.0.1', 8080);

$socket->live(function($socket)
{
    switch( $socket->read() )
    {
        case 'exit' : $socket->write('Goodbye!'); return;
        case 'write': $socket->write('Run write command.'); break;
        case 'read' : $socket->write('Run read command.'); break;

        default     : return;
    }
});

# File: client.php
$socket = ZN\Socket\Client::run('tcp', '127.0.0.1', 8080);

$socket->write($command);

echo $socket->read();
```