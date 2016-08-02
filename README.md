UserAwareCommandBundle
======================

Provides a user value to Doctrine Entities that implements [Gedmo Blameable](https://github.com/Atlantic18/DoctrineExtensions/blob/master/doc/blameable.md) when using Console commands.

Installation
------------

`composer require bentools/user-aware-command-bundle`

Usage
-----
The bundle just works out of the box, provided you already have the Blameable extension configured and working on your entities.
Your console command just has to implement `BenTools\UserAwareCommandBundle\Model\UserAwareInterface`, which contains no method. 
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