UserAwareCommandBundle
======================

This Symfony bundle provides a user value to Doctrine Entities that implements [Gedmo Blameable](https://github.com/Atlantic18/DoctrineExtensions/blob/master/doc/blameable.md) when using Console commands.

Installation
------------

`composer require bentools/user-aware-command-bundle`

Then, enable the bundle into Symfony's AppKernel.php:

```php
# app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles() 
    {
        // ...
        $bundles[] = new BenTools\UserAwareCommandBundle\UserAwareCommandBundle();
    }
}
```

Usage
-----
The bundle just works out of the box, provided you already have the Blameable extension configured and working on your entities.
Your console command just has to implement `BenTools\UserAwareCommandBundle\Model\UserAwareInterface`, which contains no method:
```php
namespace AppBundle\Command;

use BenTools\UserAwareCommandBundle\Model\UserAwareInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DoMyCommand extends Command implements UserAwareInterface 
{
    protected function execute(InputInterface $input, OutputInterface $output) {
	    // ...
	}
}
```

By default, the bundle will bind the `System` user to your *createdBy* / *updatedBy* properties.

You can change this user per command run with the *--user* option:

`php bin/console do:mycommand --user Ben`

Advanced configuration
----------------------

```yaml
# app/config.yml

user_aware_command:
    user_name: System # change default user
    option_name: user # change default command option
    option_shortcut: u # set option shortcut
```