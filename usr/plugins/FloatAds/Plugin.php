<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * FloatAds 插件
 *
 * @package FloatAds
 * @version 1.0
 * @author chatgpt
 * @link https://github.com/dylanbai8
 */
class FloatAds_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法, 如果激活失败, 丢出异常
     *
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->footer = array('FloatAds_Plugin', 'renderAds');
    }

    /**
     * 禁用插件方法, 如果禁用失败, 丢出异常
     *
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @param Typecho_Widget_Helper_Form $form 配置面板
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $leftAdImg = new Typecho_Widget_Helper_Form_Element_Text('leftAdImg', NULL, 'https://pic.616pic.com/ys_img/00/05/26/v5exFzB3eh.jpg', _t('左侧广告图片'), _t('图片尺寸：宽100px 高450px'));
        $form->addInput($leftAdImg);
        $leftAdImg_url = new Typecho_Widget_Helper_Form_Element_Text('leftAdImg_url', NULL, 'https://typecho.org/', _t('左侧广告链接'), _t('广告跳转链接'));
        $form->addInput($leftAdImg_url);

        $rightAdImg = new Typecho_Widget_Helper_Form_Element_Text('rightAdImg', NULL, 'https://pic.616pic.com/ys_img/00/05/26/v5exFzB3eh.jpg', _t('右侧广告图片'), _t('图片尺寸：宽100px 高450px'));
        $form->addInput($rightAdImg);
        $rightAdImg_url = new Typecho_Widget_Helper_Form_Element_Text('rightAdImg_url', NULL, 'https://typecho.org/', _t('右侧广告链接'), _t('广告跳转链接'));
        $form->addInput($rightAdImg_url);
    }

    /**
     * 个人用户的配置面板
     *
     * @param Typecho_Widget_Helper_Form $form
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     * 渲染广告位
     */
    public static function renderAds()
    {
        $leftAdImg = Typecho_Widget::widget('Widget_Options')->plugin('FloatAds')->leftAdImg;
        $leftAdImg_url = Typecho_Widget::widget('Widget_Options')->plugin('FloatAds')->leftAdImg_url;
        $rightAdImg = Typecho_Widget::widget('Widget_Options')->plugin('FloatAds')->rightAdImg;
        $rightAdImg_url = Typecho_Widget::widget('Widget_Options')->plugin('FloatAds')->rightAdImg_url;

        if ($leftAdImg || $rightAdImg) {
            echo <<<EOT
<style>
@media screen and (max-width: 768px) {
    .floating-image { display: none; }
}
.floating-image {
    position: fixed;
    top: 60px;
    z-index: 9999;
    width: 100px;
    height: 450px;
}
#left-image {
    left: 0;
}
#right-image {
    right: 0;
}
</style>
<div id="left-image" class="floating-image">
    <a href="$leftAdImg_url" target="_blank">
        <img src="$leftAdImg" alt="左侧图片" width="100" height="450">
    </a>
</div>
<div id="right-image" class="floating-image">
    <a href="$rightAdImg_url" target="_blank">
        <img src="$rightAdImg" alt="右侧图片" width="100" height="450">
    </a>
</div>
EOT;
        }
    }
}

?>
