# 山河与像素 / zqlovegis-theme

`zqlovegis.cn` 当前使用的自定义 WordPress 主题仓库。  
这个项目不是通用模板，而是一个围绕个人博客持续打磨的主题代码库：中文写作为主，兼顾 GIS、遥感、WebGIS、开发笔记与个人展示。

## 项目定位

这个主题目前的目标很明确：

- 做一个中文优先的个人博客，而不是标准作品集模板
- 保留一点“纸面感”和个人写作气质
- 让首页、关于页、文章页保持统一风格
- 用尽量少的依赖完成主题层控制

现在的页面方向包括：

- 首页：双栏个人博客首页
- 关于页：个人介绍与研究/技术背景
- 文章页：统一阅读页样式
- 归档页：与首页同一套阅读语气

## 当前技术方案

这个仓库现在已经不是早期的 block theme 结构，而是更偏向“自定义 PHP 模板 + 自定义样式”的轻量主题。

核心点：

- 首页使用 `front-page.php`
- 关于页使用 `page-about.php`
- 文章页使用 `single.php`
- 普通页面使用 `page.php`
- 归档/列表页使用 `index.php`
- 公共逻辑放在 `functions.php`
- 主要视觉样式集中在 `style.css`

站点里还在继续使用 WordPress 本身的内容管理能力：

- 文章内容在 WordPress 后台编写
- 页面内容与模板由主题控制
- GitHub 统计图通过站点侧代理接口输出

## 目录结构

```text
.
├─ assets/
│  ├─ css/
│  ├─ images/
│  │  └─ favicon.svg
│  └─ js/
├─ parts/
│  ├─ footer.html
│  └─ header.html
├─ front-page.php
├─ functions.php
├─ index.php
├─ page-about.php
├─ page.php
├─ single.php
├─ style.css
└─ theme.json
```

## 文件说明

- [front-page.php](/D:/Project/Myblog/front-page.php)：首页模板，负责首页双栏结构、个人资料卡、文章列表等
- [page-about.php](/D:/Project/Myblog/page-about.php)：关于页模板
- [single.php](/D:/Project/Myblog/single.php)：单篇文章页模板
- [page.php](/D:/Project/Myblog/page.php)：普通页面模板
- [index.php](/D:/Project/Myblog/index.php)：文章归档/列表页模板
- [functions.php](/D:/Project/Myblog/functions.php)：主题初始化、公共头尾、图标与技能徽章辅助函数
- [style.css](/D:/Project/Myblog/style.css)：主题元信息与主要样式
- [theme.json](/D:/Project/Myblog/theme.json)：WordPress 全局样式变量与基础配置

## 本地开发

推荐把这个仓库直接放到本地 WordPress 环境的主题目录中：

```text
wp-content/themes/zqlovegis-theme
```

然后在 WordPress 后台启用该主题。

### 建议工作流

1. 在本地修改模板或样式
2. 本地查看页面效果
3. 提交并推送到 GitHub
4. 服务器执行更新脚本同步主题

## 线上部署

当前线上部署方式是：

1. GitHub 仓库保存主题源码
2. 服务器通过脚本拉取 `main` 分支压缩包
3. 覆盖 `/www/wwwroot/wordpress/wp-content/themes/zqlovegis-theme`

也就是说，这个仓库管理的是“主题代码”，不是整个 WordPress 站点。

## 不建议纳入仓库的内容

以下内容不应该放进这个仓库：

- WordPress 核心程序
- 数据库内容
- `wp-content/uploads` 媒体文件
- 服务器密码、密钥、敏感配置

其中 [inf.md](/D:/Project/Myblog/inf.md) 只用于本地协作，已经通过 `.gitignore` 排除，不应提交。

## 内容管理说明

主题负责样式和结构，文章内容仍然建议在 WordPress 后台管理。

常见操作：

- 写文章：后台 `文章`
- 改页面：后台 `页面`
- 调整站点基础设置：后台 `设置`

也就是说：

- GitHub 管代码
- WordPress 后台管内容

## 设计原则

目前这个主题在视觉上遵循这些原则：

- 中文优先，不写成生硬的英文模板站
- 保留个人博客的书写感，而不是产品落地页语气
- 页面允许克制的设计细节，但不追求过度装饰
- 模板服务于内容，尤其服务于文章阅读

## 后续可继续打磨的方向

- 文章页的代码块、引用、图片题注样式
- 分类页、标签页、搜索页
- 更完整的导航状态与移动端体验
- 更细的中文排版节奏
- 评论区样式与页脚信息结构

---

## English Summary

This repository contains the custom WordPress theme used by `zqlovegis.cn`.

It is a personal blog theme rather than a generic portfolio template. The current codebase is centered on:

- a custom homepage template
- a custom about page
- custom post/page/archive templates
- a Chinese-first writing experience
- lightweight theme-level control with minimal dependencies

Theme content is managed in WordPress admin, while this repository only tracks theme code and assets.
