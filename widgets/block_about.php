<?php
/**
 * My New Plugin
 *
 * @package           myNewPlugin
 * @author            Kibria
 * @copyright         2021 Kibria or Skill-ice
 * @license           GPL-2.0-or-later
 */

class My_block_about extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve myNewPlugin widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'myNewWidget01';
    }

    /**
     * Get widget title.
     *
     * Retrieve myNewPlugin widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'My New Widget 01', 'my-New-Plugin' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve myNewPlugin widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'fa fa-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the myNewPlugin widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'basic','mynewplugincat' ];
    }

    /**
     * Register myNewPlugin widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'my-New-Plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_title_h1',
            [
                'label' => __( 'Title', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'My Title', 'my-New-Plugin' ),
                'placeholder' => __( 'Type Your Title', 'my-New-Plugin' ),
            ]
        );

        $this->add_control(
            'text_description',
            [
                'label' => __( 'Description', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __( 'Type Your description', 'my-New-Plugin' ),
                'placeholder' => __( 'Type your description here', 'my-New-Plugin' ),
            ]
        );
$repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'btn_text',
            [
                'label' => __( 'Button Text', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Download', 'my-New-Plugin' ),
                'placeholder' => __( 'Type Text', 'my-New-Plugin' ),
            ]
        );


        $repeater->add_control(
            'btn_link',
            [
                'label' => __( 'Link', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'my-New-Plugin' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'btn_repeater',
            [
                'label' => __( 'Add new button', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'btn_text' => __( 'Button 01', 'my-New-Plugin' ),
                    ],
                    [
                        'btn_text' => __( 'Button 02', 'my-New-Plugin' ),
                    ],
                ],
                'title_field' => '{{{ btn_text }}}',
            ]
        );



        $this->add_control(
            'side_image',
            [
                'label' => __( 'Choose Image', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );



        $this->end_controls_section();

    }

    /**
     * Render myNewPlugin widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();
        // ------- my code start -----------
        ?>


        <section class="fdb-block">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-12 col-md-6 mb-4 mb-md-0">
                <img alt="image" class="img-fluid" src="<?php echo $settings['side_image']['url']; ?>">
              </div>
              <div class="col-12 col-md-6 col-lg-5 ml-md-auto text-left">
                <h1> <?php echo $settings['text_title_h1'] ?> </h1>
                <p class="lead">  <?php echo $settings['text_description'] ?>  </p>

                    <?php 

                        if ( $settings['btn_repeater'] ) {
                            echo '<p>';
                            foreach (  $settings['btn_repeater'] as $item ) {
                                ?>
                                <a class="btn btn-secondary mt-4" href=" <?php echo $item['btn_link']['url'] ?> "> <?php echo $item['btn_text'] ?> </a>
                                <?php

                            }
                            echo '</p>';
                        }


                     ?>

                
              </div>
            </div>
          </div>
        </section>


        <?php
        // ------- my code end -------------
    }

}