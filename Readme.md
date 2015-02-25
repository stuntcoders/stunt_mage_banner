# Stuntcoders Banner

Banner is Magento extension that simplifies creating and managing banners.

## Usage
* Create banner - This can be done from admin panel (CMS -> Banner)
* Fetch banner or banner group on frontend

Getting banner data by id:
```php
<?php
	$banner = Mage::getModel('stuntcoders_banner/banner')->load(<banner id>);
?>
```

Getting banner data by code:
```php
<?php
	$banner = Mage::getModel('stuntcoders_banner/banner')->load('<banner code>', 'code');
?>
```

Rendering banner block:
```xml
<block type="stuntcoders_banner/banner" name="stuntcoders.banner" template="banner/banner.phtml">
    <action method="setData">
        <name>code</name>
        <value>banner code</value>
    </action>
</block>
```


To add your own classes and identifiers and output menu on frontend, you can use the following code:
```php
<?php
    $banners = Mage::getModel('stuntcoders_banner/banner')->getBannersByGroupCode(<banner group code>);
?>
```