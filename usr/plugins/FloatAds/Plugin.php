<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * FloatAds 插件
 *
 * @package FloatAds
 * @version 1.0
 * @author chatgpt
 * @link https://example.com
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
        $leftAdImg = new Typecho_Widget_Helper_Form_Element_Text('leftAdImg', NULL, 'https://www.wikihow.com/images/thumb/d/d0/Mental_age_test.png/728px-Mental_age_test.png', _t('左侧广告图片链接'), _t('在这里输入左侧广告图片的链接'));
        $form->addInput($leftAdImg);

        $rightAdImg = new Typecho_Widget_Helper_Form_Element_Text('rightAdImg', NULL, 'https://www.wikihow.com/images/thumb/d/d0/Mental_age_test.png/728px-Mental_age_test.png', _t('右侧广告图片链接'), _t('在这里输入右侧广告图片的链接'));
        $form->addInput($rightAdImg);
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
        $rightAdImg = Typecho_Widget::widget('Widget_Options')->plugin('FloatAds')->rightAdImg;

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
    <img src="$leftAdImg" alt="左侧图片" width="100" height="450">
</div>
<div id="right-image" class="floating-image">
    <img src="$rightAdImg" alt="右侧图片" width="100" height="450">
</div>
EOT;
        }
    }
}

?>
