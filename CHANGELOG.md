# Changelog

All notable changes to `laravel-notify` will be documented in this file.

### 2.1.0
- Auto Package Discovery
- Removed support for 5.4, 5.3, 5.2, 5.1

### 2.0.0
- Fixed outdated dependencies for laravel 5.5
- Removed support for PHP 5.5.9

### 1.8.5
- Correctly sets text/html on SMTP emails

### 1.8.4
- Added LineFormatter with newlines enabled to the Fleephook, Hipchat, Pushover, Raven, and Slack handlers

### 1.8.3
- Quick fix! Correctly sets text/html on native emails (non-SMTP)

### 1.8.2
- Emails now use the content type text/html

### 1.8.1
- Added LineFormatter with newlines enabled to the mail and mailgun handlers

### 1.8.0
- Added Mailgun support

### 1.7.0
- Added psr/log interfaces

### 1.6.0
- Added support for Raven (A driver for Sentry)

### 1.5.0
- Can now set the SMS character limit from the config

### 1.4.3
- Fixed config

### 1.4.2
- Config will now default to an empty array if config is null

### 1.4.1
- Removed array_merge_recursive which was not correctly merging config values that were provided in the constructor

### 1.4.0
- Added Flowdock and FleepHook support

### 1.3.1
- Fixed Plivo acting as Twilio

### 1.3.0
- Added Plivo and Twilio support

### 1.2.0
- Added email support

### 1.1.1
- Can now set the title from the constructor

### 1.1.0
- Added ability to change the title/subject

### 1.0.1
- Fixed array to string conversion error

### 1.0.0
- Initial release and connected with packagist
