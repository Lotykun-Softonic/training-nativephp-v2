# INSTRUCTIONS

## Consideration for understanding this document
- This document tires to guide you to set up a Laravel project with Sail and the prerequisites for mobile app development using Laravel.
- It is very important to distinguish between the commands executed in this document on your native machine and those commands that should be executed inside Docker.
    - Each command that is marked in this document with the icon `🟦` should be executed in your terminal or command prompt inside your `native machine`.
    - Each command that is marked in this document with the icon `🟩` should be executed in your terminal or command prompt inside the running Sail container.

## Prerequisites
Before you begin, ensure you have met the following requirements:
- You have installed [Docker](https://www.docker.com/get-started) on your machine.
- You have installed [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git) on your machine.
- You have a terminal or command prompt available.
- You have PHP 8.0.2 or higher installed on your machine.
- You have [Composer](https://getcomposer.org) installed on your machine.

### Develop In MacOS
#### Create Android Apps
- You have installed adb on your machine. You can install it via [Homebrew](https://brew.sh/) by running the command `brew install android-platform-tools`.
    - You have to check if adb is working by running the command `adb devices` in your terminal. If it is working, you should see a list of connected devices.
- You have installed JAVA JDK 11 or higher on your machine. You can download it from [Adoptium](https://adoptium.net/).
- You have installed [Android Studio](https://developer.android.com/studio) on your machine. (optional, but recommended, it will install the Android SDK, AVD Manager, Java, and adb for you)
#### Create IOS Apps
- You have installed [Xcode](https://developer.apple.com/xcode/) on your machine. (optional, but recommended, it will install the iOS SDK, Simulator, and other tools for you)

### Develop In Linux
#### Create Android Apps
- You have installed adb on your machine. You can install it via your package manager. For example, on Ubuntu, you can run the command `sudo apt-get install adb`.
    - You have to check if adb is working by running the command `adb devices` in your terminal. If it is working, you should see a list of connected devices.
- You have installed JAVA JDK 11 or higher on your machine. You can download it from [Adoptium](https://adoptium.net/).
- You have installed [Android Studio](https://developer.android.com/studio) on your machine. (optional, but recommended, it will install the Android SDK, AVD Manager, Java, and adb for you)
#### Create IOS Apps
- Not tested yet.

### Device prerequisites
#### Create Android Apps
- You have enabled Developer Options on your Android device. To do this, go to Settings > About Phone > Tap on Build Number 7 times. Then go back to Settings > System > Developer Options > Enable USB Debugging.
- You have connected your Android device to your computer via USB cable
- You have allowed USB debugging on your Android device when prompted.
#### Create IOS Apps
- You have enabled Developer Options on your iOS device. [Developer Mode](https://developer.apple.com/documentation/xcode/enabling-developer-mode-on-a-device)
- You have connected your iOS device to your computer via USB cable.
- You have trusted the computer on your iOS device when prompted.
- You have to add your device as registered device in your Apple Developer account. [Registering Your Devices](https://developer.apple.com/documentation/xcode/registering-your-devices)

## 🟦 Install Laravel
To install Laravel, you need to have [Composer](https://getcomposer.org) installed on your machine. Once Composer is installed, you can create a new Laravel project by running the following command in your terminal:

Replace `your-project-name` with the desired name of your project.
```bash
composer create-project laravel/laravel your-project-name
```

## 🟦 Install Sail
Laravel Sail is a lightweight command-line interface for interacting with Laravel's default Docker development environment. To install Sail, navigate to your Laravel project directory and run the following command:

```bash
cd your-project-name
composer require laravel/sail --dev
php artisan sail:install
```

## 🟦 Start Laravel Sail
To start Laravel Sail, run the following command in your terminal:

```bash
./vendor/bin/sail up
```
This command will start the Docker containers for your Laravel application. You can access your application at `http://localhost`. Depending on port configuration, you might need to access it via `http://localhost:8000` or another port specified in your `docker-compose.yml` file.

## 🟦 Connect to the running sail container
Replace `{CONTAINER_ID}` with the actual container ID of your running Sail container. You can find it by running the command `docker ps` in your terminal.

```bash
docker exec -it {CONTAINER_ID} bash 
```

## 🟩 Update dependencies
To ensure you have the latest dependencies, run the followings commands burt these commands should be executed `inside the running Sail container`.

### Update Composer dependencies
```bash
cd /var/www/html
composer update
```

### Update NPM dependencies
```bash
cd /var/www/html
npm update
```

## Check Laravel installation
To check if Laravel is installed correctly, you can go to your web browser and navigate to `http://localhost` or `http://localhost:8000` (depending on your port configuration). You should see the Laravel welcome page.

## 🟩 Install Laravel Tallstack
To install Laravel Tallstack, run the following commands `inside the running Sail container`:

```bash
cd /var/www/html
composer require livewire/livewire laravel-frontend-presets/tall
php artisan ui tall
npm install && npm run dev
```

## Check Laravel Tallstack installation
To check if Laravel Tallstack is installed correctly, you can go to your web browser and navigate to `http://localhost` or `http://localhost:8000` (depending on your port configuration). You should see the Laravel welcome page with Livewire and Tailwind CSS loaded.

## Install Flux
To install Flux, run the following commands:

### 🟩 Install Flux package via Composer
Install the Flux package by running the following command `inside the running Sail container`:

```bash
cd /var/www/html
composer require livewire/flux
```

### 🟦 Change files permissions
To ensure that the web server can write to the necessary directories, you need to change the permissions

Replace `{USER}` and `{GROUP}` with your actual user and group names. This command should be executed in your terminal `inside your native machine`.
```bash
cd your-project-name
sudo chown -R {USER}:{GROUP} *
```

### 🟦 Include flux dependencies in your `base.blade.php` file
Open the `resources/views/layouts/base.blade.php` file and add the following lines before the closing `</head>` tag:
```html
@fluxStyles
``` 
And add the following lines before the closing `</body>` tag:
```html
@fluxScripts
```

## 🟩 Create Livewire component
To create a Livewire component, run the following command `inside the running Sail container`:
```bash
cd /var/www/html
php artisan make:livewire ExampleComponent
```

### 🟦 Change files permissions
To ensure that the web server can write to the necessary directories, you need to change the permissions
Replace `{USER}` and `{GROUP}` with your actual user and group names. This command should be executed in your terminal `inside your native machine`.
```bash
cd your-project-name
sudo chown -R {USER}:{GROUP} *
```

## 🟩 Compile assets
To compile the assets, run the following command `inside the running Sail container`:
```bash
cd /var/www/html
npm run build
```

## 🟦 Edit Env NativePHP variables
Open the `.env` file and add the following lines at the end of the file:
```env
NATIVEPHP_APP_ID="com.yourdomain.yourapp"
NATIVEPHP_APP_VERSION="DEBUG"
NATIVEPHP_APP_VERSION_CODE="1"
```

## Install NativePHP components
### 🟦 Include nativePHP repository in your `composer.json` file
Open the `composer.json` file and add the following lines to the `repositories` section:
```json
"repositories": [
    {
        "type": "composer",
        "url": "https://nativephp.composer.sh"
    }
],
```

### 🟩 Install nativePHP components via Composer
To install nativePHP components, run the following command `inside the running Sail container`:
```bash
cd /var/www/html
composer require nativephp/mobile
```

This will ask for credentials. This will be provided you by the director of the workshop.

### 🟦 Change files permissions
To ensure that the web server can write to the necessary directories, you need to change the permissions
Replace `{USER}` and `{GROUP}` with your actual user and group names. This command should be executed in your terminal `inside your native machine`.
```bash
cd your-project-name
sudo chown -R {USER}:{GROUP} *
```

## 🟦 Install NativePHP launcher
To install NativePHP launcher, run the following command in your terminal `inside your native machine`:
```bash
cd your-project-name
php artisan native:install
```

### Force Platform installation
If you encounter issues with the SO installation, you can force the installation by running the following command in your terminal `inside your native machine`:

Replace `{platform}` with `android` or `ios` depending on your target platform.
```bash
cd your-project-name
php artisan native:install --force {platform}
```

## 🟦 Run NativePHP launcher
First you have to collect the device ID by running the command `adb devices` in your terminal. This command should be executed in your terminal `inside your native machine`. You should see a list of connected devices. Copy the device ID of your connected device.
To run NativePHP launcher, connect your device via USB and run the following command in your terminal `inside your native machine`:
You should ensure that your device is connected, recognized by your machine and in USB debugging mode.

Replace `{platform}` with `android` or `ios` depending on your target platform.
```bash
cd your-project-name
php artisan native:run {platform} ZY22JB8HDX
``` 

The command will ask you for select the build type.
- Select `debug` for development.
- Select `release` for production.

