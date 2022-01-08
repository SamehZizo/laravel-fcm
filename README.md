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

#### 2. Run below command to update composer
```sh
composer update
  ```

#### 3. Create class that implements FCMManagerResponse interface to handle responses
```sh
FCMResponse implements FCMManagerResponse
  ```
  
#### 4. Add firebase server key to config (config folder -> app.php file) with key 'firebase_server_key'
```sh
'firebase_server_key' => The Key
  ```
  
## Use

- #### Send Message to Topic
```sh
  FCMManager::send_message_to_topic(data, topic, FCMResponse interface)
  ```
  
  - #### Send Message to Tokens
  ```sh
  FCMManager::send_message_to_topic(data, tokens, FCMResponse interface)
  ```
