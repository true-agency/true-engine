<?php
namespace Trueper\Helpers;

class LibHelper {

    public function getThemeUrl()
    {
        return get_template_directory_uri();
    }

    public function getThemeDir($path = '')
    {
        return get_template_directory() . $path;
    }

    public function getCSS($css)
    {
        return get_template_directory_uri() . '/assets/css/' . $css . '.css';
    }

    public function getJS($js)
    {
        return get_template_directory_uri() . '/assets/js/' . $js . '.js';
    }

    public function createSocialButton($title, $key, $image, $url, $suffix = '')
    {
        if(trim($url) != '')
        {
            ?>
            <li class="social-<?= $image ?>">
                <a href="<?=$url?>" class="social-button <?=$image?>" target="_blank">
                    <img src="<?=self::getImageURL('social/social-' . $image . $suffix  . '.png')?>" alt="<?=$title?>" class="retina-image normal" />
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

    public function getTemplatePart($name)
    {
        get_template_part('page-templates/partials/' . $name);
    }


    /* Get Image with ACF
    /* name = acf key / filename
    /* class = string
    /*
    /* ACF Specific:
    /* id = integer
    /* acf = true / false
    /* size = string
    /* subfield = true / false

    /* Standard Image:
    /* retina = true / false - not applicable to acf

    /* -------------------------------------------------- */
    public function getImage($args)
    {
        $name = $size = $alt = $class = '';
        $acf = true;
        $retina = false;
        $subfield = false;
        $id = get_the_ID();
        extract($args);

        if($acf)
        {
            if($subfield)
            {
                $image = get_sub_field($name);
            } else {

              $image = get_field($name, $id);
            }

              //If we have an image, display it!
            if($image)
            {
                if($size != '')
                {
                    $imageURL = $image['sizes'][$size];
                } else {
                    $imageURL = $image['url'];
                }

                $str = '<img ';
                if($class != '')
                {
                    $str .= 'class="' . $class . '"';
                }

                return $str . ' src="' . $imageURL . '" alt="' . $image['alt'] . '">';
            }
          } else {
              if($retina)
              {
                  $class .= ' retina-image';
              }

              $str = '<img ';
              if($class != '')
              {
                  $str .= 'class="' . trim($class) . '"';

              }
              return  $str . ' src="' . self::getImageUrl($url) . '" alt="' . $alt  . '">';
          }
          return '';
      }


    /* Get Image with ACF
    /* Args, an array for acf images, or string for a standard image from assets
    /*
    /* name = acf key / filename
    /* subfield = true / false
    /* id = postid
    /* acf = true / false
    /* size = string
    /* ---------------------------------------*/
    public function getImageUrl($args)
    {
        if(is_array($args))
        {
            $name = $size = $alt = $class = '';
            $subfield = false;
            $id = get_the_ID();
            extract($args);
            if($subfield)
            {
                $image = get_sub_field($name);
            } else {

                $image = get_field($name, $id);
            }


            if($image)
            {
                if($size != '')
                {
                    $imageURL = $image['sizes'][$size];
                } else {
                    $imageURL = $image['url'];
                }

                return $imageURL;
            }
        } else {
            return get_template_directory_uri() . '/assets/img/' . $args;
        }

        return '';
    }

    public function getDescriptionField($field, $sub = false, $postID = null)
    {
        ?>
        <div class="page-description entry-content">
        <?php
                if($sub)
                {
                    echo get_sub_field($field);
                } else {
                    echo get_field($field, $postID);
                }
            ?>
        </div>
        <?php
    }

    public function getChildPages($post_id)
    {
        $pages_children = get_pages('child_of='.$post_id.'&hierarchical=0&parent='.$post_id.'&sort_column=menu_order');
        return $pages_children;
    }

    /**
     * Debug utilities
     */

    public function printVar($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    /**
     * To use this, add hook somewhere in theme.php file
     * add_action('admin_init', array('TrueLib', 'showMenuStructure'));
     * 
     */
    public function showMenuStructure()
    {
        echo '<pre>'.print_r($GLOBALS['menu'], true).'</pre>';
    }
}
