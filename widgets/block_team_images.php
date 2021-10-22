<?php
/**
 * My New Plugin
 *
 * @package           myNewPlugin
 * @author            Kibria
 * @copyright         2021 Kibria or Skill-ice
 * @license           GPL-2.0-or-later
 */

class My_block_team_images extends \Elementor\Widget_Base {

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
        return 'myNewWidget02';
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
        return __( 'My New Widget 02', 'my-New-Plugin' );
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
            'team_image1',
            [
                'label' => __( 'Choose Image', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'team_image2',
            [
                'label' => __( 'Choose Image', 'my-New-Plugin' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'team_image3',
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
        <div class="row pb-3">
          <div class="col text-center">
            <h1>  <?php echo $settings['text_title_h1'] ?>  </h1>
          </div>
        </div>
        <div class="row pt-5 justify-content-center align-items-center">
          <div class="col-3">
            <img alt="image" class="img-fluid" src="<?php echo $settings['team_image1']['url']; ?>">
          </div>
          <div class="col-3 offset-1">
            <img alt="image" class="img-fluid" src="<?php echo $settings['team_image2']['url']; ?>">
          </div>
          <div class="col-3 offset-1">
            <img alt="image" class="img-fluid" src="<?php echo $settings['team_image3']['url']; ?>">
          </div>
        </div>
      </div>
    </section>


        <?php
        // ------- my code end -------------
    }

}