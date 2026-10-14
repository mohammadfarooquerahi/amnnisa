<?php
/**
 * Template Name: Legal Team & Collaborators
 * Description: Dedicated page template for Amannisa Legal Team, Society Members & Collaborators.
 *
 * @package Amannisa
 */

get_header();
?>

<div class="wrap" style="padding-top: 40px; padding-bottom: 80px;">
    <div class="ph">
        <span class="pill"><?php esc_html_e( 'Legal & Collaborators', 'amannisa' ); ?></span>
        <h1><?php esc_html_e( 'Legal Support, Team & Collaborators', 'amannisa' ); ?></h1>
        <p><?php esc_html_e( 'Trusted advocates, dedicated society members, and collaborative partners advancing women\'s safety together.', 'amannisa' ); ?></p>
    </div>

    <div class="amn-jump-nav" aria-label="Section Quick Links">
        <a href="#legal-team" class="amn-jump-pill">⚖ <?php esc_html_e( 'Legal Team', 'amannisa' ); ?></a>
        <a href="#team-members" class="amn-jump-pill">👥 <?php esc_html_e( 'Team Members', 'amannisa' ); ?></a>
        <a href="#collaborators-section" class="amn-jump-pill">🤝 <?php esc_html_e( 'Collaborators', 'amannisa' ); ?></a>
    </div>

    <div class="amn-wrap">
        <!-- LEGAL TEAM -->
        <section class="amn-sec" id="legal-team">
            <span class="amn-tag"><?php esc_html_e( 'Legal Team', 'amannisa' ); ?></span>
            <h2><?php esc_html_e( 'Legal Support', 'amannisa' ); ?> <span><?php esc_html_e( 'You Can Trust', 'amannisa' ); ?></span></h2>
            <p class="amn-sub"><?php esc_html_e( 'Our legal team guides survivors through reporting, rights and next steps with care, confidentiality and respect.', 'amannisa' ); ?></p>

            <div class="amn-grid amn-grid-legal">
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/rabia.png' ) ); ?>" alt="Rabia Samo" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Rabia Samo</h3>
                    <div class="amn-role"><?php esc_html_e( 'Advocate', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( '15+ years of experience handling harassment cases.', 'amannisa' ); ?></p>
                </div>
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/afsheen.png' ) ); ?>" alt="Afsheen Naz Bhutto" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Afsheen Naz Bhutto</h3>
                    <div class="amn-role"><?php esc_html_e( 'Advocate', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( '15+ years of experience handling harassment cases.', 'amannisa' ); ?></p>
                </div>
            </div>
            <div class="amn-note">
                <span style="font-size: 20px; line-height: 1;">🛡️</span>
                <div>
                    <strong><?php esc_html_e( 'Confidential & Safe', 'amannisa' ); ?>:</strong> <?php esc_html_e( 'Amnnisa provides legal guidance and support. Every report is handled confidentially.', 'amannisa' ); ?>
                </div>
            </div>
        </section>

        <!-- TEAM MEMBERS -->
        <section class="amn-sec" id="team-members">
            <span class="amn-tag"><?php esc_html_e( 'Team Members', 'amannisa' ); ?></span>
            <h2><?php esc_html_e( 'The People', 'amannisa' ); ?> <span><?php esc_html_e( 'Behind Amnnisa', 'amannisa' ); ?></span></h2>
            <p class="amn-sub"><?php esc_html_e( 'Dedicated members who volunteer their time, skills and heart to make women safer.', 'amannisa' ); ?></p>
            <div class="amn-grid">
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/paras.png' ) ); ?>" alt="Paras Bhutto" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Paras Bhutto</h3>
                    <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                </div>
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/huzaifa.png' ) ); ?>" alt="Huzaifa Junejo" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Huzaifa Junejo</h3>
                    <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                </div>
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/umar.png' ) ); ?>" alt="Umar Qureshi" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Umar Qureshi</h3>
                    <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                </div>
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/younis.png' ) ); ?>" alt="Syed Younis Shah" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Syed Younis Shah</h3>
                    <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                </div>
                <div class="amn-card">
                    <div class="amn-av">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/aina.png' ) ); ?>" alt="Aina Syed" loading="lazy" decoding="async" width="96" height="96">
                    </div>
                    <h3>Aina Syed</h3>
                    <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                    <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                </div>
            </div>
        </section>

        <!-- COLLABORATORS -->
        <section class="amn-sec" id="collaborators-section">
            <span class="amn-tag"><?php esc_html_e( 'Collaborators', 'amannisa' ); ?></span>
            <h2><?php esc_html_e( 'Our', 'amannisa' ); ?> <span><?php esc_html_e( 'Partners & Collaborators', 'amannisa' ); ?></span></h2>
            <p class="amn-sub"><?php esc_html_e( 'Organizations and institutions that support Amnnisa\'s mission.', 'amannisa' ); ?></p>
            <div class="amn-collab">
                <div class="amn-logo">
                    <img src="<?php echo esc_url( amannisa_asset( 'images/draftify.png' ) ); ?>" alt="Draftify" loading="lazy" decoding="async" width="170" height="85" style="border-radius:18px">
                    <b>Draftify</b>
                    <small><?php esc_html_e( 'Strategic Partner', 'amannisa' ); ?></small>
                </div>
                <div class="amn-logo">
                    <img src="<?php echo esc_url( amannisa_asset( 'images/women.png' ) ); ?>" alt="WomenWheelz" loading="lazy" decoding="async" width="170" height="85">
                    <b>WomenWheelz</b>
                    <small><?php esc_html_e( 'Collaborator & Mobility Partner', 'amannisa' ); ?></small>
                </div>
                <div class="amn-logo">
                    <img src="<?php echo esc_url( amannisa_asset( 'images/yen.png' ) ); ?>" alt="YEN" loading="lazy" decoding="async" width="170" height="85">
                    <b>YEN</b>
                    <small><?php esc_html_e( 'Youth Empowerment Network', 'amannisa' ); ?></small>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
