
# JoinSaveSkin

[![](https://poggit.pmmp.io/shield.state/joinskinsave)](https://poggit.pmmp.io/p/joinskinsave)

[![](https://poggit.pmmp.io/shield.api/joinskinsave)](https://poggit.pmmp.io/p/joinskinsave)

![joinskinsavesetumei](https://user-images.githubusercontent.com/43107628/116814514-508f2500-ab94-11eb-82c3-d6a7d114b016.png)

Select language:
[日本語](#日本語)
[English](#English)

## 日本語

### Requirement
* gd

#### Enable GD Library
`extension=php_gd.dll`のコメントアウトを解除します
php.ini
```diff
- ;extension=php_gd.dll
+ extension=php_gd.dll
```

### Usage
* pluginsフォルダにプラグインpharを入れます
* サーバーに参加します
* プレイヤーのスキンデータ(png)が保存されます！

`plugin_data/joinskinsave/<プレイヤー名>/<Y-m-d-H-i-s>.png`
 
### Author
* tatchan

### SpecialThanks
* suinua
* [参照したコード](https://gist.github.com/suinua/315d8239dce060615e184acf2264bbfe)

## English

### Requirement
* gd

#### Enable GD Library
Uncomment `extension=php_gd.dll`
php.ini
```diff
- ;extension=php_gd.dll
+ extension=php_gd.dll
```

### Usage
* Place the plugin phar in the plugins folder
* Join the server
* The player's skin data (png) will be saved!

`plugin_data/joinskinsave/<player name>/<Y-m-d-H-i-s>.png`
 
### Author
* tatchan

### SpecialThanks
* suinua
* [Referenced code](https://gist.github.com/suinua/315d8239dce060615e184acf2264bbfe)
