# Stuntcoders Banner

Module which enhances Magento CMS by adding allowing admins to create banners and add them to banner groups.

## Usage
* Create banner – This can be done from admin panel (CMS -> Banner)
* Fetch banner or banner group on frontend

Getting banner data by code:
```php
<?php
    $banner = Mage::getModel('stuntcoders_banner/banner')->load('<banner code>', 'code');
```

Rendering banner block:
```xml
<block type="stuntcoders_banner/banner" name="stuntcoders.banner" template="stuntcoders/banner/banner.phtml">
    <action method="setCode"><value>example-banner-code</value></action>
</block>
```

To get banenr from banner group:
```php
<?php
    $group = Mage::getModel('stuntcoders_banner/banner_group')->load('<banner group code>', 'code');
    foreach ($group->getBannerColelction() as $banner) {
       ...
    }
```

Rendering banner group block:
```xml
<block type="stuntcoders_banner/banne_groupr" name="stuntcoders.banner.group" template="stuntcoders/banner/group.phtml">
    <action method="setCode"><value>example-banner-group-code</value></action>
</block>
```
