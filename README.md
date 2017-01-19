# Ip Filter

Magento 2.x CE module for filtering IP addresses on storefront.

## Installation Instructions

1. Use composer to download the module:

   ```
   composer require mageware/magento2-ip-filter
   ```

2. Enable downloaded module:

   ```
   php bin/magento module:enable MageWare_Common MageWare_IpFilter
   ```

3. Upgrade your database:

   ```
   php bin/magento setup:upgrade
   ```
