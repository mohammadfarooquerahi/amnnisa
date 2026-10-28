<?php
/**
 * Footer template for Amannisa theme
 * Fully editable via WordPress Customizer.
 *
 * @package Amannisa
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$footer_blurb          = amannisa_get_option( 'footer_blurb', 'Securing women\'s dignity and empowering women through legal guidance, technical guidance, moral support, and innovation.' );
$footer_founder_credit = amannisa_get_option( 'footer_founder_credit', 'Founded by Homair Nisar · MUET Business Incubation Center' );
$footer_copyright      = amannisa_get_option( 'footer_copyright', 'Built with ♥ for dignity & safety.' );
$contact_email         = amannisa_get_option( 'contact_email', 'amnnisafoundation@gmail.com' );
$contact_location      = amannisa_get_option( 'contact_location', 'Business Incubation Center, Mehran University of Engineering and Technology (MUET), Jamshoro' );
$contact_instagram     = amannisa_get_option( 'contact_instagram', 'https://www.instagram.com/amannisa_pk' );
$contact_whatsapp      = amannisa_get_option( 'contact_whatsapp', 'https://whatsapp.com/channel/0029Vb7sh2jI7BeKLp1uf13O' );
?>
</main><!-- #main-content -->

<footer class="site-footer">
    <div class="wrap">
        <div class="fg">
            <!-- Brand & Mission Column -->
            <div>
                <?php
                $footer_logo_url = amannisa_get_option( 'brand_logo_image' );
                if ( empty( $footer_logo_url ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
                    $footer_logo_id = get_theme_mod( 'custom_logo' );
                    $footer_logo_data = wp_get_attachment_image_src( $footer_logo_id, 'full' );
                    if ( $footer_logo_data ) {
                        $footer_logo_url = $footer_logo_data[0];
                    }
                }
                if ( empty( $footer_logo_url ) ) {
                    $footer_logo_url = amannisa_asset( 'images/logo.jpg' );
                }
                ?>
                <img class="footer-logo" src="<?php echo esc_url( $footer_logo_url ); ?>" alt="Amnnisa Logo" width="58" height="58">
                <p style="font-size: 15px; line-height: 1.6; color: #cfc6b4; margin-bottom: 18px;">
                    <?php echo esc_html( $footer_blurb ); ?>
                </p>
                <div style="display: flex; gap: 12px; align-items: center;">
                    <?php if ( ! empty( $contact_instagram ) ) : ?>
                    <a href="<?php echo esc_url( $contact_instagram ); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; color: var(--pink); font-weight: 600;">
                        <span>◎</span> Instagram
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $contact_instagram ) && ! empty( $contact_whatsapp ) ) : ?>
                    <span style="color: #555;">·</span>
                    <?php endif; ?>
                    <?php if ( ! empty( $contact_whatsapp ) ) : ?>
                    <a href="<?php echo esc_url( $contact_whatsapp ); ?>" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 6px; color: #70d655; font-weight: 600;">
                        <span>💬</span> WhatsApp
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h4><?php esc_html_e( 'Quick Links', 'amannisa' ); ?></h4>
                <a href="#home"><?php esc_html_e( 'Home', 'amannisa' ); ?></a>
                <a href="#about"><?php esc_html_e( 'About Us', 'amannisa' ); ?></a>
                <a href="#team"><?php esc_html_e( 'Our Team', 'amannisa' ); ?></a>
                <a href="#collaborators"><?php esc_html_e( 'Legal & Collaborators', 'amannisa' ); ?></a>
                <a href="#involved"><?php esc_html_e( 'Get Involved', 'amannisa' ); ?></a>
                <a href="#contact"><?php esc_html_e( 'Contact', 'amannisa' ); ?></a>
            </div>

            <!-- Take Action Column -->
            <div>
                <h4><?php esc_html_e( 'Take Action', 'amannisa' ); ?></h4>
                <a href="#involved:idea"><?php esc_html_e( 'Share an Idea', 'amannisa' ); ?></a>
                <a href="#involved:case"><?php esc_html_e( 'Report a Case', 'amannisa' ); ?></a>
                <a href="#involved:join"><?php esc_html_e( 'Join the Mission', 'amannisa' ); ?></a>
                <a href="#involved:track"><?php esc_html_e( 'Track Your Report', 'amannisa' ); ?></a>
                <a href="#involved:donate"><?php esc_html_e( 'Support / Donate', 'amannisa' ); ?></a>
            </div>

            <!-- Reach Us Column -->
            <div>
                <h4><?php esc_html_e( 'Reach Us', 'amannisa' ); ?></h4>
                <p style="font-size: 14px; color: #cfc6b4; line-height: 1.6; margin-bottom: 12px;">
                    📍 <?php echo esc_html( $contact_location ); ?>
                </p>
                <a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>" style="color: var(--pink); word-break: break-all;">
                    ✉ <?php echo esc_html( $contact_email ); ?>
                </a>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="fb">
            <span>
                <?php echo esc_html( $footer_founder_credit ); ?>
            </span>
            <span>
                © <?php echo date( 'Y' ); ?> Amnnisa. <?php echo esc_html( $footer_copyright ); ?>
            </span>
        </div>
        <div style="text-align: center; margin-top: 14px; padding-bottom: 6px;">
            <a href="https://www.linkedin.com/in/mohammadfarooque/" target="_blank" rel="noopener noreferrer" class="dev-credit" style="font-size: 11px; color: #ffffff; opacity: 0.10; text-decoration: none; transition: opacity 0.3s ease; letter-spacing: 0.04em; display: inline-block;" onmouseover="this.style.opacity='0.20'" onmouseout="this.style.opacity='0.10'">
                Developed by Mohammad Farooque
            </a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
