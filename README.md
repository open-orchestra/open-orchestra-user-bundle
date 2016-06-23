# open-orchestra-user-bundle

| Service       | Badge         |
| ------------- |:-------------:|
| Travis | [![Build Status](https://travis-ci.org/open-orchestra/open-orchestra-user-bundle.svg?branch=1.1)](https://travis-ci.org/open-orchestra/open-orchestra-user-bundle) |
| Sensio Insight | [![SensioLabsInsight](https://insight.sensiolabs.com/projects/9fb35126-d98c-41d6-9a90-ad9fa269aa60/big.png)](https://insight.sensiolabs.com/projects/9fb35126-d98c-41d6-9a90-ad9fa269aa60) |
| Code Climate (Quality) | [![Code Climate](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/badges/gpa.svg)](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle) |
| Code Climate (Code coverage) | [![Test Coverage](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/badges/coverage.svg)](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/coverage) |
| Latest Stable Version | [![Latest Stable Version](https://poser.pugx.org/open-orchestra/open-orchestra-user-bundle/v/stable)](https://packagist.org/packages/open-orchestra/open-orchestra-user-bundle) |
| Total Downloads | [![Total Downloads](https://poser.pugx.org/open-orchestra/open-orchestra-user-bundle/downloads)](https://packagist.org/packages/open-orchestra/open-orchestra-user-bundle) |

## Usage with mongo db

To use the `open-orchestra-user-bundle` you should also activate and configure the `FosUserBundle`

Configuration :

``` yaml
    fos_user:
        db_driver: mongodb
        firewall_name: main
        user_class: %user_class%
        group:
            group_class: %group_class%
```

In this configuration you can choose a parameter :

 - `user_class` : either your own user class or `OpenOrchestra\UserBundle\Document\User`
 - `group_class : either :
   - Your own group class
   - If you use the `open-orchestra-cms-bundle` : `OpenOrchestra\GroupBundle\Document\Group`
   - If you use only the `open-orchestra-user-bundle` : `OpenOrchestra\UserBundle\Document\Group`

## Usage with another database

To use the `open-orchestra-user-bundle` with another database, you should :

 - follow the `FosUserBundle` documentation on how to use the database
 - Create your own user class, and configure the bundle with the correct parameters
