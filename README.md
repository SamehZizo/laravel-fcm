# Laravel FCM
Firebase Cloud Messaging handler Package

## Setup

#### 1. Add libary to composer.json
```sh
  "require": {
      "sameh/laravel-fcm": "*"
  }
  ```
```sh
"repositories": [
      {
          "type": "vcs",
          "url": "git@github.com:SamehZizo/laravel-fcm.git"
      }
  ]
  ```

#### 2. Run below command to update install
```sh
composer install
  ```

#### 3. Create class that implements FCMManagerResponse interface to handle responses
```sh
FCMResponse implements FCMManagerResponse
  ```
  
## Use

- #### Change menu file
  ###### Change "menu_layout" variable in config -> laravel_system
