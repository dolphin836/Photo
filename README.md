# 网络图片批量下载

当我在写 [36Photo](https://github.com/dolphin836/36Photo) 项目时，需要从网络上下载一些免费的图片，于是就有了这个项目。

目前已经支持的网站

| 名称  | 地址   |  存储目录  | 命令 |
| -------- | :----- | :----- | :----- |
| Unsplash | [https://unsplash.com](https://unsplash.com) | /Photo/Unsplash | php unsplash.php |
| Awesome Wallpapers | [https://alpha.wallhaven.cc](https://alpha.wallhaven.cc) | /Photo/Wallhaven | php wallhaven.php |
| Bing | [https://bing.ioliu.cn](https://bing.ioliu.cn) | /Photo/Bing | php bing.php |
| Konachan | [https://konachan.com](https://konachan.com) | /Photo/Konachan | php konachan.php |
| Shopify | [https://burst.shopify.com](https://burst.shopify.com) | /Photo/Shopify | php shopify.php |

## 使用

1. 通过 Git 拉取项目到本地

```
$ git clone https://github.com/dolphin836/Photo.git
```

2. 进入项目根目录（默认名称 Photo），安装项目

```
$ composer install
```

3. 在根目录下创建 Photo 照片存储目录，并在 Photo 目录下创建每个网站各自对应的存储目录，Linux 系统注意首字母大写；
4. 运行下载命令