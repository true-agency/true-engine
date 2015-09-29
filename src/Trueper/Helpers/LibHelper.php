<?php
namespace Trueper\Helpers;

/**
 * Collection of help
 */
class LibHelper {


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
