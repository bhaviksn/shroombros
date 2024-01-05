<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="container container--m-shrink">
	<div class="row row--m-vertical">
		<div class="column column--half column--padding-xl">
			<div class="card">
				<div class="form w-form">
					<h2 class="card-heading">
						<?php esc_html_e( 'Login', 'shroom-bros' ); ?>
					</h2>

					<form class="woocommerce-form woocommerce-form-login login form" action="#" method="post">
						<?php do_action( 'woocommerce_login_form_start' ); ?>

						<div class="form-fields">
							<input type="text" class="field field--icon field--user w-input" placeholder="Username or Email Address *" maxlength="256" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							<input type="password" class="field field--icon field--password w-input" placeholder="Password *" maxlength="256" name="password" id="password" autocomplete="current-password" />
						</div>

						<?php do_action( 'woocommerce_login_form' ); ?>

						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'shroom-bros' ); ?></span>
						</label>

						<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

						<button type="submit" class="button button--primary button--login w-button" name="login" value="<?php esc_attr_e( 'Log in', 'shroom-bros' ); ?>">
							<?php esc_html_e( 'Log in', 'shroom-bros' ); ?>
						</button>

						<p class="woocommerce-LostPassword lost_password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'shroom-bros' ); ?></a>
						</p>

						<?php do_action( 'woocommerce_login_form_end' ); ?>
					</form>
				</div>
			</div>
		</div>

		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
			<div class="column column--half column--padding-xl">
				<div class="card">
					<div class="form w-form">
                            <h2 class="card-heading card-heading--secondary">
                                <?php esc_html_e( 'Register', 'shroom-bros' ); ?>
                            </h2>

                            <form method="post" class="woocommerce-form woocommerce-form-register register form" action="#" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
                                <?php do_action( 'woocommerce_register_form_start' ); ?>

                                <div class="form-fields">
                                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                                        <input type="text" class="field field--icon field--user w-input" placeholder="<?php esc_html_e( 'Username *', 'shroom-bros' ); ?>" maxlength="256" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                    <?php endif; ?>
                                    
                                    <input type="email" class="field field--icon field--email w-input" placeholder="<?php esc_html_e( 'Email Address *', 'shroom-bros' ); ?>" maxlength="256" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
                                    
                                    <input type="password" class="field field--icon field--password w-input" name="Password-2" data-name="Password 2" placeholder="<?php esc_html_e( 'Password *', 'shroom-bros' ); ?>" id="Password-2" required="">

                                    <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                        <input type="password" class="field field--icon field--password w-input" placeholder="<?php esc_html_e( 'Confirm Password *', 'shroom-bros' ); ?>" maxlength="256" name="password" id="reg_password" autocomplete="new-password" />
                                    <?php else : ?>
                                        <p><?php esc_html_e( 'A password will be sent to your email address.', 'shroom-bros' ); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php do_action( 'woocommerce_register_form' ); ?>
                                    
                                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

                                <button type="submit" class="button button--secondary button--signup w-button" name="register" value="<?php esc_attr_e( 'Sign Up', 'shroom-bros' ); ?>">
                                    <?php esc_html_e( 'Sign Up', 'shroom-bros' ); ?>
                                </button>

                                <?php do_action( 'woocommerce_register_form_end' ); ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
