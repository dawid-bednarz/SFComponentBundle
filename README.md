# DESCRIPTION
Common logic for SF DawBed Bundle
# INSTALLATION
``
composer require dawid-bednarz/sf-component-bundle
``

1 Register Listener (%project_dir%/config/services.yaml)
```yaml
  App\EventListener\ErrorListener:
    tags:
      - { name: kernel.event_listener, event: !php/const DawBed\ComponentBundle\Event\Events::ERROR_RESPONSE } # hande ExceptionErrorEvent::class || FormErrorEvent::class
```

# COMMANDS
Checking if you have all required registered listeners
```
bin/console dawbed:debug:event_listener  
```
