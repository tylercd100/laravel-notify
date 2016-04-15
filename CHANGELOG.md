# Changelog

All notable changes to `laravel-notify` will be documented in this file.

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
