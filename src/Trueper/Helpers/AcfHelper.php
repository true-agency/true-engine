<?php
namespace Trueper\Helpers;

/**
 * Helper for AdvancedCustomFields
 */
class AcfHelper {
    use \Trueper\Traits\SingletonTrait;

    protected $theme = null;
    protected $lib = null;

    /**
     * Set the theme helper instance
     *
     * @param Trueper\Helpers\ThemeHelper
     */
    public function setThemeHelper($theme)
    {
        $this->theme = $theme;
    }

    /**
     * Set the lib helper instance
     *
     * @param Trueper\Helpers\LibHelper
     */
    public function setLib($lib)
    {
        $this->lib = $lib;
    }

    public function createSocialButton($title, $key, $image, $url, $suffix = '')
    {
        if(trim($url) != '')
        {
            ?>
            <li class="social-<?= $image ?>">
                <a href="<?=$url?>" class="social-button <?=$image?>" target="_blank">
                    <img src="<?= $this->theme->url('social/social-' . $image . $suffix  . '.png')?>" alt="<?=$title?>" class="retina-image normal" />
                </a>
            </li>
            <?php
        }

    }

    /**
     * Print social links using font awesome
     * Need to make sure font awesome is included
     * @param  string $iconModifier [description]
     * @return [type]               [description]
     */
    public function printSocialAwesome($iconModifier = '')
    {
        if(get_field('social_accounts', 'option'))
        {
            while(has_sub_field('social_accounts', 'option'))
            {  
                $type = get_sub_field('account_type');
                $url = get_sub_field('account_url');
                $iconType = $type;
                if ($type == 'youtube') {
                    $iconType = 'youtube-play';
                }
                if(trim($url) != '')
                {
                    ?>
                    <li class="social-<?= $type ?>">
                        <a href="<?=$url?>" class="social-button <?=$type?>" target="_blank" title="<?= ucfirst($type) ?>">
                            <i class="fa fa-<?= $iconType ?> <?= $iconModifier ?>"></i>
                        </a>
                    </li>
                    <?php
                }
            }
        }
    }

    public function printSocialButtons($suffix = '')
    {
        if(get_field('social_accounts', 'option'))
        {
            while(has_sub_field('social_accounts', 'option'))
            {
                TrueLib::createSocialButton(ucfirst(strtolower(get_sub_field('account_type'))), 'social-' . get_sub_field('account_type'), get_sub_field('account_type'), get_sub_field('account_url'), $suffix);
            }
        }
    }

    public function getFooterCopyright()
    {
        if (function_exists('get_field')) {
            return str_replace('%year%', date('Y'), get_field('footer_copyright', 'option'));
        } else {
            return '';
        }
    }
    
}
